<?php echo $this->Html->script('slick.min.js'); ?>
<?php echo $this->Html->css('slick.css'); ?>
<?php echo $this->Html->css('slick-theme.css'); ?>
<script>
$(function() {
    $('.multiple-item').slick({
          infinite: true,
          dots:true,
          slidesToShow: 2,
          slidesToScroll: 1,
          autoplay: true,
          speed: 1200,
          centerMode: true,
          dots: false,
          responsive: [{
               breakpoint: 768,
                    settings: {
                         slidesToShow: 2,
                         slidesToScroll: 1,
               }
          },{
               breakpoint: 480,
                    settings: {
                         slidesToShow: 1,
                         slidesToScroll: 1,
                    }
               }
          ]
     });
});

</script>
<div class="posts index">
  <div class="main_header">
  </div>
  <!-- ↓スライダー本体 -->
  <div class="box">
    <ul class="multiple-item">
      <?php foreach ($popular_posts as $popular_post): ?>
        <?php if (!empty($popular_post['Image'])): ?>
          <li><?php echo $this->Html->image('/files/image/attachment/' . $popular_post['Image'][0]['dir'] . '/' . $popular_post['Image'][0]['attachment'], array('url' => array('controller' => 'posts', 'action' => 'view', $popular_post['Post']['id']), 'width' => '100%', 'height' => '300')); ?></li>
        <?php else: ?>
          <li><?php echo $this->Html->image('/images/Noimage.jpg', array('url' => array('controller' => 'posts', 'action' => 'view', $popular_post['Post']['id']), 'width' => '100%', 'height' => '300')); ?></li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
  </div>
  
  <div class="main">
    <div class="row home_contents">
      <div class="home_contents panel panel-default home_panel_title">
        <div class="panel-body panel_title">
          Pick-Up
        </div>
        <div class="panel-footer">
          <?php if (!empty($pickup['Image'])): ?>
            <?php echo $this->Html->image('/files/image/attachment/' . $pickup['Image'][0]['dir'] . '/' . $pickup['Image'][0]['attachment'], array('url' => array('controller' => 'posts', 'action' => 'view', $pickup['Post']['id']), 'width' => '668', 'height' => '400')); ?>
          <?php else: ?>
            <?php echo $this->Html->image('/images/Noimage.jpg', array('url' => array('controller' => 'posts', 'action' => 'view', $pickup['Post']['id']), 'width' => '668', 'height' => '400')); ?>
          <?php endif; ?>
          <div class="home_panel_body">
            <?php echo $pickup['Post']['title']; ?>
          </div>
        </div>
      </div>
      
      <div class="sub_contents">
        <div class="panel panel-default sub_panel_title category_left">
          <div class="panel-body panel_title sub_category_culture">
            カルチャー
          </div>
          <div class="panel-footer">
            <?php $i = 0; ?>
            <?php foreach ($culture as $culture_contents): ?>
              <?php if ($i === 0): ?>
                <div class="panel panel-default">
                  <?php if (!empty($culture_contents['Image'])): ?>
                    <?php echo $this->Html->image('/files/image/attachment/' . $culture_contents['Image'][0]['dir'] . '/' . $culture_contents['Image'][0]['attachment'], array('url' => array('controller' => 'posts', 'action' =>'view', $culture_contents['Post']['id']), 'width' => '306', 'height' => '200')); ?>
                  <?php else: ?>
                    <?php echo $this->Html->image('/images/Noimage.jpg', array('url' => array('controller' => 'posts', 'action' => 'view', $culture_contents['Post']['id']), 'width' => '306', 'height' => '200')); ?>
                  <?php endif; ?>
                  <div class="pannel-body category_title">
                    <?php echo $culture_contents['Post']['title']; ?>
                  </div>
                </div>
              <?php else: ?>
                <div class="media category_media">
                  <div class="media-left">
                    <?php if (!empty($culture_contents['Image'])): ?>
                      <?php echo $this->Html->image('/files/image/attachment/' . $culture_contents['Image'][0]['dir'] . '/' . $culture_contents['Image'][0]['attachment'], array('url' => array('controller' => 'posts', 'action' => 'view', $culture_contents['Post']['id']), 'width' => '120', 'height' => '100')); ?>
                    <?php else: ?>
                      <?php echo $this->Html->image('/images/Noimage.jpg', array('url' => array('controller' => 'posts', 'action' => 'view', $culture_contents['Post']['id']), 'width' => '120', 'height' => '100')); ?>
                    <?php endif; ?>
                  </div>
                  <div class="media-body">
                    <?php echo $culture_contents['Post']['title']; ?>
                  </div>
                </div>
              <?php endif; ?>
              <?php $i += 1; ?>
            <?php endforeach; ?>
          </div>
        </div>
        
        <div class="panel panel-default sub_panel_title category_right">
          <div class="panel-body panel_title sub_category_play">
            遊び
          </div>
          <div class="panel-footer">
            <?php $i = 0; ?>
            <?php foreach ($play as $play_contents): ?>
              <?php if ($i === 0): ?>
                <div class="panel panel-default">
                  <?php if (!empty($play_contents['Image'])): ?>
                    <?php echo $this->Html->image('/files/image/attachment/' . $play_contents['Image'][0]['dir'] . '/' . $play_contents['Image'][0]['attachment'], array('url' => array('controller' => 'posts', 'action' => 'view', $play_contents['Post']['id']), 'width' => '306', 'height' => '200')); ?>
                  <?php else: ?>
                    <?php echo $this->Html->image('/images/Noimage.jpg', array('url' => array('controller' => 'posts', 'action' => 'view', $play_contents['Post']['id']), 'width' => '306', 'height' => '200')); ?>
                  <?php endif; ?>
                  <div class="pannel-body category_title">
                    <?php echo $play_contents['Post']['title']; ?>
                  </div>
                </div>
              <?php else: ?>
                <div class="media category_media">
                  <div class="media-left">
                    <?php if (!empty($play_contents['Image'])): ?>
                      <?php echo $this->Html->image('/files/image/attachment/' . $play_contents['Image'][0]['dir'] . '/' . $play_contents['Image'][0]['attachment'], array('url' => array('controller' => 'posts', 'action' => 'view', $play_contents['Post']['id']), 'width' => '120', 'height' => '100')); ?>
                    <?php else: ?>
                      <?php echo $this->Html->image('/images/Noimage.jpg', array('url' => array('controller' => 'posts', 'action' => 'view', $play_contents['Post']['id']), 'width' => '120', 'height' => '100')); ?>
                    <?php endif; ?>
                  </div>
                  <div class="media-body">
                    <?php echo $play_contents['Post']['title']; ?>
                  </div>
                </div>
              <?php endif; ?>
              <?php $i += 1; ?>
            <?php endforeach; ?>
          </div>
        </div> 
        
        <div class="panel panel-default sub_panel_title category_left">
          <div class="panel-body panel_title sub_category_work">
            仕事
          </div>
          <div class="panel-footer">
            <?php $i = 0; ?>
            <?php foreach ($work as $work_contents): ?>
              <?php if ($i === 0): ?>
                <div class="panel panel-default">
                  <?php if (!empty($work_contents['Image'])): ?>
                    <?php echo $this->Html->image('/files/image/attachment/' . $work_contents['Image'][0]['dir'] . '/' . $work_contents['Image'][0]['attachment'], array('url' => array('controller' => 'posts', 'action' => 'view', $work_contents['Post']['id']), 'width' => '306', 'height' => '200')); ?>
                  <?php else: ?>
                    <?php echo $this->Html->image('/images/Noimage.jpg', array('url' => array('controller' => 'posts', 'action' => 'view', $work_contents['Post']['id']), 'width' => '306', 'height' => '200')); ?>
                  <?php endif; ?>
                  <div class="pannel-body category_title">
                    <?php echo $work_contents['Post']['title']; ?>
                  </div>
                </div>
              <?php else: ?>
                <div class="media category_media">
                  <div class="media-left">
                    <?php if (!empty($work_contents['Image'])): ?>
                      <?php echo $this->Html->image('/files/image/attachment/' . $work_contents['Image'][0]['dir'] . '/' . $work_contents['Image'][0]['attachment'], array('url' => array('controller' => 'posts', 'action' => 'view', $work_contents['Post']['id']), 'width' => '120', 'height' => '100')); ?>
                    <?php else: ?>
                      <?php echo $this->Html->image('/images/Noimage.jpg', array('url' => array('controller' => 'posts', 'action' => 'view', $work_contents['Post']['id']), 'width' => '120', 'height' => '100')); ?>
                    <?php endif; ?>
                  </div>
                  <div class="media-body">
                    <?php echo $work_contents['Post']['title']; ?>
                  </div>
                </div>
              <?php endif; ?>
              <?php $i += 1; ?>
            <?php endforeach; ?>
          </div>
        </div> 
        
        <div class="panel panel-default sub_panel_title category_right">
          <div class="panel-body panel_title sub_category_tv">
            テレビ
          </div>
          <div class="panel-footer">
            <?php $i = 0; ?>
            <?php foreach ($tv as $tv_contents): ?>
              <?php if ($i === 0): ?>
                <div class="panel panel-default">
                  <?php if (!empty($tv_contents['Image'])): ?>
                    <?php echo $this->Html->image('/files/image/attachment/' . $tv_contents['Image'][0]['dir'] . '/' . $tv_contents['Image'][0]['attachment'], array('url' => array('controller' => 'posts', 'action' => 'view', $tv_contents['Post']['id']), 'width' => '306', 'height' => '200')); ?>
                  <?php else: ?>
                    <?php echo $this->Html->image('/images/Noimage.jpg', array('url' => array('controller' => 'posts', 'action' => 'view', $tv_contents['Post']['id']), 'width' => '306', 'height' => '200')); ?>
                  <?php endif; ?>
                  <div class="pannel-body category_title">
                    <?php echo $tv_contents['Post']['title']; ?>
                  </div>
                </div>
              <?php else: ?>
                <div class="media category_media">
                  <div class="media-left">
                    <?php if (!empty($tv_contents['Image'])): ?>
                      <?php echo $this->Html->image('/files/image/attachment/' . $tv_contents['Image'][0]['dir'] . '/' . $tv_contents['Image'][0]['attachment'], array('url' => array('controller' => 'posts', 'action' => 'view', $tv_contents['Post']['id']), 'width' => '120', 'height' => '100')); ?>
                    <?php else: ?>
                      <?php echo $this->Html->image('/images/Noimage.jpg', array('url' => array('controller' => 'posts', 'action' => 'view', $tv_contents['Post']['id']), 'width' => '120', 'height' => '100')); ?>
                    <?php endif; ?>
                  </div>
                  <div class="media-body">
                    <?php echo $tv_contents['Post']['title']; ?>
                  </div>
                </div>
              <?php endif; ?>
              <?php $i += 1; ?>
            <?php endforeach; ?>
          </div>
        </div> 

      
        <div class="footer_contents latest_articles">
          <div class="panel panel-default">
            <div class="panel-body panel_title article_title">
              <?php echo (__('Latest Articles')); ?>
            </div>
            <div class="panel-footer">
              <?php foreach ($posts as $post): ?>
                <div class="media latest_article">
                  <div class="media-left">
                    <?php if (!empty($post['Image'])): ?>
                      <?php echo $this->Html->image('/files/image/attachment/' . $post['Image'][0]['dir'] . '/' . $post['Image'][0]['attachment'], array('url' => array('controller' => 'posts', 'action' => 'view', $post['Post']['id']), 'width' => '300', 'height' => '200')); ?>
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
      </div>
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
                <?php echo $this->Html->link($category['Category']['category'], array('controller' => 'categories', 'action' => 'view', $category['Category']['id']), array('class' => 'category_btn')); ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
    
    <div class="clear">
    </div>
  </div>
</div>