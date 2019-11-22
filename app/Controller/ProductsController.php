<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class ProductsController extends AppController {

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
	public function load(){
		$this->set('status', $this->Product->status);
		$this->set('tax', $this->Product->tax);
		$this->loadModel('MeasurementUnit');
		$this->loadModel('ItemType');
		$this->loadModel('Item');
		$this->loadModel('Good');
		$this->loadModel('Kit');
		$this->loadModel('ServiceProducts');
		$this->set('measurement_units', $this->MeasurementUnit->getAll());
		$this->set('item_types', $this->ItemType->getAll());
	}

/**
 * setCode method
 * @param string $id
 * @return int
 */

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
 * setPid method
 * Sets productId (not same as ID!)
 * @param
 * @return int
 */

	public function setPid(){

		$products = $this->Product->find('count');
		$goods = $this->Good->find('count');
		$kits = $this->Kit->find('count');
		$serviceProducts = $this->ServiceProducts->find('count');
		return $products + $goods + $kits + $serviceProducts;
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if ($this->request->is(array('post', 'put'))) {
			$keyword = $this->request->data['Item']['keywords'];
			$this->Product->recursive = 0;
			$this->paginate = array(
				'conditions' => array('Item.is_deleted' => false, 'Item.name LIKE' => '%' . $keyword . '%')
			);
			$this->set('products', $this->Paginator->paginate());
		}else{
			$this->Product->recursive = 0;
			$this->paginate = array(
				'conditions' => array('Item.is_deleted' => false)
			);
			$this->set('products', $this->Paginator->paginate());
		}
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
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$product = $this->Product->find('first', $options);
		$this->set('product', $product);
		$this->set('measurement_unit', $this->MeasurementUnit->findById($product['Item']['measurement_unit_id']));
		$this->set('item_type', $this->ItemType->findById($product['Item']['item_type_id']));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->load();

		if ($this->request->is('post')) {

			$finalCode = $this->setCode($this->request->data['Item']['ItemTypeId']);
			$pid = $this->setPid();

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
				'Product' => array(
					'pid' => $pid,
					'status' => $this->request->data['Product']['status'],
					'is_for_service_production' => $this->request->data['Product']['is_for_service_production'],
					'hts_number' => $this->request->data['Product']['hts_number'],
					'tax_group' => $this->request->data['Product']['tax_group'],
					'eccn' => $this->request->data['Product']['eccn'],
					'release_date' => $this->request->data['Product']['release_date'],
					'is_for_distributors' => $this->request->data['Product']['is_for_distributors'],
					'project' => $this->request->data['Product']['project'],
				)
			);

			$this->Product->create();
			$this->Item->create();

			if($this->Product->saveAssociated($data, array('validate' => 'first'))){
				$this->Flash->success(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			if($this->Product->validationErrors || $this->Item->validationErrors){
				$this->Flash->warning(array($this->Product->validationErrors, $this->Item->validationErrors), array('key' => 'negative'));
			}
			else{
				$this->Flash->error(__('The product could not be saved. Please, try again.'));
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
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->load();

		if($id){
			$this->request->data['Product']['id'] = $id;
			$product = $this->Product->findById($this->request->data['Product']['id']);
			$this->request->data['Item']['id'] = $product['Item']['id'];
			$itemTypeCode = $product['Item']['code'];
		}

		if ($this->request->is(array('post', 'put'))) {

			$typeId = $this->request->data['Item']['item_type_id'];
			$typeCode = $this->ItemType->findById($typeId);
			$code = $typeCode['ItemType']['code'];
			$totalItems = count($this->Item->findAllByItemTypeId($typeId));  //+ 1;
			$hasItems = $totalItems;
			$totalItems++;
			$finalCode = $code . '-' . $totalItems;

			if($this->request->data['Item']['item_type_id'] == $product['Item']['item_type_id']){
				$finalCode = $itemTypeCode;
			}
			else if(($this->request->data['Item']['item_type_id'] != $product['Item']['item_type_id']) && $hasItems){
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

			$data = array(
				'Item' => array(
					'id' => $this->request->data['Item']['id'],
					'name' => $this->request->data['Item']['name'],
					'description' => $this->request->data['Item']['description'],
					'weight' => $this->request->data['Item']['weight'],
					'measurement_unit_id' => $this->request->data['Item']['measurement_unit_id'],
					'is_deleted' => false
				),
				'Product' => array(
					'id' => $this->request->data['Product']['id'],
					'status' => $this->request->data['Product']['status'],
					'is_for_service_production' => $this->request->data['Product']['is_for_service_production'],
					'hts_number' => $this->request->data['Product']['hts_number'],
					'tax_group' => $this->request->data['Product']['tax_group'],
					'eccn' => $this->request->data['Product']['eccn'],
					'release_date' => $this->request->data['Product']['release_date'],
					'is_for_distributors' => $this->request->data['Product']['is_for_distributors'],
					'project' => $this->request->data['Product']['project'],
				)
			);

			if($this->Product->saveAssociated($data, array('validate' => 'first'))){
				$this->Flash->success(__('The product has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			if($this->Product->validationErrors || $this->Item->validationErrors){
				$this->Flash->warning(array($this->Product->validationErrors, $this->Item->validationErrors), array('key' => 'negative'));
			}
			else{
				$this->Flash->error(__('The product could not be updated. Please, try again.'));
			}

		}
		else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
		}
	}

/**
 * search method
 *
 * @throws NotFoundException
 * @param string $keyword
 * @return Product
 */

	public function search(){
		$this->loadModel('Item');
		$this->view('index');
		$keyword = $this->request->data['Item']['keywords'];
		$this->Product->recursive = 0;
		$this->paginate = array(
			'conditions' => array('Item.is_deleted' => false, 'Item.name LIKE' => "%$keyword", 'Item.item_type_id' => 15)
		);
		$this->set('products', $this->Paginator->paginate());
		$this->redirect(array('action' => 'index'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->loadModel('Item');
		$this->request->allowMethod('post', 'delete');
		$product = $this->Product->findById($id);
		$this->Item->read(null, $product['Product']['item_id']);
		$this->Item->set('is_deleted', true);

		if($product['Product']['status'] == 'obsolete'){
			if ($this->Item->save()) {
				$this->Flash->success(__('The product has been deleted.'));
			} else {
				$this->Flash->error(__('The product could not be deleted. Please, try again.'));
			}
		} else{
			$this->Flash->error(__('This product is in use, therefore it cannot  be deleted, please change its status first'));
		}

		return $this->redirect(array('action' => 'index'));
	}

    /**
     * import_excel method
     * Import products from an excel file
     * @return void
     */
	public function import_excel() {

		//Set page title
		$this->set('title_for_layout', 'Uvoz podataka iz excela');
		set_time_limit(0);
		ini_set('memory_limit', '1500M');
		if ($this->request->is('post') || $this->request->is('put')) {
			//Init data
			$starting_row = 1;
			$active_sheet = 0;

			//Check for uploaded file
			if(empty($this->request->data['Product']['excel_file']['name'])){

				throw new Exception('Fajl nije ispravno prenet! Pokušajte ponovo.');
			}

			//Check if uploaded file is in excel format
			$upload_name = $this->request->data['Product']['excel_file']['name'];
			if(substr($upload_name, -4) != '.xls' && substr($upload_name, -5) != '.xlsx'){
				throw new Exception('Fajl nije u Excel formatu!');
			}
			//Move uploaded file
			$file = $this->request->data['Product']['excel_file'];
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
				$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, FALSE, FALSE);

				if($row<10 && $rowData[0][0] != 'name'){
					$finalCode = $this->setCode(15);
					$serviceP = $rowData[0][8] == 0 ? false : true;
					$distributors = $rowData[0][6] == 0 ? false : true;

					if(!$rowData[0][5] == null) {
						$date = explode('/', $rowData[0][5]);

						$date = mktime(0, 0, 0, $date[1], $date[0], $date[2]);
						$date = date("Y-m-d H:i:s", $date);
					} else $date = null;
					$data = array(
						'Item' => array(
							'name' => $rowData[0][0],
							'code' => $finalCode,
							'item_type_id' => 15,
							'is_deleted' => false
						),
						'Product' => array(
							'status' => $rowData[0][7],
							'is_for_service_production' => $serviceP,
							'hts_number' => $rowData[0][2],
							'eccn' => $rowData[0][4],
							'release_date' => $date,
							'is_for_distributors' => $distributors,
							'tax_group' => $rowData[0][3] . '%'
						)
					);

					$saved = $this->Product->saveAssociated($data);

					$i++;
				}

			}


		}

	}

    /**
     * init_tcpdf method
     * Initializes a pdf file listing all of products
     * @return void
     */
	public function init_tcpdf(){
		//Init PDF
		$pdf = null;
		while (!class_exists('PDF')) {
			//Init PDF
			App::import('Vendor', 'PDF', array('file' => 'tcpdf' . DS . 'pdf.php'));
		}

		$data = $this->Product->find('all');
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

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view');
    }
}
