<?php
App::uses('Kit', 'Model');

/**
 * Kit Test Case
 */
class KitTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.kit',
		'app.item',
		'app.measurement_unit',
		'app.item_type',
		'app.consumable',
		'app.good',
		'app.product',
		'app.inventory',
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
		$this->Kit = ClassRegistry::init('Kit');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Kit);

		parent::tearDown();
	}

}
