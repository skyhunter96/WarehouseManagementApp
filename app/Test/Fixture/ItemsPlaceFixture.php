<?php
/**
 * ItemsPlace Fixture
 */
class ItemsPlaceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'items_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'warehouse_places_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'total' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'available' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'reserved' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'used' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_items_places_items1_idx' => array('column' => 'items_id', 'unique' => 0),
			'fk_items_places_warehouse_places1_idx' => array('column' => 'warehouse_places_id', 'unique' => 0)
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
			'items_id' => 1,
			'warehouse_places_id' => 1,
			'total' => 1,
			'available' => 1,
			'reserved' => 1,
			'used' => 1
		),
	);

}
