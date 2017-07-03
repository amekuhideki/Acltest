<?php
App::uses('AppController', 'Controller');

class CategoriesController extends AppController {
  public function beforeFilter() {
    parent::beforeFilter();

    $this->Auth->allow('index');
}

  public $components = array('Paginator', 'Flash');

  public function index() {
    // $categoryList = $this->Category->generateTreeList(null, null, null, '---->');
    // $this->set(compact('categoryList'));
    $this->Category->recursive = 0;
    $this->set('categories', $this->Paginator->paginate());
  }

  public function view($id = null) {
    if (!$this->Category->exists($id)) {
      throw new NotFoundException(__('Invalid category'));
    }
    $options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
    $this->set('category', $this->Category->find('first', $options));
    $this->loadModel('Post');
    $this->loadModel('User');
    // $this->loadModel('User');
    // $user = $this->User->find('list',array(
    // 													'fields', array('Use.id', 'User.username'),
    // 													'recursive'=> -1
    // 													)
    // 												);
    // $user = $this->User->find('all');
    // echo "<pre>";
    // var_dump ($user);
  }

  public function add() {
    // return $this->edit();
    if ($this->request->is('post')) {
      $this->Category->create();
      if ($this->Category->save($this->request->data)) {
        $this->Flash->success(__('The category has been saved.'));
        return $this->redirect(array('action' => 'index'));
      } else {
        $this->Flash->error(__('The category could not be saved. Please, try again.'));
      }
    }
  }

  public function edit($id = null) {
    if (!$this->Category->exists($id)) {
      throw new NotFoundException(__('Invalid category'));
    }
    if ($this->request->is(array('post', 'put'))) {
      if ($this->Category->save($this->request->data)) {
        $this->Flash->success(__('The category has been saved.'));
        return $this->redirect(array('action' => 'index'));
      } else {
        $this->Flash->error(__('The category could not be saved. Please, try again.'));
      }
    } else {
      $options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
      $this->request->data = $this->Category->find('first', $options);
    }
  }

  public function delete($id = null) {
    $this->Category->id = $id;
    if (!$this->Category->exists()) {
      throw new NotFoundException(__('Invalid category'));
    }
    $this->request->allowMethod('post', 'delete');
    if ($this->Category->delete()) {
      $this->Flash->success(__('The category has been deleted.'));
    } else {
      $this->Flash->error(__('The category could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
  }
}
