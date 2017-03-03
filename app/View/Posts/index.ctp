
<div class="posts index">
	<div class="section form_search">
		<fieldset>
			<legend>検索</legend>
			<?php echo $this->Form->create('Post', array('novalidate' => true, 'url' => array_merge(
				array('action' => 'index'), $this->params['pass']) )); ?>
			<?php
				echo $this->Form->input('title', array('label' => 'タイトル', 'empty' => true, 'placeholder' => '例）検索ワードを入力してください。', 'style' => "width:250px;"));
				echo $this->Form->input('category', array('label' => 'カテゴリー', 'class' => 'selectpicker_pre', 'empty' => true, 'options' => $categories));
				echo $this->Form->input('tag', array('label' => 'タグ', 'empty' => true, 'options' => $tags, 'multiple' => true, 'class' => "form-control", 'style' => "width:250px;"));
				echo $this->Form->end(array('label' => '検索', 'class' => "btn btn-default"));
			?>
		<fieldset>
	</div>
	<h3><?php echo __('記事一覧'); ?></h3>
	<?php echo $this->Paginator->counter(array('format' => __('記事件数:{:count}件 表示件数:{:start}件~{:end}件'))); ?>

	<table class="table table-striped">
		<thead>
			<tr>
					<th>Id</th>
					<th>Title</th>
					<th>Category</th>
					<th>Tag</th>
					<th>Action</th>
					<th>Created</th>
					<th>Modified</th>

					<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>
	<tbody>
		<?php foreach ($posts as $post): ?>
			<tr>
				<td><?php echo h($post['Post']['id']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($post['User']['username'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link($post['Category']['category'], array('controller' => 'categories', 'action' => 'view', $post['Category']['id'])); ?>
				</td>
				<td><?php echo h($post['Post']['title']); ?>&nbsp;</td>
				<td><?php echo h($post['Post']['body']); ?>&nbsp;</td>
				<td><?php echo h($post['Post']['created']); ?>&nbsp;</td>
				<td><?php echo h($post['Post']['modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $post['Post']['id']),
					 																				 array('type' => "button", 'class' => "btn btn-primary")); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id']),
																									 array('type' => "button", 'class' => "btn btn-primary")); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']),
					 																							 array('confirm' => __('Are you sure you want to delete # %s?', $post['Post']['id']),
																												  										 'type' => 'button',
																																							 'class' => "btn btn-danger")); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>
	</p>
	<nav>
		<ul class="pagination">
	         <?php
	             echo $this->Paginator->prev(__('前へ'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
	             echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
	             echo $this->Paginator->next(__('次へ'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
	             ?>
	  </ul>
	</nav>
	<div>
	<?php echo $this->Html->Link(__('Logout'), array('controller' => 'users', 'action' => 'logout'),
																						 array('confirm' => __('本当にログアウトしますか？'), 'type' => "button", 'class' => "btn btn-success")); ?>
	</div>
</div>
<!-- <div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Post'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
	</ul>
</div> -->
