<?php
App::uses('AppModel', 'Model');
/**
 * ItemsAddress Model
 *
 * @property WarehouseAddresses $WarehouseAddresses
 * @property Items $Items
 */
class ItemsAddress extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'warehouse_addresses_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Not a correct value',
		),

	));

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'WarehouseAddresses' => array(
			'className' => 'WarehouseAddresses',
			'foreignKey' => 'warehouse_addresses_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Items' => array(
			'className' => 'Items',
			'foreignKey' => 'items_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
