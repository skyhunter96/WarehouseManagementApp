<?php
App::uses('Consumable', 'Model');

/**
 * Consumable Test Case
 */
class ConsumableTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.consumable',
		'app.item',
		'app.measurement_unit',
		'app.item_type',
		'app.good',
		'app.product',
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
		$this->Consumable = ClassRegistry::init('Consumable');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Consumable);

		parent::tearDown();
	}

}
