<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 */
class PostsController extends AppController {
	public function beforeFilter() {
	    parent::beforeFilter();
	    // $this->Auth->allow('index', 'view');
			$this->Auth->allow();

	}
	var $uses = array('Post', 'User', 'Category', 'Tag', 'PostsTag', 'Attachment', 'Comment');
	// public $uses = array('Post', 'Category', 'Tag', 'Attachment', 'PostsTag',);
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Search.Prg');
	public $presetVars = true;
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$user = $this->Auth->user();
		$user_group = $user['group_id'];
		$user_name = $user['username'];
		$user_auth = ['user_group' => $user_group, 'user_name' => $user_name];
		$this->set('user_auth', $user_auth);
		// unset($this->Post->validate['title']);
		// unset($this->Post->validate['category_id']);
		// unset($this->Post->validate['tag']);
		// unset($this->Post->validate['posts_tags']);
		$this->Post->recursive = 0;
		// $this->set('posts', $this->paginate());

		//SearchPlugin
		$this->Prg->commonProcess();
		$this->paginate = array(
			'conditions' =>
				array($this->Post->parseCriteria($this->passedArgs), 'Post.status' => 0),//'Post.status' => 0 で論理削除
			'order' => array('Post.modified' => 'desc')//日付順で表示
		);

		$this->set('posts', $this->paginate());
		// $tags = $this->Post->Tag->find('list', array(
		// 	'fields' => array('Tag.tag')
		// ));
		$tags = $this->Post->Tag->find('all');

		$this->set('tags', $tags);

		$categories = $this->Post->Category->find('list', array(
			'fields' => array('Category.category')
		));
		$this->set('categories', $categories);

	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null, $comment_page = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));

		$this->set('post', $this->Post->find('first', $options));
		if ($comment_page === null){
			$comment_page = 1;
		}
		$comments = $this->Post->Comment->find('all', array(
																			'limit' => ($comment_page * 10),
																			'offset' => (($comment_page - 1) * 10),
																			'conditions' => array('Comment.post_id' => $id),
																			'order' => array('Comment.created DESC')));
		$comment_total = count($this->Post->Comment->find('all', array('conditions' => array('Comment.post_id' => $id))));

		$this->set(compact('comments', 'comment_page', 'comment_total'));
	}

	public function getComment() {
		$this->Comment->auto_Render = FALSE;
		if ($this->request->is('ajax')) {
			$comment_page = $this->request->data['comment_page'];
			$post_id = $this->request->data['post_id'];

			$comment = $this->Post->Comment->find('all', array(
																						'limit' => ($comment_page * 10),
																						'offset' => (($comment_page - 1) * 10),
																						'conditions' => array('Comment.post_id' => $post_id),
																						'order' => array('Comment.created DESC')));
			$comment_total = count($this->Post->Comment->find('all', array('conditions' => array('Comment.post_id' => $post_id))));
			$comment_total_page = ceil($comment_total / 10);
			$params = array($comment, $comment_page, $comment_total, $comment_total_page);
			echo json_encode($params);
			$this->set(compact('comments', 'comment_page', 'comment_total'));

		}
		exit;
	}
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			if(isset($this->request->data['Image'])) {
				$count = count($this->request->data['Image']);
				for ($i = 0; $i < $count; $i++){
					if (!$this->request->data['Image'][$i]['attachment']['name']) {
						unset($this->request->data['Image'][$i]);
					}
				}
			}
			$this->Post->create();
			if ($this->Post->saveAll($this->request->data)) {
				$this->Flash->success(__('The post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The post could not be saved. Please, try again.'));
			}
		}
		$users = $this->Auth->user()['id'];
		// $users = $this->Post->User->find('list');

		$categories = $this->Post->Category->find('list', array(
			'fields' => array('Category.category')
		));
		$this->set(compact('users', 'categories'));
 }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}

		$post = $this->Post->findById($id);
		if (!$post) {
			throw new NotFoundException(__('Invalid post'));
		}
		if (!($this->Auth->user()['id'] == $post['User']['id'] || ($this->Auth->user()['group_id'] == 1))) {
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->Post->id = $id;

			if (isset($this->request->data['Image'])){
				$image_count = count($this->request->data['Image']);

				for ($i = 0; $i < $image_count; $i++){
					if (!$this->request->data['Image'][$i]['attachment']['name']) {
						unset($this->request->data['Image'][$i]);
					}
				}
			}

			if ($this->Post->saveAll($this->request->data)) {
				$this->Flash->success(__('The post has been saved.'));
				// return $this->redirect(array('action' => 'index'));
				return $this->redirect(array('action' => 'edit/'. $this->request->params['pass'][0]));
			} else {
				$this->Flash->error(__('The post could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
			$this->request->data = $this->Post->find('first', $options);
		}

		$users = $this->Post->User->find('list', array(
			'fields' => array('User.username')
		));
		$categories = $this->Post->Category->find('list', array(
			'fields' => array('Category.category')
		));

		// $file_dir = $this->Post->Image->find('list', array(
		// 	'conditions' => array('foreign_key' => $id),
		// 	'fields' => array('Image.dir')
		// ));
		$this->set(compact('users', 'categories', 'post'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		//もしGETでリクエストされた場合の対処

		$post = $this->Post->findById($id);
		if (!($this->Auth->user()['id'] == $post['User']['id'] || ($this->Auth->user()['group_id'] == 1))) {
			return $this->redirect(array('action' => 'index'));
		}
		// $this->request->allowMethod('post', 'delete');
		$data = array('Post' => array('id' => $id, 'status' => 1));
		if ($this->Post->save($data)) {
			$this->Flash->success(__('The post has been deleted.'));
		} else {
			$this->Flash->error(__('The post could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function deleteImage($id = null, $post_id = null){
		if (!$this->Post->Image->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->request->allowMethod('post', 'delete');
		$post = $this->Post->Image->findById($id);
		if (!$post) {
			throw new NotFoundException(__('Invalid post'));
		}
		if ($this->Post->Image->delete($id)) {
			$this->Flash->success(__('The post has been deleted.'));
		} else {
			$this->Flash->error(__('The post could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'edit/'. $post_id));
	}

}
