<?php
App::uses('ItemsPlace', 'Model');

/**
 * ItemsPlace Test Case
 */
class ItemsPlaceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.items_place',
		'app.items',
		'app.warehouse_places'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ItemsPlace = ClassRegistry::init('ItemsPlace');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ItemsPlace);

		parent::tearDown();
	}

}
