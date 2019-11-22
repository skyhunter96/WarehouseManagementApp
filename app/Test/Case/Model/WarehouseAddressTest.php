<?php
App::uses('WarehouseAddress', 'Model');

/**
 * WarehouseAddress Test Case
 */
class WarehouseAddressTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.warehouse_address',
		'app.warehouse_places'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->WarehouseAddress = ClassRegistry::init('WarehouseAddress');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->WarehouseAddress);

		parent::tearDown();
	}

}
