<?php echo $this->Html->css('common.css'); ?>
<div class="users index">
  <div class="row main">
    <div class="contents">
      <p><?php echo (__('List Users')); ?></p>
      <?php foreach ($users as $user): ?>
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail_user">
            <div class="thumbnail">
              <?php if (!empty($user['userImage']['id'])): ?>
                <?php echo $this->Html->image('/files/user_image/user_image/' . $user['userImage']['dir'] . '/' . $user['userImage']['user_image'], array('class' => 'img-rounded', 'width' => '200px', 'height' => '200px')); ?>
              <?php else: ?>
                <?php echo $this->Html->image('/images/no_user.png', array('class' => 'img-rounded', 'width' => '200px', 'height' => '200px')); ?>
              <?php endif; ?>
              <div class="caption">
                 <h4><?php echo $user['User']['username']; ?></h4>
                 <div class="user_caption_introduction">
                   <?php if (!empty($user['User']['introduction'])): ?>
                     <?php echo $user['User']['introduction']; ?>
                   <?php else: ?>
                     <p><?php echo (__('自己紹介はありません')); ?></p>
                   <?php endif; ?>
                 </div>
                 <p><?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id']), array('class' => 'btn btn-primary btn-sm')); ?></p>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      
      <nav class="post_paginate_sm">
        <div class="paginate">
          <div class="pagination">
              <?php echo $this->Paginator->prev('< ', array(), null, array('class' => 'prev disabled')); ?>
              <?php echo $this->Paginator->numbers(array('modulus' => '2', 'separator' => '')); ?>
              <?php echo $this->Paginator->next('>', array(), null, array('class' => 'next disabled')); ?>
          </div>
        </div>
      </nav>
      
    </div>
  </div>
</div>
