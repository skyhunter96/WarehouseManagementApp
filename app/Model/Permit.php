<?php
App::uses('AppModel', 'Model');
/**
 * Permit Model
 *
 * @property Users $Users
 * @property WarehousePlaces $WarehousePlaces
 */
class Permit extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'users_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Invalid value',

			),
		),
		'warehouse_places_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Invalid value',

			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Users' => array(
			'className' => 'User',
			'foreignKey' => 'users_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'WarehousePlaces' => array(
			'className' => 'WarehousePlace',
			'foreignKey' => 'warehouse_places_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
