<div class="posts view">
	<?php echo $this->element('header'); ?>
<h2><?php echo __('記事内容'); ?></h2>
<table class="table">
		<tr>
			<td width="200px"><?php echo __('記事番号'); ?></td>
			<td><?php echo h($post['Post']['id']); ?>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo __('投稿者'); ?></td>
			<td>
				<?php echo $this->Html->link($post['User']['username'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td><?php echo __('カテゴリー'); ?></td>
			<td>
				<?php echo $this->Html->link($post['Category']['category'], array('controller' => 'categories', 'action' => 'view', $post['Category']['id'])); ?>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td><?php echo __('タイトル'); ?></td>
			<td>
				<?php echo h($post['Post']['title']); ?>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td><?php echo __('本文'); ?></td>
			<td>
				<?php echo h($post['Post']['body']); ?>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td><?php echo __('タグ'); ?></td>
			<td>
				<?php foreach ($post['Tag'] as $tag): ?>
					<?php echo '#' . h($tag['tag']); ?>
				<?php endforeach; ?>
				&nbsp;
			</td>
		</tr>
		<?php if(!empty($post['Image'])): ?>
		<tr>
			<td><?php echo __('画像一覧'); ?></td>
			<td>
					<?php foreach ($post['Image'] as $image): ?>
							<!-- <a><?php echo $this->Html->image( "/files/image/attachment/"
																						. $image["dir"] . "/" . $image["attachment"],
																					 	array('class' => "image", 'width' => "250")); ?></a> -->
					  <a href=<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?>
							 data-lightbox="group01" data-title=""/>
							 <img src=<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?>
							 width="256"></a>
					<?php endforeach; ?>
			</td>
		</tr>
		<?php endif; ?>
		<tr>
			<td><?php echo __('作成日'); ?></td>
			<td>
				<?php echo h($post['Post']['created']); ?>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td><?php echo __('変更日'); ?></td>
			<td>
				<?php echo h($post['Post']['modified']); ?>
				&nbsp;
			</td>
		</tr>
	</table>
	<p><?php echo $this->Html->link(__('記事一覧に戻る'), array('action' => "index")); ?></p>
</div>
<!-- <div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Post'), array('action' => 'edit', $post['Post']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Post'), array('action' => 'delete', $post['Post']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $post['Post']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div> -->
