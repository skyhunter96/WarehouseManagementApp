<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 * @property User $User
 */
class Group extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Name of the group cannot be blank!'
			),
			'between' => array(
				'rule' => array('lengthBetween', 3, 30),
				'message' => 'Name of the group must contain between 3 and 30 characters'
			),
			'alphanum' => array(
				'rule' => 'alphanumeric',
				'message' => 'Name of the group must have only letters and numbers'
			)
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'group_id',
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

	//ACL

    public $actsAs = array('Acl' => array('type' => 'requester'));

    public function parentNode() {
        return null;
    }

    //ACL

}
