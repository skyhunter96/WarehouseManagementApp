<?php
App::uses('AppController', 'Controller');
/**
 * ItemsPlaces Controller
 *
 * @property ItemsPlace $ItemsPlace
 * @property PaginatorComponent $Paginator
 */
class ItemsPlacesController extends AppController {

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
	public function load()
	{
		$this->loadModel('WarehousePlace');
		$this->loadModel('ItemType');
		$this->loadModel('ItemsPlace');
		$this->loadModel('Item');
    }

/**
 * index method
 *
 * @return void
 */
	public function index($id = null) {
		$this->load();
		if (!$this->WarehousePlace->exists($id)) {
			throw new NotFoundException(__('Invalid items place'));
		}
		$this->ItemsPlace->recursive = 0;
		$this->paginate = array(
			'conditions' => array(
				'warehouse_places_id' => $id
			)
		);
		$this->set('itemsPlaces', $this->Paginator->paginate());
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
		if (!$this->ItemsPlace->exists($id)) {
			throw new NotFoundException(__('Invalid items place'));
		}
		$options = array('conditions' => array('ItemsPlace.' . $this->ItemsPlace->primaryKey => $id));
		$this->set('itemsPlace', $this->ItemsPlace->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ItemsPlace->create();
			if ($this->ItemsPlace->save($this->request->data)) {
				$this->Flash->success(__('The items place has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The items place could not be saved. Please, try again.'));
			}
		}
		$items = $this->ItemsPlace->Item->find('list');
		$warehousePlaces = $this->ItemsPlace->WarehousePlace->find('list');
		$this->set(compact('items', 'warehousePlaces'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->load();
		if (!$this->ItemsPlace->exists($id)) {
			throw new NotFoundException(__('Invalid items place'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ItemsPlace->save($this->request->data)) {
				$this->Flash->success(__('The items place has been saved.'));
				return $this->redirect($this->referer());
			} else {
				$this->Flash->error(__('The items place could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ItemsPlace.' . $this->ItemsPlace->primaryKey => $id));
			$this->request->data = $this->ItemsPlace->find('first', $options);
		}
		$items = $this->ItemsPlace->find('first', $id);
		$this->set('items');
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->ItemsPlace->exists($id)) {
			throw new NotFoundException(__('Invalid items place'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ItemsPlace->delete($id)) {
			$this->Flash->success(__('The items place has been deleted.'));
		} else {
			$this->Flash->error(__('The items place could not be deleted. Please, try again.'));
		}
		return $this->redirect($this->referer());
	}

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view');
    }
}
