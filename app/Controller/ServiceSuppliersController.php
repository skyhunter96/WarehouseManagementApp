<?php
App::uses('AppController', 'Controller');
/**
 * ServiceSuppliers Controller
 *
 * @property ServiceSupplier $ServiceSupplier
 * @property PaginatorComponent $Paginator
 */
class ServiceSuppliersController extends AppController {

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
		$this->set('status', $this->ServiceSupplier->status);
		$this->set('recommended_rating', $this->ServiceSupplier->recommended_rating);
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
			$this->ServiceSupplier->recursive = 0;
			$this->paginate = array(
				'conditions' => array('Item.is_deleted' => false, 'Item.name LIKE' => '%' . $keyword . '%')
			);
			$this->set('serviceSuppliers', $this->Paginator->paginate());
		}else{
		$this->ServiceSupplier->recursive = 0;
		$this->paginate = array(
			'conditions' => array('Item.is_deleted' => false)
		);
		$this->set('serviceSuppliers', $this->Paginator->paginate());}
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
		if (!$this->ServiceSupplier->exists($id)) {
			throw new NotFoundException(__('Invalid serviceSupplier'));
		}
		$options = array('conditions' => array('ServiceSupplier.' . $this->ServiceSupplier->primaryKey => $id));
		$serviceSupplier = $this->ServiceSupplier->find('first', $options);
		$this->set('serviceSupplier', $serviceSupplier);
		$this->set('measurement_unit', $this->MeasurementUnit->findById($serviceSupplier['Item']['measurement_unit_id']));
		$this->set('item_type', $this->ItemType->findById($serviceSupplier['Item']['item_type_id']));
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
					'item_type_id' => $this->request->data['Item']['ItemTypeId'],
					'is_deleted' => false
				),
				'ServiceSupplier' => array(
					'status' => $this->request->data['ServiceSupplier']['status'],
					'recommended_rating' => $this->request->data['ServiceSupplier']['recommended_rating']
				)
			);

			$this->ServiceSupplier->create();
			$this->Item->create();

			if($this->ServiceSupplier->saveAssociated($data, array('validate' => 'first'))){
				$this->Flash->success(__('The serviceSupplier has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			if($this->ServiceSupplier->validationErrors || $this->Item->validationErrors){
				$this->Flash->warning(array($this->ServiceSupplier->validationErrors, $this->Item->validationErrors), array('key' => 'negative'));

			}
			else{
				$this->Flash->error(__('The serviceSupplier could not be saved. Please, try again.'));
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
		if (!$this->ServiceSupplier->exists($id)) {
			throw new NotFoundException(__('Invalid serviceSupplier'));
		}
		$this->load();
		if($id){
			$this->request->data['ServiceSupplier']['id'] = $id;
			$serviceSupplier = $this->ServiceSupplier->findById($this->request->data['ServiceSupplier']['id']);
			$this->request->data['Item']['id'] = $serviceSupplier['Item']['id'];
		}

		if ($this->request->is(array('post', 'put'))) {

			$data = array(
				'Item' => array(
					'id' => $this->request->data['Item']['id'],
					'name' => $this->request->data['Item']['name'],
					'description' => $this->request->data['Item']['description'],
					'is_deleted' => false
				),
				'ServiceSupplier' => array(
					'id' => $this->request->data['ServiceSupplier']['id'],
					'status' => $this->request->data['ServiceSupplier']['status'],
					'recommended_rating' => $this->request->data['ServiceSupplier']['recommended_rating']
				)
			);

			if($this->ServiceSupplier->saveAssociated($data, array('validate' => 'first'))){
				$this->Flash->success(__('The serviceSupplier has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			if($this->ServiceSupplier->validationErrors || $this->Item->validationErrors){
				$this->Flash->warning(array($this->ServiceSupplier->validationErrors, $this->Item->validationErrors), array('key' => 'negative'));
			}
			else{
				$this->Flash->error(__('The serviceSupplier could not be updated. Please, try again.'));
			}

		}
		else {
			$options = array('conditions' => array('ServiceSupplier.' . $this->ServiceSupplier->primaryKey => $id));
			$this->request->data = $this->ServiceSupplier->find('first', $options);
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
		if (!$this->ServiceSupplier->exists($id)) {
			throw new NotFoundException(__('Invalid serviceSupplier'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ServiceSupplier->delete($id)) {
			$this->Flash->success(__('The serviceSupplier has been deleted.'));
		} else {
			$this->Flash->error(__('The serviceSupplier could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    /**
     * init_tcpdf method
     * Initializes a pdf file listing all of service suppliers
     * @return void
     */
	public function init_tcpdf(){
		//Init PDF
		$pdf = null;
		while (!class_exists('PDF')) {
			//Init PDF
			App::import('Vendor', 'PDF', array('file' => 'tcpdf' . DS . 'pdf.php'));
		}

		$data = $this->ServiceSupplier->find('all');
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
