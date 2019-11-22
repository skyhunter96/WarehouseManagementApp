<?php
App::uses('MeasurementUnit', 'Model');

/**
 * MeasurementUnit Test Case
 */
class MeasurementUnitTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.measurement_unit',
		'app.item'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MeasurementUnit = ClassRegistry::init('MeasurementUnit');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MeasurementUnit);

		parent::tearDown();
	}

}
