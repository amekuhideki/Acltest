<?php
App::uses('AppModel', 'Model');

class UserImage extends AppModel {
  public $actsAs = array(
    'Upload.Upload' => array(
     'user_image' => array(
       'thumbnailSizes' => array(
         'xvga' => '1024x768',
         'vga' => '640x480',
         'thumb' => '80x80',
       ),
     ),
   ),
  );
  
  public $validate = array(
    'model' => array(
      'notBlank' => array(
        'rule' => array('notBlank'),
      ),
    ),
    'foreign_key' => array(
      'numeric' => array(
        'rule' => array('numeric'),
      ),
    ),
  );
  
  public $belongsTo = array(
    'User' => array(
      'className' => 'User',
      'foreignKey' => 'foreign_key',
    )
  );
}