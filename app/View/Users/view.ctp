<?php echo $this->Html->css('common.css'); ?>
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
			<div class="actions">
				<h3>他アカウントの連携</h3>
				<ul>
					<li>
						<?php if (is_null($user['User']['credentials_token']) && is_null($user['User']['credentials_secret'])): ?>
							<?php echo $this->Html->link(__('Twitterと連携'), array('controller' => '', 'action' => 'auth/twitter'), array('class' => "btn btn-on", 'style' => "background-color:#00aced; color:white;")); ?>
						<?php else: ?>
							<?php echo $this->Html->link(__('Twitter連携を解除する'), array('action' => 'account_clear', $user['User']['id'], 'Twitter'), array('class' => "btn btn-off")); ?>
						<?php endif; ?>
					</li>
					<li>
						<?php if (is_null($user['User']['fb_id'])): ?>
							<?php echo $this->Html->link(__('Facebookと連携'), array('controller' => '', 'action' => 'auth/facebook'), array('class' => "btn btn-on", 'style' => "background-color:#305097; color:white;")); ?>
						<?php else: ?>
							<?php echo $this->Html->link(__('Facebook連携を解除する'), array('action' => 'account_clear', $user['User']['id'], 'Facebook'), array('class' => "btn btn-off")); ?>
						<?php endif; ?>
					</li>
					<li>
						<?php if (is_null($user['User']['g_id'])): ?>
							<?php echo $this->Html->link(__('Googleと連携'), array('controller' => '', 'action' => 'auth/google'), array('class' => "btn btn-on", 'style' => "background-color:#db4a39; color:white;")); ?>
						<?php else: ?>
							<?php echo $this->Html->link(__('Google連携を解除する'), array('action' => 'account_clear', $user['User']['id'], 'Google'), array('class' => "btn btn-off")); ?>
						<?php endif; ?>
					</li>
					<li>
						<?php if (is_null($user['User']['git_id']) && is_null($user['User']['git_url'])): ?>
							<?php echo $this->Html->link(__('GitHubと連携'), array('controller' => '', 'action' => 'auth/github'), array('class' => "btn btn-on", 'style' => "background-color:#2c4762; color:white;")); ?>
						<?php else: ?>
							<?php echo $this->Html->link(__('GitHub連携を解除する'), array('action' => 'account_clear', $user['User']['id'], 'GitHub'), array('class' => "btn btn-off")); ?>
						<?php endif; ?>
					</li>
				</ul>
			</div>
		</div>
		
		<div class="user_introduction">
			<h4>自己紹介</h4>
			<?php if(!is_null($user['User']['introduction'])): ?>
				<?php echo $user['User']['introduction']; ?>
			<?php else: ?>
				<p>自己紹介文はありません。</p>
			<?php endif; ?>
		</div>

		<div class="btn-list">
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
											<li class="users_post_category"><?php echo $category['Category']['category']; ?></li>
										<?php endif; ?>
									<?php endforeach; ?>
									<li class="post_created"><?php echo "作成日: ".$post['created']; ?></li>
								</ul>
							</div>
							<p class="users_post_body"><?php echo strip_tags($post['body']); ?></p>
							<ul class="detail_bottun">
								<li class="btn_details"><?php echo $this->Html->link(__('View'), array('controller' => 'posts', 'action' => 'view', $post['id'])); ?></li>
								<li class="btn_edit"><?php echo $this->Html->link(__('Edit'), array('controller' => 'posts', 'action' => 'edit', $post['id'])); ?></li>
								<li class="btn_dlete"><?php echo $this->Form->postLink(__('Delete'), array('controller' => 'posts', 'action' => 'delete', $post['id']),
																															 array('confirm' => __('Are you sure you want to delete # %s?', $post['id']))); ?></li>
							</ul>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="not_post">
						<?php echo "記事はありません。"; ?>
					</div>
				<?php endif; ?>


			</div>
		</div>
	</div>
</div>
