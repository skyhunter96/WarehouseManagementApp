<?php
/**
 * Good Fixture
 */
class GoodFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'pid' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'unique'),
		'status' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'hts_number' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'tax_group' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'eccn' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'release_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'is_for_distributors' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'pid_UNIQUE' => array('column' => 'pid', 'unique' => 1),
			'fk_goods_items1_idx' => array('column' => 'item_id', 'unique' => 0)
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
			'item_id' => 1,
			'pid' => 1,
			'status' => 'Lorem ipsum dolor sit amet',
			'hts_number' => 'Lorem ipsum dolor sit amet',
			'tax_group' => 'Lorem ipsum dolor sit amet',
			'eccn' => 'Lorem ipsum dolor sit amet',
			'release_date' => '2019-10-18 14:25:55',
			'is_for_distributors' => 1,
			'created' => '2019-10-18 14:25:55',
			'modified' => '2019-10-18 14:25:55'
		),
	);

}
