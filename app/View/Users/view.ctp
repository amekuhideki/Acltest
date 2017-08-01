<?php echo $this->Html->css('common.css'); ?>
<div class="users view">
  <div class="header">
    <?php echo $this->element('header2'); ?>
  </div>
  <div class="row details">
    <div class="user_sidebar">
      <div class="detail_top">
        <div class="panel panel-default user_details">
          <div class="panel-heading">
            <h2 class="panel-title"><?php echo (__('ユーザー')); ?></h2>
          </div>
          <div class="panel-body">
            <div class="user_info_image">
              <?php if (!empty($user['userImage']['id'])): ?>
                <?php echo  $this->Html->image('/files/user_image/user_image/' . $user['userImage']['dir'] . '/' . $user['userImage']['user_image'], array('class' => 'img-rounded', 'width' => '200px')); ?>
              <?php else: ?>
                <?php echo $this->Html->image('/images/no_user.png', array('class' => 'img-rounded', 'width' => '200px')); ?>
              <?php endif; ?>
            </div>
            <table class="table user_info_table">
              <tr>
                <th><?php echo __('アカウント名:'); ?></th>
                <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
              </tr>
              <tr>
                <th><?php echo __('ID:'); ?></th>
                <td><?php echo h($user['User']['id']); ?>&nbsp;</td>
              </tr>
              <tr>
                <th><?php echo __('Group') . ':'; ?></th>
                <?php if ($user['Group']['name'] === 'administrators'): ?>
                  <td><?php echo __('Administrators'); ?>&nbsp;</td>
                <?php elseif ($user['Group']['name'] === 'managers'): ?>
                  <td><?php echo __('Managers'); ?></td>
                <?php else: ?>
                  <td><?php echo __('User'); ?></td>
                <?php endif; ?>
              </tr>
              <tr>
                <th><?php echo __('Created') . ':'; ?></th>
                <td>
                  <?php echo h(date("Y/m/d", strtotime($user['User']['created']))); ?>
                  &nbsp;
                </td>
              </tr>
            </table>
            <div class="user_info_btn">
              <?php echo $this->Html->link(__('Edit Account'), array('controller' => 'users', 'action' => 'edit', $user['User']['id']), array("class" => 'btn btn-success btn-sm', 'style' => 'width:250px;')); ?> 
            </div>
          </div>
        </div>
        
        <div class="panel panel-default user_introduction">
          <div class="panel-heading">
            <h4 class="panel-title"><?php echo __('Self-introduction'); ?></h4>
          </div>
          <div class="panel-body">
            <?php if(!is_null($user['User']['introduction'])): ?>
              <?php echo $user['User']['introduction']; ?>
            <?php else: ?>
              <p><?php echo __('Self-introduction none'); ?></p>
            <?php endif; ?>
          </div>
        </div>  
        
        <div class="panel panel-default actions">
          <div class="panel-heading">
            <h4 class="panel-title"><?php echo __('Other account collaboration'); ?></h4>
          </div>
          <div class="panel-body">
            <ul style="list-style:none;">
              <li>
                <?php if (is_null($user['User']['credentials_token']) && is_null($user['User']['credentials_secret'])): ?>
                  <?php echo $this->Html->link(__('Twitter cooperation'), array('controller' => '', 'action' => 'auth/twitter'), array('class' => "btn btn-on", 'style' => "background-color:#00aced; color:white;")); ?>
                <?php else: ?>
                  <?php echo $this->Html->link(__('Cancel Twitter linkage'), array('action' => 'account_clear', $user['User']['id'], 'Twitter'), array('class' => "btn btn-off")); ?>
                <?php endif; ?>
              </li>
              <li>
                <?php if (is_null($user['User']['fb_id'])): ?>
                  <?php echo $this->Html->link(__('Facebook cooperation'), array('controller' => '', 'action' => 'auth/facebook'), array('class' => "btn btn-on", 'style' => "background-color:#305097; color:white;")); ?>
                <?php else: ?>
                  <?php echo $this->Html->link(__('Cancel Facebook linkage'), array('action' => 'account_clear', $user['User']['id'], 'Facebook'), array('class' => "btn btn-off")); ?>
                <?php endif; ?>
              </li>
              <li>
                <?php if (is_null($user['User']['g_id'])): ?>
                  <?php echo $this->Html->link(__('Google cooperation'), array('controller' => '', 'action' => 'auth/google'), array('class' => "btn btn-on", 'style' => "background-color:#db4a39; color:white;")); ?>
                <?php else: ?>
                  <?php echo $this->Html->link(__('Cancel Google linkage'), array('action' => 'account_clear', $user['User']['id'], 'Google'), array('class' => "btn btn-off")); ?>
                <?php endif; ?>
              </li>
              <li>
                <?php if (is_null($user['User']['git_id']) && is_null($user['User']['git_url'])): ?>
                  <?php echo $this->Html->link(__('GitHub cooperation'), array('controller' => '', 'action' => 'auth/github'), array('class' => "btn btn-on", 'style' => "background-color:#2c4762; color:white;")); ?>
                <?php else: ?>
                  <?php echo $this->Html->link(__('Cancel GitHub linkage'), array('action' => 'account_clear', $user['User']['id'], 'GitHub'), array('class' => "btn btn-off")); ?>
                <?php endif; ?>
              </li>
            </ul>
          </div>
        </div>
      </div>
        
    </div>
    
    <div class="user_posts">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title"><?php echo __('作成記事'); ?></h4>
        </div>
        <div class="panel-body post_details">
          <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $post): ?>
              <div class="user_post_detail media">
                <div class="media-left">
                  <?php if (!empty($post['Image'])): ?>
                    <?php  echo $this->Html->image('/files/image/attachment/' . $post['Image'][0]['dir'] . '/' . $post['Image'][0]['attachment'], array('width' => '140px', 'height' => '140px')); ?>
                  <?php else: ?>
                    <?php echo $this->Html->image('/images/Noimage.jpg', array('class' => "con_image", 'width' => '140px', 'height' => '140px')); ?>
                  <?php endif; ?>
                </div>
                <div class="media-body">
                  <ul class="" style="list-style:none;">
                    <li class="users_post_category"><?php echo $post['Category']['category']; ?></li>
                    <li class="post_created"><?php echo "作成日: ".$post['Post']['created']; ?></li>
                  </ul>
                  <h4 class="media-heading user_post_title"><?php echo h($post['Post']['title']); ?></h4>

                  <p class="users_post_body ellipsis"><?php echo strip_tags($post['Post']['body']); ?></p>
                  <ul class="detail_bottun" style="list-style:none;">
                    <li class="btn_details"><?php echo $this->Html->link(__('View'), array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?></li>
                    <li class="btn_edit"><?php echo $this->Html->link(__('Edit'), array('controller' => 'posts', 'action' => 'edit', $post['Post']['id'])); ?></li>
                    <li class="btn_dlete"><?php echo $this->Form->postLink(__('Delete'), array('controller' => 'posts', 'action' => 'delete', $post['Post']['id']),
                                                                   array('confirm' => __('Are you sure you want to delete # %s?', $post['Post']['id']))); ?></li>
                  </ul>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="not_post">
              <?php echo __('No article'); ?>
            </div>
          <?php endif; ?>
          
          <div class="user_info_btn">
            <?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add'), array("class" => 'btn btn-primary post_create_btn', 'style' => 'width:566px')); ?> 
          </div>
        </div>

      </div>
      
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
    
    <div class="details_footer">
      <?php echo $this->Html->link(__('Delete Account'), array('controller' => 'users', 'action' => 'delete', $user['User']['id']), array("class" => 'btn btn-danger', 'style' => 'width:200px', "confirm" => __('Are you sure you want to delete #%s?', $user['User']['username']))); ?>
    </div>
    
  </div>
</div>
