<?php
App::uses('Material', 'Model');

/**
 * Material Test Case
 */
class MaterialTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.material',
		'app.item',
		'app.measurement_unit',
		'app.item_type',
		'app.consumable',
		'app.good',
		'app.product',
		'app.inventory',
		'app.kit',
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
		$this->Material = ClassRegistry::init('Material');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Material);

		parent::tearDown();
	}

}
