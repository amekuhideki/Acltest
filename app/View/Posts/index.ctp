<style>
	#wrapper{
		width: 960px;
		margin: 0 auto;
	}

	#content{
		width: 960px;
		margin: 0 auto;
	}

	#content_details{
		margin: 100px;
	}

	.post_title{
		font-size: 25px;
		text-align: left;
		background: linear-gradient(transparent 60%, #ff0 0%);/*　タイトルの下線*/
	}

	.post_body{
		font-size: 15px;
		text-align: center;
	}

	.action_view{
		text-align: right;
	}

</style>
<div id="wrapper">
	<div class="posts index">
		<?php echo $this->element('header2'); ?>

		<div id="contents">
			<?php foreach ($posts as $post): ?>
				<div id="content_details">
					<div class="post_title">
						<?php echo h($post['Post']['title']); ?><br>
					</div>

					<div class="post_date">
						<?php $post_date = date('Y年m月d日', strtotime($post['Post']['created']));
						      echo h('□'.$post_date);
						 ?>
					</div>

					<div class="post_body">
						<?php
							$body = $post['Post']['body'];
							$limit_body = mb_substr($body, 0, 30, 'utf-8');
							if (mb_strlen($body, 'utf-8') > '30'){
								$limit_body = $limit_body . '...';
							}
						 echo h($limit_body); ?>
					 </div>

					 <div class="action_view">
						<?php echo $this->Html->link(__('続きを読む＞'), array('action' => "view", $post['Post']['id'])) ?><br>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</div>
<!-- <div class="posts index">
	<h3><?php echo __('記事一覧'); ?></h3>
	<?php echo $this->Paginator->counter(array('format' => __('記事件数:{:count}件 表示件数:{:start}件~{:end}件'))); ?>

	<table class="table table-striped">
		<thead>
			<tr>
					<th><?php echo(__('記事番号')); ?></th>
					<th><?php echo(__('ユーザ')); ?></th>
					<th><?php echo(__('カテゴリ')); ?></th>
					<th><?php echo(__('タイトル')); ?></th>
					<th><?php echo(__('記事内容')); ?></th>
					<th><?php echo(__('作成日')); ?></th>
					<th><?php echo(__('変更日')); ?></th>

					<th class="actions"><?php echo __('詳細'); ?></th>
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
						<?php echo $this->Html->link(__('詳細'), array('action' => 'view', $post['Post']['id']),
						 																				 array('type' => "button", 'class' => "btn btn-primary")); ?>
						<?php if ($user_auth['user_group'] == 1 || $user_auth['user_name'] == $post['User']['username']): ?>
						<?php echo $this->Html->link(__('編集'), array('action' => 'edit', $post['Post']['id']),
																										 array('type' => "button", 'class' => "btn btn-primary")); ?>
						<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $post['Post']['id']),
						 																							 array('confirm' => __('Are you sure you want to delete # %s?', $post['Post']['id']),
																													  										 'type' => 'button',
																																								 'class' => "btn btn-danger")); ?>
						<?php endif; ?>
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
</div> -->
