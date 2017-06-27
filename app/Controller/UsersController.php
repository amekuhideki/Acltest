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
    if ($this->params['action'] == 'opauthComplete') {
				$provider = $this->request->data['auth']['provider'];
				if ($provider === 'Twitter') {
						$token = $this->request->data['auth']['credentials'];
						$twitter_account = $this->User->find('first', array(
																										'conditions' => array(
																												'credentials_token' => $token['token'],
																												'credentials_secret' => $token['secret']
																									)
						));
						if (empty($twitter_account)) {
								$this->Session->write('twitter_auth' ,array(
																						'twitter_token' => $token["token"],
																						'twitter_secret' => $token["secret"]
																					)
																			);
								$this->redirect('add');
						} elseif (!empty($twitter_account)) {
								$t = array_shift($twitter_account);
								$t = array_merge($t, ['Group' => array_shift($twitter_account)]);
										if ($this->Auth->login($t)) {
											return $this->redirect($this->Auth->redirect());
										} else {
											$this->Session->setFlash('ログアウトしています。アカウントを作成しますか？');
										}
								return $this->redirect(array('controllers' => 'posts', 'action' => 'index'));
						}
				} elseif ($provider === 'Facebook') {	
						$fb_id = $this->request->data['auth']['uid'];
						$facebook_account = $this->User->find('first', array(
																											'conditions' => array(
																													'fb_id' => $fb_id
																											)
						));
						if (empty($facebook_account)) {
								$this->Session->write('facebook_auth', array(
																					'fb_id' => $fb_id
																				)
																			);
								$this->redirect('add');
						} elseif (!empty($facebook_account)) {
								$account = array_shift($facebook_account);
								$account = array_merge($account, ['Group' => array_shift($facebook_account)]);
										if ($this->Auth->login($account)) {
												return $this->redirect($this->Auth->redirect());
										} else {
												$this->Session->setFlash('ログアウトしています。アカウントを作成しますか？');
										}
								return $this->redirect(array('controllers' => 'posts', 'action' => 'index'));
						}
				} elseif ($provider === 'Google') {
						$g_id = $this->request->data['auth']['raw']['id'];
						$gmail = $this->request->data['auth']['raw']['id'];
						$google_account = $this->User->find('first', array(
																										'conditions' => array(
																												'g_id' => $g_id,
																												'gmail' => $gmail
																										)
						));
						if (empty($google_account)) {
								$this->Session->write('google_auth', array(
																					'g_id' => $g_id,
																					'gmail' => $gmail
																				)
																			);
								$this->redirect('add');
						} else {
								$account = array_shift($google_account);
								$account = array_merge($account, ['Group' => array_shift($google_account)]);
								if ($this->Auth->login($account)) {
										return $this->redirect($this->Auth->redirect());
								} else {
										$this->Session->setFlash('ログアウトしています。アカウントを作成しますか？');
								}
								return $this->redirect(array('controllers' => 'posts', 'action' => 'index'));
						}
				}
    }
    // CakePHP 2.0
    // $this->Auth->allow('*');

    // CakePHP 2.1以上
    // $this->Auth->allow();
}
  public function opauthComplete() {
      debug($this->data);
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
          $loginUser = $this->User->find('first', array(
                                            'conditions' => array(
                                                'username' => $this->request->data['User']['username']
                                                )));
          if (!empty($loginUser)) {
              $errCnt = $loginUser['User']['error_count'];
              if ($errCnt >= 10 ) {
                  if (time() - strtotime($loginUser['User']['error_time']) < 600 ) {
                      $this->Session->setFlash(__('アカウントはロックしました。10分後にやり直してください。'));
                      return;
                  } else {
                      $errCnt = 0;
                  }
              }  
          }  
          if ($this->Auth->login()) {
              if (!empty($loginUser['User']['error_count'])) {
                  $data = array('id' => $loginUser['User']['id'], 'error_count' => 0, 'error_time' => NULL);
                  $this->User->save($data, array('collback' => false), array('error_count', 'error_time'));
              }
              return $this->redirect($this->Auth->redirect());
	        } else {
              if (!empty($loginUser)) {
                $data = array('id' => $loginUser['User']['id'], 'error_count' => $errCnt + 1, 'error_time' => date('Y-m-d H:i:s'));
                $this->User->save($data, array('callback' => false), array('error_count', 'error_time'));
            } 
            $this->Session->setFlash(__('Your username or password was incorrect.'));
					}
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
			if (isset($this->Session->read()['twitter_auth'])) {
					$this->request->data['User']['credentials_token'] = $this->Session->read()['twitter_auth']['twitter_token'];
					$this->request->data['User']['credentials_secret'] = $this->Session->read()['twitter_auth']['twitter_secret'];
					$this->Session->delete('twitter_auth');
			} elseif (isset($this->Session->read()['facebook_auth'])) {
					$this->request->data['User']['fb_id'] = $this->Session->read()['facebook_auth']['fb_id'];
			} elseif (isset($this->Session->read()['google_auth'])) {
					$this->request->data['User']['g_id'] = $this->Session->read()['google_auth']['g_id'];
					$this->request->data['User']['gmail'] = $this->Session->read()['google_auth']['gmail'];
			}
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
			$data = $this->request->data;

			//パスワード変更
			if(empty($data['User']['password_edit'])){
				$data = array('User' =>
								array('id' => $id,
											'username' => $this->request->data['User']['username'],
											'introduction' => $this->request->data['User']['introduction']
										 ));
				$saveField = ['username', 'introduction'];
			} else {
				$data['User']['password'] = $this->request->data['User']['password_edit'];
				$saveField = ['username', 'password', 'introduction'];
				unset($this->request->data['User']['password_edit']);
			}
			if ($this->User->save($data, null, $saveField)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'view', $id));
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
		// $this->request->allowMethod('post', 'delete');
		// $data = array('id' => $id, 'status' => 1);

		if ($this->User->delete()) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		if ($id === $this->Auth->user()['id']) {
			return $this->redirect(array('action' => 'logout'));
		} else {
			return $this->redirect(array('action' => 'index'));
		}
	}
	
	public function authentication($id = null) {

	}
}
