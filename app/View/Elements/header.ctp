<nav class="navbar navbar-default">
  <div class="navbar-header">
   <a class="navbar-brand">AMEブロ！</a>
   </div>
  	<ul class="nav nav-tabs">
      <li><?php echo $this->Html->link(__('Article create'), array('controller' => 'posts', 'action' => 'add'),
                                                      array('role' => "presentation")); ?></li>
  		<li><?php echo $this->Html->link(__('List of articles'), array('controller' => 'posts','action' => 'index'),
                                                     array('role' => "presentation")); ?></li>
  		<li><?php echo $this->Html->link(__('User'), array('controller' => 'users', 'action' => 'index'),
                                                       array('role' => "presentation")); ?> </li>
  		<li><?php echo $this->Html->link(__('Category'), array('controller' => 'categories', 'action' => 'index'),
                                                      array('role' => "presentation")); ?> </li>
  		<li><?php echo $this->Html->link(__('Tag'), array('controller' => 'tags', 'action' => 'index'),
                                                  array('role' => "presentation")); ?> </li>
      <li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'),
                                                     array('confirm' => __('本当にログアウトしますか？'))); ?> </li>

  	</ul>

  </div>
</nav>
