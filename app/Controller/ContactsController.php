<?php
App::uses('AppController', 'Controller');

class ContactsController extends AppController {
  public function beforeFilter() {
    parent::beforeFilter();

    $this->Auth->allow();
}
// public $components = array('RequestHandler' => array('className' => 'MyRequestHandler'));

public function contact()
{
    if (!$this->request->is('post') || !$this->request->data) {
      $this->RequestHandler->isSmartPhone() === true ? $this->render('contact_sm') : $this->render('contact');
    }
    if (!empty($this->request->data)) {
      $this->Contact->set($this->request->data);
      
      if (!$this->Contact->validates()) {
          $this->Flash->error('入力内容に不備があります。');
          $this->RequestHandler->isSmartPhone() === true ? $this->render('contact_sm') : $this->render('contact');
          return;
      }
      switch ($this->request->data['confirm']) {
          case 'confirm':
              $this->RequestHandler->isSmartPhone() === true ? $this->render('contact_confirm_sm') : $this->render('contact_confirm');
              break;
          case 'send':
              if ($this->sendContact($this->request->data['Contact'])) {
                  $this->Session->setFlash('お問い合わせを受け付けました。');
                  $this->redirect('/contacts/contact');
              } else {
                  $this->Flash->error('エラーが発生しました。');
              }
              break;
          case 'revise':
              $this->RequestHandler->isSmartPhone() === true ? $this->render('contact_sm') : $this->render('contact');
              break;
      }
    }

}

private function sendContact($content)
{
    App::uses('CakeEmail', 'Network/Email');
    $email = new CakeEmail('contact');
    $email->emailPattern('/^.+$/');
    return $email
        ->from(array($content['email'] => $content['subject']))
        ->viewVars($content)
        ->template('contact', 'contact')
        ->send();
}

}
