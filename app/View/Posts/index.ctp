<?php echo $this->Html->css('common.css'); ?>
<?php echo $this->Html->script('common.js'); ?>
<?php echo $this->Html->script('slick.min.js'); ?>
<?php echo $this->Html->css('slick.css'); ?>
<?php echo $this->Html->css('slick-theme.css'); ?>
<script>
$(function() {
    $('.multiple-item').slick({
          infinite: true,
          dots:true,
          slidesToShow: 3,
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
  <div class="box">
    <ul class="multiple-item">
      <?php foreach ($carousel_image as $calousel): ?>
        <?php if (!empty($calousel['Image'])): ?>
          <li><?php echo $this->Html->image('/files/image/attachment/' . $calousel['Image'][0]['dir'] . '/' . $calousel['Image'][0]['attachment'], array('url' => array('controller' => 'posts', 'action' => 'view', $calousel['Post']['id']), 'width' => '100%', 'height' => '300')); ?></li>
        <?php else: ?>
          <li><?php echo $this->Html->image('/images/Noimage.jpg', array('url' => array('controller' => 'posts', 'action' => 'view', $calousel['Post']['id']), 'width' => '100%', 'height' => '300')); ?></li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
  </div>
  <div class="row main">
    
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
    
    <div class="contents">
      <div class="posts_contents panel panel-default">
        <div class="contents_title panel-body">

          <div id="list">
            <h3><?php echo(__('List of articles')); ?></h3>
          </div>

        </div>
        <div class="panel-footer">
          <?php foreach ($posts as $post): ?>
            <div id="content_details" class="media">
              <div class="image media-left">
                <?php $image_flag = 0; ?>
                <?php foreach ($images as $image): ?>
                  <?php if ($image['Image']['foreign_key'] === $post['Post']['id']): ?>
                    <?php echo $this->Html->image('/files/image/attachment/'. $image['Image']['dir']. '/' . $image['Image']['attachment'], array('width' => '240', 'height' => '200')); ?>
                    <?php $image_flag = 1; break; ?>
                  <?php endif; ?>
                <?php endforeach; ?>
                <?php if ($image_flag === 0): ?>
                  <?php echo $this->Html->image('/images/Noimage.jpg', array('width' => '240', 'height' => '200')); ?>
                <?php endif; ?>
                <?php unset($image_flag); ?>
              </div>
              <div class="post_contents media-body">
                <ul class="post_header" style="list-style:none;">
                  <li class="post_category">
                    <span class="badge_category">
                      <?php echo ($post['Category']['category']) ?>
                    </span>
                  </li>
                  <li class="post_date">
                    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                    <?php $post_date = date('Y年m月d日', strtotime($post['Post']['created']));
                      echo h($post_date);
                    ?>
                    &nbsp;&nbsp;
                  </li>
                  <li class="post_writer">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    <?php if (isset($post['User']['username'])): ?>
                      <?php echo $this->Html->link(__($post['User']['username']), array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?>
                    <?php else: ?>
                      <?php echo __('未登録者'); ?>
                    <?php endif; ?>
                    &nbsp;&nbsp;
                  </li>
                </ul>

                <div class="post_title">
                  <?php echo h($post['Post']['title']); ?><br>
                </div>

                <div class="post_body ellipsis">
                  <?php echo $post['Post']['body']; ?>
                </div>

                <div class="contents_footer">
                  <div class="action_view">
                    <?php echo $this->Html->link(__('Read more') . '＞', array('action' => "view", $post['Post']['id'])); ?><br>
                  </div>

                  <div id="item">
                    <?php if ($user['id'] == $post['User']['id'] || $user['Group']['id'] == 1): ?>
                      <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])); ?>
                      ・
                      <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $post['Post']['id']),array('confirm' => '本当にこの記事を削除しますか？')); ?>
                    <?php endif; ?>
                  </div>
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
    
    <div class="wrapper_sidebar">
      <div class="sidebar">

        <div class="panel panel-default">
          <div id="calender_header" class="panel-body">
            <div id="calender_title">
              <h4 style="text-align:left;"><?php echo __('Calender'); ?></h4>
            </div>
          </div>
          <div class="panel-footer">
            <div id="calender">
            </div>
          </div>
          <!-- <input type=”text” name=”demo” id="date_val"> -->
        </div>

        <div id="news" class="panel panel-default">
          <div id="news_header" class="panel-heading">
            <div id="news_title">
              <h4><?php echo __('News Summary'); ?></h4>
            </div>
          </div>
          <?php $i = 1 ?>
          <?php foreach ($news as $new): ?>
            <div class="news_contents">
              <div class="news_img">
                <?php if ($new['img'] == null): ?>
                  <?php echo $this->Html->image('/images/Noimage.jpg', array('width' => '150')); ?>
                <?php else: ?>
                  <a href=<?php echo $new['url'];  ?>><img src="<?php echo $new['img']; ?>" width="260"> </a><br>
                <?php endif; ?>
              </div>
              <div class="news_content">
                <!-- <?php echo $i;
                $limit_title = mb_substr($new['title'], 0, 20, 'utf-8');
                if (mb_strlen($new['title'], 'utf-8') > '20'){
                  $limit_title = $limit_title . '. . .';
                } ?> -->
                <?php echo $i; ?>
                <?php echo $this->Html->link(__($new['title']), $new['url'], array('target' => '_blank')); ?><br>
                <?php $i += 1; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>
