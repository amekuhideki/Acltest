<?php echo $this->Html->css('common.css'); ?>

<div class="categories index">
  <div class="header_sm">
    <?php echo $this->element('header_sm'); ?>
  </div>
  
  <div class="main_sm">
    <div class="main_header_sm">
      <h4><?php echo (__('Category')); ?></h4>
    </div>
    <div class="categories_details_sm">
      <?php foreach ($categories as $category): ?>
        <div class="category_detail_sm">
          <div class="category_name_sm">
            <?php echo ($category['Category']['category']); ?><br>
          </div>
          <div class="post_link_sm">
            <?php echo $this->Html->link('', array('controller' => "category", 'action' => "view", $category['Category']['id'])); ?><br>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    
  </div>
  
</div>