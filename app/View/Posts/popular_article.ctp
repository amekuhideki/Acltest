<?php echo $this->Html->css('common.css'); ?>

<div class="post popular">
  <div class="header">
    <?php echo $this->element('header'); ?>
  </div>
  <div class="row main">
    <div class="contents panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title"><?php echo(__('Popular articles list')); ?></h4>
      </div>
      <div class="panel-body">
        <?php foreach ($posts as $post): ?>
          <div class="media">
            <div class="media-left">
              <?php if (!empty($post['Image'])): ?>
                <?php echo $this->Html->image('/files/image/attachment/' . $post['Image'][0]['dir'] . '/' . $post['Image'][0]['attachment'], array('width' => '150', 'height' => '150')); ?>
              <?php else: ?>
                <?php echo $this->Html->image('/images/Noimage.jpg', array('width' => '150')); ?>
              <?php endif; ?>
            </div>
            <div class="media-body">
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

              </div>
              
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    
  </div>
</div>
