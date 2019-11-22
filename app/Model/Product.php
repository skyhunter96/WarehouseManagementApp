<?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 * @property Item $Item
 */
class Product extends AppModel {

	public $status = array(
		'development' => 'In development phase',
		'for_sale' => 'For sale',
		'nrnd' =>  'Not going to be used soon',
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
				'message' => 'Not a correct value',
			),
		),
		'is_for_service_production' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Not a correct value',
			),
		),
		'project' => array(

			'between' => array(
				'rule' => array('lengthBetween', 0, 30),
				'message' => 'Name must be between 3 and 30 characters long'
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

	public $hasOne = array(

	);
}
