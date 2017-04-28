<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {
	var $users = array('User', 'Group');
	// var $uses = array('Post', 'User', 'Category', 'Tag', 'PostsTag', 'Attachment', 'Groups');

	public function beforeFilter() {
    parent::beforeFilter();
		$this->Auth->allow('add', 'logout', 'login');

    // CakePHP 2.0
    // $this->Auth->allow('*');

    // CakePHP 2.1以上
    // $this->Auth->allow();
}
	public function initDB() {
	    $group = $this->User->Group;
	    //管理者グループには全てを許可する
	    $group->id = 1;
	    $this->Acl->allow($group, 'controllers');

	    //マネージャグループには posts と widgets に対するアクセスを許可する
	    $group->id = 2;
	    $this->Acl->deny($group, 'controllers');
	    $this->Acl->allow($group, 'controllers/Posts');
	    $this->Acl->allow($group, 'controllers/Widgets');
			$this->Acl->allow($group, 'controllers/categories');
			$this->Acl->allow($group, 'controllers/Attachments');
			$this->Acl->allow($group, 'controllers/Users/index');
			$this->Acl->allow($group, 'controllers/Users/view');

	    //ユーザグループには posts と widgets に対する追加と編集を許可する
	    $group->id = 3;
	    $this->Acl->deny($group, 'controllers');
	    $this->Acl->allow($group, 'controllers/Posts/add');
	    $this->Acl->allow($group, 'controllers/Posts/edit');
	    $this->Acl->allow($group, 'controllers/Widgets/add');
	    $this->Acl->allow($group, 'controllers/Widgets/edit');
			$this->Acl->allow($group, 'controllers/Posts');
			$this->Acl->allow($group, 'controllers/Attachments');
			$this->Acl->allow($group, 'controllers/categories/view');
			$this->Acl->allow($group, 'controllers/Users');
	    //馬鹿げた「ビューが見つからない」というエラーメッセージを表示させないために exit を追加します
	    echo "all done";
	    exit;
	}
	public function login() {
			if ($this->Session->read('Auth.User')) {
				$this->Session->setFlash('You are logged in!');
				$this->redirect('/posts', null, false);
			}
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
						session_start();
            return $this->redirect($this->Auth->redirect());
	        }
	        $this->Session->setFlash(__('Your username or password was incorrect.'));
	    }
	}

	public function logout() {
		$_SESSION = array();
		session_destroy();
		$this->Session->setFlash('Good-Bye');
		$this->redirect($this->Auth->logout());	}
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
		$user = $this->Auth->user();
		$user_group = $user['group_id'];
		$user_name = $user['username'];
		$user_auth = ['user_group' => $user_group, 'user_name' => $user_name];
		$this->set('user_auth', $user_auth);

		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());

		// $tags = $this->Post->Tag->find('list', array(
		// 	'fields' => array('Tag.tag')
		// ));
		// $this->set('tags', $tags);
		// $categories = $this->Post->Category->find('list', array(
		// 	'fields' => array('Category.category')
		// ));
		// $this->set('categories', $categories);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
		#カテゴリの呼び出し
		$this->loadModel('Category');
		$categories = $this->Category->find('all');
		$this->set('categories', $categories);

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if(!($this->Auth->user()['id'] == $id || $this->Auth->user()['group_id'] == 1)){
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			var_dump($this->request->data);
			exit;
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$user = $this->User->find('first', $options);

		$groups = $this->User->Group->find('list');
		$this->set(compact('groups', 'user'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}

		$user = $this->User->findById($id);
		if (!($this->Auth->user()['id'] == $user['User']['id'] || $this->Auth->user()['group_id'] == 1)){
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
