<?php echo $this->Html->css('common.css'); ?>

<nav class="navbar-inverse navbar-collapse" id="nav_targets">
  <div class="header_nav">
    <h1 class="navbar-brand"><?php echo $this->Html->link(__('AMEブロ！！！'), array('controller' => 'posts', 'action' => 'home'), array('class' => 'title')); ?></h1>
  </div>
  <div class="search_section">
    <ul>
      <?php echo $this->Form->create('Post', array('novalidate' => true, 'url' => array('controller' => 'posts', 'action' => 'index') )); ?>
      <li class="search_box">
        <?php
          echo $this->Form->input('keyword', array('label' => '', 'empty' => true, 'placeholder' => 'キーワード検索', 'size' => '25'));
        ?>
      </li>
      <li class="search_bottun">
        <?php echo $this->Form->end(array('label' => '検索')); ?>
      </li>
    </ul>
  </div>
  </div>
</nav>
<nav class="navbar-inverse navbar-collapse" id="nav_targets_sub">
  <div class="header_nav">
  </div>
  <ul class="nav navbar-nav list_nav">
    <?php if (isset($_SESSION['Auth']['User']['username'])): ?>
      <li><?php echo $this->Html->link(__('MyPage'), array('controller' => 'users', 'action' => 'view', $_SESSION['Auth']['User']['id']),
                                                       array('role' => "presentation")); ?> </li>
      <li><?php echo $this->Html->link(__('Article create'), array('controller' => 'posts', 'action' => 'add'),
                                                     array('role' => "presentation")); ?></li>
    <?php endif;?>

    <li><?php echo $this->Html->link(__('List of articles'), array('controller' => 'posts','action' => 'index'),
                                                   array('role' => "presentation")); ?></li>
    <li><?php echo $this->Html->link(__('User'), array('controller' => 'users', 'action' => 'index')); ?></li>
    <li><?php echo $this->Html->link(__('Category'), array('controller' => 'categories', 'action' => 'index'),
                                                    array('role' => "presentation")); ?> </li>
    <li><?php echo $this->Html->link(__('Contact'), array('controller' => 'contacts', 'action' => 'contact'),
                                                array('role' => "presentation")); ?> </li>
    <?php if ($_SESSION['lang'] === 'eng'): ?>
      <?php if ($this->action === 'view' || $this->action === 'edit'): ?>
        <?php if (isset($post['Post']['id'])){
                $id = $post['Post']['id'];
              } elseif (isset($user['User']['id'])){
                $id = $user['User']['id'];
              } elseif (isset($category['Category']['id'])){
                $id = $category['Category']['id'];
              }
        ?>
        <li><?php echo $this->Html->link(__('japanese'), array('controller' => $this->name, 'action' => $this->action . "/" . $id, 'parameter' => 'jpn'),
                                                      array('role' => 'presentation', 'class' => 'language')); ?></li>
      <?php else: ?>
        <li><?php echo $this->Html->link(__('japanese'), array('controller' => $this->name, 'action' => $this->action, 'parameter' => 'jpn'),
                                                      array('role' => 'presentation', 'class' => 'language')); ?></li>
      <?php endif; ?>
      <?php else: ?>
      <?php if ($this->action === 'view' || $this->action === 'edit'): ?>
        <?php if (isset($post['Post']['id'])){
                $id = $post['Post']['id'];
              } elseif (isset($user['User']['id'])){
                $id = $user['User']['id'];
              } elseif (isset($category['Category']['id'])){
                $id = $category['Category']['id'];
              }
        ?>
        <li><?php echo $this->Html->link(__('English'), array('controller' => $this->name, 'action' => $this->action . "/" . $id, 'parameter' => 'eng'),
                                                    array('role' => 'presentation', 'class' => 'language')); ?></li>
      <?php else: ?>
        <li><?php echo $this->Html->link(__('English'), array('controller' => $this->name, 'action' => $this->action, 'parameter' => 'eng'),
                                                    array('role' => 'presentation', 'class' => 'language')); ?></li>
      <?php endif; ?>
    <?php endif; ?>
    <?php if (!isset($_SESSION['Auth']['User']['username'])): ?>
      <li class="list_logout"><?php echo $this->Html->link(__('Login'), array('controller' => 'users', 'action' => 'login')) ?></li>
    <?php else: ?>
      <li class="list_logout"><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'),
                                                     array('confirm' => __('本当にログアウトしますか？'))); ?></li>
    <?php endif; ?>
  </ul>
  </div>
</nav>