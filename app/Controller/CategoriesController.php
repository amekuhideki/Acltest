<?php
App::uses('AppController', 'Controller');

class CategoriesController extends AppController {
  public function beforeFilter() {
    parent::beforeFilter();

    $this->Auth->allow('index', 'view');
}

  public $components = array('Paginator', 'Flash');

  public function index() {
    // $categoryList = $this->Category->generateTreeList(null, null, null, '---->');
    // $this->set(compact('categoryList'));
    $this->Category->recursive = 1;
    $this->set('categories', $this->Paginator->paginate());
    $this->RequestHandler->isSmartPhone() === true ? $this->render('index_sm') : $this->render('index');
  }

  public function view($id = null) {
    if (!$this->Category->exists($id)) {
      throw new NotFoundException(__('Invalid category'));
    }
    // $this->Category->recursive = 2;
    $options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
    $category = $this->Category->find('first', $options);
    $category_name = $category['Category']['category'];
    $this->loadModel('Post');
    $this->loadModel('User');
    $this->paginate = array('Post' =>array(
      'conditions' => array('Post.status' => 0, 'Post.category_id' => $id),
      'order' => array('Post.created' => 'DESC'),
      'limit' => 10
    ));
    $posts = $this->paginate('Post');
    $popular_posts = $this->Post->find('all', array('conditions' => array('status' => 0), 'order' => 'access_counter DESC', 'limit' => 10));
    $categories = $this->Category->find('all');
    $this->set(compact("category", "category_name", "posts", "popular_posts", "categories"));
    $this->RequestHandler->isSmartPhone() === true ? $this->render('view_sm') : $this->render('view');
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
