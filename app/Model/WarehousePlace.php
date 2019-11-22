<?php
App::uses('AppModel', 'Model');
/**
 * WarehousePlace Model
 *
 * @property Warehouses $Warehouses
 * @property ItemType $ItemType
 */
class WarehousePlace extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(

		'code' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'code is required',
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'This code already exists!'
			),
			'between' => array(
				'rule' => array('lengthBetween', 3, 10),
				'message' => 'code must be between 3 and 80 characters long'
			),
		),
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Name is required',
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'This name already exists!'
			),
			'between' => array(
				'rule' => array('lengthBetween', 3, 80),
				'message' => 'Name must be between 3 and 80 characters long'
			),
		),
		'is_default' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Not a correct value',
			),
		),
		'is_active' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Not a correct value',
			),
		),
		'warehouses_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'Warehouses' => array(
			'className' => 'Warehouses',
			'foreignKey' => 'warehouse_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'ItemType' => array(
			'className' => 'ItemType',
			'joinTable' => 'warehouse_places_item_types',
			'foreignKey' => 'warehouse_places_id',
			'associationForeignKey' => 'item_types_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

	public $hasMany = array(
		'ItemsPlaces' => array(
			'className' => 'ItemsPlaces',
			'foreignKey' => 'warehouse_places_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),);

	public $actsAs = array('Containable');
}
