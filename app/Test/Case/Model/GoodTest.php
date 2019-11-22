<?php
App::uses('Good', 'Model');

/**
 * Good Test Case
 */
class GoodTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.good',
		'app.item',
		'app.measurement_unit',
		'app.item_type',
		'app.consumable',
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
		$this->Good = ClassRegistry::init('Good');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Good);

		parent::tearDown();
	}

}
