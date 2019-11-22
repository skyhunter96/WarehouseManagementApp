<?php
/**
 * Material Fixture
 */
class MaterialFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'status' => array('type' => 'enum(\'development\',\'in_use\',\'phase_out\',\'obsolete\')', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'is_for_service_production' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'recommended_rating' => array('type' => 'enum(\'platinum\',\'gold\',\'silver\')', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_materials_items1_idx' => array('column' => 'item_id', 'unique' => 0)
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
			'status' => '',
			'is_for_service_production' => 1,
			'recommended_rating' => '',
			'created' => '2019-10-28 10:38:07',
			'modified' => '2019-10-28 10:38:07'
		),
	);

}
