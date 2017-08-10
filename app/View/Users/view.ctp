<?php echo $this->Html->css('common.css'); ?>
<div class="users view">
  <div class="row details">
    
    <?php if (!empty($this->Session->read()['Message']['flash'])): ?>
      <?php if ($this->Session->read()['Message']['flash']['element'] === 'Flash/error'): ?>
        <div id="flash_message" class="alert alert-danger">
          <?php echo $this->Session->flash(); ?>
        </div>
      <?php else: ?>
        <div id="flash_message" class="alert alert-success">
          <?php echo $this->Session->flash(); ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>
    
    <div class="user_posts">
      <div class="panel panel-default">
        <div class="panel-body">
          <h4 class="panel-title"><?php echo __('Created Articles'); ?></h4>
        </div>
        <div class="panel-footer post_details">
          <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $post): ?>
              <div class="user_post_detail media">
                <div class="media-left">
                  <?php if (!empty($post['Image'])): ?>
                    <?php  echo $this->Html->image('/files/image/attachment/' . $post['Image'][0]['dir'] . '/' . $post['Image'][0]['attachment'], array('width' => '220px', 'height' => '196px')); ?>
                  <?php else: ?>
                    <?php echo $this->Html->image('/images/Noimage.jpg', array('class' => "con_image", 'width' => '220px', 'height' => '196px')); ?>
                  <?php endif; ?>
                </div>
                <div class="media-body user_post_detail_right">
                  <ul class="" style="list-style:none;">
                    <li class="users_post_category"><?php echo $this->Html->link($post['Category']['category'], array('controller' => 'categories', 'action' => 'view', $post['Category']['id'])); ?></li>
                    <li class="post_created"><?php echo date("Y/m/d", strtotime($post['Post']['created'])); ?></li>
                  </ul>
                  <h4 class="media-heading user_post_title"><?php echo h($post['Post']['title']); ?></h4>

                  <p class="users_post_body ellipsis"><?php echo strip_tags($post['Post']['body']); ?></p>
                  <?php if (!empty($_SESSION['Auth']['User']['id']) && $_SESSION['Auth']['User']['id'] === $post['User']['id']): ?>
                    <ul class="detail_bottun" style="list-style:none;">
                      <li class="btn_details"><?php echo $this->Html->link(__('View'), array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?></li>
                      <li class="btn_edit"><?php echo $this->Html->link(__('Edit'), array('controller' => 'posts', 'action' => 'edit', $post['Post']['id'])); ?></li>
                      <li class="btn_dlete"><?php echo $this->Form->postLink(__('Delete'), array('controller' => 'posts', 'action' => 'delete', $post['Post']['id']),
                                                                     array('confirm' => __('Are you sure you want to delete # %s?', $post['Post']['id']))); ?></li>
                    </ul>
                  <?php else: ?>
                    <div class="user_view_btn">
                      <?php echo $this->Html->link(__('Read more') . '＞', array('controller' => 'posts', 'action' => "view", $post['Post']['id'])); ?><br>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="not_post">
              <?php echo __('No article'); ?>
            </div>
          <?php endif; ?>
          <?php if (!empty($_SESSION['Auth']['User']['id']) && $_SESSION['Auth']['User']['id'] === $user['User']['id']): ?>
            <div class="user_info_btn">
              <?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add'), array("class" => 'btn btn-primary post_create_btn', 'style' => 'width:566px')); ?> 
            </div>
          <?php endif;?>
          
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
    
    <div class="user_sidebar">
      <div class="detail_top">
        <div class="panel panel-default">
          <div class="panel-body">
            <h2 class="panel-title"><?php echo (__('User')); ?></h2>
          </div>
          <div class="panel-footer">
            <div>
              <div class="user_info_image">
                <?php if (!empty($user['userImage']['id'])): ?>
                  <?php echo  $this->Html->image('/files/user_image/user_image/' . $user['userImage']['dir'] . '/' . $user['userImage']['user_image'], array('class' => 'img-rounded', 'width' => '200px', 'height' => '200px')); ?>
                <?php else: ?>
                  <?php echo $this->Html->image('/images/no_user.png', array('class' => 'img-rounded', 'width' => '200px', 'height' => '200px')); ?>
                <?php endif; ?>
              </div>
              <table class="table user_info_table">
                <tr>
                  <th><?php echo __('Account name') . ':'; ?></th>
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
              <?php if (!empty($_SESSION['Auth']['User']['id']) && $_SESSION['Auth']['User']['id'] === $user['User']['id']): ?>
                <div class="user_info_btn">
                  <?php echo $this->Html->link(__('Edit Account'), array('controller' => 'users', 'action' => 'edit', $user['User']['id']), array("class" => 'btn btn-success btn-sm', 'style' => 'width:270px;')); ?> 
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        
        <div class="panel panel-default user_introduction">
          <div class="panel-body">
            <h4 class="panel-title"><?php echo __('Self-introduction'); ?></h4>
          </div>
          <div class="panel-footer">
            <div class="">
              <?php if(!is_null($user['User']['introduction'])): ?>
                <?php echo $user['User']['introduction']; ?>
              <?php else: ?>
                <p><?php echo __('Self-introduction none'); ?></p>
              <?php endif; ?>
            </div>
          </div>
        </div>  
        
        <?php if (!empty($_SESSION['Auth']['User']['id']) && $_SESSION['Auth']['User']['id'] === $user['User']['id']): ?>
          <div class="panel panel-default actions">
            <div class="panel-body">
              <h4 class="panel-title"><?php echo __('Other account collaboration'); ?></h4>
            </div>
            <div class="panel-footer">
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
        <?php endif; ?>
        <div class="panel panel-default">
          <div class="panel-body"><?php echo $user['User']['username'] . (__('の人気記事')); ?>
          </div>
          <div class="panel-footer">
            <?php foreach ($popular_posts as $popular): ?>
              <div class="media popular_article">
                <div class="media-left">
                  <?php if (!empty($popular['Image'])): ?>
                    <?php echo $this->Html->image('/files/image/attachment/' . $popular['Image'][0]['dir'] . '/' . $popular['Image'][0]['attachment'], array('width' => '110', 'height' => '120', 'class' => 'media-object')); ?>
                  <?php else: ?>
                    <?php echo $this->Html->image('/images/Noimage.jpg', array('width' => '110', 'height' => '120', 'class' => 'media-object')); ?>
                  <?php endif; ?>
                </div>
                <div class="media-body popular_article_right">
                  <div class="user_view_popular_creat">
                    <?php echo (__('作成日')); ?>
                    <?php echo date("Y/m/d", strtotime($popular['Post']['created'])); ?>
                  </div>
                  <div class="user_view_popular_title ellipsis">
                    <?php echo $popular['Post']['title']; ?>
                  </div>
                  <div class="user_view_btn">
                    <?php echo $this->Html->link(__('Read more') . '＞', array('controller' => 'posts', 'action' => "view", $popular['Post']['id']), array('style' => 'font-size:12px;')); ?><br>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
        
    </div>
    <?php if (!empty($_SESSION['Auth']['User']['id']) && $_SESSION['Auth']['User']['id'] === $user['User']['id']): ?>
      <div class="details_footer">
        <?php echo $this->Html->link(__('Delete Account'), array('controller' => 'users', 'action' => 'delete', $user['User']['id']), array("class" => 'btn btn-danger', 'style' => 'width:200px', "confirm" => __('Are you sure you want to delete #%s?', $user['User']['username']))); ?>
      </div>
    <?php endif; ?>
    
  </div>
</div>
