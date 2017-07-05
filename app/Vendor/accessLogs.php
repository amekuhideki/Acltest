<?php
class AccessLogs{
  function write_log() {
    $msg = date('Y-m-d H:i:s') . "," . env('REQUEST_URI') . "," . env('HTTP_REFERER') . "," . env('HTTP_USER_AGENT') . "," . env('REMOTE_ADDR') . "\n";
    $filename = LOGS . 'accesslogs/' . date('Ymd') . '.log';
    $log = new File($filename);
    $log->append($msg);
    
    return true;
  }
}