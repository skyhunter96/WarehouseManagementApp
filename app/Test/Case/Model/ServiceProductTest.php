<?php
App::uses('ServiceProduct', 'Model');

/**
 * ServiceProduct Test Case
 */
class ServiceProductTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.service_product',
		'app.item',
		'app.measurement_unit',
		'app.item_type',
		'app.consumable',
		'app.good',
		'app.product',
		'app.inventory',
		'app.kit',
		'app.material',
		'app.semiproduct',
		'app.service_supplier'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ServiceProduct = ClassRegistry::init('ServiceProduct');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ServiceProduct);

		parent::tearDown();
	}

}
