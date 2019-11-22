<?php
App::uses('TransitionsItem', 'Model');

/**
 * TransitionsItem Test Case
 */
class TransitionsItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.transitions_item',
		'app.transitions',
		'app.items'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TransitionsItem = ClassRegistry::init('TransitionsItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TransitionsItem);

		parent::tearDown();
	}

}
