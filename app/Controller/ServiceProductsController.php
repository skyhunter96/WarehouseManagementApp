<?php
App::uses('AppController', 'Controller');
/**
 * ServiceProducts Controller
 *
 * @property ServiceProduct $ServiceProduct
 * @property PaginatorComponent $Paginator
 */
class ServiceProductsController extends AppController {

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
		$this->set('status', $this->ServiceProduct->status);
		$this->set('tax', $this->ServiceProduct->tax);
		$this->loadModel('MeasurementUnit');
		$this->loadModel('ItemType');
		$this->loadModel('Item');
		$this->loadModel('Good');
		$this->loadModel('Kit');
		$this->loadModel('Product');
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
			$this->ServiceProduct->recursive = 0;
			$this->paginate = array(
				'conditions' => array('Item.is_deleted' => false, 'Item.name LIKE' => '%' . $keyword . '%')
			);
			$this->set('serviceProducts', $this->Paginator->paginate());
		}else{
		$this->ServiceProduct->recursive = 0;
		$this->paginate = array(
			'conditions' => array('Item.is_deleted' => false)
		);
		$this->set('serviceProducts', $this->Paginator->paginate());}

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
		if (!$this->ServiceProduct->exists($id)) {
			throw new NotFoundException(__('Invalid serviceProduct'));
		}
		$options = array('conditions' => array('ServiceProduct.' . $this->ServiceProduct->primaryKey => $id));
		$serviceProduct = $this->ServiceProduct->find('first', $options);
		$this->set('serviceProduct', $serviceProduct);
		$this->set('measurement_unit', $this->MeasurementUnit->findById($serviceProduct['Item']['measurement_unit_id']));
		$this->set('item_type', $this->ItemType->findById($serviceProduct['Item']['item_type_id']));
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
					'item_type_id' => $this->request->data['Item']['ItemTypeId'],
					'is_deleted' => false
				),
				'ServiceProduct' => array(
					'pid' => $pid,
					'status' => $this->request->data['ServiceProduct']['status'],
					'hts_number' => $this->request->data['ServiceProduct']['hts_number'],
					'tax_group' => $this->request->data['ServiceProduct']['tax_group'],
					'eccn' => $this->request->data['ServiceProduct']['eccn'],
					'release_date' => $this->request->data['ServiceProduct']['release_date'],
					'is_for_distributors' => $this->request->data['ServiceProduct']['is_for_distributors'],
					'project' => $this->request->data['ServiceProduct']['project'],
				)
			);

			$this->ServiceProduct->create();
			$this->Item->create();

			if($this->ServiceProduct->saveAssociated($data, array('validate' => 'first'))){
				$this->Flash->success(__('The serviceProduct has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			if($this->ServiceProduct->validationErrors || $this->Item->validationErrors){
				$this->Flash->warning(array($this->ServiceProduct->validationErrors, $this->Item->validationErrors), array('key' => 'negative'));
			}
			else{
				$this->Flash->error(__('The serviceProduct could not be saved. Please, try again.'));
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
		if (!$this->ServiceProduct->exists($id)) {
			throw new NotFoundException(__('Invalid serviceProduct'));
		}
		$this->load();

		if($id){
			$this->request->data['ServiceProduct']['id'] = $id;
			$serviceProduct = $this->ServiceProduct->findById($this->request->data['ServiceProduct']['id']);
			$this->request->data['Item']['id'] = $serviceProduct['Item']['id'];
		}

		if ($this->request->is(array('post', 'put'))) {

			$data = array(
				'Item' => array(
					'id' => $this->request->data['Item']['id'],
					'name' => $this->request->data['Item']['name'],
					'description' => $this->request->data['Item']['description'],
					'is_deleted' => false
				),
				'ServiceProduct' => array(
					'id' => $this->request->data['ServiceProduct']['id'],
					'status' => $this->request->data['ServiceProduct']['status'],
					'hts_number' => $this->request->data['ServiceProduct']['hts_number'],
					'tax_group' => $this->request->data['ServiceProduct']['tax_group'],
					'eccn' => $this->request->data['ServiceProduct']['eccn'],
					'release_date' => $this->request->data['ServiceProduct']['release_date'],
					'is_for_distributors' => $this->request->data['ServiceProduct']['is_for_distributors'],
					'project' => $this->request->data['ServiceProduct']['project'],
				)
			);

			if($this->ServiceProduct->saveAssociated($data, array('validate' => 'first'))){
				$this->Flash->success(__('The serviceProduct has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			if($this->ServiceProduct->validationErrors || $this->Item->validationErrors){
				$this->Flash->warning(array($this->ServiceProduct->validationErrors, $this->Item->validationErrors), array('key' => 'negative'));
			}
			else{
				$this->Flash->error(__('The serviceProduct could not be updated. Please, try again.'));
			}

		}
		else {
			$options = array('conditions' => array('ServiceProduct.' . $this->ServiceProduct->primaryKey => $id));
			$this->request->data = $this->ServiceProduct->find('first', $options);
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
		if (!$this->ServiceProduct->exists($id)) {
			throw new NotFoundException(__('Invalid serviceProduct'));
		}
		$this->loadModel('Item');
		$this->request->allowMethod('post', 'delete');
		$serviceProduct = $this->ServiceProduct->findById($id);
		$this->Item->read(null, $serviceProduct['ServiceProduct']['item_id']);
		$this->Item->set('is_deleted', true);

		if($serviceProduct['ServiceProduct']['status'] == 'obsolete'){
			if ($this->Item->save()) {
				$this->Flash->success(__('The serviceProduct has been deleted.'));
			} else {
				$this->Flash->error(__('The serviceProduct could not be deleted. Please, try again.'));
			}
		} else{
			$this->Flash->error(__('This serviceProduct is in use, therefore it cannot  be deleted, please change its status first'));
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

		$data = $this->ServiceProduct->find('all');
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
