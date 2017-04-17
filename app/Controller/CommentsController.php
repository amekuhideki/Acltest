<?php
App::uses('AppController', 'Controller');

class CommentsController extends AppController {
  public $helper = array('HTML', 'Form');

  public function beforeFilter() {
	    parent::beforeFilter();
      $this->Auth->allow('add', 'delete');
	}

  public $components = array('Paginator', 'Flash', 'Search.Prg');

  public function add() {
    $this->Comment->create();
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

  public function delete($id = null) {
    $this->Comment->id = $id;
    if (!$this->Comment->exists()) {
      throw new NotFoundException(__('Invalid post'));
    }
    $comment = $this->Comment->findById($id);
    if (!($this->Auth->user()['id'] == $comment['Comment']['user_id'] || ($this->Auth->user()['group_id'] == 1))) {
      return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
    }
    $data = array('Comment' => array('id' => $id, 'status' => 1));
    if ($this->Comment->save($data)) {
      $this->Flash->success(__('The post has been deleted.'));
    } else {
      $this->Flash->error(__('The post could not be deleted. Please, try again.'));
    }
		return $this->redirect(array('controller' => 'posts', 'action' => 'view/' . $comment['Comment']['post_id']));
  }
}
