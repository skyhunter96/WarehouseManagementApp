<?php
App::uses('ItemType', 'Model');

/**
 * ItemType Test Case
 */
class ItemTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.item_type',
		'app.item'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ItemType = ClassRegistry::init('ItemType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ItemType);

		parent::tearDown();
	}

}
