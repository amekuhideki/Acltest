<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 * @property Group $Group
 * @property Post $Post
 */
class User extends AppModel {
  public function beforeSave($options = array()) {
    // $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
    if (!empty($this->data['User']['password'])) {
      $this->data['User']['password'] = AuthComponent::password(
       $this->data['User']['password']
      );
      // $this->data['User']['password'] = $passwordHasher->hash(
      //   $this->data['User']['password']
      // );
    }
    // if (!isset($this->data['User']['credentials_secret'])) {
    //     $this->data['User']['credentials_secret'] = $passwordHasher->hash(
    //       $this->data['User']['credentials_secret']
    //     );
    // }
    return true;
  }

	public $belongsTo = array('Group');
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
		} else {
				return array('Group' => array('id' => $groupId));
		}
	}

	public function bindNode($user) {
    return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
	}
  
  public function passwordConfirm($check) {
    if ($this->data['User']['password'] === $this->data['User']['password_confirm']) {
      return true;
    } else {
      return false;
    }
  }
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
      ),
      'check_character' => array(
        'rule' => array('check_char'),
        'message' => '同じ書式に統一してください'
      )
    ),
    'email' => array(
      'notBlank' => array(
        'rule' => array('notBlank'),
			),
      'unique' => array(
        'rule' => 'isUnique',
        'required' => true,
        'allowEmpty' => false,
        'message' => '既に使用されています'
      ),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
        'message' => 'パスワードを入力してください'
			),
      'match' => array(
        'rule' => 'passwordConfirm',
        'message' => 'パスワードが一致していません'
      ),
      'minLength' => array(
        'rule' => array('minLength', 4),
        'message' => 'パスワードは4文字以上にしてください'
      )
		),
    'password_confirm' => array(
      'match' => array(
        'rule' => array(
          'notBlank',
          'message' => 'パスワード(確認)を入力してください'
        )
      )
    ),
		'group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
    'credentials_token' => array(
      'notBlank' => array(
        'rule' => array('notBlank'),
      )
    ),
    'credentials_secret' => array(
      'notBlank' => array(
        'rule' => array('notBlank'),
      )
    ),
	);
  public function check_char($check) {
    $character = array_shift($check);
    $first_char = mb_substr($character, 0, 1);
    if (preg_match("/^[ぁ-ゞ]+$/u", $first_char)) {
      return preg_match("/^[ぁ-ゞ]+$/u", $character);
    }
    if (preg_match("/^[ァ-ヾ]+$/u", $first_char)) {
      return preg_match("/^[ァ-ヾ]+$/u", $character);
    }
    if (preg_match("/^[a-zA-Z]+$/", $first_char)) {
      return preg_match("/^[a-zA-Z]+$/", $character);
    }
  }
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'user_id',
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
  
  public $hasOne = array(
    'userImage' => array(
      'className' => 'UserImage',
      'foreignKey' => 'foreign_key',
      'conditions' => array(
        'userImage.model' => 'User',
        'active' => '1'
      )
    )
  );

}
