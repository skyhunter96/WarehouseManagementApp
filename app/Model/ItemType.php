	<?php

App::uses('AppModel', 'Model');
/**
 * ItemType Model
 *
 * @property Item $Item
 */
class ItemType extends AppModel {

	public function getAll(){
		return $this->find('list', array('keyField' => 'id', 'valueField' => 'name'));
	}

	public $classes = array(
		'product' => 'Proizvod',
		'kit' => 'Kit (bundle)',
		'material' => 'Repromaterijal',
		'semi_product' => 'Poluproizvod',
		'service_product' => 'Prodajna usluga',
		'service_supplier' => 'Usluga od dobavljača',
		'consumable' => 'Potrošna roba',
		'inventory' => 'Inventar',
		'goods' => 'Proizvod za preprodaju',
		'other' => 'Ostalo (neklasifikovani tip)'
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'code' => array(
			'required' => array(
				'rule' => 'notBlank',
				'message' => 'A code is required'
			),
			'alphanum' => array(
				'rule' => 'alphanumeric',
				'message' => 'A code must be an alphanumeric value'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'This code already exists!',
				'required' => 'create'
			),
			'between' => array(
				'rule' => array('lengthBetween', 2, 7),
				'message' => 'Code must be between 3 and 7 characters long'
			)
		),
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
				'rule' => array('lengthBetween', 3, 30),
				'message' => 'Name must be between 3 and 30 characters long'
			)
		),
		'class' => array(
			'valid' => array(
				'rule' => array('inList', array('product', 'material', 'kit', 'semi_product', 'service_product', 'service_supplier','consumable','inventory','goods','other')),
				'message' => 'Please enter a valid class',
				'allowEmpty' => false
			)
		),
		'tangible' => array(
			'bool' => array(
				'rule' => 'boolean',
				'message' => 'Incorrect value for the checkbox'
			)
		),
		'active' => array(
			'bool' => array(
				'rule' => 'boolean',
				'message' => 'Incorrect value for the checkbox'
			)
		)
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
			'foreignKey' => 'item_type_id',
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
	public $hasAndBelongsToMany = array(
		'WarehousePlace' => array(
			'className' => 'WarehousePlace',
			'joinTable' => 'warehouse_places_item_types',
			'foreignKey' => 'item_types_id',
			'associationForeignKey' => 'warehouse_places_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);
	public $actsAs = array('Containable');
}
