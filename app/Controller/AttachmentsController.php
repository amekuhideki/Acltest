<?php
App::uses('AppController', 'Controller');

class AttachmentsController extends AppController {
  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow();
}

  public $components = array('Paginator', 'Flash');

  public function index() {
    $this->Attachment->recursive = 0;
    $this->set('attachments', $this->Paginator->paginate());
  }

  public function view($id = null) {
    if (!$this->Attachment->exists($id)) {
      throw new NotFoundException(__('Invalid attachment'));
    }
    $options = array('conditions' => array('Attachment.' . $this->Attachment->primaryKey => $id));
    $this->set('attachment', $this->Attachment->find('first', $options));
  }

  public function add() {
    if ($this->request->is('post')) {
      $this->Attachment->create();
      if ($this->Attachment->save($this->request->data)) {
        $this->Flash->success(__('The attachment has been saved.'));
        return $this->redirect(array('action' => 'index'));
      } else {
        $this->Flash->error(__('The attachment could not be saved. Please, try again.'));
      }
    }
  }

  public function edit($id = null) {
    if (!$this->Attachment->exists($id)) {
      throw new NotFoundException(__('Invalid attachment'));
    }
    if ($this->request->is(array('post', 'put'))) {
      if ($this->Attachment->save($this->request->data)) {
        $this->Flash->success(__('The attachment has been saved.'));
        return $this->redirect(array('action' => 'index'));
      } else {
        $this->Flash->error(__('The attachment could not be saved. Please, try again.'));
      }
    } else {
      $options = array('conditions' => array('Attachment.' . $this->Attachment->primaryKey => $id));
      $this->request->data = $this->Attachment->find('first', $options);
    }
  }

  public function delete($id = null) {
    $this->Attachment->id = $id;
    if (!$this->Attachment->exists()) {
      throw new NotFoundException(__('Invalid attachment'));
    }
    $this->request->allowMethod('post', 'delete');
    if ($this->Attachment->delete()) {
      $this->Flash->success(__('The attachment has been deleted.'));
    } else {
      $this->Flash->error(__('The attachment could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
  }
}
