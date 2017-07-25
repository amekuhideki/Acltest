<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_search" aria-expanded="false" aria-controls="navbar">
        <span><i class="glyphicon glyphicon-search"></i></span>
      </button>
      <button type="button" class="navbar-toggle collapsed nav_bar_left" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="navbar-brand disabled nav_title">AMEブロ！！！</div>
    </div>
    
    <div id="navbar_search" class="navbar-collapse collapse">
      <div class="nav_search_sm">
        <ul class="nav navbar-nav-search">
          <?php echo $this->Form->create('Post', array('novalidate' => true, 'url' => array('controller' => 'posts', 'action' => 'index') )); ?>
          <li class="search_box_sm">
            <?php
              echo $this->Form->input('keyword', array('label' => '', 'empty' => true, 'placeholder' => 'キーワード検索', 'size' => '30')); ?>
          </li>
          <li class="search_bottun_sm">
            <?php echo $this->Form->end(array('label' => '検索')); ?>
          </li>
        </ul>
      </div>
    </div>
    
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <?php if (isset($_SESSION['Auth']['User']['username'])): ?>
          <li><?php echo $this->Html->link(__('MyPage'), array('controller' => 'users', 'action' => 'view', $_SESSION['Auth']['User']['id']), array('role' => "presentation")); ?> </li>
          <li><?php echo $this->Html->link(__('Article create'), array('controller' => 'posts', 'action' => 'add'), array('role' => "presentation")); ?></li>
        <?php endif;?>
        <li><?php echo $this->Html->link(__('List of articles'), array('controller' => 'posts','action' => 'index'), array('role' => "presentation")); ?></li>
        <li><?php echo $this->Html->link(__('Popular articles list'), array('controller' => 'posts', 'action' => 'popularArticles'), array('role' => "presentation")); ?></li>
        <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index'), array('role' => "presentation")); ?></li>
        <li><?php echo $this->Html->link(__('Category'), array('controller' => 'categories', 'action' => 'index'), array('role' => "presentation")); ?> </li>
        <li><?php echo $this->Html->link(__('Contact'), array('controller' => 'contacts', 'action' => 'contact'), array('role' => "presentation")); ?> </li>
        <?php if (!isset($_SESSION['Auth']['User']['username'])): ?>
          <li class="list_logout"><?php echo $this->Html->link(__('Login'), array('controller' => 'users', 'action' => 'login')) ?></li>
        <?php else: ?>
          <li class="list_logout"><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?></li>
        <?php endif; ?>
      </ul>
    </div><!--/.nav-collapse -->
  
  </div><!--/.container-fluid -->
</nav>

    