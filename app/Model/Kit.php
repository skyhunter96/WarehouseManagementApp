<?php
App::uses('AppModel', 'Model');
/**
 * Kit Model
 *
 * @property Item $Item
 */
class Kit extends AppModel {

	public $status = array(
		'development' => 'In development phase',
		'for_sale' => 'For sale',
		'nrnd' => 'Not going to be used soon',
		'phase_out' => 'Going to be outdated',
		'obsolete' => 'Not in regular use',
	);

	public $tax = array(
		'20%' => '20%',
		'30%' => '30%'
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(

		'is_for_distributors' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Your custom message here',
			),
		),

		'hts_number' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'hts_number is required',
			),
			'between' => array(
				'rule' => array('lengthBetween', 3, 30),
				'message' => 'Hts number must be between 3 and 30 characters long'
			),
		),
		'eccn' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'eccn is required',
			),
			'between' => array(
				'rule' => array('lengthBetween', 3, 30),
				'message' => 'eccn number must be between 3 and 30 characters long'
			),
		),
		'date' => array(
			'isDate' => array(
				'rule' => array('datetime', 'mdy'),
				'message' => 'Please enter a valid datetime'
			)
		),
		'tax_group' => array(
			'valid' => array(
				'rule' => array('inList', array('20%', '30%'))
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
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
