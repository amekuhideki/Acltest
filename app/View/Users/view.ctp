<style>
#wrapper {
	width: 960px;
	margin: auto;
}
.header{
	border-bottom: 1px solid #000;
}
</style>
<div id="wrapper">
	<div class="users view">
		<div class="header">
			<?php echo $this->element('header2'); ?>
		</div>
	<h2><?php echo $_SESSION['Auth']['User']['username']; ?></h2>
		<table class="table">
			<tr>
				<td><?php echo __('ユーザーID'); ?></td>
				<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
			</tr>
			<tr>
				<td><?php echo __('グループ'); ?></td>
				<td>
					<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td><?php echo __('ユーザー作成日'); ?></td>
				<td>
					<?php echo h($user['User']['created']); ?>
					&nbsp;
				</td>
			</tr>
		</table>
	</div>

	<div class="related">
		<h3><?php echo __('記事一覧'); ?></h3>
		<?php if (!empty($user['Post'])): ?>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('記事ID'); ?></th>
			<th><?php echo __('カテゴリー'); ?></th>
			<th><?php echo __('タイトル'); ?></th>
			<th><?php echo __('作成日'); ?></th>
			<th><?php echo __('編集日'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($user['Post'] as $post): ?>
			<div class="article">
			<tr>
				<td><?php echo $post['id']; ?></td>
				<td><?php echo $post['category_id']; ?></td>
				<td><?php echo $post['title']; ?></td>
				<td><?php echo $post['created']; ?></td>
				<td><?php echo $post['modified']; ?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'posts', 'action' => 'view', $post['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'posts', 'action' => 'edit', $post['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'posts', 'action' => 'delete', $post['id']), array('confirm' => __('Are you sure you want to delete # %s?', $post['id']))); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add')); ?> </li>
			</ul>
		</div>
	</div>
</div>
