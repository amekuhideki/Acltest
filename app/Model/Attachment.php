<?php
App::uses('AppModel', 'Model');
/**
 * Attachment Model
 *
 */
class Attachment extends AppModel {
	public $actsAs = array(
		'Upload.Upload' => array(
		 'attachment' => array(
			 'thumbnailSizes' => array(
				 'xvga' => '1024x768',
				 'vga' => '640x480',
				 'thumb' => '80x80',
			 ),
		 ),
	 ),
	);
/**
 * Validation rules
 *
 * @var array
 */

	// public $validate = array(
	// 	'model' => array(
	// 		'notBlank' => array(
	// 			'rule' => array('notBlank'),
	// 			//'message' => 'Your custom message here',
	// 			//'allowEmpty' => false,
	// 			//'required' => false,
	// 			//'last' => false, // Stop validation after this rule
	// 			//'on' => 'create', // Limit validation to 'create' or 'update' operations
	// 		),
	// 	),
	// 	'foreign_key' => array(
	// 		'numeric' => array(
	// 			'rule' => array('numeric'),
	// 			//'message' => 'Your custom message here',
	// 			//'allowEmpty' => false,
	// 			//'required' => false,
	// 			//'last' => false, // Stop validation after this rule
	// 			//'on' => 'create', // Limit validation to 'create' or 'update' operations
	// 		),
	// 	),
	// 	'attachment' => array(
	// 		'notBlank' => array(
	// 			'rule' => array('notBlank'),
	// 			//'message' => 'Your custom message here',
	// 			//'allowEmpty' => false,
	// 			//'required' => false,
	// 			//'last' => false, // Stop validation after this rule
	// 			//'on' => 'create', // Limit validation to 'create' or 'update' operations
	// 		),
	// 	),
	// );
	public $belongsTo = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'foreign_key',
		),
	);
}
