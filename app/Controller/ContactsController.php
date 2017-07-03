<?php
App::uses('AppController', 'Controller');

class ContactsController extends AppController {
  public function beforeFilter() {
    parent::beforeFilter();

    $this->Auth->allow();
}
// public $components = array('Paginator', 'Flash', 'Search.Prg');

public function contact()
{
    if (!$this->request->is('post') || !$this->request->data) {
        return;
    }

    $this->Contact->set($this->request->data);

    if (!$this->Contact->validates()) {
        $this->Session->setFlash('入力内容に不備があります。');
        return;
    }

    switch ($this->request->data['confirm']) {
        case 'confirm':
            $this->render('contact_confirm');
            break;
        case 'send':
            if ($this->sendContact($this->request->data['Contact'])) {
                $this->Session->setFlash('お問い合わせを受け付けました。');
                $this->redirect('/Posts');
            } else {
                $this->Session->setFlash('エラーが発生しました。');
            }
            break;
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
