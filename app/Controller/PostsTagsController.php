<?php
App::uses('AppController', 'Controller');
/**
 * PostsTags Controller
 *
 * @property PostsTag $PostsTag
 * @property PaginatorComponent $Paginator
 */
class PostsTagsController extends AppController {
	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow();
	}
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PostsTag->recursive = 0;
		$this->set('postsTags', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PostsTag->exists($id)) {
			throw new NotFoundException(__('Invalid posts tag'));
		}
		$options = array('conditions' => array('PostsTag.' . $this->PostsTag->primaryKey => $id));
		$this->set('postsTag', $this->PostsTag->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PostsTag->create();
			if ($this->PostsTag->save($this->request->data)) {
				$this->Flash->success(__('The posts tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The posts tag could not be saved. Please, try again.'));
			}
		}
		$posts = $this->PostsTag->Post->find('list');
		$tags = $this->PostsTag->Tag->find('list');
		$this->set(compact('posts', 'tags'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PostsTag->exists($id)) {
			throw new NotFoundException(__('Invalid posts tag'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PostsTag->save($this->request->data)) {
				$this->Flash->success(__('The posts tag has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The posts tag could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PostsTag.' . $this->PostsTag->primaryKey => $id));
			$this->request->data = $this->PostsTag->find('first', $options);
		}
		$posts = $this->PostsTag->Post->find('list');
		$tags = $this->PostsTag->Tag->find('list');
		$this->set(compact('posts', 'tags'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PostsTag->id = $id;
		if (!$this->PostsTag->exists()) {
			throw new NotFoundException(__('Invalid posts tag'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->PostsTag->delete()) {
			$this->Flash->success(__('The posts tag has been deleted.'));
		} else {
			$this->Flash->error(__('The posts tag could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
