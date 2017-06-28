<style>
.details{
	width: 960px;
	margin-left: 40px;
	margin-right: 40px;
	margin: 0 auto;
	margin-top: 40px;
	background-color: white;
	border: 1px solid;
}
.actions .btn {
	margin: 3px;
}
.user_details {
	width: 280px;
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
	width: 760px;
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
	background-color: #7BAEB5;
}

.table th {
	text-align: right;

}
.user_introduction {
	float: left;
	width: 288px;
	height: 246px;
	margin-top: 20px;
	margin-left: 5px;
	margin-right: 5px;
	padding-top: 20px;
}
.user_introduction h4 {
	text-align: left;
	border-bottom: solid;
}
.actions {
	float:left;
	width: 180px;
	height: 226px;
	margin: auto;
	margin-top: 60px;
	text-align: left;
	padding-top: 40px;
}
.actions ul {
	padding-left: 0px;
}
.account_collabo {
	margin: 0 auto;
}
.detail_top {
	padding-left: 100px;
	display: table-cell;
	vertical-align: middle;
	text-align: center;
}
.post_details {
	margin: auto;
	margin-bottom: 10px;
	padding: 10px;
	width: 760px;
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

.post_details_header {
	border-bottom: dotted 1px black;
	height: 34px;
}
/*.list_details {
	border-bottom: dotted 2px black;
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
	padding-top: 10px;
	clear: left;
	overflow: hidden;
	white-space:  nowrap;
	text-overflow: ellipsis;
	text-align: left;
}
.btn_details {
	margin-left: -30px;
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
						<th><?php echo __('ID:'); ?></th>
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
						<th><?php echo __('作成日:'); ?></th>
						<td>
							<?php echo h($user['User']['created']); ?>
							&nbsp;
						</td>
					</tr>
				</table>
			</div>
			<div class="user_introduction">
				<h4>自己紹介</h4>
				<?php if(!is_null($user['User']['introduction'])): ?>
					<?php echo $user['User']['introduction']; ?>
				<?php else: ?>
					<p>自己紹介文はありません。</p>
				<?php endif; ?>
			</div>
			<div class="actions">
				<ul>
					<li><?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add'),
					 																								 array("class" => 'btn btn-default btn-lg active', 'style' => 'width:180px')); ?> </li>
					<li><?php echo $this->Html->link(__('Edit Account'), array('controller' => 'users', 'action' => 'edit', $user['User']['id']),
					                                                     array("class" => 'btn btn-default btn-lg active', 'style' => 'width:180px')); ?> </li>
					<li><?php echo $this->Html->link(__('Delete Account'), array('controller' => 'users', 'action' => 'delete', $user['User']['id']),
					                                                       array("class" => 'btn btn-default btn-lg active', 'style' => 'width:180px',
																															 					"confirm" => __('Are you sure you want to delete #%s?', $user['User']['username']))); ?> </li>
				</ul>
			</div>
		</div>
		
		<div class="account_collabo">
			<ul>
				<li>
					<?php echo $this->Html->link(__('Twitterと連携'), array('controller' => '', 'action' => 'auth/twitter')); ?>
				</li>
				<li>
					<?php echo $this->Html->link(__('Facebookと連携'), array('controller' => '', 'action' => 'auth/facebook')); ?>
				</li>
				<li>
					<?php echo $this->Html->link(__('Googleと連携'), array('controller' => '', 'action' => 'auth/google')); ?>
				</li>
				<li>
					<?php echo $this->Html->link(__('GitHubと連携'), array('controller' => '', 'action' => 'auth/github')); ?>
				</li>
			</ul>
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
								<ul class="list_details">
									<?php foreach ($categories as $category): ?>
										<?php if ($category['Category']['id'] === $post['category_id']): ?>
											<li class="post_category"><?php echo $category['Category']['category']; ?></li>
										<?php endif; ?>
									<?php endforeach; ?>
									<li class="post_created"><?php echo "作成日: ".$post['created']; ?></li>
								</ul>
							</div>
							<p class="post_body"><?php echo strip_tags($post['body']); ?></p>
							<ul class="detail_bottun">
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
