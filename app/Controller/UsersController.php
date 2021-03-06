<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
  var $users = array('User', 'Group', 'Post', 'UserImage');
  
  public $components = array('Paginator', 'Flash');
  
  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('add', 'logout', 'login', 'view', 'index', 'initDB');
    if ($this->params['action'] == 'opauthComplete') {
      $provider = $this->request->data['auth']['provider'];
      if ($provider === 'Twitter') {
        $saveField = ['credentials_token', 'credentials_secret'];
        $conditions = [
                       'credentials_token' => $this->request->data['auth']['credentials']['token'],
                       'credentials_secret' => $this->request->data['auth']['credentials']['secret']
                       ];
      } elseif ($provider === 'Facebook') {
        $email['sns_auth']['email'] = $this->request->data['auth']['info']['email'];
        $saveField = ['fb_id'];
        $conditions = ['fb_id' => $this->request->data['auth']['uid'],];

      } elseif ($provider === 'Google') {
        $email['sns_auth']['email'] = $this->request->data['auth']['raw']['email'];
        $saveField = ['g_id'];
        $conditions = ['g_id' => $this->request->data['auth']['raw']['id']];

      } elseif ($provider === 'GitHub') {
        $saveField = ['git_id', 'git_url'];
        $conditions = [
                       'git_id' => $this->request->data['auth']['uid'],
                       'git_url' => $this->request->data['auth']['info']['urls']['github']
                       ];
      }

      $account = $this->User->find('first', ['conditions' => $conditions]);
      if ($this->Auth->user()) {
        if (empty($account)) {
          $up_data = ['id' => $this->Auth->user()['id']];
          $data['User'] = array_merge($up_data, $conditions);
          if ($this->User->save($data, null, $saveField)) {
            $this->Session->setFlash($provider . 'を登録しました。');
          } else {
            $this->Flash->error('登録できませんでした。もう一度試してください。');
          } 
        } else {
          $this->Flash->error('指定した' . $provider . 'アカウントは既に使われています。');
        }
        $this->redirect(array('action' => 'view', $this->Auth->user()['id']));

      } else {
        if (empty($account)) {

          if ($provider === 'GitHub') {
            $username['sns_auth']['username'] = $this->request->data['auth']['raw']['login'];
          } else {
            $username['sns_auth']['username'] = $this->request->data['auth']['info']['name'];
          }
          $this->Session->write('sns_auth', ['provider' => $provider]);
          $auth_conditions['sns_auth'] = $conditions;
          $_SESSION = array_merge_recursive($_SESSION, $username);
          $_SESSION = array_merge_recursive($_SESSION, $auth_conditions);

          if ($provider === 'Google' || $provider === 'Facebook') {
            $_SESSION = array_merge_recursive($_SESSION, $email);
          }
          $this->redirect('add');

        } else {
          $sns_account = array_shift($account);
          $sns_account = array_merge($sns_account, ['Group' => array_shift($account)]);
          if ($this->Auth->login($sns_account)) {
            return $this->redirect($this->Auth->redirect());
          } else {
            $this->Session->setFlash('ログアウトしています。アカウントを作成しますか？');
          }
        }
      }
    }
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
    $this->Acl->allow($group, 'controllers/Posts/home');
    $this->Acl->allow($group, 'controllers/Posts/index');
    $this->Acl->allow($group, 'controllers/Posts/view');
    $this->Acl->allow($group, 'controllers/Posts/getdate');
    $this->Acl->allow($group, 'controllers/Posts/postUser');
    $this->Acl->allow($group, 'controllers/Posts/comment');
    $this->Acl->allow($group, 'controllers/Posts/add');
    $this->Acl->allow($group, 'controllers/Posts/edit');
    $this->Acl->allow($group, 'controller/Posts/delete');
    $this->Acl->allow($group, 'controller/Posts/deleteImage');

    $this->Acl->allow($group, 'controller/Users/index');
    $this->Acl->allow($group, 'controller/Users/view');
    $this->Acl->allow($group, 'controller/Users/login');
    $this->Acl->allow($group, 'controller/Users/add');
    $this->Acl->allow($group, 'controller/Users/logout');
    $this->Acl->allow($group, 'controller/Users/edit');
    $this->Acl->allow($group, 'controller/Users/delete');
    $this->Acl->allow($group, 'controller/Users/account_clear');
    $this->Acl->allow($group, 'controller/Users/deleteUserImage');
    
    $this->Acl->allow($group, 'controller/Categoriew/index');
    $this->Acl->allow($group, 'controller/Categoriew/view');
    $this->Acl->allow($group, 'controller/contact');
    $this->Acl->allow($group, 'controller/comments/add');
    $this->Acl->allow($group, 'controller/comments/delete');
    $this->Acl->allow($group, 'controller/comments/edit');
    // $this->Acl->allow($group, 'controllers/Widgets/add');
    // $this->Acl->allow($group, 'controllers/Widgets/edit');
    // $this->Acl->allow($group, 'controllers/Posts');
    // $this->Acl->allow($group, 'controllers/Attachments');
    $this->Acl->allow($group, 'controllers/categories/view');
    $this->Acl->allow($group, 'controllers/Users');
    //馬鹿げた「ビューが見つからない」というエラーメッセージを表示させないために exit を追加します
    echo "all done";
    exit;
  }

  public function login() {
    if ($this->Session->read('Auth.User')) {
      $this->Flash->success('You are logged in!');
      $this->redirect('/posts', null, false);
    }
    if ($this->request->is('post')) {
      $loginUser = $this->User->find('first', [
                                        'conditions' => [
                                            'email' => $this->request->data['User']['email']
                                            ]]);
      if (!empty($loginUser)) {
        $errCnt = $loginUser['User']['error_count'];
        if ($errCnt >= 10 ) {
          if (time() - strtotime($loginUser['User']['error_time']) < 600 ) {
              $this->Flash->error(__("アカウントはロックしました。10分後にやり直してください。"));
              return;
          } else {
              $errCnt = 0;
          }
        }  
      }  
      if ($this->Auth->login()) {
        if (!empty($loginUser['User']['error_count'])) {
            $data = ['id' => $loginUser['User']['id'], 'error_count' => 0, 'error_time' => NULL];
            $this->User->save($data, null, array('error_count', 'error_time'));
        }
        return $this->redirect($this->Auth->redirect());
      } else {
        if (!empty($loginUser)) {
          $data = array('id' => $loginUser['User']['id'], 'error_count' => $errCnt + 1, 'error_time' => date('Y-m-d H:i:s'));
          $this->User->save($data, null, array('error_count', 'error_time'));
        } 
        $this->Flash->error(__('Your username or password was incorrect.'));
      }
    }

    $this->RequestHandler->isSmartPhone() === true ? $this->render('login_sm') : $this->render('login');
  }

  public function logout() {
    $_SESSION = array();
    session_destroy();
    //$this->Session->setFlash('Good-Bye');
    $this->redirect($this->Auth->logout());	}


  public function index() {
    $user = $this->Auth->user();
    $user_group = $user['group_id'];
    $user_name = $user['username'];
    $user_auth = ['user_group' => $user_group, 'user_name' => $user_name];
    $this->set('user_auth', $user_auth);
    $this->loadModel('Category');
    $categories = $this->Category->find('all');
    $this->set('categories', $categories);
    $this->loadModel('Post');
    $popular_posts = $this->Post->find('all', array(
      'conditions' => array('Post.status' => 0),
      'order' => 'access_counter DESC',
      'limit' => 10
    ));
    $this->set('popular_posts', $popular_posts);
    $this->User->recursive = 1;
    $this->paginate = array('limit' => 15, 'order' => 'User.created DESC');
    $this->set('users', $this->Paginator->paginate());
    
    $this->RequestHandler->isSmartPhone() === true ? $this->render('index_sm') : $this->render('index');
  }

  public function view($id = null) {
    if (!$this->User->exists($id)) {
      throw new NotFoundException(__('Invalid user'));
    }
    $this->User->recursive = 1;
    $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
    $this->set('user', $this->User->find('first', $options));
    #カテゴリの呼び出し
    $this->loadModel('Category');
    $categories = $this->Category->find('all');
    $this->set('categories', $categories);
    // $posts = $this->User->Post->find('all', array('conditions' => array('user_id' => $id, 'status' => 0), 'order' => 'Post.created DESC'));
    $this->paginate = array('Post' => array('limit' => 15, 'order' => 'Post.created DESC'));
    $posts = $this->Paginator->paginate('Post', array('Post.user_id' => $id));
    $this->set('posts', $posts);
    $this->loadModel('Post');
    $popular_posts = $this->Post->find('all', array('conditions' => array('user_id' => $id), 'order' => 'access_counter DESC', 'limit' => 5));
    $this->set('popular_posts', $popular_posts);
    $this->RequestHandler->isSmartPhone() === true ? $this->render('view_sm') : $this->render('view');
  }

  public function add() {
    if ($this->request->is('post')) {
      $this->User->create();
      if (isset($this->Session->read()['sns_auth'])){
        if ($this->Session->read()['sns_auth']['provider'] === 'Twitter') {
          $this->request->data['User']['credentials_token'] = $this->Session->read()['sns_auth']['twitter_token'];
          $this->request->data['User']['credentials_secret'] = $this->Session->read()['sns_auth']['twitter_secret'];
        } elseif ($this->Session->read()['sns_auth']['provider'] === 'Facebook') {
          $this->request->data['User']['fb_id'] = $this->Session->read()['sns_auth']['fb_id'];
        } elseif ($this->Session->read()['sns_auth']['provider'] === 'Google') {
          $this->request->data['User']['g_id'] = $this->Session->read()['sns_auth']['g_id'];
        } elseif (isset($this->Session->read()['sns_auth'])) {
          $this->request->data['User']['git_id'] = $this->Session->read()['sns_auth']['git_id'];
          $this->request->data['User']['git_url'] = $this->Session->read()['sns_auth']['git_url'];
        }
      }
      if ($this->User->save($this->request->data)) {
        $this->Flash->success(__('The user has been saved.'));
        return $this->redirect(array('action' => 'login'));
      } else {
        $this->Flash->error(__('The user could not be saved. Please, try again.'));
      }
    }
    $groups = $this->User->Group->find('list');
    $this->set(compact('groups'));
    
    $this->RequestHandler->isSmartPhone() === true ? $this->render('add_sm') : $this->render('add');
  }

  public function edit($id = null) {
    
    if (!$this->User->exists($id)) {
      throw new NotFoundException(__('Invalid user'));
    }
    if(!($this->Auth->user()['id'] == $id || $this->Auth->user()['group_id'] == 1)){
      return $this->redirect(array('action' => 'index'));
    }
    if ($this->request->is(array('post', 'put'))) {
      $data = $this->request->data;
      if(empty($this->request->data['User']['password']) && empty($this->request->data['User']['password_confirm'])){
        unset($this->request->data['User']['password']);
        unset($this->request->data['User']['password_confirm']);
      }
      if (isset($this->request->data['userImage'])) {
        if ($this->request->data['userImage']['user_image']['size'] === 0) {
          unset($this->request->data['userImage']);
        } else {
          $user = $this->User->find('first',array('conditions' => array('User.id' => $id)));
          if(!is_null($user['userImage']['id'])) {
            // $data = array('userImage' => array('id' => $image_id, 'active' => 0));
            // $fields = array('id', 'active');
            // $this->User->userImage->save($data, false, $fields);
          }
        }
      }
      if ($this->User->saveAll($this->request->data)) {
        $this->loadModel('UserImage');
        $user_image = $this->UserImage->find('all',array('conditions' => array('foreign_key' => $id, 'active' => 1)));
        if (count($user_image) >= 2) {
          $data = array('userImage' => array('id' => $user_image[0]['userImage']['id'], 'active' => 0));
          $fields = array('id', 'active');
          $this->UserImage->save($data, false, $fields);
        }
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
    // pr($user);
    // exit;
    $groups = $this->User->Group->find('list');
    $this->set(compact('groups', 'user'));
    
    $this->RequestHandler->isSmartPhone() === true ? $this->render('edit_sm') : $this->render('edit');
  }

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
  
  public function account_clear($id = null, $provider) {
    $this->User->id = $id;
    if (!$this->User->exists()) {
      throw new NotFoundException(__('Invalid user'));
    }
    $user = $this->User->findById($id);
    if ($provider === 'Twitter') {
      $up_data['User'] = ['credentials_token' => null, 'credentials_secret' => null];
      $saveField = ['credentials_token', 'credentials_secret'];

    } elseif ($provider === 'Facebook') {
      $up_data['User'] = ['fb_id' => null,];
      $saveField = ['fb_id'];

    } elseif ($provider === 'Google') {
      $up_data['User'] = ['g_id' => null];
      $saveField = ['g_id'];

    } elseif ($provider === 'GitHub') {
      $up_data['User'] = ['git_id' => null, 'git_url' => null];
      $saveField = ['git_id', 'git_url'];

    }
    $user_id = ['User' => ['id' => $id]];
    $data = array_merge_recursive($user_id, $up_data);
    if ($this->User->save($data, null, $saveField)) {
      $this->Flash->success($provider . '連携を解除しました');
    }
    return $this->redirect(array('action' => 'view', $id));
  }

  public function authentication($id = null) {

  }
  
  public function deleteUserImage($id = null, $user_id = null) {
    $this->loadModel('UserImage');
    if (!$this->UserImage->exists($id)) {
      throw new NotFoundException(__('Invalid post'));
    }
    $this->request->allowMethod('post', 'delete');
    $image = $this->UserImage->findById($id);
    if (!$image) {
      throw new NotFoundException(__('Invalid user image'));
    }
    $data = array('UserImage' => array('id' => $id, 'active' => 0));
    
    if ($this->UserImage->save($data)) {
      $this->Flash->success(__('The user image has been deleted.'));
    } else {
      $this->Flash->error(__('The user image could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'edit/'. $user_id));
  }
}
