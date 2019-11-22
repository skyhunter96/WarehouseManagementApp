<?php
App::uses('AppController', 'Controller');
App::uses('Item', 'Model');
/**
 * WarehousePlaces Controller
 *
 * @property WarehousePlace $WarehousePlace
 * @property PaginatorComponent $Paginator
 */
class WarehousePlacesController extends AppController {

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
		$this->loadModel('ItemType');
		$this->loadModel('ItemsPlace');
		$this->loadModel('Item');
		$this->loadModel('WarehouseAddress');
		$this->set('warehouses', $this->Warehouse->find('list'));
		$this->set('itemTypes', $this->ItemType->find('list', array('conditions' => array('tangible' => true, 'active' => true)))); //SAMO OPIPLJIVE
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->WarehousePlace->recursive = 0;
		$this->set('warehousePlaces', $this->Paginator->paginate());
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
		if (!$this->WarehousePlace->exists($id)) {
			throw new NotFoundException(__('Invalid warehouse place'));
		}
		$options = array('conditions' => array('WarehousePlace.' . $this->WarehousePlace->primaryKey => $id));
		$this->set('warehousePlace', $this->WarehousePlace->find('first', $options));

		$addressesHere = $this->WarehouseAddress->find('all', array('conditions' => array('warehouse_places_id' => $id)));
		foreach($addressesHere as $value){
			if(!empty($value['ItemsAddresses'])){
				$itemsHere[] = $value['ItemsAddresses'];
			}
		}

		if(isset($itemsHere)) {
			foreach ($itemsHere as $value) {
				foreach ($value as $k) {
					$items[] = $k;
				}
			}
			//FINDING ALL THE ITEMS WITH SUM OF NUMBERS
			$count = count($items);
			for ($i = 0; $i < $count; $i++) {
				if (!isset($items[$i])) {
					continue;
				}
				for ($j = $i + 1; $j < $count; $j++) {
					if ($items[$i]['items_id'] == $items[$j]['items_id']) {
						$items[$i]['total'] += $items[$j]['total'];
						$items[$i]['available'] += $items[$j]['available'];
						$items[$i]['reserved'] += $items[$j]['reserved'];
						$items[$i]['used'] += $items[$j]['used'];
						unset($items[$j]);
					}
				}
			}

			for ($i = 0; $i < count($items); $i++) {
				$it = $this->Item->findById($items[$i]['items_id']);
				$name = $it['Item']['name'];
				$items[$i]['items_id'] = $name;
			}


			$this->set('items', $items);

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

			$data = array(
				'WarehousePlace' => array(
					'code' => $this->request->data['WarehousePlace']['code'],
					'name' => $this->request->data['WarehousePlace']['name'],
					'description' => $this->request->data['WarehousePlace']['description'],
					'is_default' => $this->request->data['WarehousePlace']['is_default'],
					'is_active' => $this->request->data['WarehousePlace']['is_active'],
					'warehouse_id' => $this->request->data['WarehousePlace']['warehouse_id'],
				),
				'ItemType' => array(
					'ItemType' => $this->request->data['ItemType']['ItemType']
				)
			);

			$this->WarehousePlace->create();

			if ($this->WarehousePlace->saveAll($data, array('validate' => 'first', 'deep' => true))) {
				$this->Flash->success(__('The Warehouse Place has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}

			if ($this->WarehousePlace->validationErrors) {
				$this->Flash->warning(array($this->WarehousePlace->validationErrors), array('key' => 'negative'));
			} else {
				$this->Flash->error(__('The Warehouse Place could not be saved. Please, try again.'));
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
		if (!$this->WarehousePlace->exists($id)) {
			throw new NotFoundException(__('Invalid warehouse place'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = array(
				'WarehousePlace' => array(
					'id' => $this->request->data['WarehousePlace']['id'],
					'code' => $this->request->data['WarehousePlace']['code'],
					'name' => $this->request->data['WarehousePlace']['name'],
					'description' => $this->request->data['WarehousePlace']['description'],
					'is_default' => $this->request->data['WarehousePlace']['is_default'],
					'is_active' => $this->request->data['WarehousePlace']['is_active'],
					'warehouse_id' => $this->request->data['WarehousePlace']['warehouse_id'],
				),
				'ItemType' => array(
					'ItemType' => $this->request->data['ItemType']['ItemType']
				)
			);

			if ($this->WarehousePlace->saveAssociated($data, array('validate' => 'first'))) {
				$this->Flash->success(__('The Warehouse Place has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			if ($this->WarehousePlace->validationErrors ) {
				$this->Flash->warning(array($this->WarehousePlace->validationErrors), array('key' => 'negative'));
			} else {
				$this->Flash->error(__('The Warehouse Place could not be updated. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('WarehousePlace.' . $this->WarehousePlace->primaryKey => $id));
			$this->request->data = $this->WarehousePlace->find('first', $options);
		}

	}

	public function itemToAdd($id = null){
		$this->load();

		if($this->request->is(array('post'))){

			$this->request->data['WarehousePlace']['id'] = $this->Session->read('placeId');

			$exists = $this->ItemsPlace->find('first', array('conditions' => array(
				'warehouse_places_id' => $this->request->data['WarehousePlace']['id'],
				'items_id' => $this->request->data['ItemsPlace']['itemToAdd'])));

			$data = array(
				'warehouse_places_id' => $this->request->data['WarehousePlace']['id'],
				'items_id' => $this->request->data['ItemsPlace']['itemToAdd'],
				'total' => $this->request->data['ItemsPlace']['total'],
				'available' => $this->request->data['ItemsPlace']['available'],
				'reserved' => $this->request->data['ItemsPlace']['reserved'],
				'used' => $this->request->data['ItemsPlace']['used'],
			);

			if(empty($exists)){
				if ($this->ItemsPlace->save($data, array('validate' => 'first',))) {
					$this->Flash->success(__('Items have been successfully added to the requested place.'));
					return $this->redirect($this->referer());
				}
				if ($this->ItemsPlace->validationErrors) {
					$this->Flash->warning(array($this->ItemsPlace->validationErrors), array('key' => 'negative'));
					return $this->redirect($this->referer());
				}
				else {
					$this->Flash->error(__('Items could not be added to this address. Please, try again.'));
					return $this->redirect($this->referer());
				}
			} else {$this->Flash->error(__('Items already exist on this address!'));
				return $this->redirect($this->referer());
			}

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
		if (!$this->WarehousePlace->exists($id)) {
			throw new NotFoundException(__('Invalid warehouse place'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->WarehousePlace->delete($id)) {
			$this->Flash->success(__('The warehouse place has been deleted.'));
		} else {
			$this->Flash->error(__('The warehouse place could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view');
    }
}
