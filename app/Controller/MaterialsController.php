<?php
App::uses('AppController', 'Controller');
App::uses('MeasurementUnit', 'Model');
App::uses('ItemType', 'Model');
App::uses('Item', 'Model');
App::uses('Folder', 'Utility');

/**
 * Materials Controller
 *
 * @property Material $Material
 * @property PaginatorComponent $Paginator
 */
class MaterialsController extends AppController
{

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
		$this->set(compact('items'));
		$this->set('status', $this->Material->status);
		$this->set('recommended_rating', $this->Material->recommended_rating);
		$this->loadModel('MeasurementUnit');
		$this->loadModel('ItemType');
		$this->loadModel('Item');
		$this->loadModel('WarehousePlace');
		$this->loadModel('WarehouseAddress');
		$this->set('measurement_units', $this->MeasurementUnit->getAll());
		$this->set('item_types', $this->ItemType->getAll());
	}

	public function setCode($id){
		$this->load();
		$typeId = $id;
		$typeCode = $this->ItemType->findById($typeId);
		$code = $typeCode['ItemType']['code'];
		$totalItems = count($this->Item->findAllByItemTypeId($typeId)) + 1;
		$finalCode = $code . '-' . $totalItems;

		$conditions = array(
			'code' => $finalCode
		);
		if($this->Item->hasAny($conditions)){

			$last = $this->Item->find('all', array('conditions' => array('item_type_id' => $typeId), 'order' => array('Item.code' => 'DESC')));

			foreach($last as $l){
				$newCode = $l['Item']['code'];
				$newCode = explode('-', $newCode);
				$newCode = $newCode[1];
				$codes[] = $newCode;
			}
			$updatedCodeValue = max($codes) + 1;
			$finalCode = $code . '-' . $updatedCodeValue;
		}
		return $finalCode;
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index()
	{
		if ($this->request->is(array('post', 'put'))) {
			$keyword = $this->request->data['Item']['keywords'];
			$this->Material->recursive = 0;
			$this->paginate = array(
				'conditions' => array('Item.is_deleted' => false, 'Item.name LIKE' => '%' . $keyword . '%')
			);
			$this->set('materials', $this->Paginator->paginate());
		}else{

		$this->Material->recursive = 0;

		/**
		 * conditions for index method
		 *
		 * @return only fields that are not soft deleted
		 */
		$this->paginate = array(
			'conditions' => array('Item.is_deleted' => false)
		);
		$this->set('materials', $this->Paginator->paginate());}
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 * @throws NotFoundException
	 */
	public function view($id = null)
	{
		$this->load();
		if (!$this->Material->exists($id)) {
			throw new NotFoundException(__('Invalid material'));
		}
		$options = array('conditions' => array('Material.' . $this->Material->primaryKey => $id));
		$material = $this->Material->find('first', $options);
		$this->set('material', $material);
		$this->set('measurement_unit', $this->MeasurementUnit->findById($material['Item']['measurement_unit_id']));
		$this->set('item_type', $this->ItemType->findById($material['Item']['item_type_id']));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		$this->load(); //USES LOAD FUNCT TO LOAD DATA FOR ALL APPROPRIATE FIELDS

		if ($this->request->is('post')) {
			$typeId = $this->request->data['Item']['ItemTypeId'];
			$typeCode = $this->ItemType->findById($typeId);
			$code = $typeCode['ItemType']['code'];
			$totalItems = count($this->Item->findAllByItemTypeId($typeId)) + 1;
			$finalCode = $code . '-' . $totalItems;

			$conditions = array(
				'code' => $finalCode
			);
			if ($this->Item->hasAny($conditions)) {

				$last = $this->Item->find('all', array('conditions' => array('item_type_id' => $typeId), 'order' => array('Item.code' => 'DESC')));

				foreach ($last as $l) {
					$newCode = $l['Item']['code'];
					$newCode = explode('-', $newCode);
					$newCode = $newCode[1];
					$codes[] = $newCode;
				}
				$updatedCodeValue = max($codes) + 1;
				$finalCode = $code . '-' . $updatedCodeValue;
			}

			$data = array(
				'Item' => array(
					'code' => $finalCode,
					'name' => $this->request->data['Item']['name'],
					'description' => $this->request->data['Item']['description'],
					'weight' => $this->request->data['Item']['weight'],
					'measurement_unit_id' => $this->request->data['Item']['measurement_unit_id'],
					'item_type_id' => $this->request->data['Item']['ItemTypeId'],
					'is_deleted' => false
				),
				'Material' => array(
					'status' => $this->request->data['Material']['status'],
					'is_for_service_production' => $this->request->data['Material']['is_for_service_production'],
					'recommended_rating' => $this->request->data['Material']['recommended_rating']
				)
			);

			$this->Material->create();
			$this->Item->create();

			if ($this->Material->saveAssociated($data, array('validate' => 'first'))) {
				$this->Flash->success(__('The material has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			if ($this->Material->validationErrors || $this->Item->validationErrors) {
				$this->Flash->warning(array($this->Material->validationErrors, $this->Item->validationErrors), array('key' => 'negative'));
			} else {
				$this->Flash->error(__('The material could not be saved. Please, try again.'));
			}
		}
	}

	/**
	 * edit method
	 *
	 * @param string $id
	 * @return void
	 * @throws NotFoundException
	 */
	public function edit($id = null)
	{
		if (!$this->Material->exists($id)) {
			throw new NotFoundException(__('Invalid material'));
		}
		$this->load();
		if ($id) {
			$this->request->data['Material']['id'] = $id;
			$material = $this->Material->findById($this->request->data['Material']['id']);
			$this->request->data['Item']['id'] = $material['Item']['id'];
			$itemTypeCode = $material['Item']['code'];
		}

		if ($this->request->is(array('post', 'put'))) {

			$data = array(
				'Item' => array(
					'id' => $this->request->data['Item']['id'],
					'name' => $this->request->data['Item']['name'],
					'description' => $this->request->data['Item']['description'],
					'weight' => $this->request->data['Item']['weight'],
					'measurement_unit_id' => $this->request->data['Item']['measurement_unit_id'],
					'is_deleted' => false
				),
				'Material' => array(
					'id' => $this->request->data['Material']['id'],
					'status' => $this->request->data['Material']['status'],
					'is_for_service_production' => $this->request->data['Material']['is_for_service_production'],
					'recommended_rating' => $this->request->data['Material']['recommended_rating']
				)
			);

			if ($this->Material->saveAssociated($data, array('validate' => 'first'))) {
				$this->Flash->success(__('The material has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			if ($this->Material->validationErrors || $this->Item->validationErrors) {
				$this->Flash->warning(array($this->Material->validationErrors, $this->Item->validationErrors), array('key' => 'negative'));
			} else {
				$this->Flash->error(__('The material could not be updated. Please, try again.'));
			}

		} else {
			$options = array('conditions' => array('Material.' . $this->Material->primaryKey => $id));
			$this->request->data = $this->Material->find('first', $options);
		}

	}

	/**
	 * delete method
	 *
	 * @param string $id
	 * @return void
	 * @throws NotFoundException
	 */
	public function delete($id = null)
	{
		if (!$this->Material->exists($id)) {
			throw new NotFoundException(__('Invalid material'));
		}
		$this->loadModel('Item');
		$this->request->allowMethod('post', 'delete');
		$material = $this->Material->findById($id);
		$this->Item->read(null, $material['Material']['item_id']);
		$this->Item->set('is_deleted', true);

		if ($material['Material']['status'] == 'obsolete') {
			if ($this->Item->save()) {
				$this->Flash->success(__('The material has been deleted.'));
			} else {
				$this->Flash->error(__('The material could not be deleted. Please, try again.'));
			}
		} else {
			$this->Flash->error(__('This material is in use, therefore it cannot  be deleted, please change its status first'));
		}

		return $this->redirect(array('action' => 'index'));
	}

	/**
	 * Method for importing records from excel file
	 *
	 * @return void
	 */

	public function import_excel() {
		$this->load();
		//Set page title
		$this->set('title_for_layout', 'Uvoz podataka iz excela');
		set_time_limit(0);
		ini_set('memory_limit', '1500M');
		if ($this->request->is('post') || $this->request->is('put')) {
			//Init data
			$starting_row = 1;
			$active_sheet = 0;

			//Check for uploaded file
			if(empty($this->request->data['Material']['excel_file']['name'])){
				debug($this->request->data['Material']);
				throw new Exception('Fajl nije ispravno prenet! Pokušajte ponovo.');
			}

			//Check if uploaded file is in excel format
			$upload_name = $this->request->data['Material']['excel_file']['name'];
			if(substr($upload_name, -4) != '.xls' && substr($upload_name, -5) != '.xlsx'){
				throw new Exception('Fajl nije u Excel formatu!');
			}
			//Move uploaded file
			$file = $this->request->data['Material']['excel_file'];
			$file['name'] = date('Ymdhis-') . $file['name'];
			$dir = new Folder(TMP, true, 0755);
			$dest = TMP . $file['name'];
			if(!move_uploaded_file($file['tmp_name'], $dest)){
				throw new Exception('Fajl me nože biti prenet!');
			}
			//Init Excel
			App::import('Vendor', 'Excel', array('file' => 'phpexcel/excel.php'));
			$inputFileName = TMP.$file['name'];
			//Read your Excel workbook
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
			//Set active sheet
			$objWorksheet = $objPHPExcel->setActiveSheetIndex($active_sheet);
			// Get worksheet dimensions
			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow();
			$highestColumn = $sheet->getHighestColumn();
			$order_record_count = 0;
			$i = 0;
			for ($row = $starting_row; $row <= $highestRow + 1; $row++){
				$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

				if($rowData[0][0] != 'name'){

					$conditions = array(
						'name' => $rowData[0][0]
					);

					if($this->Item->hasAny($conditions)) continue;

					$finalCode = $this->setCode(6);
					$serviceP = $rowData[0][2] == 0 ? false : true;
					$data = array(
						'Item' => array(
							'name' => $rowData[0][0],
							'code' => $finalCode,
							'item_type_id' => 6,
							'is_deleted' => false
						),
						'Material' => array(
							'status' => $rowData[0][1],
							'is_for_service_production' => $serviceP,
							'recommended_rating' => $rowData[0][3],
						)
					);

					$saved = $this->Material->saveAssociated($data);

					$i++;
				}

			}

			return $this->redirect(array('action' => 'index'));
			exit();
		}

	}

    /**
     * init_tcpdf method
     * Initializes a pdf file listing all of materials
     * @return void
     */
	public function init_tcpdf(){
		//Init PDF
        set_time_limit(0);
        ini_set('memory_limit', '1500M');
		$pdf = null;
		while (!class_exists('PDF')) {
			//Init PDF
			App::import('Vendor', 'PDF', array('file' => 'tcpdf' . DS . 'pdf.php'));
		}

		$data = $this->Material->find('all');
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
 * edit method
 *
 * @param string $id
 * @return void
 * @throws NotFoundException
 */

	public function addToWarehouse($id = null){
		$this->load();
		if (!$this->Material->exists($id)) {
			throw new NotFoundException(__('Invalid material'));
		}
		$this->Material->id = $id;
		$idItem = $this->Material->field('item_id');
		$item = $this->Item->findById($idItem);
		$idItemType = $item['ItemType']['id'];

		$placesAndTypes = $this->ItemType->find('all', array(
			'contain' => array('WarehousePlace'),
			'conditions' => array(
				'ItemType.id' => $idItemType,
			),
		));

		for($i = 0; $i < count($placesAndTypes[0]['WarehousePlace']); $i++){
			if(!$placesAndTypes[0]['WarehousePlace'][$i]['is_active']){
				unset($placesAndTypes[0]['WarehousePlace'][$i]);
			}
		}

		$types = $placesAndTypes[0]['ItemType'];
		$places =$placesAndTypes[0]['WarehousePlace'];
		$this->set('idItem', $idItem);
		$this->set('type', $types);
		$this->set('places', $places);
		$this->Session->write('idItem', $idItem);
	}

	public function viewAddresses($id = null){
		$this->load();
		if (!$this->WarehousePlace->exists($id)) {
			throw new NotFoundException(__('Invalid warehouse place'));
		}

		$addresses = $this->WarehouseAddress->find('all', array('conditions' => array('active' => true, 'warehouse_places_id' => $id)));
		$this->set('adresses', $addresses);

	}

	public function addToAddress($id = null){
		$this->load();
		if (!$this->WarehouseAddress->exists($id)) {
			throw new NotFoundException(__('Invalid warehouse address'));
		}

		if ($this->request->is(array('post'))) {

			$data = array(
				'Item' => array(
					'id' => $this->Session->read('idItem'),
				),
				'WarehouseAddress' => array(
					'id' => $id
				)
			);

			if ($this->Item->saveAll($data, array('validate' => 'first', 'deep' => true))) {
				$this->Flash->success(__('The material has been successfully added to the requested address.'));
				return $this->redirect(array('action' => 'index'));
			}
			else {
				$this->Flash->error(__('The material could not be added to this address. Please, try again.'));
			}

		}

	}

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view');
    }

}
