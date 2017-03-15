<style>
html, body{
	margin: 0;　　　　　　　
	padding: 0;　　　　　　
	height: 100%;　　　　　
}
#mom_layer{
	display: none;
	position: fixed;
	top: 0;
	left: 0;
	height: 100%;
	width: 100%;
	background: black;
	opacity: 0.60;
}
#kids_layer{
	display: none;
	position: fixed;
	top: 50%;
	left: 50%;
	margin-top: -240px;
	margin-left: -320px;
}
#modal_window h4{
	margin: 20px 50px;
	font-size: large;
	border-left: 10px solid #7BAEB5;
	border-bottom: 1px solid #7BAEB5;
	padding: 10px;
	width: 600px;
}
#modal_window ul{
	width: 700px;
	list-style-type: none;
}
#modal_window ul li{
	float: left;
}
#modal_window ul li img{
  border: 0;
  margin: 10px;
}

</style>
<script>
$(function(){
    $("body").append("<div id='mom_layer'></div><div id='kids_layer'></div>");
    $("#mom_layer").click(function(){
      $(this).fadeOut();
      $("#kids_layer").fadeOut();
　  });
    $("a.modal_picture").click(function(){
      $("#mom_layer").fadeIn();
      $("#kids_layer").fadeIn().html("<img src='../../images/close.png' class='close'/>"+
																	 "<img src='"+$(this).attr("href")+"' width='400'>");
			$("#kids_layer img.close").click(function(){
				$("#kids_layer").fadeOut();
				$("#mom_layer").fadeOut();
			});
      return false;
    });
  });
</script>
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
			<div id="modal_window">
				<h4><?php echo __('画像一覧'); ?></h4>
				<ul>
					<?php foreach ($post['Image'] as $image): ?>
					  <li><a href=<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?> class="modal_picture">
						<img src=<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?>
								 width="250"></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
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
