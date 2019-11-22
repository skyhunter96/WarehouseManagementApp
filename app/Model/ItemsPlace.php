<?php
App::uses('AppModel', 'Model');
/**
 * ItemsPlace Model
 *
 * @property Items $Items
 * @property WarehousePlaces $WarehousePlaces
 */
class ItemsPlace extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'items_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Not a correct value',

			),
		),
		'warehouse_places_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Not a correct value',

			),
		),
		'total' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Needs to have a numeric value',
			)
		),
		'available' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Needs to have a numeric value',
			)
		),
		'reserved' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Needs to have a numeric value',
			)
		),
		'used' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Needs to have a numeric value',
			)
		)
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Items' => array(
			'className' => 'Items',
			'foreignKey' => 'items_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'WarehousePlaces' => array(
			'className' => 'WarehousePlaces',
			'foreignKey' => 'warehouse_places_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
