<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 * @property User $User
 */
class Post extends AppModel {
	// public function createWithAttachments($data) {
	// 		// Sanitize your images before adding them
	// 		$images = array();
	// 		if (!empty($data['Image'][0])) {
	// 				foreach ($data['Image'] as $i => $image) {
	// 						if (is_array($data['Image'][$i])) {
	// 								// Force setting the `model` field to this model
	// 								$image['model'] = 'Post';
	//
	// 								// Unset the foreign_key if the user tries to specify it
	// 								if (isset($image['foreign_key'])) {
	// 										unset($image['foreign_key']);
	// 								}
	//
	// 								$images[] = $image;
	// 						}
	// 				}
	// 		}
	// 		$data['Image'] = $images;
	//
	// 		// Try to save the data using Model::saveAll()
	// 		$this->create();
	// 		if ($this->saveAll($data)) {
	// 				return true;
	// 		}
	//
	// 		// Throw an exception for the controller
	// 		throw new Exception(__("This post could not be saved. Please try again"));
	// }

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
			'className' => 'tag',
			'joinTable' => 'posts_tags',
			'foreignKey' => 'post_id',
			'associationForeignKey' => 'tag_id',
			'unique' => true,
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
