<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 */
class ZipcodesController extends AppController {
	public $helpers = array('Html', 'Form', 'Flash');
	public $presetVars = true;
	public $components = array('Paginator', 'Flash');
	var $uses = array('Post', 'User', 'Category', 'Tag', 'PostsTag', 'Attachment', 'Zipcode');

	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('index', 'getdata', 'add');
	}

	public function index() {
		$this->Zipcode->recursive = 0;


	}

	public function getdata(){
		$this->auto_Render = FALSE;
		if($this->request->is('ajax')){
			// $params = array('東京', '葛飾区', '金町');
			$data = $this->Zipcode->find('all', array('conditions' => array('Zipcode.postal_code'
																										=> $this->request->data['zipcode'])));
			// $data = $data[0];
			$data = array_shift($data[0]);
			$prefecture = $data['prefecture'];
			$city = $data['city'];
			$municipality = $data['municipality'];
			$params = array($prefecture, $city, $municipality);
			// header('Content-type: application/json; charset=utf-8');
			echo json_encode($params);
			exit;
		}
	}

}
