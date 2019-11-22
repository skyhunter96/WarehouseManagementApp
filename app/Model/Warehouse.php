<?php
App::uses('AppModel', 'Model');
/**
 * Warehouse Model
 *
 */
class Warehouse extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => 'notBlank',
				'message' => 'A name is required'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'This name already exists!'
			),
			'between' => array(
				'rule' => array('lengthBetween', 3, 60),
				'message' => 'Name must be between 3 and 30 characters long'
			)
		),
	);
}
