<?php
/**
 * TransitionsItem Fixture
 */
class TransitionsItemFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'transitions_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'items_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'demanded_quantity' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'issued_quantity' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'from_address' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'to_address' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_transitions_has_items_items1_idx' => array('column' => 'items_id', 'unique' => 0),
			'fk_transitions_has_items_transitions1_idx' => array('column' => 'transitions_id', 'unique' => 0),
			'fk_transitions_items_warehouse_places1_idx' => array('column' => 'from_address', 'unique' => 0),
			'fk_transitions_items_warehouse_places2_idx' => array('column' => 'to_address', 'unique' => 0)
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
			'transitions_id' => 1,
			'items_id' => 1,
			'demanded_quantity' => 1,
			'issued_quantity' => 1,
			'from_address' => 1,
			'to_address' => 1
		),
	);

}
