<?php
App::uses('WarehousePlace', 'Model');

/**
 * WarehousePlace Test Case
 */
class WarehousePlaceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.warehouse_place',
		'app.warehouses',
		'app.item_type',
		'app.item',
		'app.measurement_unit',
		'app.consumable',
		'app.good',
		'app.product',
		'app.inventory',
		'app.kit',
		'app.material',
		'app.semiproduct',
		'app.service_product',
		'app.service_supplier',
		'app.warehouse_places_item_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->WarehousePlace = ClassRegistry::init('WarehousePlace');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->WarehousePlace);

		parent::tearDown();
	}

}
