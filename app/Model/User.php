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
      'mail_address' => array(
        'rule' => array('email'),
        'message' => '正しいアドレスを入力してください'
      ),
      // 'is_email' => array(
      //   'rule' => array('mail_check'),
      //   'message' => '正しいアドレスを入力してください'
      // )
    ),
    'phone_number' => array(
      'nunber_check' => array(
        'required' => false,
        'allowEmpty' => true,
        'rule' => array('number_check'),
        'message' => '正しい値で入力してください'
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
    return preg_match("/^\p{Hiragana}+$|^\p{Katakana}+$|^[a-zA-Z]+$|\p{Han}/u", $character);
  }
  
  public function number_check($check) {
    $value = array_shift($check);
    // $number = mb_convert_kana($value,"a", "utf-8");
    if (ctype_digit($value) && (strlen($value) == 10 || strlen($value) == 11)) {
      return true;
    } else {
      return false;
    }
  }
  
  public function mail_check($check) {
    $email = array_shift($check);
    $mailre = '^[\x01-\x7F]+@(([-a-z0-9]+\.)*[a-z]+|\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\])';
    if (preg_match($mailre, $email)) {
      return preg_match($mailre, $email);
    }
    exit;
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
