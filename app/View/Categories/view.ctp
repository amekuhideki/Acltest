<?php echo $this->Html->css('common.css'); ?>
<div class="categories view">
  <div class="header">
    <?php echo $this->element('header'); ?>
  </div>
  <div class="row main">
    <div class="row home_contents">
      <div class="home_contents panel panel-default home_panel_title">
        <div class="panel-body panel_title">
          <?php echo $category_name; ?>
        </div>
        <div class="panel-footer">
          <?php foreach ($posts as $post): ?>
            <div class="media latest_article">
              <div class="media-left">
                <?php if (!empty($post['Image'])): ?>
                  <?php echo $this->Html->image('/files/image/attachment/'. $post['Image'][0]['dir'] . '/' . $post['Image'][0]['attachment'], array('url' => array('controller' => 'posts', 'action' => 'view', $post['Post']['id']), 'width' => '300', 'height' => '200')); ?>
                <?php else: ?>
                  <?php echo $this->Html->image('/images/Noimage.jpg', array('url' => array('controller' => 'posts', 'action' => 'view', $post['Post']['id']), 'width' => '300', 'height' => '200')); ?>
                <?php endif; ?>
              </div>
              <div class="media-body latest_article_body">
                <div class="post_category badge_category">
                  <?php echo $post['Category']['category']; ?>
                </div>
                <div class="post_date">
                  <?php echo date("Y/m/d", strtotime($post['Post']['created'])); ?>
                </div>
                <div class="post_writer">
                  <?php echo $post['User']['username']; ?>
                </div>
                <div class="latest_article_title">
                  <h4 class="media-heading"><?php echo h($post['Post']['title']); ?></h4>
                </div>
                <div class="latest_article_body">
                  <?php echo $post['Post']['body']; ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <nav>
        <div class="paginate">
          <ul class="pagination">
            <li>
              <?php echo $this->Paginator->prev('<', array(), null, array('class' => 'prev disabled')); ?>
            </li>
            <li>
              <?php echo $this->Paginator->numbers(array('separator' => '')); ?>
            </li>
            <li>
              <?php echo $this->Paginator->next('>', array(), null, array('class' => 'next disabled')); ?>
            </li>
          </ul>
        </div>
      </nav>
      
    </div>
  
  <div class="home_side">
    <div class="panel panel-default">
      <div class="panel-body">
        人気記事
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
            <li>
              <?php echo $this->Html->link($category['Category']['category'], array('controller' => 'categories', 'action' => 'view', $category['Category']['id'])); ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
  
</div>
