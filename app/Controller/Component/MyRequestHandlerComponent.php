<?php
App::uses('RequestHandlerComponent', 'Controller/Component');

class MyRequestHandlerComponent extends RequestHandlerComponent {
  
  public function isSmartPhone() {
    $ua = env('HTTP_USER_AGENT');
    return ((strpos($ua, 'iPhone') !== false) || (strpos($ua, 'iPad') !== false) || strpos($ua, 'Android') !== false);
  }
}