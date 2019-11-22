<?php
App::uses('AppController', 'Controller');
/**
 * Permits Controller
 *
 * @property Permit $Permit
 * @property PaginatorComponent $Paginator
 */
class PermitsController extends AppController {

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
		$this->loadModel('Warehouse');
		$this->loadModel('User');
		$this->loadModel('WarehousePlace');
		$users = $this->User->find('list', array('fields' => array('id', 'username')));
		$warehousePlaces = $this->WarehousePlace->find('list');
		$this->set('users', $users);
		$this->set('warehousePlaces', $warehousePlaces);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->load();
		if ($this->request->is(array('post', 'put'))) {
			$keyword = $this->request->data['Permit']['User:'];
			$idUser = $this->User->find('all', array('conditions' => array('username LIKE' => '%' . $keyword . '%')));
			foreach($idUser as $id){
				$ids[] = $id['User']['id'];
			}
			$this->Permit->recursive = 0;
			$this->paginate = array(
				'conditions' => array('Permit.users_id' => $ids)
			);
			$this->set('permits', $this->Paginator->paginate());
		}else{

		$this->Permit->recursive = 0;
		$this->set('permits', $this->Paginator->paginate());}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Permit->exists($id)) {
			throw new NotFoundException(__('Invalid permit'));
		}
		$options = array('conditions' => array('Permit.' . $this->Permit->primaryKey => $id));
		$this->set('permit', $this->Permit->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->load();
		if ($this->request->is('post')) {
			$this->Permit->create();
			$exists = $this->Permit->find('first', array('conditions' => array('users_id' => $this->request->data['Permit']['users_id'], 'warehouse_places_id' => $this->request->data['Permit']['warehouse_places_id'])));

			if(empty($exists)){
				if ($this->Permit->save($this->request->data)) {
					$this->Flash->success(__('The permit has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Flash->error(__('The permit could not be saved. Please, try again.'));
				}
			}
			else{
				$this->Flash->error(__('This user already has permit for this address'));
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
		$this->load();
		if (!$this->Permit->exists($id)) {
			throw new NotFoundException(__('Invalid permit'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Permit->save($this->request->data)) {
				$this->Flash->success(__('The permit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The permit could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Permit.' . $this->Permit->primaryKey => $id));
			$this->request->data = $this->Permit->find('first', $options);
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
		if (!$this->Permit->exists($id)) {
			throw new NotFoundException(__('Invalid permit'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Permit->delete($id)) {
			$this->Flash->success(__('The permit has been deleted.'));
		} else {
			$this->Flash->error(__('The permit could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
