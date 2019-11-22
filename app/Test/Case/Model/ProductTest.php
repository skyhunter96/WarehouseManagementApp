<?php
App::uses('Product', 'Model');

/**
 * Product Test Case
 */
class ProductTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.product',
		'app.item',
		'app.measurement_unit',
		'app.item_type',
		'app.consumable',
		'app.good',
		'app.inventory',
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
		$this->Product = ClassRegistry::init('Product');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Product);

		parent::tearDown();
	}

}
