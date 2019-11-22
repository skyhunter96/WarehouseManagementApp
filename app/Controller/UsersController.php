<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

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
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->set($this->request->data);

			if($this->User->validates()){
				$this->User->create();

				if ($this->User->save($this->request->data)) {
					$this->Flash->success(__('The user has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Flash->error(__('The user could not be saved. Please, try again.'));
				}
			}
			$this->Flash->warning($this->User->validationErrors, array(
				'key' => 'negative'
			));

		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->User->set($this->request->data);

			if($this->User->validates()){
				if ($this->User->save($this->request->data)) {
					$this->Flash->success(__('The user has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Flash->error(__('The user could not be saved. Please, try again.'));
				}
			}
			else{
				$this->Flash->warning($this->User->validationErrors, array(
					'key' => 'negative'
				));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete($id)) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->loginAction);
			}
			$this->Session->setFlash(__('Your username or password was incorrect.'));
		}
		if ($this->Session->read('Auth.User')) {

			$this->Session->setFlash('You are logged in!');

			return $this->redirect('/');
		}
		
	}

	public function logout() {
		$this->Session->setFlash('Good-Bye');
		$this->redirect($this->Auth->logout());
	}

    public function beforeFilter() {
        parent::beforeFilter();

    }

    public function initDB() {
        $group = $this->User->Group;

        // Allow admins to everything
        $group->id = 1;
        $this->Acl->allow($group, 'controllers');

        // allow managers to posts and widgets
        $group->id = 2;
        $this->Acl->allow($group, 'controllers');
        $this->Acl->deny($group, 'controllers/Users/add');
        $this->Acl->deny($group, 'controllers/Users/delete');
        $this->Acl->deny($group, 'controllers/Groups/add');
        $this->Acl->deny($group, 'controllers/Groups/delete');

        // allow users to only add and edit on posts and widgets
        $group->id = 3;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Consumables');
        $this->Acl->allow($group, 'controllers/Goods');
        $this->Acl->allow($group, 'controllers/Home');
        $this->Acl->allow($group, 'controllers/Inventories');
        $this->Acl->allow($group, 'controllers/Items');
        $this->Acl->allow($group, 'controllers/ItemsPlaces');
        $this->Acl->allow($group, 'controllers/Kits');
        $this->Acl->allow($group, 'controllers/Materials');
        $this->Acl->allow($group, 'controllers/Products');
        $this->Acl->allow($group, 'controllers/Semiproducts');
        $this->Acl->allow($group, 'controllers/ServiceSuppliers');
        $this->Acl->allow($group, 'controllers/ServiceProducts');

        // allow basic users to log out
        $this->Acl->allow($group, 'controllers/users/logout');

        // we add an exit to avoid an ugly "missing views" error message
        echo "all done";
        exit;
    }
}
