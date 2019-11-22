<?php
App::uses('AppModel', 'Model');
/**
 * Material Model
 *
 * @property Item $Item
 */
class Material extends AppModel {

	public $status = array(
		'development' => 'In development phase',
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

		'is_for_service_production' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Not a correct value',
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
