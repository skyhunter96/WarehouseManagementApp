<?php
App::uses('AppModel', 'Model');
/**
 * MeasurementUnit Model
 *
 * @property Item $Item
 */
class MeasurementUnit extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public function getAll(){
		return $this->find('list', array('keyField' => 'id', 'valueField' => 'name'));
	}

	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'A name is required',
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Measurement unit with this name already exists!',
			),
			'between' => array(
				'rule' => array('lengthBetween', 2, 30),
				'message' => 'Name must be between 2 and 30 characters long'
			),
			'letters' => array(
				'rule' => array('custom', '/[a-zA-Z]/'),
				'message' => 'Name must contain only letters'
			)
		),
		'symbol' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'A symbol is required'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Symbol with this name already exists!',
			),
			'between' => array(
				'rule' => array('lengthBetween', 0, 5),
				'message' => 'Symbol must be between 0 and 5 characters long'
			),
			'letters' => array(
				'rule' => array('custom', '/[a-zA-Z]/'),
				'message' => 'Symbol must contain only letters'
			)
		),
		'active' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Incorrect value for the checkbox'
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'measurement_unit_id',
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

}
