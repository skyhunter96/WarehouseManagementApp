<?php
App::uses('Permit', 'Model');

/**
 * Permit Test Case
 */
class PermitTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.permit',
		'app.users',
		'app.warehouse_places'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Permit = ClassRegistry::init('Permit');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Permit);

		parent::tearDown();
	}

}
