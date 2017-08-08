<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'simple_html_dom');
mb_language('Japanese');

class PostsController extends AppController {
  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('index', 'view', 'getdate', 'date_post', 'postUser', 'popularArticles', 'home');

  }
  var $uses = array('Post', 'User', 'Category', 'Tag', 'PostsTag', 'Attachment', 'Comment', 'SubCategory');

  public $components = array('Paginator', 'Flash', 'Search.Prg');
  public $presetVars = true;

  public function home() {
    $this->paginate = array(
      'conditions' => array('Post.status' => 0),
      'order' => array('Post.created' => 'desc'),
      'limit' => 15
    );
    $this->set('posts', $this->paginate());
    $pickup = $this->Post->find('first', array('conditions' => array('status' => 0), 'order' => 'rand()', 'limit' => 1));
    $culture = $this->Post->find('all', array('conditions' => array('status' => 0, 'category_id' => 1), 'order' => 'access_counter DESC', 'limit' => 3));
    $play = $this->Post->find('all', array('conditions' => array('status' => 0, 'category_id' => 2), 'order' => 'access_counter DESC', 'limit' => 3));
    $work = $this->Post->find('all', array('conditions' => array('status' => 0, 'category_id' => 3), 'order' => 'access_counter DESC', 'limit' => 3));
    $tv = $this->Post->find('all', array('conditions' => array('status' => 0, 'category_id' => 4), 'order' => 'access_counter DESC', 'limit' => 3));
    $popular_posts = $this->Post->find('all', array('conditions' => array('status' => 0), 'order' => 'access_counter DESC', 'limit' => 10));
    $this->loadModel('Category');
    $categories = $this->Category->find('all');
    
    $this->set(compact("pickup", "culture", "play", "work", "tv", "popular_posts", "categories"));

  }
  
  public function index($data = null) {
    //まとめサイトのスクレイピング
    $source = file_get_contents('http://blog.livedoor.jp/dqnplus/');
    $source = mb_convert_encoding($source, 'utf8', 'auto');
    $html = str_get_html($source);
    sleep(rand(0.1, 0.2));
    $i = 0;
    foreach ($html->find('.fullbody') as $element) {
      if ($i === 10) {
        break;
      }
      $url = $element->find('.titlebody a', 0)->href;
      $title = $element->find('.titlebody text', 0)->outertext;
      if (isset($element->find('.blogbody img', 0)->src)) {
        $img = $element->find('.blogbody img', 0)->src;
      } else {
        $img = null;
      }
      $news[] = ['url' => $url, 'title' => $title, 'img' => $img];
      $i += 1;
    }

    $this->set('news', $news);

    $user = $this->Auth->user();
    $this->set('user', $user);
    $user_group = $user['group_id'];
    $user_name = $user['username'];
    $user_auth = ['user_group' => $user_group, 'user_name' => $user_name];
    $this->set('user_auth', $user_auth);
    // unset($this->Post->validate['title']);
    // unset($this->Post->validate['category_id']);
    // unset($this->Post->validate['tag']);
    // unset($this->Post->validate['posts_tags']);
    $this->Post->recursive = 1;
    // $this->set('posts', $this->paginate());

    //SearchPlugin
    $this->Prg->commonProcess();
    if (!is_null($data)) {
      $conditions = array($this->Post->parseCriteria($this->passedArgs), 'Post.status' => 0, 'Post.created LIKE' => $data . "%");
    } else {
      $conditions = array($this->Post->parseCriteria($this->passedArgs), 'Post.status' => 0);//'Post.status' => 0 で論理削除
    }
    $this->paginate = array(
      'conditions' => $conditions,
      'order' => array('Post.created' => 'desc'),//日付順で表示
      'limit' => 15
    );
    $this->set('posts', $this->paginate());
    // $tags = $this->Post->Tag->find('list', array(
    // 	'fields' => array('Tag.tag')
    // ));
    $tags = $this->Post->Tag->find('all');
    $this->set('tags', $tags);
    $categories = $this->Post->Category->find('list', array('fields' => array('Category.category')));
    $this->set('categories', $categories);

    $images = $this->Post->Image->find('all');
    $this->set('images', $images);
    
    $this->RequestHandler->isSmartPhone() === true ? $this->render('index_sm') : $this->render('index');
  }

  public function view($id = null, $comment_page = null) {
    $user = $this->Auth->user();

    if (!$this->Post->exists($id)) {
      throw new NotFoundException(__('Invalid post'));
    }
    $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
    $posts = $this->Post->find('first',$options);
    $data = array('Post' => array('id' => $id, 'access_counter' => $posts['Post']['access_counter'] + 1));
    $fields = array('id', 'access_counter');
    $this->Post->save($data, false, $fields);
    $this->set('post', $this->Post->find('first', $options));
    
    if ($comment_page === null){
      $comment_page = 1;
    }
    $comments = $this->Post->Comment->find('all', array(
                                      'limit' => ($comment_page * 10),
                                      'offset' => (($comment_page - 1) * 10),
                                      'conditions' => array('Comment.post_id' => $id, 'Comment.status' => 0),
                                      'order' => array('Comment.created DESC')));
    $comment_total = count($this->Post->Comment->find('all', array('conditions' => array('Comment.post_id' => $id, 'Comment.status' => 0))));
    $comment_total_page = ceil($comment_total / 10);

    $this->set(compact('comments', 'comment_page', 'comment_total', 'comment_total_page', 'user'));
    
    $this->RequestHandler->isSmartPhone() === true ? $this->render('view_sm') : $this->render('view');
  }

  public function comment() {
    $user = $this->Auth->user();
    $this->autoLayout = false;
    // $this->Comment->auto_Render = FALSE;
    if ($this->request->is('ajax')) {
      $comment_page = $this->request->data['comment_page'];
      $post_id = $this->request->data['post_id'];
      $comments = $this->Post->Comment->find('all', array(
                                             'limit' => 10,
                                              // 'offset' => (($comment_page - 1) * 10),
                                              'page' => $comment_page,
                                              'conditions' => array('Comment.post_id' => $post_id, 'Comment.status' => 0),
                                              'order' => array('Comment.created DESC')));
      $comment_total = count($this->Post->Comment->find('all', array('conditions' => array('Comment.post_id' => $post_id, 'Comment.status' => 0))));
      $comment_total_page = ceil($comment_total / 10);
      // $params = array($comment, $comment_page, $comment_total, $comment_total_page);
      // echo json_encode($params);
      $params = $this->set(compact('comments', 'comment_page', 'comment_total', 'user'));
      $this->render('/Posts/comment', $params);
    }
  }

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
                                              'fields' => array('Category.category')));
    $this->set(compact('users', 'categories'));
    
    $this->RequestHandler->isSmartPhone() === true ? $this->render('add_sm') : $this->render('add');
  }

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
      if (!isset($this->request->data['Post']['sub_category_id'])) {
        $this->request->data['Post']['sub_category_id'] = null;
      }
      if ($this->Post->saveAll($this->request->data)) {
        $this->Flash->success(__('The post has been saved.'));
        // return $this->redirect(array('action' => 'index'));
        return $this->redirect(array('action' => 'view/'. $this->request->params['pass'][0]));
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
    $sub_categories = $this->SubCategory->find('all');
    // $file_dir = $this->Post->Image->find('list', array(
    // 	'conditions' => array('foreign_key' => $id),
    // 	'fields' => array('Image.dir')
    // ));
    $this->set(compact('users', 'categories', 'post', 'sub_categories'));
    $this->RequestHandler->isSmartPhone() === true ? $this->render('edit_sm') : $this->render('edit');
  }

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

  public function getdate() {
    $this->autoLayout = false;
    $this->auto_Render = false;

    if ($this->request->is('ajax')) {
      $date = $this->request->data['date'];

      $blog_date = $this->Post->find('first', array(
                                      'conditions' => array(
                                      'status' => 0,
                                      'Post.created LIKE' => $date . "%"
                                      )
                                    ));
      if (!empty($blog_date)) {
        echo "true";
      }else {
        echo "false";
      }
      exit;
      // if ($blog_date) {
      //   json_encode("true");
      // } else {
      //   json_encode("false");
      // }
    }
  }
  
  public function date_post() {
    var_dump('a');
    exit;
  }
  
  public function postUser($id) {
    $this->User->id = $id;
    $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

    if (!$this->User->exists($id)) {
      throw new NotFoundException(__('Invalid post'));
    }

    $post_user = $this->Post->find('all', array('conditions' => array('user_id' => $id), 'order' => 'Post.created DESC'));
    $this->set('posts', $post_user);
    $this->set('user', $user);
  }
  
  public function popularArticles() {
    
    $this->paginate = array(
      'conditions' => array('Post.status' => 0, 'Post.access_counter >' => 0),
      'order' => array('Post.access_counter' => 'desc'),
      'limit' => 15
    );
    // pr($this->paginate());
    $this->set('posts', $this->paginate());
    $this->loadModel('User');
    $users = $this->User->find('all', array('order' => 'rand()', 'limit' => 10));
    $this->set('users', $users);
    $this->RequestHandler->isSmartPhone() === true ? $this->render('popular_article_sm') : $this->render('popular_article');
  }
}
