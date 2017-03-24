<nav class="navbar navbar-default">
  <div class="navbar-header">
   <a class="navbar-brand">AMEブロ！</a>
   </div>
  	<ul class="nav nav-tabs">
  		<li><?php echo $this->Html->link(__('記事一覧'), array('controller' => 'posts','action' => 'index'),
                                                     array('role' => "presentation")); ?></li>
  		<li><?php echo $this->Html->link(__('ユーザ一覧'), array('controller' => 'users', 'action' => 'index'),
                                                       array('role' => "presentation")); ?> </li>
  		<li><?php echo $this->Html->link(__('カテゴリ'), array('controller' => 'categories', 'action' => 'index'),
                                                      array('role' => "presentation")); ?> </li>
  		<li><?php echo $this->Html->link(__('タグ'), array('controller' => 'tags', 'action' => 'index'),
                                                  array('role' => "presentation")); ?> </li>
      <li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'),
                                                     array('confirm' => __('本当にログアウトしますか？'))); ?> </li>

  	</ul>

  </div>
</nav>
