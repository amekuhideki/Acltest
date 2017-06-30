<?php

Cache::config('default', array('engine' => 'File'));

Configure::write('Dispatcher.filters', array(
  'AssetDispatcher',
  'CacheDispatcher'
));

App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
  'engine' => 'File',
  'types' => array('notice', 'info', 'debug'),
  'file' => 'debug',
));
CakeLog::config('error', array(
  'engine' => 'File',
  'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
  'file' => 'error',
));

CakePlugin::load(array('DebugKit', 'AclExtras', 'Upload', 'Search', 'TwitterBootstrap'));
CakePlugin::load('Opauth', array('routes' => true, 'bootstrap' => true));

Configure::write('Opauth.Strategy.Twitter', array(
                                                  'key' => '',
                                                  'secret' => ''
                                                  )
);
Configure::write('Opauth.Strategy.Facebook', array(
                                                  'app_id' => '',
                                                  'app_secret' => '',
                                                  'scope' => array('email')
                                                  )
);
Configure::write('Opauth.Strategy.Google', array(
                                                'client_id' => '',
                                                'client_secret' => ''
                                                )
);
Configure::write('Opauth.Strategy.GitHub', array(
                                                'client_id' => '',
                                                'client_secret' => ''
                                                )
);
Configure::write('Opauth.path', '/AclTest/auth/');
