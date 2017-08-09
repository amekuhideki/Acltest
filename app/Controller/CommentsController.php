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

  public function edit($id = null) {
    if (!$this->Comment->exists($id)){
      throw new NotFoundException(__('Invalid post'));
    }
    if ($this->request->is(array('post', 'put'))) {
      $post_data = $this->request->data['Comment'];
      $data = array('Comment' => array('id' => $id, 'commenter' => $post_data['commenter'], 'body' => $post_data['body']));
      if ($this->Comment->save($data)) {
        $post_id = $this->Comment->findById($id);
        $this->Flash->success(__('The tag has been saved.'));
        return $this->redirect(array('controller' => 'posts', 'action' => 'view/' . $post_id['Comment']['post_id']));
      } else {
        $this->Flash->error(__('The tag could not be saved. Please, try again.'));
      }
    } else {

      $options = array('conditions' => array('Comment.id' . $this->Comment->id => $id));
      $this->request->data = $this->Comment->find('first', $options);

    }
    $comments = $this->Comment->find('first', array('conditions' => array('Comment.id' => $id)));

    $this->set(compact('comments'));
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
