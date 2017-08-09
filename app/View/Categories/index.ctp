<div class="categories index">
  <div class="row main">
    <div class="row home_contents">
      <div class="home_contents panel panel-default home_panel_title">
        <div class="panel-body panel_title">
          <?php echo (__('List Category')); ?>
        </div>
        <div class="panel-footer">
          <?php foreach ($categories as $category): ?>
            <div class="category_list">
              <?php if (!empty($category['Post'][0]['Image'])): ?>
                <?php echo $this->Html->image('/files/image/attachment/' . $category['Post'][0]['Image'][0]['dir'] . '/' . $category['Post'][0]['Image'][0]['attachment'], array('url' => array('controller' => 'categories', 'action' => 'view', $category['Category']['id']), 'width' => '100%', 'height' => '400'));?>
              <?php else: ?>
                <?php echo $this->Html->image('/images/Noimage.jpg', array('url' => array('controller' => 'categories', 'action' => 'view', $category['Category']['id']), 'width' => '100%', 'height' => '400')); ?>
              <?php endif; ?>
              <div class="home_panel_body category_name">
                <a><?php echo $this->Html->link(__($category['Category']['category']), array('action' => 'view', $category['Category']['id'])); ?></a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <nav>
          <ul class="pagination">
                 <?php
                     echo $this->Paginator->prev(__('<'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                     echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                     echo $this->Paginator->next(__('>'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                     ?>
          </ul>
        </nav>
      </div>
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
</div>
