<?php
App::uses('AppController', 'Controller');
/**
 * MeasurementUnits Controller
 *
 * @property MeasurementUnit $MeasurementUnit
 * @property PaginatorComponent $Paginator
 */
class MeasurementUnitsController extends AppController {

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
		$this->MeasurementUnit->recursive = 0;
		$this->set('measurementUnits', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MeasurementUnit->exists($id)) {
			throw new NotFoundException(__('Invalid measurement unit'));
		}
		$options = array('conditions' => array('MeasurementUnit.' . $this->MeasurementUnit->primaryKey => $id));
		$this->set('measurementUnit', $this->MeasurementUnit->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MeasurementUnit->set($this->request->data);

			if($this->MeasurementUnit->validates()){

				$this->MeasurementUnit->create();
				if ($this->MeasurementUnit->save($this->request->data)) {
					$this->Flash->success(__('The measurement unit has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Flash->error(__('The measurement unit could not be saved. Please, try again.'));
				}
			}
			$this->Flash->warning($this->MeasurementUnit->validationErrors, array(
				'key' => 'negative'
			));
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
		if (!$this->MeasurementUnit->exists($id)) {
			throw new NotFoundException(__('Invalid measurement unit'));
		}
		if ($this->request->is(array('post', 'put'))) {

			$this->MeasurementUnit->set($this->request->data);

			if($this->MeasurementUnit->validates()) {
				$this->MeasurementUnit->create();
				if ($this->MeasurementUnit->save($this->request->data)) {
					$this->Flash->success(__('The measurement unit has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Flash->error(__('The measurement unit could not be saved. Please, try again.'));
				}
			}
			else{
				$this->Flash->warning($this->MeasurementUnit->validationErrors, array(
					'key' => 'negative'
				));
			}
		} else {
			$options = array('conditions' => array('MeasurementUnit.' . $this->MeasurementUnit->primaryKey => $id));
			$this->request->data = $this->MeasurementUnit->find('first', $options);
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
		if (!$this->MeasurementUnit->exists($id)) {
			throw new NotFoundException(__('Invalid measurement unit'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->MeasurementUnit->delete($id)) {
			$this->Flash->success(__('The measurement unit has been deleted.'));
		} else {
			$this->Flash->error(__('The measurement unit could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    /**
     * init_tcpdf method
     * Initializes a pdf file listing all of measurement units
     * @return void
     */
	public function init_tcpdf(){
		//Init PDF
		$pdf = null;
		while (!class_exists('PDF')) {
			//Init PDF
			App::import('Vendor', 'PDF', array('file' => 'tcpdf' . DS . 'pdf.php'));
		}

		$data = $this->MeasurementUnit->find('all');
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
}
