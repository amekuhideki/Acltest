<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {

    public $components = array(
      'Acl',
      'Auth' => array(
          'authorize' => array(
              'Actions' => array('actionPath' => 'controllers')
          ),
      ),
      'RequestHandler',
      'Session'
    );
    public $helpers = array(
      'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
      'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
      'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
      'Js' => array('jQuery'),
      'Session'
    );
    // public $layout = 'TwitterBootstrap.default';

    public function beforeFilter() {
      // AuthComponent の設定
      $this->Auth->loginAction = array(
        'controller' => 'users',
        'action' => 'login'
      );
      $this->Auth->logoutRedirect = array(
        'controller' => 'users',
        'action' => 'login'
      );
      $this->Auth->loginRedirect = array(
        'controller' => 'posts',
        'action' => 'index'
      );

      $this->Auth->allow('display');
      if ($this->request->is('post')) {
          if(isset($this->request->data['User']['email'])){
            $this->Auth->authenticate = array(
                                              'Form' => array(
                                              'fields' => array('username' => 'email', 'password' => 'password'),
                                              'userModel' => 'User',
                                          )
                                        );
          } else if (isset($this->data['auth']['credentials']['token'])) {
            $this->Auth->authenticate = array(
                                              'Form' => array(
                                                'userModel' => 'User',
                                                'fields' => array('username' => 'credentials_token',
                                                                  'password' => 'credentials_secret'
                                                                )
                                              )
                                        );
          }
      }
      //言語設定
      if (isset($this->params['named']['parameter'])) {
    		$lang = $this->params['named']['parameter'];

    	} elseif ($this->Session->read('lang')) {
        $lang = $this->Session->read('lang');

    	} else {
    		$lang = 'jpn';

    	}
      $this->Session->write('lang', $lang);

      Configure::write('Config.language', $lang);

    }
}
