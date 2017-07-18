<?php echo $this->Html->css('common.css'); ?>
<div class="post view">
  <div class="header_sm">
    <?php echo $this->element('header_sm'); ?>
  </div>
  
  <div class="main_sm">
    <div class="main_header_sm">
      <h4><?php echo (__('MyPage')); ?></h4>
    </div>
    
    <div class="user_info_sm">
      <form class="user_info_form_sm">
        <div class="form-group">
          <label>会員ID</label><br>
          <?php echo $user['User']['id']; ?>
        </div>
        <div class="form-group">
          <label>ユーザー名</label><br>
          <?php echo $user['User']['username']; ?>
        </div>
        <div class="form-group">
          <label>メールアドレス</label><br>
          <?php echo $user['User']['email']; ?>
        </div>
        <div class="form-group">
          <label>自己紹介</label><br>
          <?php if (isset($user['User']['introduction'])): ?>
            <?php echo $user['User']['introduction']; ?>
          <?php else: ?>
            <?php echo (__('なし')); ?>
          <?php endif; ?>
        </div>
      </form>
      
      <div class="user_item_sm">
        <?php echo $this->Html->link(__('Edit Account'), array('action' => 'edit', $user['User']['id']), array('class' => 'btn btn-success btn-sm', 'style' => "width:90%;")); ?>
      </div>
    </div>
    
    <div class="main_header_sm">
      <h4><?php echo (__('作成記事')); ?></h4>
    </div>
    
    <div class="user_post_sm">
      <div class="content_details_sm">
        <?php foreach ($user['Post'] as $post): ?>
          <div class="content_detail_sm">
            <?php if (!empty($post['Image'])): ?>
              <?php 
                echo $this->Html->image('/files/image/attachment/' . $post['Image'][0]['dir'] . '/' . $post['Image'][0]['attachment'], array('width' => '26%')); 
              ?>
            <?php else: ?>
              <?php
                echo $this->Html->image('/images/Noimage.jpg', array('class' => "con_image", 'width' => '26%'));
              ?>
            <?php endif; ?>
            
            <div class="post_content_sm">
              <ul class="post_content_header_sm" style="list-style:none;">
                <li class="post_category_sm">
                  <span class="category_badge">
                    <?php echo $post['Category']['category']; ?>
                  </span>
                </li>
                <li class="post_created_sm">
                  <?php echo h(date('Y年m月d日', strtotime($post['created']))); ?><br>
                </li>
              </ul>
              <div class="post_title_sm">
                <?php echo h($post['title']); ?><br>
              </div>
              <div class="post_link_sm">
                <?php echo $this->Html->link('', array('controller' => "posts", 'action' => "view", $post['id'])); ?><br>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      
      <div class="user_post_footer_sm">
        <div class="user_item_other_sm">
          <?php echo $this->Html->link(__('Article create'), array('controller' => 'Posts', 'action' => 'add'), array('class' => 'btn btn-primary btn-sm', 'style' => 'width:90%;')); ?>
        </div>
      </div>
    </div>

    <div class="main_header_sm">
      <h4><?php echo (__('ソーシャル連携')); ?></h4>
    </div>
    
    <div class="sns_login_sm">
      <ul style="list-style:none;">
        <li>
          <?php if (is_null($user['User']['credentials_token']) && is_null($user['User']['credentials_secret'])): ?>
            <?php echo $this->Html->link(__('Twitter cooperation'), array('controller' => '', 'action' => 'auth/twitter'), array('class' => "btn btn-on_sm", 'style' => "background-color:#00aced; color:white;")); ?>
          <?php else: ?>
            <?php echo $this->Html->link(__('Cancel Twitter linkage'), array('action' => 'account_clear', $user['User']['id'], 'Twitter'), array('class' => "btn btn-off_sm")); ?>
          <?php endif; ?>
        </li>
        <li>
          <?php if (is_null($user['User']['fb_id'])): ?>
            <?php echo $this->Html->link(__('Facebook cooperation'), array('controller' => '', 'action' => 'auth/facebook'), array('class' => "btn btn-on_sm", 'style' => "background-color:#305097; color:white;")); ?>
          <?php else: ?>
            <?php echo $this->Html->link(__('Cancel Facebook linkage'), array('action' => 'account_clear', $user['User']['id'], 'Facebook'), array('class' => "btn btn-off_sm")); ?>
          <?php endif; ?>
        </li>
        <li>
          <?php if (is_null($user['User']['g_id'])): ?>
            <?php echo $this->Html->link(__('Google cooperation'), array('controller' => '', 'action' => 'auth/google'), array('class' => "btn btn-on_sm", 'style' => "background-color:#db4a39; color:white;")); ?>
          <?php else: ?>
            <?php echo $this->Html->link(__('Cancel Google linkage'), array('action' => 'account_clear', $user['User']['id'], 'Google'), array('class' => "btn btn-off_sm")); ?>
          <?php endif; ?>
        </li>
        <li>
          <?php if (is_null($user['User']['git_id']) && is_null($user['User']['git_url'])): ?>
            <?php echo $this->Html->link(__('GitHub cooperation'), array('controller' => '', 'action' => 'auth/github'), array('class' => "btn btn-on_sm", 'style' => "background-color:#2c4762; color:white;")); ?>
          <?php else: ?>
            <?php echo $this->Html->link(__('Cancel GitHub linkage'), array('action' => 'account_clear', $user['User']['id'], 'GitHub'), array('class' => "btn btn-off_sm")); ?>
          <?php endif; ?>
        </li>
      </ul>
    </div>
    
    <div class="main_footer_sm">
      <div class="user_item_sm">
        <?php echo $this->Html->link(__('Delete Account'), array('action' => 'delete', $user['User']['id']), array('class' => 'btn btn-danger btn-sm', 'style' => 'width:94%;')); ?> 
      </div>
    </div>
  </div>
</div>