<?php
App::uses('AppModel', 'Model');
/**
 * Attachment Model
 *
 */
class Attachment extends AppModel {

	public $actsAs = array(
		'Upload.Upload' => array(
			'photo_user' => array(
				'thumbnailSizes' => array(
					'thumb150' => '150*150',
					'thumb80' => '80*80',
				),
				'thumbnailMehod' => 'php',
				'fields' => array('dir' => 'dir', 'type' => 'type', 'size' => 'size'),
				'mimetypes' => array('image/jpeg', 'image/gif', 'image/png'),
				'extensions' => array('jpg', 'jpeg', 'JPG', 'JPEG', 'gif', 'GIF', 'png', 'PNG'),
				'maxSize' => 209715,
			),
			'photo_menu' => array(
				'thumbnailSizes' => array(
					'thumb' => '100*100'
				),
				'thumbnailMethod' => 'php',
				'fields' => array('dir' => 'dir', 'type' => 'type', 'size' => 'size')
			),
		),
	);
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'model' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'foreign_key' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	public $belongsTo = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'foreign_key',
		),
	);
}
