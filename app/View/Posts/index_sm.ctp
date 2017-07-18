<?php echo $this->Html->css('common.css'); ?>

<div class="posts index">
  <div class="header_sm">
    <?php echo $this->element('header_sm'); ?>
  </div>

  <div class="main_sm">
    <div class="main_header_sm">
      <h4><?php echo(__('List of articles')); ?></h4>
    </div>
    
    <div class="content_details_sm">
      <?php foreach($posts as $post): ?>
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
                <?php echo h(date('Y年m月d日', strtotime($post['Post']['created']))); ?><br>
              </li>
            </ul>
            <div class="post_title_sm">
              <?php echo h($post['Post']['title']); ?><br>
            </div>
            <div class="post_link_sm">
              <?php echo $this->Html->link('', array('controller' => "posts", 'action' => "view", $post['Post']['id'])); ?><br>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
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
</div>