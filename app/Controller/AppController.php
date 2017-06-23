<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    // var $components = array('DebugKit.Toolbar');
    // var $language;

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
            if(isset($this->request->data['User']['username'])){
              $this->Auth->authenticate = array(
                                                'Form' => array(
                                                'fields' => array('username' => 'username', 'password' => 'password'),
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
