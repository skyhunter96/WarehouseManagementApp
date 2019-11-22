<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Group $Group
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Username is required'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'This username already exists!'
			),
			'between' => array(
				'rule' => array('lengthBetween', 3, 30),
				'message' => 'Username must be between 3 and 30 characters long'
			),
			'isUserName' => array(
				'rule' => array('custom', '/^[A-Za-z0-9]+(?:[_-][A-Za-z0-9]+)*$/'),
				'message' => 'Username must contain only letters, numbers, hyphens and underscores, two of hyphens and underscores cannot be in a row, also these cannot start or end'
			)
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
			'between' => array(
				'rule' => array('lengthBetween', 3, 30),
				'message' => 'Password must be between 3 and 30 characters long'
			)
		),
		'group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Incorrect value for Group field'
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
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    //ACL
    public $actsAs = array('Acl' => array('type' => 'requester', 'enabled' => false));

    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if (!$groupId) {
            return null;
        }
        return array('Group' => array('id' => $groupId));
    }

    public function bindNode($user) {
        return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
    }
    //ACL
	public function beforeSave($options = array()) {
		$this->data['User']['password'] = AuthComponent::password(
			$this->data['User']['password']
		);
		return true;
	}
}
