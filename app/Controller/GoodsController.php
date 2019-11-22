<?php
App::uses('AppController', 'Controller');
App::uses('ProductsController', 'Controller');
App::uses('MeasurementUnit', 'Model');
App::uses('ItemType', 'Model');
App::uses('Item', 'Model');
App::uses('Product', 'Model');
App::uses('ServiceProduct', 'Model');
App::uses('Kit', 'Model');
App::import('Controller', 'Products');
/**
 * Goods Controller
 *
 * @property Good $Good
 * @property PaginatorComponent $Paginator
 */
class GoodsController extends AppController {

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
		$this->set('status', $this->Good->status);
		$this->set('tax', $this->Good->tax);
		$this->loadModel('MeasurementUnit');
		$this->loadModel('ItemType');
		$this->loadModel('Item');
		$this->loadModel('Product');
		$this->loadModel('Kit');
		$this->loadModel('ServiceProduct');
		$this->set('measurement_units', $this->MeasurementUnit->getAll());
		$this->set('item_types', $this->ItemType->getAll());
	}

/**
 * setCode method
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
			$this->Good->recursive = 0;
			$this->paginate = array(
				'conditions' => array('Item.is_deleted' => false, 'Item.name LIKE' => '%' . $keyword . '%')
			);
			$this->set('goods', $this->Paginator->paginate());
		}else{
		$this->Good->recursive = 0;
		$this->paginate = array(
			'conditions' => array('Item.is_deleted' => false)
		);
		$this->set('goods', $this->Paginator->paginate());}
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
		if (!$this->Good->exists($id)) {
			throw new NotFoundException(__('Invalid good'));
		}
		$options = array('conditions' => array('Good.' . $this->Good->primaryKey => $id));
		$good = $this->Good->find('first', $options);
		$this->set('good', $good);
		$this->set('measurement_unit', $this->MeasurementUnit->findById($good['Item']['measurement_unit_id']));
		$this->set('item_type', $this->ItemType->findById($good['Item']['item_type_id']));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->load();

		if ($this->request->is('post')) {

			$finalCode = $this->setCode($this->request->data['Item']['item_type_id']);
			$pid = $this->setPid();

			$data = array(
				'Item' => array(
					'code' => $finalCode,
					'name' => $this->request->data['Item']['name'],
					'description' => $this->request->data['Item']['description'],
					'weight' => $this->request->data['Item']['weight'],
					'measurement_unit_id' => $this->request->data['Item']['measurement_unit_id'],
					'item_type_id' => $this->request->data['Item']['item_type_id'],
					'is_deleted' => false
				),
				'Good' => array(
					'pid' => $pid,
					'status' => $this->request->data['Good']['status'],
					'hts_number' => $this->request->data['Good']['hts_number'],
					'tax_group' => $this->request->data['Good']['tax_group'],
					'eccn' => $this->request->data['Good']['eccn'],
					'release_date' => $this->request->data['Good']['release_date'],
					'is_for_distributors' => $this->request->data['Good']['is_for_distributors'],
				)
			);

			$this->Good->create();
			$this->Item->create();

			if($this->Good->saveAssociated($data, array('validate' => 'first'))){
				$this->Flash->success(__('The good has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			if($this->Good->validationErrors || $this->Item->validationErrors){
				$this->Flash->warning(array($this->Good->validationErrors, $this->Item->validationErrors), array('key' => 'negative'));
			}
			else{
				$this->Flash->error(__('The good could not be saved. Please, try again.'));
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
		if (!$this->Good->exists($id)) {
			throw new NotFoundException(__('Invalid good'));
		}
		$this->load();

		if($id){
			$this->request->data['Good']['id'] = $id;
			$good = $this->Good->findById($this->request->data['Good']['id']);
			$this->request->data['Item']['id'] = $good['Item']['id'];
			$itemTypeCode = $good['Item']['code'];
		}

		if ($this->request->is(array('post', 'put'))) {

			$typeId = $this->request->data['Item']['item_type_id'];
			$typeCode = $this->ItemType->findById($typeId);
			$code = $typeCode['ItemType']['code'];
			$totalItems = count($this->Item->findAllByItemTypeId($typeId));  //+ 1;
			$hasItems = $totalItems;
			$totalItems++;
			$finalCode = $code . '-' . $totalItems;

			if($this->request->data['Item']['item_type_id'] == $good['Item']['item_type_id']){
				$finalCode = $itemTypeCode;
			}
			else if(($this->request->data['Item']['item_type_id'] != $good['Item']['item_type_id']) && $hasItems){
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
				'Good' => array(
					'id' => $this->request->data['Good']['id'],
					'status' => $this->request->data['Good']['status'],
					'hts_number' => $this->request->data['Good']['hts_number'],
					'tax_group' => $this->request->data['Good']['tax_group'],
					'eccn' => $this->request->data['Good']['eccn'],
					'release_date' => $this->request->data['Good']['release_date'],
					'is_for_distributors' => $this->request->data['Good']['is_for_distributors'],
				)
			);

			if($this->Good->saveAssociated($data, array('validate' => 'first'))){
				$this->Flash->success(__('The good has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			if($this->Good->validationErrors || $this->Item->validationErrors){
				$this->Flash->warning(array($this->Good->validationErrors, $this->Item->validationErrors), array('key' => 'negative'));
			}
			else{
				$this->Flash->error(__('The good could not be updated. Please, try again.'));
			}

		}
		else {
			$options = array('conditions' => array('Good.' . $this->Good->primaryKey => $id));
			$this->request->data = $this->Good->find('first', $options);
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
		if (!$this->Good->exists($id)) {
			throw new NotFoundException(__('Invalid good'));
		}
		$this->loadModel('Item');
		$this->request->allowMethod('post', 'delete');
		$good = $this->Good->findById($id);
		$this->Item->read(null, $good['Good']['item_id']);
		$this->Item->set('is_deleted', true);

		if($good['Good']['status'] == 'obsolete'){
			if ($this->Item->save()) {
				$this->Flash->success(__('The good has been deleted.'));
			} else {
				$this->Flash->error(__('The good could not be deleted. Please, try again.'));
			}
		} else{
			$this->Flash->error(__('This good is in use, therefore it cannot  be deleted, please change its status first'));
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

		$data = $this->Good->find('all');
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
