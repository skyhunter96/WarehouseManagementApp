<?php
/**
 * ItemsAddress Fixture
 */
class ItemsAddressFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'warehouse_addresses_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'items_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'indexes' => array(
			'fk_warehouse_addresses_has_items_items2_idx' => array('column' => 'items_id', 'unique' => 0),
			'fk_warehouse_addresses_has_items_warehouse_addresses2_idx' => array('column' => 'warehouse_addresses_id', 'unique' => 0)
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
			'warehouse_addresses_id' => 1,
			'items_id' => 1
		),
	);

}
