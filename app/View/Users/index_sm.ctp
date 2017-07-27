<?php echo $this->Html->css('common.css'); ?>

<div class="user index_sm">
  <div class="header_sm">
    <?php echo $this->element('header_sm'); ?>
  </div>
  
  <div class="main_sm">
    <div class="main_header_sm">
      <h4><?php echo (__('List Users')); ?></h4>
    </div>
    
    <div class="content_user_details_sm">
      <?php foreach($users as $user): ?>
        <div class="content_detail_sm">
          <div class="user_image_sm">
            <?php if (isset($user['userImage']['id'])): ?>
              <?php 
                echo $this->Html->image('/files/user_image/user_image/' .  $user['userImage']['dir']. '/' . $user['userImage']['user_image'], array('width' => '26%', 'height' => '26%')); 
              ?>
            <?php else: ?>
              <?php 
                echo $this->Html->image('/images/no_user.png', array('class' => 'con_image', 'width' => '26%'));
              ?>
            <?php endif; ?>
          </div>
          <div class="user_name_sm">
            <?php echo $this->Html->link($user['User']['username'], array('controller' => 'posts', 'action' => 'postUser', $user['User']['id'])) . 'さん'; ?>
          </div>
          <div class="user_sns_sm">
            <?php if (isset($user['User']['git_id']) && isset($user['User']['git_url'])): ?>
              <?php echo $this->Html->image('/images/icon_github.png', array('url' => $user['User']['git_url'])); ?>
            <?php else: ?>
              <?php echo $this->Html->image('/images/icon_gray_github.png', array('url' => $user['User']['git_url'])); ?>
            <?php endif; ?>
          </div>
          <div class="access_post_sm">
            <?php echo '記事数:' . (count($user['Post']) . '件'); ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    
    <nav class="post_paginate_sm">
      <div class="paginate">
        <div class="pagination">
          <?php echo $this->Paginator->prev('< ', array(), null, array('tag' => 'li')); ?>
          <?php echo $this->Paginator->numbers(array('modulus' => '2', 'separator' => '')); ?>
          <?php echo $this->Paginator->next('>', array(), null, array('class' => 'next disabled')); ?>
        </div>
      </div>
    </nav>
    
  </div>
</div>