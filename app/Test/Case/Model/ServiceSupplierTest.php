<?php
App::uses('ServiceSupplier', 'Model');

/**
 * ServiceSupplier Test Case
 */
class ServiceSupplierTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.service_supplier',
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
		'app.service_product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ServiceSupplier = ClassRegistry::init('ServiceSupplier');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ServiceSupplier);

		parent::tearDown();
	}

}
