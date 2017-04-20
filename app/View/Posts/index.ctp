<style>
	#wrapper{
		width: 960px;
		margin: 0 auto;
	}

	#contents{
		width: 700px;
		margin: 0 auto;
		float: left;
	}

	#content_details{
		/*margin: 100px;*/
		padding-top: 50px;
	}

	.post_title{
		margin: 20px;
		font-size: 30px;
		text-align: left;
		/*padding-left: 10px;*/
		padding: 20px;
		border-left: 10px solid #7BAEB5;
		border-bottom: 1px solid #7BAEB5;
	}

	.post_body{
		margin: auto;
		padding: 40px;
		font-size: 18px;
		text-align: center;
	}

	.action_view{
		text-align: right;
	}
	.header{
		border-bottom: 1px solid #000;
	}

	#post_header{
		margin: auto;
		padding: 10px;
	}

	.post_date{
		float:left;
		font-size: 14px;
	}
	.post_tags{
		float: left;
		font-size: 14px;
	}
	#item {
		float: right;
		padding-right: 5px;
	}
	.sidebar {
		padding-top: 96px;
		padding-left: 30px;
		width: 250px;
		float: right;
	}
	.news_contents {
		margin: auto;
		padding: 2px;
		font-size: 14px;
	}
	#news h4 {
		border-bottom: 1px solid;
		padding-bottom: 5px;
	}
	.news_img{
		margin: auto;
		padding: 4px;
	}
	.news_content {
		padding-top: 4px;
		padding-bottom: 2px;
		border-bottom: dashed 1px;
	}
</style>
<div id="wrapper">
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
						<li class="post_tags">
							<span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
							<?php foreach ($tags as $tag): ?>
								<?php if(!empty($tag['Post'][0]) && $tag['Post'][0]['id'] == $post['Post']['id']): ?>
									<?php echo $this->Html->link(__($tag['Tag']['tag']), array('controller' => "tags", 'action' => "view", $tag['Tag']['id'])); ?>
								<?php endif; ?>
							<?php  endforeach; ?>
						</li>
					</ul>

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

			<?php endforeach; ?>
		</div>

		<div class="sidebar">
			<div id="news">
				<h4><?php echo __('まとめニュース'); ?></h4>
				<?php $i = 1 ?>
				<?php foreach ($news as $new): ?>
					<div class="news_contents">
						<div class="news_img">
							<a href=<?php echo $new['url'];  ?>><img src="<?php echo $new['img']; ?>" width="140"> </a><br>
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
</div>
