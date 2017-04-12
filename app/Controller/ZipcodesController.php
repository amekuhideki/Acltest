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
			// $data = $this->Zipcode->find('all', array('conditions' => array('Zipcode.postal_code'
			// 																							=> '9070000')));
			if (count($data)>1) {
				foreach ($data as $value) {
					$prefecture = $value['Zipcode']['prefecture'];
					$city = $value['Zipcode']['city'];
					$municipality = $value['Zipcode']['municipality'];
					$params[] = array($prefecture, $city, $municipality);

				}
				echo json_encode($params);
				exit;
			} else {
				// $data = $data[0];
				$data = array_shift($data[0]);
				$prefecture = $data['prefecture'];
				$city = $data['city'];
				$municipality = $data['municipality'];
				$params[] = array($prefecture, $city, $municipality);
				// header('Content-type: application/json; charset=utf-8');
				echo json_encode($params);
				exit;
			}
			// exit;
		}
	}

	public function add(){
		if ($this->request->is('post')){
			echo"<pre>";
			var_dump($this->request->data);
			exit;
			$Member = ClassRegistry::init('Members');
			$Member->create();
			if ($Member->saveAll($this->request->data)) {
				$this->Flash->success(__('The post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The post could not be saved. Please, try again.'));
			}
		}
	}

}
