<?php
App::uses('AppController', 'Controller');
App::uses('MeasurementUnit', 'Model');
App::uses('ItemType', 'Model');
App::uses('Item', 'Model');
/**
 * Semiproducts Controller
 *
 * @property Semiproduct $Semiproduct
 * @property PaginatorComponent $Paginator
 */
class SemiproductsController extends AppController {

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
		$this->set('status', $this->Semiproduct->status);
		$this->loadModel('MeasurementUnit');
		$this->loadModel('ItemType');
		$this->loadModel('Item');
		$this->set('measurement_units', $this->MeasurementUnit->getAll());
		$this->set('item_types', $this->ItemType->getAll());
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if ($this->request->is(array('post', 'put'))) {
			$keyword = $this->request->data['Semiproduct']['keywords'];
			$this->Semiproduct->recursive = 0;
			$this->paginate = array(
				'conditions' => array('Item.is_deleted' => false, 'name LIKE' => '%' . $keyword . '%')
			);
			$this->set('semiproducts', $this->Paginator->paginate());
		}else{
		$this->Semiproduct->recursive = 0;
		$this->paginate = array(
			'conditions' => array('Item.is_deleted' => false)
		);
		$this->set('semiproducts', $this->Paginator->paginate());}
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
		if (!$this->Semiproduct->exists($id)) {
			throw new NotFoundException(__('Invalid semiproduct'));
		}
		$options = array('conditions' => array('Semiproduct.' . $this->Semiproduct->primaryKey => $id));
		$semiproduct = $this->Semiproduct->find('first', $options);
		$this->set('semiproduct', $semiproduct);
		$this->set('measurement_unit', $this->MeasurementUnit->findById($semiproduct['Item']['measurement_unit_id']));
		$this->set('item_type', $this->ItemType->findById($semiproduct['Item']['item_type_id']));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->load();

		if ($this->request->is('post')) {
			$typeId = $this->request->data['Item']['ItemTypeId'];
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
				'Semiproduct' => array(
					'status' => $this->request->data['Semiproduct']['status'],
					'is_for_service_production' => $this->request->data['Semiproduct']['is_for_service_production']
				)
			);

			$this->Semiproduct->create();
			$this->Item->create();

			if($this->Semiproduct->saveAssociated($data, array('validate' => 'first'))){
				$this->Flash->success(__('The semiproduct has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			if($this->Semiproduct->validationErrors || $this->Item->validationErrors){
				$this->Flash->warning(array($this->Semiproduct->validationErrors, $this->Item->validationErrors), array('key' => 'negative'));
			}
			else{
				$this->Flash->error(__('The semiproduct could not be saved. Please, try again.'));
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
		if (!$this->Semiproduct->exists($id)) {
			throw new NotFoundException(__('Invalid semiproduct'));
		}
		$this->load();
		if($id){
			$this->request->data['Semiproduct']['id'] = $id;
			$semiproduct = $this->Semiproduct->findById($this->request->data['Semiproduct']['id']);
			$this->request->data['Item']['id'] = $semiproduct['Item']['id'];
			$itemTypeCode = $semiproduct['Item']['code'];
		}

		if ($this->request->is(array('post', 'put'))) {

			$typeId = $this->request->data['Item']['item_type_id'];
			$typeCode = $this->ItemType->findById($typeId);
			$code = $typeCode['ItemType']['code'];
			$totalItems = count($this->Item->findAllByItemTypeId($typeId));  //+ 1;
			$hasItems = $totalItems;
			$totalItems++;
			$finalCode = $code . '-' . $totalItems;

			if($this->request->data['Item']['item_type_id'] == $semiproduct['Item']['item_type_id']){
				$finalCode = $itemTypeCode;
			}
			else if(($this->request->data['Item']['item_type_id'] != $semiproduct['Item']['item_type_id']) && $hasItems){
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
				'Semiproduct' => array(
					'id' => $this->request->data['Semiproduct']['id'],
					'status' => $this->request->data['Semiproduct']['status'],
					'is_for_service_production' => $this->request->data['Semiproduct']['is_for_service_production'],
				)
			);

			if($this->Semiproduct->saveAssociated($data, array('validate' => 'first'))){
				$this->Flash->success(__('The semiproduct has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			if($this->Semiproduct->validationErrors || $this->Item->validationErrors){
				$this->Flash->warning(array($this->Semiproduct->validationErrors, $this->Item->validationErrors), array('key' => 'negative'));
			}
			else{
				$this->Flash->error(__('The semiproduct could not be updated. Please, try again.'));
			}

		}
		else {
			$options = array('conditions' => array('Semiproduct.' . $this->Semiproduct->primaryKey => $id));
			$this->request->data = $this->Semiproduct->find('first', $options);
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
		if (!$this->Semiproduct->exists($id)) {
			throw new NotFoundException(__('Invalid semiproduct'));
		}
		$this->loadModel('Item');
		$this->request->allowMethod('post', 'delete');
		$semiproduct = $this->Semiproduct->findById($id);
		$this->Item->read(null, $semiproduct['Semiproduct']['item_id']);
		$this->Item->set('is_deleted', true);

		if($semiproduct['Semiproduct']['status'] == 'obsolete'){
			if ($this->Item->save()) {
				$this->Flash->success(__('The semiproduct has been deleted.'));
			} else {
				$this->Flash->error(__('The semiproduct could not be deleted. Please, try again.'));
			}
		} else{
			$this->Flash->error(__('This semiproduct is in use, therefore it cannot  be deleted, please change its status first'));
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

		$data = $this->Semiproduct->find('all');
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
