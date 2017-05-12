<?php
App::uses('AppController', 'Controller');
/**
 * SubCategories Controller
 *
 * @property SubCategory $SubCategory
 * @property PaginatorComponent $Paginator
 */
class SubCategoriesController extends AppController {
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
		$this->SubCategory->recursive = 0;
		$this->set('subCategories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SubCategory->exists($id)) {
			throw new NotFoundException(__('Invalid sub category'));
		}
		$options = array('conditions' => array('SubCategory.' . $this->SubCategory->primaryKey => $id));
		$this->set('subCategory', $this->SubCategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SubCategory->create();
			if ($this->SubCategory->save($this->request->data)) {
				$this->Flash->success(__('The sub category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The sub category could not be saved. Please, try again.'));
			}
		}
		$categories = $this->SubCategory->Category->find('list');
		$this->set(compact('categories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->SubCategory->exists($id)) {
			throw new NotFoundException(__('Invalid sub category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SubCategory->save($this->request->data)) {
				$this->Flash->success(__('The sub category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The sub category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SubCategory.' . $this->SubCategory->primaryKey => $id));
			$this->request->data = $this->SubCategory->find('first', $options);
		}
		$categories = $this->SubCategory->Category->find('list');
		$this->set(compact('categories'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->SubCategory->id = $id;
		if (!$this->SubCategory->exists()) {
			throw new NotFoundException(__('Invalid sub category'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SubCategory->delete()) {
			$this->Flash->success(__('The sub category has been deleted.'));
		} else {
			$this->Flash->error(__('The sub category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function getdata() {
		$this->auto_Render = FALSE;
		if ($this->request->is('ajax')) {
			$data = $this->SubCategory->find('all', array('conditions' =>
																										 array('category_id' => $this->request->data['category_id'])));

			if (empty($data)) {
				echo json_encode('false');
				exit;
			}
			echo json_encode($data);
			exit;
		}

	}

	public function getdata2() {
		$this->auto_Render = FALSE;
		if ($this->request->is('ajax')) {
			$data = $this->SubCategory->find('all', array('conditions' =>
																										 array('category_id' => array_keys($this->params->query)[0])));
			$this->set('getdata2', $data);
			// echo json_encode($data);
			// exit;

		}

	}
}
