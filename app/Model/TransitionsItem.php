<?php
App::uses('AppModel', 'Model');
/**
 * TransitionsItem Model
 *
 * @property Transitions $Transitions
 * @property Items $Items
 */
class TransitionsItem extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'transitions_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Not a correct value',
			),
		),
		'items_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
                'message' => 'Not a correct value'
			),
		),
		'demanded_quantity' => array(
			'numeric' => array(
				'rule' => array('numeric'),
                'message' => 'Not a correct value'
			),
		),
		'from_address' => array(
			'numeric' => array(
				'rule' => array('numeric'),
                'message' => 'Not a correct value'
			),
		),
		'to_address' => array(
			'numeric' => array(
				'rule' => array('numeric'),
                'message' => 'Not a correct value'
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
		'Transitions' => array(
			'className' => 'Transitions',
			'foreignKey' => 'transitions_id',
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
