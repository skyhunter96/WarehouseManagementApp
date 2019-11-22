<?php
App::uses('AppController', 'Controller');
/**
 * Warehouses Controller
 *
 * @property Warehouse $Warehouse
 * @property PaginatorComponent $Paginator
 */
class WarehousesController extends AppController {

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
		$this->Warehouse->recursive = 0;
		$this->set('warehouses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Warehouse->exists($id)) {
			throw new NotFoundException(__('Invalid warehouse'));
		}
		$options = array('conditions' => array('Warehouse.' . $this->Warehouse->primaryKey => $id));
		$this->set('warehouse', $this->Warehouse->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Warehouse->set($this->request->data);

			if($this->Warehouse->validates()){

				$this->Warehouse->create();
				if ($this->Warehouse->save($this->request->data)) {
					$this->Flash->success(__('The measurement unit has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Flash->error(__('The measurement unit could not be saved. Please, try again.'));
				}
			}
			$this->Flash->warning($this->Warehouse->validationErrors, array(
				'key' => 'negative'
			));
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
		if (!$this->Warehouse->exists($id)) {
			throw new NotFoundException(__('Invalid measurement unit'));
		}
		if ($this->request->is(array('post', 'put'))) {

			$this->Warehouse->set($this->request->data);

			if($this->Warehouse->validates()) {
				$this->Warehouse->create();
				if ($this->Warehouse->save($this->request->data)) {
					$this->Flash->success(__('The measurement unit has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Flash->error(__('The measurement unit could not be saved. Please, try again.'));
				}
			}
			else{
				$this->Flash->warning($this->Warehouse->validationErrors, array(
					'key' => 'negative'
				));
			}
		} else {
			$options = array('conditions' => array('Warehouse.' . $this->Warehouse->primaryKey => $id));
			$this->request->data = $this->Warehouse->find('first', $options);
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
		if (!$this->Warehouse->exists($id)) {
			throw new NotFoundException(__('Invalid warehouse'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Warehouse->delete($id)) {
			$this->Flash->success(__('The warehouse has been deleted.'));
		} else {
			$this->Flash->error(__('The warehouse could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view');
    }
}
