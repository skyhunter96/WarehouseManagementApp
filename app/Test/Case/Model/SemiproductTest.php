<?php
App::uses('Semiproduct', 'Model');

/**
 * Semiproduct Test Case
 */
class SemiproductTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.semiproduct',
		'app.item',
		'app.measurement_unit',
		'app.item_type',
		'app.consumable',
		'app.good',
		'app.inventory',
		'app.kit',
		'app.material',
		'app.product',
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
		$this->Semiproduct = ClassRegistry::init('Semiproduct');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Semiproduct);

		parent::tearDown();
	}

}
