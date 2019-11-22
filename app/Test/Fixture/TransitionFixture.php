<?php
/**
 * Transition Fixture
 */
class TransitionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'user_created_by' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'warehouses_places_from' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'warehouses_places_to' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'user_issued_by' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'user_received_by' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'status' => array('type' => 'enum(\'open\',\'sent\',\'ready\',\'delivered\',\'canceled\')', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'type' => array('type' => 'enum(\'standard\',\'requisition\')', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'work_order' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'code_UNIQUE' => array('column' => 'code', 'unique' => 1),
			'fk_transitions_users1_idx' => array('column' => 'user_created_by', 'unique' => 0),
			'fk_transitions_warehouse_places1_idx' => array('column' => 'warehouses_places_from', 'unique' => 0),
			'fk_transitions_warehouse_places2_idx' => array('column' => 'warehouses_places_to', 'unique' => 0),
			'fk_transitions_users2_idx' => array('column' => 'user_issued_by', 'unique' => 0),
			'fk_transitions_users3_idx' => array('column' => 'user_received_by', 'unique' => 0)
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
			'code' => 'Lorem ipsum dolor sit amet',
			'user_created_by' => 1,
			'warehouses_places_from' => 1,
			'warehouses_places_to' => 1,
			'user_issued_by' => 1,
			'user_received_by' => 1,
			'status' => '',
			'type' => '',
			'work_order' => 'Lorem ipsum dolor sit amet',
			'created' => '2019-11-05 09:23:51',
			'modified' => '2019-11-05 09:23:51'
		),
	);

}
