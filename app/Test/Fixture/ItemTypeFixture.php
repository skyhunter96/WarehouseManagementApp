<?php
/**
 * ItemType Fixture
 */
class ItemTypeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'class' => array('type' => 'enum(\'product\',\'kit\',\'material\',\'semi_product\',\'service_product\',\'service_supplier\',\'consumable\',\'inventory\',\'goods\',\'other\')', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'tangible' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'active' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'code_UNIQUE' => array('column' => 'code', 'unique' => 1)
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
			'code' => 'Lorem ipsum dolor ',
			'name' => 'Lorem ipsum dolor sit amet',
			'class' => '',
			'tangible' => 1,
			'active' => 1,
			'created' => '2019-10-11 10:50:15',
			'modified' => '2019-10-11 10:50:15'
		),
	);

}
