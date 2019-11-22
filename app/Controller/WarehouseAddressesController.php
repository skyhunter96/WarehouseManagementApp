<?php
App::uses('AppController', 'Controller');
/**
 * WarehouseAddresses Controller
 *
 * @property WarehouseAddress $WarehouseAddress
 * @property PaginatorComponent $Paginator
 */
class WarehouseAddressesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'RequestHandler');

/**
 * load method
 *
 * @return void
 */
	public function load()
	{
		$this->loadModel('Warehouse');
		$this->loadModel('ItemType');
		$this->loadModel('WarehousePlace');
		$this->loadModel('Item');
		$this->loadModel('ItemsAddress');
		$this->loadModel('ItemsPlace');
		$this->set('warehouses', $this->Warehouse->find('list'));
		$this->set('itemTypes', $this->ItemType->getAll());
		$this->set('warehousePlaces', $this->WarehousePlace->find('list', array('conditions' => array('is_active' => true)))); //SAMO AKTIVNE
	}


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->WarehouseAddress->recursive = 0;
		$this->set('warehouseAddresses', $this->Paginator->paginate());
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

		if (!$this->WarehouseAddress->exists($id)) {
			throw new NotFoundException(__('Invalid warehouse address'));
		}
		$options = array('conditions' => array('WarehouseAddress.' . $this->WarehouseAddress->primaryKey => $id));
		$this->set('warehouseAddress', $this->WarehouseAddress->find('first', $options));

		$addressAndItems = $this->ItemsAddress->find('all', array(
			'conditions' => array(
				'warehouse_addresses_id' => $id
			)
		));

		$this->set('items', $addressAndItems);

		$idPlace = $this->WarehouseAddress->field('warehouse_places_id');
		$placesAndTypes = $this->WarehousePlace->find('all', array(
			'contain' => array('ItemType'),
			'conditions' => array(
				'WarehousePlace.id' => $idPlace
			),
		));
		$types = $placesAndTypes[0]['ItemType'];
		foreach($types as $type){
			$idsOfTypes[] = $type['id'];
		}
		$itemsToAdd = $this->Item->find('list', array('conditions' => array('item_type_id' => $idsOfTypes), 'limit' => 10));
		$this->Session->write('addressId', $id);
		$this->set('itemsToAdd', $itemsToAdd);

	}

    /**
     * searchItem method
     * Searches all items (live AJAX search)
     *
     * @param string $keyword
     * @return $result
     */
	public function searchItem(){
		$this->load();

		if ($this->request->is('ajax')) {
			$this->RequestHandler->setContent('json');
			$this->layout = 'ajax';
			$keword = $_REQUEST['term'];
			$this->disableCache();

			$idPlace = $this->WarehouseAddress->field('warehouse_places_id');
			$placesAndTypes = $this->WarehousePlace->find('all', array(
				'contain' => array('ItemType'),
				'conditions' => array(
					'WarehousePlace.id' => $idPlace
				)
			));
			$types = $placesAndTypes[0]['ItemType'];
			foreach($types as $type){
				$idsOfTypes[] = $type['id'];
			}
			$itemsToAdd = $this->Item->find('all', array('conditions' => array('item_type_id' => $idsOfTypes, 'name LIKE' => '%' . $keword . '%'), 'limit' => 10, 'recursive' => -1));

			$this->set('result', $itemsToAdd);
			$this->set('_serialize', 'result');


		}else{
			throw new NotFoundException(__('Not found!'));
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

			$place = $this->WarehousePlace->findById($this->request->data['WarehouseAddress']['warehouse_places_id']);
			$this->request->data['WarehouseAddress']['code'] = $place['WarehousePlace']['code'] . '_' . $this->request->data['WarehouseAddress']['row']
				. '_' . $this->request->data['WarehouseAddress']['shelf'] . '_' . $this->request->data['WarehouseAddress']['partition'];

			$idOfPlace = (string)$this->request->data['WarehouseAddress']['warehouse_places_id'];
			$lenOfId = strlen($idOfPlace);
			$idOfPlace = $lenOfId == 1 ? '0' . $idOfPlace : $idOfPlace;

			$ascii = ord($this->request->data['WarehouseAddress']['row']);

			$shelf = (string)$this->request->data['WarehouseAddress']['shelf'];
			$lenOfShelf = strlen($shelf);
			$shelf = $lenOfShelf == 1 ? '0' . $shelf : $shelf;

			$partition = (string)$this->request->data['WarehouseAddress']['partition'];
			$lenOfPart = strlen($partition);
			$partition = $lenOfPart == 1 ? '0' . $partition : $partition;

			$this->request->data['WarehouseAddress']['barcode'] = '2912' . $idOfPlace . $ascii . $shelf . $partition;

			$digits = array_reverse(str_split($this->request->data['WarehouseAddress']['barcode']));
			$even = 0;
			$odd = 0;
			for($i = 0; $i < count($digits); $i++){
				if($i % 2 == 0){
					$odd += $digits[$i];
				}
				else{
					$even += $digits[$i];
				}
			}

			$checksum = (10 - ((3 * $odd + $even) % 10)) % 10;

			$this->request->data['WarehouseAddress']['barcode'] .= $checksum;

			debug($this->request->data);

			$data = array(
				'WarehouseAddress' => array(
					'row' => $this->request->data['WarehouseAddress']['row'],
					'shelf' => $this->request->data['WarehouseAddress']['shelf'],
					'partition' => $this->request->data['WarehouseAddress']['partition'],
					'warehouse_places_id' => $this->request->data['WarehouseAddress']['warehouse_places_id'],
					'active' => $this->request->data['WarehouseAddress']['active'],
					'code' => $this->request->data['WarehouseAddress']['code'],
					'barcode' => $this->request->data['WarehouseAddress']['barcode'],
				),
			);

			$this->WarehouseAddress->create();

			if ($this->WarehouseAddress->save($data, array('validate' => 'first'))) {
				$this->Flash->success(__('The Warehouse Address has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}

			if ($this->WarehouseAddress->validationErrors) {
				$this->Flash->warning(array($this->WarehouseAddress->validationErrors), array('key' => 'negative'));
			} else {
				$this->Flash->error(__('The Warehouse Address could not be saved. Please, try again.'));
			}
			debug($this->WarehouseAddress->validationErrors);
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
		if (!$this->WarehouseAddress->exists($id)) {
			throw new NotFoundException(__('Invalid warehouse place'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$place = $this->WarehousePlace->findById($this->request->data['WarehouseAddress']['warehouse_places_id']);
			$this->request->data['WarehouseAddress']['code'] = $place['WarehousePlace']['code'] . '_' . $this->request->data['WarehouseAddress']['row']
				. '_' . $this->request->data['WarehouseAddress']['shelf'] . '_' . $this->request->data['WarehouseAddress']['partition'];

			$this->request->data['WarehouseAddress']['warehouse_places_id'] = $place['WarehousePlace']['id'];

			$data = array(
				'WarehouseAddress' => array(
					'id' => $this->request->data['WarehouseAddress']['id'],
					'row' => $this->request->data['WarehouseAddress']['row'],
					'shelf' => $this->request->data['WarehouseAddress']['shelf'],
					'partition' => $this->request->data['WarehouseAddress']['partition'],
					'warehouse_places_id' => $this->request->data['WarehouseAddress']['warehouse_places_id'],
					'active' => $this->request->data['WarehouseAddress']['active'],
					'code' => $this->request->data['WarehouseAddress']['code'],
				),
			);

			if ($this->WarehouseAddress->saveAssociated($data, array('validate' => 'first'))) {
				$this->Flash->success(__('The Warehouse Place has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			if ($this->WarehouseAddress->validationErrors ) {
				$this->Flash->warning(array($this->WarehouseAddress->validationErrors), array('key' => 'negative'));
			} else {
				$this->Flash->error(__('The Warehouse Place could not be updated. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('WarehouseAddress.' . $this->WarehouseAddress->primaryKey => $id));
			$this->request->data = $this->WarehouseAddress->find('first', $options);
		}

	}

    /**
     * itemToADd method
     *
     *
     * @param string $id
     * @return void
     */
	public function itemToAdd($id = null){
		$this->load();
		$this->request->data['WarehouseAddress']['id'] = $this->Session->read('addressId');

		if($this->request->is(array('post'))){

			$exists = $this->ItemsAddress->find('first', array('conditions' => array(
			'warehouse_addresses_id' => $this->request->data['WarehouseAddress']['id'],
			'items_id' => $this->request->data['Item']['item_id'])));

			$data = array(
				'warehouse_addresses_id' => $this->request->data['WarehouseAddress']['id'],
				'items_id' => $this->request->data['Item']['item_id'],
				'total' => $this->request->data['Item']['total']
			);

			if(empty($exists)){
				if ($this->ItemsAddress->save($data, array('validate' => 'first',))) {
					$this->Flash->success(__('This item has been successfully added to the requested address.'));
					return $this->redirect($this->referer());
				}

				else {
					$this->Flash->error(__('This item could not be added to this address. Please, try again.'));
				}
			} else {$this->Flash->error(__('This item already exists on this address!'));
				return $this->redirect($this->referer());}

		}
	}

    /**
     * removeFromAddress method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
	public function removeFromAddress($id = null){
		$this->load();
		if (!$this->Item->exists($id)) {
			throw new NotFoundException(__('Invalid item'));
		}
		$this->WarehouseAddress->id = $this->Session->read('addressId');
		if($this->ItemsAddress->deleteAll(array('warehouse_addresses_id' => $this->Session->read('addressId'), 'items_id' => $id), false, false)){
			$this->Flash->success(__('This item has been successfully removed from the requested address.'));
			$this->redirect($this->referer());
		}
		else {
			$this->Flash->error(__('This item could not be removed from this address. Please, try again.'));
		}
	}

/**
 * init_tcpdf method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function init_tcpdf($id = null){
		//Init PDF
		$pdf = null;
		while (!class_exists('PDF')) {
			//Init PDF
			App::import('Vendor', 'PDF', array('file' => 'tcpdf' . DS . 'pdf.php'));
		}

		$data = $this->WarehouseAddress->findById($id);

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

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->WarehouseAddress->exists($id)) {
			throw new NotFoundException(__('Invalid warehouse address'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->WarehouseAddress->delete($id)) {
			$this->Flash->success(__('The warehouse address has been deleted.'));
		} else {
			$this->Flash->error(__('The warehouse address could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view');
    }
}
