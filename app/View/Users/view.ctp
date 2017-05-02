<style>
.header{
	border-bottom: 1px solid #000;
}
.actions .btn {
	margin: 3px;
}
/*
table th {
	font-size: 16px;
}
table td {
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}*/
/*.details {
	margin: 0 auto;
}*/
.user_details {
	width: 360px;
	padding: 20px;
	margin: 0 auto;
	margin-top: 20px;
	border: 1px solid;
	float: left;
}
.user_details h2 {
	margin: auto;
	padding: 10px;
	text-align: center;
}
.user_posts {
	clear: left;
	margin: 0 auto;
	width: 700px;
}
.user_posts_header {
	margin: auto;
	margin-top: 20px;
	padding: 0px;
	border-style: solid;
	border-color: #A9A9A9;
	border-width: 2px;
}
.user_posts_header h4 {
	margin: auto;
	padding: 10px;
}

.table th {
	text-align: right;

}
.actions {
	float:left;
	width: 500px;
	height: 226px;
	margin: auto;
	margin-top: 20px;
	text-align: left;
	padding-top: 40px;
}
.detail_top {
	padding-left: 100px;
	display: table-cell;
	vertical-align: middle;
	text-align: center;
}
.post_details {
	margin: auto;
	padding: 10px;
	width: 700px;
	height: 110px;
	border-left-style: solid;
	border-bottom-style: solid;
	border-right-style: solid;
	border-color: #A9A9A9;
	border-width: 1px;
}
.post_details h5 {
	/*margin-left: 24px;*/
	margin: auto;
}

/*.post_details_header {
	background-color: 	#A9A9A9；
}*/
.post_category {
	float: left;
	padding-right: 10px;
	margin-left: -26px;
}
.post_created {
	float: left;
}
.post_body {
	clear: left;
	overflow: hidden;
	white-space:  nowrap;
	text-overflow: ellipsis;
	text-align: left;
}
.btn_details {
	float: left;
	padding-right: 15px;
}
.btn_edit {
	float: left;
	padding-right: 15px
}
.btn_delete {
	float: left;
}
.not_post {
	text-align: center;
}
</style>
<div class="users view">
	<div class="header">
		<?php echo $this->element('header2'); ?>
	</div>
	<div class="details">
		<div class="detail_top">
			<div class="user_details">
				<h2><?php echo $user['User']['username'] . "さん"; ?></h2>
				<table class="table">
					<tr>
						<th><?php echo __('ユーザID:'); ?></th>
						<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
					</tr>
					<tr>
						<th><?php echo __('グループ:'); ?></th>
						<?php if ($user['Group']['name'] === 'administrators'): ?>
							<td><?php echo "管理者"; ?>&nbsp;</td>
						<?php elseif ($user['Group']['name'] === 'managers'): ?>
							<td><?php echo "マネージャー"; ?></td>
						<?php else: ?>
							<td><?php echo "一般ユーザー"; ?></td>
						<?php endif; ?>
					</tr>
					<tr>
						<th><?php echo __('ユーザー作成日:'); ?></th>
						<td>
							<?php echo h($user['User']['created']); ?>
							&nbsp;
						</td>
					</tr>
				</table>
			</div>
			<div class="actions">
				<ul>
					<li><?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add'), array("class" => 'btn btn-default btn-lg active')); ?> </li>
					<li><?php echo $this->Html->link(__('Edit Account'), array('controller' => 'users', 'action' => 'edit', $user['User']['id']), array("class" => 'btn btn-default btn-lg active')); ?> </li>
					<li><?php echo $this->Html->link(__('Delete Account'), array('controller' => 'posts', 'action' => 'add'), array("class" => 'btn btn-default btn-lg active')); ?> </li>
				</ul>
			</div>
		</div>
		<div class="user_posts">
			<div class="related">
				<div class="user_posts_header">
					<h4><?php echo __('記事一覧'); ?></h4>
				</div>
				<?php if (!empty($user['Post'])): ?>
					<?php foreach ($user['Post'] as $post): ?>
						<div class="post_details">
							<div class="post_details_header">
								<h5><?php echo h("・".$post['title']); ?></h5>
								<ul>
									<?php foreach ($categories as $category): ?>
										<?php if ($category['Category']['id'] === $post['category_id']): ?>
											<li class="post_category"><?php echo $category['Category']['category']; ?></li>
										<?php endif; ?>
									<?php endforeach; ?>
									<li class="post_created"><?php echo "作成日: ".$post['created']; ?></li>
								</ul>
							</div>
							<p class="post_body"><?php echo strip_tags($post['body']); ?></p>
							<ul>
								<li class="btn_details"><?php echo $this->Html->link(__('View'), array('controller' => 'posts', 'action' => 'view', $post['id'])); ?></li>
								<li class="btn_edit"><?php echo $this->Html->link(__('Edit'), array('controller' => 'posts', 'action' => 'edit', $post['id'])); ?></li>
								<li class="btn_dlete"><?php echo $this->Form->postLink(__('Delete'), array('controller' => 'posts', 'action' => 'delete', $post['id']),
																															 array('confirm' => __('Are you sure you want to delete # %s?', $post['id']))); ?></li>
							</ul>
						</div>
					<?php endforeach; ?>
				<!-- <table cellpadding = "0" cellspacing = "0" class="table-bordered">
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
							<td><?php echo h($post['title']); ?></td>
							<td><?php echo $post['created']; ?></td>
							<td><?php echo $post['modified']; ?></td>
							<td class="actions">
								<?php echo $this->Html->link(__('View'), array('controller' => 'posts', 'action' => 'view', $post['id']), array("class" => 'btn btn-primary')); ?>
								<?php echo $this->Html->link(__('Edit'), array('controller' => 'posts', 'action' => 'edit', $post['id']), array("class" => 'btn btn-primary')); ?>
								<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'posts', 'action' => 'delete', $post['id']),
																															 array('confirm' => __('Are you sure you want to delete # %s?', $post['id']),
																														 				 "class" => 'btn btn-danger')); ?>
							</td>
						</tr>
					</div>
					<?php endforeach; ?>
				</table> -->
				<?php else: ?>
					<div class="not_post">
						<?php echo "記事はありません。"; ?>
					</div>
				<?php endif; ?>


			</div>
		</div>
	</div>
</div>
