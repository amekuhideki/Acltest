<?php
App::uses('AppController', 'Controller');

class CommentsController extends AppController {
  public $helper = array('HTML', 'Form');

  public function beforeFilter() {
	    parent::beforeFilter();
      $this->Auth->allow('add');
	}

  public $components = array('Paginator', 'Flash', 'Search.Prg');

  public function add() {
    $this->Comment->create();
    // echo "<pre>";
    // var_dump($this->request->data);
    // exit;

    // echo '<pre>';
    // var_dump($this->request->data);
    // exit;
    if ($this->request->is('Post')) {
      $this->Comment->create();
      if ($this->Comment->save($this->request->data)) {
        $this->Session->setFlash('Success!');
        return $this->redirect(array('controller' => 'posts', 'action' => 'view', $this->data['Comment']['post_id']));
      } else {
        $this->Session->setFlash('failed');
        return $this->redirect(array('controller' => 'posts', 'action' => 'view', $this->data['Comment']['post_id']));
      }
    }
  }
}
