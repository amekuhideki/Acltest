<?php
App::uses('AppController', 'Controller');

class WidgetsController extends AppController {
  public function beforeFilter() {
    parent::beforeFilter();
    // $this->Auth->allow('index', 'view');
}

public $components = array('Paginator', 'Flash');

  public function index() {
    $this->Widget->recursive = 0;
    $this->set('widgets', $this->Paginator->paginate());
  }

  public function view($id = null) {
    if (!$this->Widget->exists($id)) {
      throw new NotFoundException(__('Invalid widget'));
    }
    $options = array('conditions' => array('Widget.' . $this->Widget->primaryKey => $id));
    $this->set('widget', $this->Widget->find('first', $options));
  }

  public function add() {
    if ($this->request->is('post')) {
      $this->Widget->create();
      if ($this->Widget->save($this->request->data)) {
        $this->Flash->success(__('The widget has been saved.'));
        return $this->redirect(array('action' => 'index'));
      } else {
        $this->Flash->error(__('The widget could not be saved. Please, try again.'));
      }
    }
  }

  public function edit($id = null) {
    if (!$this->Widget->exists($id)) {
      throw new NotFoundException(__('Invalid widget'));
    }
    if ($this->request->is(array('post', 'put'))) {
      if ($this->Widget->save($this->request->data)) {
        $this->Flash->success(__('The widget has been saved.'));
        return $this->redirect(array('action' => 'index'));
      } else {
        $this->Flash->error(__('The widget could not be saved. Please, try again.'));
      }
    } else {
      $options = array('conditions' => array('Widget.' . $this->Widget->primaryKey => $id));
      $this->request->data = $this->Widget->find('first', $options);
    }
  }

  public function delete($id = null) {
    $this->Widget->id = $id;
    if (!$this->Widget->exists()) {
      throw new NotFoundException(__('Invalid widget'));
    }
    $this->request->allowMethod('post', 'delete');
    if ($this->Widget->delete()) {
      $this->Flash->success(__('The widget has been deleted.'));
    } else {
      $this->Flash->error(__('The widget could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
  }
}
