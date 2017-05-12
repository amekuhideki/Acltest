<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 * @property User $User
 */
class Post extends AppModel {
 //SearchPluginの利用
 	public $order = array('Post.id DESC');
	public $actsAs = array('Search.Searchable');
  public $helpers = array('Js' => array('Jquery'));
	// public $filterArgs = array(
	// 	'category' => array(
	// 		'type' => 'value',
	// 		'field' => 'Category.id'
	// 	),
	// 	'title' => array(
	// 		'type' => 'like',
	// 		'field' => 'Post.title'
	// 	),
  //   'tag' => array(
  //     'type' => 'subquery',
  //     'method' => 'searchTag',
  //     'field' => 'Post.id',
  //   ),
	// );
  public $filterArgs = array(
    'keyword' => array('type' => 'like', 'field' => array('Post.title', 'Post.body', 'Category.category')),
  );

  function searchTag($data = array()) {

    $this->PostsTag->Behaviors->attach('Containable', array('autoFields' => false));
    $this->PostsTag->Behaviors->attach('Search.Searchable');

    // $cond = explode('|', $data['tag_id']);
    $query = $this->PostsTag->getQuery('all', array(
      'conditions' => array('PostsTag.tag_id' => $data['tag']),
      'fields' => array('post_id'),
      'contain' => array('Tag')
      )
    );
    return $query;
  }
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'category_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank')
			),
		),
		'title' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
      'maxlen' => array(
        'rule' => array('maxLength', 24),
        'message' => '24文字以内で収めてください。'
      )
		),
	);


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
 	public $hasMany = array(
		'Image' => array(
			'className' => 'Attachment',
			'foreignKey' => 'foreign_key',
			'cinditions' => array(
				'Image.model' => 'Post',
			),
		),
    'Comment' => array(
      'className' => 'Comment',
      'foreignKey' => 'post_id',
    )
	);

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Category' => array(
			'className' => 'Category',
			'foreign_key' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasAndBelongsToMany = array(
		'Tag' => array(
			'className' => 'Tag',
			'joinTable' => 'posts_tags',
			'foreignKey' => 'post_id',
			'associationForeignKey' => 'tag_id',
			'unique' => true,
      'with' => 'PostsTag',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => '',
 		)
	);

}
