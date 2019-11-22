<?php
App::uses('AppModel', 'Model');
/**
 * ServiceSupplier Model
 *
 * @property Item $Item
 */
class ServiceSupplier extends AppModel {

	public $status = array(
		'draft' => 'Scheduled for arrival',
		'in_use' => 'In regular use',
		'phase_out' => 'Going to be outdated',
		'obsolete' => 'Not in regular use'
	);

	public $recommended_rating = array(
		'platinum' => 'platinum',
		'gold' => 'gold',
		'silver' => 'silver'
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'item_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),

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
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
