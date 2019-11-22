<?php
App::uses('AppController', 'Controller');
/**
 * Transitions Controller
 *
 * @property Transition $Transition
 * @property PaginatorComponent $Paginator
 */
class TransitionsController extends AppController {

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
		$this->loadModel('ItemType');
		$this->loadModel('WarehousePlace');
		$this->loadModel('Item');
		$this->loadModel('ItemsAddress');
		$this->loadModel('WarehouseAddress');
		$this->loadModel('User');
		$this->loadModel('Permit');
		$this->loadModel('TransitionsItem');
		$this->set('itemTypes', $this->ItemType->getAll());
		$this->set('warehousePlaces', $this->WarehousePlace->find('list', array('conditions' => array('is_active' => true))));
		$this->set('status', $this->Transition->status);
		$this->set('type', $this->Transition->type);
	}


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Transition->recursive = 0;
		$this->set('transitions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Transition->exists($id)) {
			throw new NotFoundException(__('Invalid transition'));
		}
		$options = array('conditions' => array('Transition.' . $this->Transition->primaryKey => $id));
		$this->set('transition', $this->Transition->find('first', $options));
	}


/**
 * chooseUsers method
 *
 * @return void
 */
	public function chooseUsers() {
		$this->load();
		debug($this->request->data);
		$addresses = $this->WarehouseAddress->find('all', array('conditions' => array('warehouse_places_id' => $this->request->data['Transition']['warehouses_places_from'])));

		foreach($addresses as $address){
			$allAddresses[] = $address['WarehouseAddress'];
		}

		if($this->request->data['Transition']['status'] == 'ready' || $this->request->data['Transition']['status'] == 'delivered'){
			$show = true;
		}else $show = false;
		if($this->request->data['Transition']['status'] == 'delivered'){
			$showReceived = true;
		}else $showReceived = false;

		$code = $this->request->data['Transition']['type'] == 'standard' ? 'INTPRE' : 'TREMAT';
		$code .= date("Y");
		$last = $this->Transition->find('first', array('order' => array('id' => 'DESC')));
		if(empty($last)){
			$last = '0001';
		}
		else{
			$last = substr($last['Transition']['code'], -4);
			$last = $last + 1;
			while(strlen($last) < 4){
				$last = '0' . $last;
			}
		}
		$code .= $last;

		$this->request->data['Transition']['code'] = $code;
		$permitted = $this->Permit->find('all', array('conditions' => array(
			'warehouse_places_id' => $this->request->data['Transition']['warehouses_places_from'],
			'allowed' => true
			)));

		foreach($permitted as $value){
			$users[$value['Users']['id']] = $value['Users']['username'];
		}

		$this->request->data['Transition']['created_by'] = $this->Auth->User('id');

		$issued = $this->User->find('all');
		foreach($issued as $value){
			$issuedBy[$value['User']['id']] = $value['User']['username'];
		}

		$received = $this->User->find('all');
		foreach($received as $value){
			$receivedBy[$value['User']['id']] = $value['User']['username'];
		}

		$this->set('received', $receivedBy);
		$this->set('issued', $issuedBy);
		$this->set('users', $users);
		$this->set('show', $show);
		$this->set('showReceived', $showReceived);
	}

/**
 * add method
 *
 * @return void
 */
	public function save(){

		$this->load();
		if ($this->request->is('post')) {
			$data = array(
				'Transition' => array(
					'code' => $this->request->data['Transition']['code'],
					'user_created_by' => $this->request->data['Transition']['created_by'],
					'warehouses_places_from' => $this->request->data['Transition']['warehouses_places_from'],
					'status' => $this->request->data['Transition']['status'],
					'type' => $this->request->data['Transition']['type'],
				)
			);
			if(isset($this->request->data['Transition']['issued_by'])){
				$data['Transition']['user_issued_by'] = $this->request->data['Transition']['issued_by'];
			}
			if(isset($this->request->data['Transition']['received_by'])){
				$data['Transition']['user_received_by'] = $this->request->data['Transition']['received_by'];
			}

			$this->Transition->create();
			if ($this->Transition->save($data)) {
				$this->Flash->success(__('The transition has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {

				$this->Flash->error(__('The transition could not be saved. Please, try again.'));
				return $this->redirect(array('action' => 'index'));
			}
		}
	}

/**
 * chooseAddresses method
 *
 * @return void
 */
	public function chooseAddresses($id = null) {
		$this->load();

		$transition = $this->Transition->findById($id);
		$this->Session->write('transitionId', $id);

		if($transition['Transition']['user_received_by'] == null){
			$conditions = null;
			$addresses = $this->WarehouseAddress->find('all');
		}
		else{
			$permits = $this->Permit->find('all', array('conditions' => array(
				'users_id' => $transition['Transition']['user_received_by'],
				'allowed' => true
			)));

			foreach($permits as $permit){
				$places[] = $permit['WarehousePlaces']['id'];
			}

			$addresses = $this->WarehouseAddress->find('all', array('conditions' => array('warehouse_places_id' => $places)));

			$this->Session->write('user_received_by', $transition['Transition']['user_received_by']);
		}

		foreach($addresses as $value){
			$addressBy[$value['WarehouseAddress']['id']] = $value['WarehouseAddress']['code'];
		}

		$this->set('address', $addressBy);
	}

/**
 * chooseItems method
 *
 * @return void
 */
	public function chooseItems() {
		$this->load();
		$itemsOnAddress = $this->ItemsAddress->find('all', array('conditions' => array('warehouse_addresses_id' => $this->request->data['TransitionsItem']['addresses'])));

		foreach($itemsOnAddress as $value){
			$items[$value['Items']['id']] = $value['Items']['name'];
			$itemsAndAddress[] = $value['ItemsAddress'];
		}

		$this->request->data['Transition']['address'] = $this->request->data['TransitionsItem']['addresses'];
		$this->set('address', $this->request->data['TransitionsItem']['addresses']);
		$this->set('items', $items);
	}

/**
 * chooseItems method
 *
 * @return void
 */
	public function chooseAmounts() {
		$this->load();

		$address = $this->ItemsAddress->find('first', array('conditions' => array(
			'warehouse_addresses_id' => $this->request->data['Transition']['address'],
			'items_id' => $this->request->data['Transition']['items']
		)));

		$item = $address['ItemsAddress'];

		$this->set('demanded_quantity', $item['total']);

	}

/**
 * insert method
 *
 * @return void
 */
	public function chooseDestination(){
		$this->load();

		$address = $this->ItemsAddress->find('first', array('conditions' => array(
			'warehouse_addresses_id' => $this->request->data['Transition']['address'],
			'items_id' => $this->request->data['Transition']['items']
		)));

		$item = $address['ItemsAddress'];

		$transition = $this->Transition->findById($this->Session->read('transitionId'));

		$permits = $this->Permit->find('all', array('conditions' => array(
			'users_id' => $transition['Transition']['user_received_by'],
			'allowed' => true
		)));

		foreach($permits as $permit){
			$places[] = $permit['WarehousePlaces']['id'];
		}

		$addresses = $this->WarehouseAddress->find('all', array('conditions' => array('warehouse_places_id' => $places)));

		for($i = 0; $i < count($addresses); $i++){
			if($addresses[$i]['WarehouseAddress']['id'] == $this->request->data['Transition']['address']){
				unset($addresses[$i]);
			}
		}

		foreach($addresses as $value){
			$addressBy[$value['WarehouseAddress']['id']] = $value['WarehouseAddress']['code'];
		}

		$this->Session->write('addressFrom', $this->request->data['Transition']['address']);

		$this->set('addressTo', $addressBy);
		$this->set('address', $this->request->data['Transition']['address']);

	}

/**
 * insert method
 *
 * @return void
 */
	public function insert(){
		$this->load();
		if($this->request->is('post')){

			$address = $this->WarehouseAddress->findById($this->request->data['Transition']['address']);
			$place = $address['WarehousePlaces']['id'];

			$data = array(
				'TransitionsItem' => array(
					'transitions_id' => $this->Session->read('transitionId'),
					'items_id' => $this->request->data['Transition']['items'],
					'demanded_quantity' => $this->request->data['Transition']['demanded_quantity'],
					'issued_quantity' => $this->request->data['Transition']['issued_quantity'],
					'from_address' => $this->Session->read('addressFrom'),
					'to_address' => $this->request->data['Transition']['destination_address']
				)
			);

			$transition = array(
				'Transition' => array(
					'id' => $this->Session->read('transitionId'),
					'warehouses_places_to' => $place,
				)
			);

			$itemsAddress = $this->ItemsAddress->find('all', array('conditions' => array(
				'warehouse_addresses_id' => $this->Session->read('addressFrom'),
				'items_id' => $this->request->data['Transition']['items'])));

			$dataForNew = array(
				'ItemsAddress' => array(
					'warehouse_addresses_id' => $this->request->data['Transition']['destination_address'],
					'items_id' => $this->request->data['Transition']['items'],
					'total' => $this->request->data['Transition']['issued_quantity'],
					'avalable' => $this->request->data['Transition']['issued_quantity']
				)
			);

			if(($itemsAddress[0]['ItemsAddress']['total'] - $this->request->data['Transition']['issued_quantity']) == 0){
				$this->ItemsAddress->deleteAll(array(
					'warehouse_addresses_id' => $this->Session->read('addressFrom'),
					'items_id' => $this->request->data['Transition']['items']
					),
					$cascade = false, $callbacks = false);
			}
			else{
				$this->ItemsAddress->deleteAll(array(
					'warehouse_addresses_id' => $this->Session->read('addressFrom'),
					'items_id' => $this->request->data['Transition']['items']
				),
					$cascade = false, $callbacks = false);
				$dataItemsAddress = array(
					'ItemsAddress' => array(
						'warehouse_addresses_id' => $this->Session->read('addressFrom'),
						'items_id' => $this->request->data['Transition']['items'],
						'total' => $itemsAddress[0]['ItemsAddress']['total'] - $this->request->data['Transition']['issued_quantity'],
						'avalable' => $itemsAddress[0]['ItemsAddress']['available'] - $this->request->data['Transition']['issued_quantity']
					)
				);
				$this->ItemsAddress->save($dataItemsAddress);
			}

			$this->ItemsAddress->save($dataForNew);

			if ($this->TransitionsItem->save($data) && $this->Transition->save($transition)) {
				$this->Flash->success(__('Item has been added successfully to the transition'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Item could not be added to the transition. Please, try again.'));
			}
		}
	}



/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->load();
		if ($this->request->is('post')) {
			$this->Transition->create();
			if ($this->Transition->save($this->request->data)) {
				$this->Flash->success(__('The transition has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The transition could not be saved. Please, try again.'));
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
		if (!$this->Transition->exists($id)) {
			throw new NotFoundException(__('Invalid transition'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Transition->save($this->request->data)) {
				$this->Flash->success(__('The transition has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The transition could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Transition.' . $this->Transition->primaryKey => $id));
			$this->request->data = $this->Transition->find('first', $options);
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
		if (!$this->Transition->exists($id)) {
			throw new NotFoundException(__('Invalid transition'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Transition->delete($id)) {
			$this->Flash->success(__('The transition has been deleted.'));
		} else {
			$this->Flash->error(__('The transition could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
