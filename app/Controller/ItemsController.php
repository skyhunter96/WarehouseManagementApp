<?php
App::uses('AppController', 'Controller');
/**
 * Items Controller
 *
 * @property Item $Item
 * @property PaginatorComponent $Paginator
 */
class ItemsController extends AppController {

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
		$this->Item->recursive = 0;
		$this->set('items', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Item->exists($id)) {
			throw new NotFoundException(__('Invalid item'));
		}
		$options = array('conditions' => array('Item.' . $this->Item->primaryKey => $id));
		$this->set('item', $this->Item->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Item->create();
			if ($this->Item->save($this->request->data)) {
				$this->Flash->success(__('The item has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The item could not be saved. Please, try again.'));
			}
		}
		$measurementUnits = $this->Item->MeasurementUnit->find('list');
		$itemTypes = $this->Item->ItemType->find('list');
		$this->set(compact('measurementUnits', 'itemTypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Item->exists($id)) {
			throw new NotFoundException(__('Invalid item'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Item->save($this->request->data)) {
				$this->Flash->success(__('The item has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The item could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Item.' . $this->Item->primaryKey => $id));
			$this->request->data = $this->Item->find('first', $options);
		}
		$measurementUnits = $this->Item->MeasurementUnit->find('list');
		$itemTypes = $this->Item->ItemType->find('list');
		$this->set(compact('measurementUnits', 'itemTypes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->Item->exists($id)) {
			throw new NotFoundException(__('Invalid item'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Item->delete($id)) {
			$this->Flash->success(__('The item has been deleted.'));
		} else {
			$this->Flash->error(__('The item could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view');
    }
}
