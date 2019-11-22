<?php
App::uses('AppController', 'Controller');
/**
 * TransitionsItems Controller
 *
 * @property TransitionsItem $TransitionsItem
 * @property PaginatorComponent $Paginator
 */
class TransitionsItemsController extends AppController {

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
		$this->TransitionsItem->recursive = 0;
		$this->set('transitionsItems', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TransitionsItem->exists($id)) {
			throw new NotFoundException(__('Invalid transitions item'));
		}
		$options = array('conditions' => array('TransitionsItem.' . $this->TransitionsItem->primaryKey => $id));
		$this->set('transitionsItem', $this->TransitionsItem->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TransitionsItem->create();
			if ($this->TransitionsItem->save($this->request->data)) {
				$this->Flash->success(__('The transitions item has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The transitions item could not be saved. Please, try again.'));
			}
		}
		$transitions = $this->TransitionsItem->Transition->find('list');
		$items = $this->TransitionsItem->Item->find('list');
		$this->set(compact('transitions', 'items'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TransitionsItem->exists($id)) {
			throw new NotFoundException(__('Invalid transitions item'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TransitionsItem->save($this->request->data)) {
				$this->Flash->success(__('The transitions item has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The transitions item could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TransitionsItem.' . $this->TransitionsItem->primaryKey => $id));
			$this->request->data = $this->TransitionsItem->find('first', $options);
		}
		$transitions = $this->TransitionsItem->Transition->find('list');
		$items = $this->TransitionsItem->Item->find('list');
		$this->set(compact('transitions', 'items'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->TransitionsItem->exists($id)) {
			throw new NotFoundException(__('Invalid transitions item'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->TransitionsItem->delete($id)) {
			$this->Flash->success(__('The transitions item has been deleted.'));
		} else {
			$this->Flash->error(__('The transitions item could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
