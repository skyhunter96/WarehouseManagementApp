<?php
App::uses('Transition', 'Model');

/**
 * Transition Test Case
 */
class TransitionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.transition',
		'app.item',
		'app.measurement_unit',
		'app.item_type',
		'app.warehouse_place',
		'app.warehouses',
		'app.items_places',
		'app.warehouse_places_item_type',
		'app.consumable',
		'app.good',
		'app.product',
		'app.inventory',
		'app.kit',
		'app.material',
		'app.semiproduct',
		'app.service_product',
		'app.service_supplier',
		'app.items_address',
		'app.warehouse_addresses',
		'app.items',
		'app.transitions_item'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Transition = ClassRegistry::init('Transition');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Transition);

		parent::tearDown();
	}

}
