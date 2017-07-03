<?php
App::uses('AppController', 'Controller');

class TagsController extends AppController {
  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow();
  }

  public $components = array('Paginator', 'Flash');

  public function index() {
    $this->Tag->recursive = 0;
    $this->set('tags', $this->Paginator->paginate());
  }

  public function view($id = null) {
    if (!$this->Tag->exists($id)) {
      throw new NotFoundException(__('Invalid tag'));
    }
    $options = array('conditions' => array('Tag.' . $this->Tag->primaryKey => $id));
    $this->set('tag', $this->Tag->find('first', $options));
  }

  public function add() {
    if ($this->request->is('post')) {
      $this->Tag->create();
      if ($this->Tag->save($this->request->data)) {
        $this->Flash->success(__('The tag has been saved.'));
        return $this->redirect(array('action' => 'index'));
      } else {
        $this->Flash->error(__('The tag could not be saved. Please, try again.'));
      }
    }
    $posts = $this->Tag->Post->find('list');
    $this->set(compact('posts'));
  }

  public function edit($id = null) {
    if (!$this->Tag->exists($id)) {
      throw new NotFoundException(__('Invalid tag'));
    }
    if ($this->request->is(array('post', 'put'))) {
      if ($this->Tag->save($this->request->data)) {
        $this->Flash->success(__('The tag has been saved.'));
        return $this->redirect(array('action' => 'index'));
      } else {
        $this->Flash->error(__('The tag could not be saved. Please, try again.'));
      }
    } else {
      $options = array('conditions' => array('Tag.' . $this->Tag->primaryKey => $id));
      $this->request->data = $this->Tag->find('first', $options);
    }
    $posts = $this->Tag->Post->find('list');
    $this->set(compact('posts'));
  }

  public function delete($id = null) {
    $this->Tag->id = $id;
    if (!$this->Tag->exists()) {
      throw new NotFoundException(__('Invalid tag'));
    }
    $this->request->allowMethod('post', 'delete');
    if ($this->Tag->delete()) {
      $this->Flash->success(__('The tag has been deleted.'));
    } else {
      $this->Flash->error(__('The tag could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
  }
}
