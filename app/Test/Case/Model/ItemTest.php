<?php
App::uses('Item', 'Model');

/**
 * Item Test Case
 */
class ItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.item',
		'app.measurement_unit',
		'app.item_type',
		'app.consumable',
		'app.good',
		'app.inventory',
		'app.kit',
		'app.material',
		'app.product',
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
		$this->Item = ClassRegistry::init('Item');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Item);

		parent::tearDown();
	}

}
