<?php echo $this->Html->css('common.css'); ?>
<div class="users index">
  <div class="row main">
    <div class="row home_contents">
      <div class="home_contents panel panel-default home_panel_title">
        <div class="panel-body panel_title">
          <?php echo (__('List Users')); ?>
        </div>
        <div>
          <?php foreach ($users as $user): ?>
            <div class="col-sm-6 col-md-4">
              <div class="thumbnail_user">
                <div class="thumbnail">
                  <?php if (!empty($user['userImage']['id'])): ?>
                    <?php echo $this->Html->image('/files/user_image/user_image/' . $user['userImage']['dir'] . '/' . $user['userImage']['user_image'], array('url' => array('action' => 'view', $user['User']['id']), 'class' => 'img-rounded user_image', 'width' => '100%')); ?>
                  <?php else: ?>
                    <?php echo $this->Html->image('/images/no_user.png', array('url' => array('action' => 'view', $user['User']['id']), 'class' => 'img-rounded user_image', 'width' => '100%')); ?>
                  <?php endif; ?>
                  <div class="caption user_introduction_index">
                     <?php echo $user['User']['username']; ?>
                     <div class="user_caption_introduction user_info_ellipsis">
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
    
    <div class="home_side">
      <div class="panel panel-default">
        <div class="panel-body">
          <?php echo (__('Popular Articles')); ?>
        </div>
        <div class="panel-footer">
          <?php foreach ($popular_posts as $popular_post): ?>
            <div class="media category_media">
              <div class="media-left">
                <?php if (!empty($popular_post['Image'])): ?>
                  <?php echo $this->Html->image('/files/image/attachment/' . $popular_post['Image'][0]['dir'] . '/' . $popular_post['Image'][0]['attachment'], array('url' => array('controller' => 'posts', 'action' => 'view', $popular_post['Post']['id']), 'width' => '120', 'height' => '100')); ?>
                <?php else: ?>
                  <?php echo $this->Html->image('/images/Noimage.jpg', array('url' => array('controller' => 'posts', 'action' => 'view', $popular_post['Post']['id']), 'width' => '120', 'height' => '100')); ?>
                <?php endif; ?> 
              </div>
              <div class="media-body">
                <?php if ($popular_post['Category']['category'] === 'カルチャー'): ?>
                  <div class="category_blue">
                    <?php echo $popular_post['Category']['category']; ?><br>
                  </div>
                <?php elseif ($popular_post['Category']['category'] === '遊び'): ?>
                  <div class="category_green">
                    <?php echo $popular_post['Category']['category']; ?><br>
                  </div>
                <?php elseif ($popular_post['Category']['category'] === '仕事'): ?>
                  <div class="category_red">
                    <?php echo $popular_post['Category']['category']; ?><br>
                  </div>
                <?php elseif ($popular_post['Category']['category'] === 'テレビ'): ?>
                  <div class="category_purple">
                    <?php echo $popular_post['Category']['category']; ?><br>
                  </div>
                <?php else: ?>
                  <div class="category_color">
                    <?php echo $popular_post['Category']['category']; ?><br>
                  </div>
                <?php endif; ?>

                <?php echo h($popular_post['Post']['title']); ?><br>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      
      <div class="panel panel-default">
        <div class="panel-body"><?php echo (__('Category')); ?></div>
        <div class="panel-footer panel_footer">
          <ul class="latest_article_category" style="list-style:none;">
            <?php foreach ($categories as $category): ?>
              <?php if ($category['Category']['category'] === 'カルチャー'): ?>
                <li class="blue">
                  <?php echo $this->Html->link($category['Category']['category'], array('controller' => 'categories', 'action' => 'view', $category['Category']['id']), array('class' => 'category_btn')); ?>
                </li>
              <?php elseif ($category['Category']['category'] === '遊び'): ?>
                <li class="green">
                  <?php echo $this->Html->link($category['Category']['category'], array('controller' => 'categories', 'action' => 'view', $category['Category']['id']), array('class' => 'category_btn')); ?>
                </li>
              <?php elseif ($category['Category']['category'] === '仕事'): ?>
                <li class="yellow">
                  <?php echo $this->Html->link($category['Category']['category'], array('controller' => 'categories', 'action' => 'view', $category['Category']['id']), array('class' => 'category_btn')); ?>
                </li>
              <?php elseif ($category['Category']['category'] === 'テレビ'): ?>
                <li class="green">
                  <?php echo $this->Html->link($category['Category']['category'], array('controller' => 'categories', 'action' => 'view', $category['Category']['id']), array('class' => 'category_btn')); ?>
                </li>
              <?php else: ?>
                <li class="red">
                  <?php echo $this->Html->link($category['Category']['category'], array('controller' => 'categories', 'action' => 'view', $category['Category']['id']), array('class' => 'category_btn')); ?>
                </li>
              <?php endif; ?>

            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
    
  </div>
</div>
