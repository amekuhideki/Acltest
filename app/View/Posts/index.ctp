<?php echo $this->Html->css('posts/index.css'); ?>
<div class="posts index">
	<div class="header">
		<?php echo $this->element('header2'); ?>
	</div>
	<div id="contents">
		<?php foreach ($posts as $post): ?>
			<div id="content_details">
				<div class="post_title">
					<?php echo h($post['Post']['title']); ?><br>
				</div>

				<ul id="post_header">
					<li class="post_date">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						<?php $post_date = date('Y年m月d日', strtotime($post['Post']['modified']));
						      echo h($post_date);
						 ?>
						 &nbsp;&nbsp;
					</li>
					<li class="post_writer">
						<?php echo __($post['User']['username']); ?>
						&nbsp;&nbsp;
					</li>
					<li class="post_category">
						<?php echo $this->Html->link(__($post['Category']['category']), array('controller' => 'categories', 'action' => 'view', $post['Category']['id'])) ?>
					</li>
					<li class="post_tags">
						<span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
						<?php foreach ($tags as $tag): ?>
							<?php if(!empty($tag['Post'][0]) && $tag['Post'][0]['id'] == $post['Post']['id']): ?>
								<?php echo $this->Html->link(__($tag['Tag']['tag']), array('controller' => "tags", 'action' => "view", $tag['Tag']['id'])); ?>
							<?php endif; ?>
						<?php  endforeach; ?>
					</li>
				</ul>

				<ul class="image_body">
					<li>
						<div class="post_image">
							<?php $image_flag = 0; ?>
							<?php foreach ($images as $image): ?>
								<?php if ($image['Image']['foreign_key'] === $post['Post']['id']): ?>
									<?php echo $this->Html->image('/files/image/attachment/'. $image['Image']['dir']. '/' . $image['Image']['attachment'], array('width' => '150')); ?>
									<?php $image_flag = 1; break; ?>
								<?php endif; ?>
							<?php endforeach; ?>
							<?php if ($image_flag === 0): ?>
								<?php echo $this->Html->image('/images/Noimage.jpg', array('width' => '150')); ?>
							<?php endif; ?>
							<?php unset($image_flag); ?>
						</div>
					</li>
					<li>
						<div class="post_body">
							<?php
								$body = strip_tags($post['Post']['body']);
								$limit_body = mb_substr($body, 0, 100, 'utf-8');
								if (mb_strlen($body, 'utf-8') > '100'){
									$limit_body = $limit_body . '...';
								}
							 echo ($limit_body); ?>
						 </div>
					 </li>
				 </ul>

				<div class="contents_footer">
					<div class="action_view">
					 <?php echo $this->Html->link(__('続きを読む＞'), array('action' => "view", $post['Post']['id'])); ?><br>
				 </div>

					<div id="item">
						<?php if ($user['id'] == $post['User']['id'] || $user['Group']['id'] == 1): ?>
							<?php echo $this->Html->link(__('編集'), array('action' => 'edit', $post['Post']['id'])); ?>
							・
							<?php echo $this->Html->link(__('削除'), array('action' => 'delete', $post['Post']['id']),
																											 array('confirm' => '本当にこの記事を削除しますか？')); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
		<nav>
			<div class="paginate">
				<ul class="pagination">
					<li>
					 	<?php echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled')); ?>
					</li>
					<li>
						<?php echo $this->Paginator->numbers(array('separator' => '')); ?>
					</li>
					<li>
						<?php echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled')); ?>
					</li>
				</ul>
		 	</div>
		</nav>
	</div>


	<div class="sidebar">
		<div id="news">
			<h4><?php echo __('まとめニュース'); ?></h4>
			<?php $i = 1 ?>
			<?php foreach ($news as $new): ?>
				<div class="news_contents">
					<div class="news_img">
						<a href=<?php echo $new['url'];  ?>><img src="<?php echo $new['img']; ?>" width="220"> </a><br>
					</div>
					<div class="news_content">
						<?php echo $i;
						$limit_title = mb_substr($new['title'], 0, 20, 'utf-8');
						if (mb_strlen($new['title'], 'utf-8') > '20'){
							$limit_title = $limit_title . '. . .';
						} ?>
						<?php echo $this->Html->link(__($limit_title), $new['url'], array('target' => '_blank')); ?><br>
						<?php $i += 1; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
