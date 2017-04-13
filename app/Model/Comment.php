<?php
App::uses('AppModel', 'Model');

class Comment extends AppModel {
  public $belongsTo = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

  // public $validate = array(
  //   'title' => array(
  //     'rule' => 'notEmpty',
  //     'message' => '記入してください。'
  //   ),
  //   'body' => array(
  //     'rule' => 'nootEmpty'
  //   )
  // );

}
