<?php
App::uses('AppController', 'Controller');
App::uses('ProductsController', 'Controller');
App::uses('MeasurementUnit', 'Model');
App::uses('ItemType', 'Model');
App::uses('Item', 'Model');
App::uses('Product', 'Model');
App::uses('ServiceProduct', 'Model');
App::uses('Good', 'Model');
/**
 * Kits Controller
 *
 * @property Kit $Kit
 * @property PaginatorComponent $Paginator
 */
class KitsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * load method
 *
 * @return void
 */

	public function load(){
		$this->set(compact('items'));
		$this->set('status', $this->Kit->status);
		$this->set('tax', $this->Kit->tax);
		$this->loadModel('MeasurementUnit');
		$this->loadModel('ItemType');
		$this->loadModel('Item');
		$this->loadModel('Product');
		$this->loadModel('Good');
		$this->loadModel('ServiceProduct');
		$this->set('measurement_units', $this->MeasurementUnit->getAll());
		$this->set('item_types', $this->ItemType->getAll());
	}

/**
 * setCode method
 * Sets code of this kit
 *
 * @param string $id
 * @return int
 */

	public function setCode($id){
		$this->load();
		$typeId = $id;
		$typeCode = $this->ItemType->findById($typeId);
		$code = $typeCode['ItemType']['code'];
		$totalItems = count($this->Item->findAllByItemTypeId($typeId)) + 1;
		$finalCode = $code . '-' . $totalItems;

		$conditions = array(
			'code' => $finalCode
		);
		if($this->Item->hasAny($conditions)){

			$last = $this->Item->find('all', array('conditions' => array('item_type_id' => $typeId), 'order' => array('Item.code' => 'DESC')));

			foreach($last as $l){
				$newCode = $l['Item']['code'];
				$newCode = explode('-', $newCode);
				$newCode = $newCode[1];
				$codes[] = $newCode;
			}
			$updatedCodeValue = max($codes) + 1;
			$finalCode = $code . '-' . $updatedCodeValue;
		}
		return $finalCode;
	}

/**
 * setPid method
 * @param
 * @return int
 */

	public function setPid(){
		$products = $this->Product->find('count');
		$goods = $this->Good->find('count');
		$kits = $this->Kit->find('count');
		$serviceProducts = $this->ServiceProduct->find('count');
		return $products + $goods + $kits + $serviceProducts;
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if ($this->request->is(array('post', 'put'))) {
			$keyword = $this->request->data['Item']['keywords'];
			$this->Kit->recursive = 0;
			$this->paginate = array(
				'conditions' => array('Item.is_deleted' => false, 'Item.name LIKE' => '%' . $keyword . '%')
			);
			$this->set('kits', $this->Paginator->paginate());
		}else{
		$this->Kit->recursive = 0;
		$this->paginate = array(
			'conditions' => array('Item.is_deleted' => false)
		);
		$this->set('kits', $this->Paginator->paginate());}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->load();
		if (!$this->Kit->exists($id)) {
			throw new NotFoundException(__('Invalid kit'));
		}
		$options = array('conditions' => array('Kit.' . $this->Kit->primaryKey => $id));
		$kit = $this->Kit->find('first', $options);
		$this->set('kit', $kit);
		$this->set('measurement_unit', $this->MeasurementUnit->findById($kit['Item']['measurement_unit_id']));
		$this->set('item_type', $this->ItemType->findById($kit['Item']['item_type_id']));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->load();

		if ($this->request->is('post')) {

			$finalCode = $this->setCode($this->request->data['Item']['ItemTypeId']);
			$pid = $this->setPid();

			$data = array(
				'Item' => array(
					'code' => $finalCode,
					'name' => $this->request->data['Item']['name'],
					'description' => $this->request->data['Item']['description'],
					'weight' => $this->request->data['Item']['weight'],
					'measurement_unit_id' => $this->request->data['Item']['measurement_unit_id'],
					'item_type_id' => $this->request->data['Item']['ItemTypeId'],
					'is_deleted' => false
				),
				'Kit' => array(
					'pid' => $pid,
					'status' => $this->request->data['Kit']['status'],
					'hts_number' => $this->request->data['Kit']['hts_number'],
					'tax_group' => $this->request->data['Kit']['tax_group'],
					'eccn' => $this->request->data['Kit']['eccn'],
					'release_date' => $this->request->data['Kit']['release_date'],
					'is_for_distributors' => $this->request->data['Kit']['is_for_distributors'],
					'hide_kit_kontent' => $this->request->data['Kit']['hide_kit_kontent']
				)
			);

			$this->Kit->create();
			$this->Item->create();

			if($this->Kit->saveAssociated($data, array('validate' => 'first'))){
				$this->Flash->success(__('The kit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			if($this->Kit->validationErrors || $this->Item->validationErrors){
				$this->Flash->warning(array($this->Kit->validationErrors, $this->Item->validationErrors), array('key' => 'negative'));
			}
			else{
				$this->Flash->error(__('The kit could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Kit->exists($id)) {
			throw new NotFoundException(__('Invalid kit'));
		}
		$this->load();

		if($id){
			$this->request->data['Kit']['id'] = $id;
			$kit = $this->Kit->findById($this->request->data['Kit']['id']);
			$this->request->data['Item']['id'] = $kit['Item']['id'];
			$itemTypeCode = $kit['Item']['code'];
		}

		if ($this->request->is(array('post', 'put'))) {

			$typeId = $this->request->data['Item']['item_type_id'];
			$typeCode = $this->ItemType->findById($typeId);
			$code = $typeCode['ItemType']['code'];
			$totalItems = count($this->Item->findAllByItemTypeId($typeId));  //+ 1;
			$hasItems = $totalItems;
			$totalItems++;
			$finalCode = $code . '-' . $totalItems;

			if($this->request->data['Item']['item_type_id'] == $kit['Item']['item_type_id']){
				$finalCode = $itemTypeCode;
			}
			else if(($this->request->data['Item']['item_type_id'] != $kit['Item']['item_type_id']) && $hasItems){
				$last = $this->Item->find('all', array('conditions' => array('item_type_id' => $typeId), 'order' => array('Item.code' => 'DESC')));

				foreach($last as $l){
					$newCode = $l['Item']['code'];
					$newCode = explode('-', $newCode);
					$newCode = $newCode[1];
					$codes[] = $newCode;
				}
				$updatedCodeValue = max($codes) + 1;
				$finalCode = $code . '-' . $updatedCodeValue;
			}

			$data = array(
				'Item' => array(
					'id' => $this->request->data['Item']['id'],
					'name' => $this->request->data['Item']['name'],
					'description' => $this->request->data['Item']['description'],
					'weight' => $this->request->data['Item']['weight'],
					'measurement_unit_id' => $this->request->data['Item']['measurement_unit_id'],
					'is_deleted' => false
				),
				'Kit' => array(
					'id' => $this->request->data['Kit']['id'],
					'status' => $this->request->data['Kit']['status'],
					'hts_number' => $this->request->data['Kit']['hts_number'],
					'tax_group' => $this->request->data['Kit']['tax_group'],
					'eccn' => $this->request->data['Kit']['eccn'],
					'release_date' => $this->request->data['Kit']['release_date'],
					'is_for_distributors' => $this->request->data['Kit']['is_for_distributors'],
					'hide_kit_kontent' => $this->request->data['Kit']['hide_kit_kontent']
				)
			);

			if($this->Kit->saveAssociated($data, array('validate' => 'first'))){
				$this->Flash->success(__('The kit has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			if($this->Kit->validationErrors || $this->Item->validationErrors){
				$this->Flash->warning(array($this->Kit->validationErrors, $this->Item->validationErrors), array('key' => 'negative'));
			}
			else{
				$this->Flash->error(__('The kit could not be updated. Please, try again.'));
			}

		}
		else {
			$options = array('conditions' => array('Kit.' . $this->Kit->primaryKey => $id));
			$this->request->data = $this->Kit->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->Kit->exists($id)) {
			throw new NotFoundException(__('Invalid kit'));
		}
		$this->loadModel('Item');
		$this->request->allowMethod('post', 'delete');
		$kit = $this->Kit->findById($id);
		$this->Item->read(null, $kit['Kit']['item_id']);
		$this->Item->set('is_deleted', true);

		if($kit['Kit']['status'] == 'obsolete'){
			if ($this->Item->save()) {
				$this->Flash->success(__('The kit has been deleted.'));
			} else {
				$this->Flash->error(__('The kit could not be deleted. Please, try again.'));
			}
		} else{
			$this->Flash->error(__('This kit is in use, therefore it cannot  be deleted, please change its status first'));
		}

		return $this->redirect(array('action' => 'index'));
	}

	public function init_tcpdf(){
		//Init PDF
		$pdf = null;
		while (!class_exists('PDF')) {
			//Init PDF
			App::import('Vendor', 'PDF', array('file' => 'tcpdf' . DS . 'pdf.php'));
		}

		$data = $this->Kit->find('all');
		$this->set('data', $data);

		$pdf = new PDF('L', 'mm','A4', true, 'UTF-8', false);
		$filename = 'materials';
		$this->set('filename', $filename);
		$this->set('pdf', $pdf);

		$this->layout = 'pdf';
		$this->autoRender = false;
		$this->response->type('application/pdf');

		$this->render('view_pdf');

	}

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view');
    }
}
