<?php echo $this->Html->css('common.css'); ?>
<header>
  <div class="header_header">
    <div class="header_title">
      <h2 id="site_name">AMEブログ!!</h2>
    </div>
    <div class="search_section">
      <ul>
        <?php echo $this->Form->create('Post', array('novalidate' => true, 'url' => array('controller' => 'posts', 'action' => 'index') )); ?>
        <li class="search_box">
          <?php
            echo $this->Form->input('keyword', array('label' => '', 'empty' => true, 'placeholder' => 'キーワード検索', 'size' => '25'));
            // echo $this->Form->input('category', array('label' => 'カテゴリー', 'class' => 'selectpicker_pre', 'empty' => true, 'options' => $categories));
            // echo $this->Form->input('tag', array('label' => 'タグ', 'empty' => true, 'options' => $tags, 'multiple' => true, 'class' => "form-control", 'style' => "width:250px;"));
          ?>
        </li>
        <li class="search_bottun">
          <?php echo $this->Form->end(array('label' => '検索')); ?>
        </li>
      </ul>
    </div>
  </div>
      <!-- </div>
      <a class="search-button"><span class="btn-lg glyphicon glyphicon-search" aria-hidden="true"></span></a>
    </div> -->
  <div class="header_category">
    <div class="header_category_inner">
      <nav>
        <ul>
          <?php if (isset($_SESSION['Auth']['User']['username'])): ?>
            <li><?php echo $this->Html->link(__('MyPage'), array('controller' => 'users', 'action' => 'view', $_SESSION['Auth']['User']['id']),
                                                             array('role' => "presentation")); ?> </li>
            <li><?php echo $this->Html->link(__('Article create'), array('controller' => 'posts', 'action' => 'add'),
                                                           array('role' => "presentation")); ?></li>
          <?php endif;?>

      		<li><?php echo $this->Html->link(__('List of articles'), array('controller' => 'posts','action' => 'index'),
                                                         array('role' => "presentation")); ?></li>
      		<li><?php echo $this->Html->link(__('Category'), array('controller' => 'categories', 'action' => 'index'),
                                                          array('role' => "presentation")); ?> </li>
      		<li><?php echo $this->Html->link(__('Tag'), array('controller' => 'tags', 'action' => 'index'),
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
      </nav>
    </div>
  </div>
</header>
