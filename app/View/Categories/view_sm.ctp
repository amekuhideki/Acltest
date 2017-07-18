<?php echo $this->Html->css('common.css'); ?>

<div class="category view_sm">
  <div class="header_sm">
    <?php echo $this->element('header_sm'); ?>
  </div>
  
  <div class="main_sm">
    <div class="main_header_sm">
      <h4><?php echo (__('Category')); ?></h4>
    </div>
    <div class="category_header_sm">
      <h4><span><?php echo h($category['Category']['category']); ?></span></h4>
    </div>
    <div class="content_details_sm">
      <?php foreach ($posts as $post): ?>
        <div class="content_detail_sm">
          <?php if (!empty($post['Image'])): ?>
            <?php echo $this->Html->image('/files/image/attachment/' . $post['Image'][0]['dir'] . '/' . $post['Image'][0]['attachment'], array('class' => 'category_image_sm', 'width' => '26%')); ?>
          <?php else: ?>
            <?php echo $this->Html->image('/images/Noimage.jpg', array('class' => "category_image_sm", 'width' => '26%'));?>
          <?php endif; ?>
          
          <div class="category_item_sm">
            <div class=category_post_created_sm>
              <?php echo h(date('Y年m月d日', strtotime($post['Post']['created']))); ?><br>
            </div>
            <div class="category_post_title_sm">
              <?php echo $post['Post']['title']; ?><br>
            </div>
            <div class="post_link_sm">
              <?php echo $this->Html->link('', array('controller' => "posts", 'action' => "view", $post['Post']['id'])); ?><br>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <div class="content_details_fotter_sm">
      </div>
    </div>
    
  </div>
</div>