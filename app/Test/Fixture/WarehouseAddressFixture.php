<?php
/**
 * WarehouseAddress Fixture
 */
class WarehouseAddressFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'row' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'shelf' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'partition' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'barcode' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'warehouse_places_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'active' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'code_UNIQUE' => array('column' => 'code', 'unique' => 1),
			'barcode_UNIQUE' => array('column' => 'barcode', 'unique' => 1),
			'fk_warehouse_addresses_warehouse_places1_idx' => array('column' => 'warehouse_places_id', 'unique' => 0)
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
			'row' => 'Lorem ipsum dolor sit amet',
			'shelf' => 1,
			'partition' => 1,
			'barcode' => 'Lorem ipsum dolor sit amet',
			'warehouse_places_id' => 1,
			'active' => 1,
			'created' => '2019-10-30 13:55:17',
			'modified' => '2019-10-30 13:55:17'
		),
	);

}
