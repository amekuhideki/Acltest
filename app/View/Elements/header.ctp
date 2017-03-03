<div id="header">
  <div class="actions">
  	<h1><?php echo __('アメブロ'); ?></h1>
  	<ul class="nav nav-tabs">
  		<li><?php echo $this->Html->link(__('記事一覧'), array('controller' => 'posts','action' => 'index'), array('role' => "presentation")); ?></li>
  		<li><?php echo $this->Html->link(__('ユーザ一覧'), array('controller' => 'users', 'action' => 'index'), array('role' => "presentation")); ?> </li>
  		<li><?php echo $this->Html->link(__('カテゴリ'), array('controller' => 'categories', 'action' => 'index'), array('role' => "presentation")); ?> </li>
  		<li><?php echo $this->Html->link(__('タグ'), array('controller' => 'tags', 'action' => 'index'), array('role' => "presentation")); ?> </li>
  	</ul>
  </div>
</div>
