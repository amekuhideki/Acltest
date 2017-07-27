<?php echo $this->Html->css('common.css'); ?>
<script>
$(function(){
  var topBtnSm = $('.top_scroll_sm p');
  topBtnSm.click(function(){
    $('body,html').animate({
      scrollTop: 0}, 500);
      return false;
  });
});
</script>
<div class="push"></div>
<div id="wrapper_footer_sm">
  <div class="footer_top">
    <div class="top_scroll_sm">
      <p>ページトップへ</p>
    </div>
    <div class="localize_sm">
      <?php if ($_SESSION['lang'] === 'eng'): ?>
        <?php if ($this->action === 'view' || $this->action === 'edit'): ?>
          <?php if (isset($post['Post']['id'])){
                  $id = $post['Post']['id'];
                } elseif (isset($user['User']['id'])){
                  $id = $user['User']['id'];
                } elseif (isset($category['Category']['id'])){
                  $id = $category['Category']['id'];
                }
          ?>
          <?php echo $this->Html->link(__('japanese'), array('controller' => $this->name, 'action' => $this->action . "/" . $id, 'parameter' => 'jpn'),
                                                        array('role' => 'presentation', 'class' => 'language_sm')); ?>
        <?php else: ?>
          <?php echo $this->Html->link(__('japanese'), array('controller' => $this->name, 'action' => $this->action, 'parameter' => 'jpn'),
                                                        array('role' => 'presentation', 'class' => 'language_sm')); ?>
        <?php endif; ?>
        <?php else: ?>
        <?php if ($this->action === 'view' || $this->action === 'edit'): ?>
          <?php if (isset($post['Post']['id'])){
                  $id = $post['Post']['id'];
                } elseif (isset($user['User']['id'])){
                  $id = $user['User']['id'];
                } elseif (isset($category['Category']['id'])){
                  $id = $category['Category']['id'];
                }
          ?>
          <?php echo $this->Html->link(__('English'), array('controller' => $this->name, 'action' => $this->action . "/" . $id, 'parameter' => 'eng'),
                                                      array('role' => 'presentation', 'class' => 'language_sm')); ?>
        <?php else: ?>
          <?php echo $this->Html->link(__('English'), array('controller' => $this->name, 'action' => $this->action, 'parameter' => 'eng'),
                                                      array('role' => 'presentation', 'class' => 'language_sm')); ?>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
  <div class="footer_sm">
    <p>Copyright © 2017 Hideki Ameku All Right Reserved.</p>
  </div>
</div>
