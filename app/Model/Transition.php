<?php
App::uses('AppModel', 'Model');
/**
 * Transition Model
 *
 * @property Item $Item
 */
class Transition extends AppModel {

	public $status = array(
		'open' => 'Open for creating',
		'sent' => 'Sent to storekeeper',
		'ready' => 'Ready for transition',
		'delivered' => 'Delivered',
		'canceled' => 'Canceled'
	);

	public $type = array(
		'standard' => 'Standard',
		'requisition' => 'Requisition'
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'code' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Not a correct value',
			),
		),
		'user_created_by' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Not a correct value'
			),
		),
		'warehouses_places_from' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Not a correct value'
			),
		),
		'warehouses_places_to' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Not a correct value'
			),
		),
		'user_issued_by' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Not a correct value'
			),
		),
		'user_received_by' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Not a correct value'
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed


	public $hasMany = array(
		'TransitionsItem' => array(
			'className' => 'TransitionsItems',
			'foreignKey' => 'transitions_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */




}
