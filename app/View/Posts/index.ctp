<?php echo $this->Html->css('common.css'); ?>
<?php echo $this->Html->script('common.js'); ?>
<div class="posts index">
  <div class="header">
    <?php echo $this->element('header2'); ?>
  </div>
  <div class="main">
    <div id="contents">
      <div id="contents_title">

        <div id="contents_img">
          <?php echo $this->Html->image('/images/shisa.png', array('width' => '50')); ?>
        </div>
        <div id="list">
          <h3><?php echo(__('List of articles')); ?></h3>
        </div>

      </div>
      <?php foreach ($posts as $post): ?>
        <div id="content_details">
          <div class="image">
            <div class="post_image">
              <?php $image_flag = 0; ?>
              <?php foreach ($images as $image): ?>
                <?php if ($image['Image']['foreign_key'] === $post['Post']['id']): ?>
                  <?php echo $this->Html->image('/files/image/attachment/'. $image['Image']['dir']. '/' . $image['Image']['attachment'], array('width' => '150')); ?>
                  <?php $image_flag = 1; break; ?>
                <?php endif; ?>
              <?php endforeach; ?>
              <?php if ($image_flag === 0): ?>
                <?php echo $this->Html->image('/images/Noimage.jpg', array('width' => '150')); ?>
              <?php endif; ?>
              <?php unset($image_flag); ?>
            </div>
          </div>
          <div class="post_contents">
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
                  <?php echo __($post['User']['username']); ?>
                <?php else: ?>
                  <?php echo __('未登録者'); ?>
                <?php endif; ?>
                &nbsp;&nbsp;
              </li>
            </ul>

            <div class="post_title">
              <?php echo h($post['Post']['title']); ?><br>
            </div>

            <div class="post_body">
              <?php
                $body = strip_tags($post['Post']['body']);
                $limit_body = mb_substr($body, 0, 100, 'utf-8');
                if (mb_strlen($body, 'utf-8') > '100'){
                  $limit_body = $limit_body . '...';
                }
                echo ($limit_body);
              ?>
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
      <nav>
        <div class="paginate">
          <ul class="pagination">
            <li>
              <?php echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled')); ?>
            </li>
            <li>
              <?php echo $this->Paginator->numbers(array('separator' => '')); ?>
            </li>
            <li>
              <?php echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled')); ?>
            </li>
          </ul>
        </div>
      </nav>
    </div>

    <div class="wrapper_sidebar">
      <div class="sidebar">

        <div id="calender">
          <div id="calender_header">
            <div id="calender_icon">
              <img src="/AclTest/images/sidebar_img.png", width="30">
            </div>
            <div id="calender_title">
              <h4 style="text-align:left;"><?php echo __('Calender'); ?></h4>
            </div>
          </div>
          <input type=”text” name=”demo” id="date_val">
        </div>

        <div id="news">
          <div id="news_header">
            <div id="news_icon">
              <img src="/AclTest/images/sidebar_img.png", width="30">
            </div>
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
                <?php echo $i;
                $limit_title = mb_substr($new['title'], 0, 20, 'utf-8');
                if (mb_strlen($new['title'], 'utf-8') > '20'){
                  $limit_title = $limit_title . '. . .';
                } ?>
                <?php echo $this->Html->link(__($limit_title), $new['url'], array('target' => '_blank')); ?><br>
                <?php $i += 1; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>
