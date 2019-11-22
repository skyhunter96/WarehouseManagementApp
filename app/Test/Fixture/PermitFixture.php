<?php
/**
 * Permit Fixture
 */
class PermitFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'users_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'warehouse_places_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'allowed' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_users_has_warehouse_places_warehouse_places1_idx' => array('column' => 'warehouse_places_id', 'unique' => 0),
			'fk_users_has_warehouse_places_users1_idx' => array('column' => 'users_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'users_id' => 1,
			'warehouse_places_id' => 1,
			'allowed' => 1,
			'created' => '2019-11-01 10:59:00',
			'modified' => '2019-11-01 10:59:00'
		),
	);

}
