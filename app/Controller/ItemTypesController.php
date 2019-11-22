<?php
App::uses('AppController', 'Controller');
/**
 * ItemTypes Controller
 *
 * @property ItemType $ItemType
 * @property PaginatorComponent $Paginator
 */
class ItemTypesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if ($this->request->is(array('post', 'put'))) {
			$keyword = $this->request->data['ItemType']['keywords'];
			$this->ItemType->recursive = 0;
			$this->paginate = array(
				'conditions' => array('name LIKE' => '%' . $keyword . '%', )
			);
			$this->set('itemTypes', $this->Paginator->paginate());
		}else{
		$this->ItemType->recursive = 0;
		$this->set('itemTypes', $this->Paginator->paginate());}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ItemType->exists($id)) {
			throw new NotFoundException(__('Invalid item type'));
		}
		$options = array('conditions' => array('ItemType.' . $this->ItemType->primaryKey => $id));
		$this->set('itemType', $this->ItemType->find('first', $options));
	}

/**
 * save method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function save($id = null) {
		if($this->request->is(array('post', 'put'))){
			if($id){
				$this->request->data['ItemType']['id'] = $id;
			}
			$this->ItemType->set($this->request->data);
			if($this->ItemType->validates()){
				if(!$id){
					$this->ItemType->create();
				}
				if ($this->ItemType->save($this->request->data)) {
					$this->Flash->success(__('The item type has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Flash->error(__('The item type could not be saved. Please, try again.'));
				}
			} else {
				$this->Flash->warning($this->ItemType->validationErrors, array(
					'key' => 'negative'
				));
			}

		} else {
			$options = array('conditions' => array('ItemType.' . $this->ItemType->primaryKey => $id));
			$this->request->data = $this->ItemType->find('first', $options);
		}
		$this->set('classes', $this->ItemType->classes);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			$this->ItemType->set($this->request->data);
			if($this->ItemType->validates()){
				$this->ItemType->create();
				if ($this->ItemType->save($this->request->data)) {
					$this->Flash->success(__('The item type has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Flash->error(__('The item type could not be saved. Please, try again.'));
				}
			}
			$this->Flash->warning($this->ItemType->validationErrors, array(
				'key' => 'negative'
			));
		}
		$this->set('classes', $this->ItemType->classes);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ItemType->exists($id)) {
			throw new NotFoundException(__('Invalid item type'));
		}
		if ($this->request->is(array('post', 'put'))) {

			$this->ItemType->set($this->request->data);

			if($this->ItemType->validates()) {

				if ($this->ItemType->save($this->request->data)) {
					$this->Flash->success(__('The item type has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Flash->error(__('The item type could not be saved. Please, try again.'));
				}
			}
			{
				$this->Flash->warning($this->ItemType->validationErrors, array(
					'key' => 'negative'
				));
			}
		} else {
			$options = array('conditions' => array('ItemType.' . $this->ItemType->primaryKey => $id));
			$this->request->data = $this->ItemType->find('first', $options);
		}
		$this->set('classes', $this->ItemType->classes);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->ItemType->exists($id)) {
			throw new NotFoundException(__('Invalid item type'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ItemType->delete($id)) {
			$this->Flash->success(__('The item type has been deleted.'));
		} else {
			$this->Flash->error(__('The item type could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    /**
     * init_tcpdf method
     * Initializes a pdf file listing all item types
     * @return void
     */
	public function init_tcpdf(){
		//Init PDF
		$pdf = null;
		while (!class_exists('PDF')) {
			//Init PDF
			App::import('Vendor', 'PDF', array('file' => 'tcpdf' . DS . 'pdf.php'));
		}

		$data = $this->ItemType->find('all');
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
}
