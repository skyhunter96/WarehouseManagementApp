<?php
App::uses('ItemsAddress', 'Model');

/**
 * ItemsAddress Test Case
 */
class ItemsAddressTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.items_address',
		'app.warehouse_addresses',
		'app.items'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ItemsAddress = ClassRegistry::init('ItemsAddress');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ItemsAddress);

		parent::tearDown();
	}

}
