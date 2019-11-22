<?php
App::uses('AppModel', 'Model');
/**
 * WarehouseAddress Model
 *
 * @property WarehousePlaces $WarehousePlaces
 */
class WarehouseAddress extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(

		'row' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Needs to have a value',
			),
			'letter' => array(
				'rule' => array('custom', '/[a-zA-Z]/'),
				'message' => 'Needs to be a letter'
			),
			'unique' => array(
				'rule' => 'addressIsUnique',
				'message' => 'This row, shelf, and partition already exists in this place, therefore this address exists'
			),
		),
		'shelf' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Needs to have a value'

			),
		),
		'partition' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Needs to have a value'

			),
		),
		'warehouse_places_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Not a correct value',

			),
		),
	);

	public function addressIsUnique(array $data){
			$conditions = array(
				'row' => $this->data[$this->alias]['row'],
				'shelf' => $this->data[$this->alias]['shelf'],
				'partition' => $this->data[$this->alias]['partition'],
				'warehouse_places_id' => $this->data[$this->alias]['warehouse_places_id']
			);
			if(!empty($this->id)){
				$conditions[$this->alias . '.' . $this->primaryKey . ' !='] = $this->id;
			}
			return $this->find('count', array('conditions' => $conditions)) === 0;
	}
	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'WarehousePlaces' => array(
			'className' => 'WarehousePlaces',
			'foreignKey' => 'warehouse_places_id',
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

    public $hasMany = array(
        'ItemsAddresses' => array(
            'className' => 'ItemsAddress',
            'foreignKey' => 'warehouse_addresses_id',
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

}
