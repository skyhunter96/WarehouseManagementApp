<?php
App::uses('AppController', 'Controller');
App::uses('MeasurementUnit', 'Model');
App::uses('ItemType', 'Model');
App::uses('Item', 'Model');
/**
 * Inventories Controller
 *
 * @property Inventory $Inventory
 * @property PaginatorComponent $Paginator
 */
class InventoriesController extends AppController {

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
		$this->set('status', $this->Inventory->status);
		$this->set('recommended_rating', $this->Inventory->recommended_rating);
		$this->loadModel('MeasurementUnit');
		$this->loadModel('ItemType');
		$this->loadModel('Item');
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
 * index method
 *
 * @return void
 */
	public function index() {
		if ($this->request->is(array('post', 'put'))) {
			$keyword = $this->request->data['Item']['keywords'];
			$this->Inventory->recursive = 0;
			$this->paginate = array(
				'conditions' => array('Item.is_deleted' => false, 'Item.name LIKE' => '%' . $keyword . '%')
			);
			$this->set('inventories', $this->Paginator->paginate());
		}else{
		$this->Inventory->recursive = 0;
		$this->paginate = array(
			'conditions' => array('Item.is_deleted' => false)
		);
		$this->set('inventories', $this->Paginator->paginate());}
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
		if (!$this->Inventory->exists($id)) {
			throw new NotFoundException(__('Invalid inventory'));
		}
		$options = array('conditions' => array('Inventory.' . $this->Inventory->primaryKey => $id));
		$inventory = $this->Inventory->find('first', $options);
		$this->set('inventory', $inventory);
		$this->set('measurement_unit', $this->MeasurementUnit->findById($inventory['Item']['measurement_unit_id']));
		$this->set('item_type', $this->ItemType->findById($inventory['Item']['item_type_id']));

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->load();

		if($this->request->is('post')){
			$finalCode = $this->setCode($this->request->data['Item']['ItemTypeId']);

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
				'Inventory' => array(
					'status' => $this->request->data['Inventory']['status'],
					'recommended_rating' => $this->request->data['Inventory']['recommended_rating']
				)
			);

			$this->Inventory->create();
			$this->Item->create();

			if($this->Inventory->saveAssociated($data, array('validate' => 'first'))){
				$this->Flash->success(__('The inventory has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			if($this->Inventory->validationErrors || $this->Item->validationErrors){
				$this->Flash->warning(array($this->Inventory->validationErrors, $this->Item->validationErrors), array('key' => 'negative'));
			}
			else{
				$this->Flash->error(__('The inventory could not be saved. Please, try again.'));
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
		if (!$this->Inventory->exists($id)) {
			throw new NotFoundException(__('Invalid inventory'));
		}
		$this->load();
		if($id){
			$this->request->data['Inventory']['id'] = $id;
			$inventory = $this->Inventory->findById($this->request->data['Inventory']['id']);
			$this->request->data['Item']['id'] = $inventory['Item']['id'];
			$itemTypeCode = $inventory['Item']['code'];
		}

		if ($this->request->is(array('post', 'put'))) {

			$typeId = $this->request->data['Item']['ItemTypeId'];
			$typeCode = $this->ItemType->findById($typeId);
			$code = $typeCode['ItemType']['code'];
			$totalItems = count($this->Item->findAllByItemTypeId($typeId));  //+ 1;
			$hasItems = $totalItems;
			$totalItems++;
			$finalCode = $code . '-' . $totalItems;

			if($this->request->data['Item']['ItemTypeId'] == $inventory['Item']['item_type_id']){
				$finalCode = $itemTypeCode;
			}
			else if(($this->request->data['Item']['ItemTypeId'] != $inventory['Item']['item_type_id']) && $hasItems){
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
				'Inventory' => array(
					'id' => $this->request->data['Inventory']['id'],
					'status' => $this->request->data['Inventory']['status'],
					'recommended_rating' => $this->request->data['Inventory']['recommended_rating'],
				)
			);

			if($this->Inventory->saveAssociated($data, array('validate' => 'first'))){
				$this->Flash->success(__('The inventory has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			if($this->Inventory->validationErrors || $this->Item->validationErrors){
				$this->Flash->warning(array($this->Inventory->validationErrors, $this->Item->validationErrors), array('key' => 'negative'));
			}
			else{
				$this->Flash->error(__('The inventory could not be updated. Please, try again.'));
			}

		}
		else {
			$options = array('conditions' => array('Inventory.' . $this->Inventory->primaryKey => $id));
			$this->request->data = $this->Inventory->find('first', $options);
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
		if (!$this->Inventory->exists($id)) {
			throw new NotFoundException(__('Invalid inventory'));
		}
		$this->loadModel('Item');
		$this->request->allowMethod('post', 'delete');
		$inventory = $this->Inventory->findById($id);
		$this->Item->read(null, $inventory['Inventory']['item_id']);
		$this->Item->set('is_deleted', true);

		if($inventory['Inventory']['status'] == 'obsolete'){
			if ($this->Item->save()) {
				$this->Flash->success(__('The inventory has been deleted.'));
			} else {
				$this->Flash->error(__('The inventory could not be deleted. Please, try again.'));
			}
		} else{
			$this->Flash->error(__('This inventory is in use, therefore it cannot  be deleted, please change its status first'));
		}

		return $this->redirect(array('action' => 'index'));
	}

    /**
     * init_tcpdf method
     * Initializes a pdf of all items of this type
     * @return void
     */
	public function init_tcpdf(){
		//Init PDF
		$pdf = null;
		while (!class_exists('PDF')) {
			//Init PDF
			App::import('Vendor', 'PDF', array('file' => 'tcpdf' . DS . 'pdf.php'));
		}

		$data = $this->Inventory->find('all');
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
