<?php
App::uses('Inventory', 'Model');

/**
 * Inventory Test Case
 */
class InventoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.inventory',
		'app.item',
		'app.measurement_unit',
		'app.item_type',
		'app.consumable',
		'app.good',
		'app.product',
		'app.kit',
		'app.material',
		'app.semiproduct',
		'app.service_product',
		'app.service_supplier'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Inventory = ClassRegistry::init('Inventory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Inventory);

		parent::tearDown();
	}

}
