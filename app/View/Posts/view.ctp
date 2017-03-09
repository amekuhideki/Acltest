<style type="text/css">
  /*.largeImage{
      display: none;  // 非表示
  }*/

	.back-curtain{
			background: rgba(0, 0, 0, 0.5);
			display: none;
			position: absolute;
			left: 0;
			top: 0;
	}
</style>



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
																					 	array('class' => "image", 'width' => "250")); ?></a>

							<?php echo $this->Html->image( "/files/image/attachment/"
							 															. $image["dir"] . "/" . $image["attachment"],
																					 	array('class' => "largeImage", 'width' => "800")); ?> -->
						  <div class="image">
								<a href=<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?>
									 data-lightbox="group01" data-title=""/>
									 <img src=
								<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?>
								width="256"></a>
							</div>
							<div class="back-curtain">
									<div class="largeImage">
									<img src=
									<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?>
								  class="largeImage">
								</div>
							</div>
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
<!-- <script>
var img_width;
var img_height;
var img_ratio;

// jQuery.event.add(window, "load", function() {
// 	var el = $('.largeImage img');
// 			var img = new Image();
// 			img.src = el.attr('src');
// 			img_width = img.width;
// 			img_height = img.height;
// 	img_ratio = img_height/img_width;
// });
//
// $('.image img').click(function(e) {
// 	e.preventDefault();
//
// 	disp();
// 	$('.largeImage img').fadeIn();
// });
//
// jQuery.event.add(window, "resize", function(){disp();});
//
// $('.back-curtain, .largeImage').click(function() {
// 	$('.largeImage img').fadeOut('slow', function() {$('.back-curtain').hide();});
// });
//
// function disp(){
// 	$('.back-curtain')
// 		 .css({
// 				 'width' : $(window).width(),    // ウィンドウ幅
// 				 'height': $(window).height()    // 同 高さ
// 		 })
// 		 .show();
//
//  var win_ratio = $(window).height() / $(window).width(); // ウィンドウの幅高比
//  var w;  var h;      // 幅、高さ
//  const margin=50;    // 上下左右の最低マージン
//
//  if(img_ratio > win_ratio ){      // 画像の方がウィンドウより縦長
// 		 h= $(window).height()-2*margin; // 画像の高さ　ウィンドウに合わせる
// 		 if( h < $(window).height() ) h=$(window).height()-2*margin;
// 		 w=h/img_ratio;
//  }else{                  //  ウィンドウの方が縦長
// 		 w=$(window).width()-2*margin;   // 画像幅　元の画像に合わせる
// 		 if( w < $(window).width() ) w=$(window).width()-2*margin;
// 		 h=w * img_ratio;
//  }
//
//  $('.largeImage img').css({
// 		 'position': 'absolute',
// 		 'left': ($(window).width()-w)/2+'px',
// 		 'top' : ($(window).height()-h)/2+'px',
// 		 'width' :w+'px',
// 		 'height':h+'px'
//  });
// }
// jQuery(document).ready(function() {
// 	$(".image").click(function(e){
// 		$(".back-curtain")
// 		.css({
// 			'width': $(window).width(),
// 			'height': $(window).height()
// 		})
// 		.show();
//
// 		$(".largeImage")
// 		.css({
// 			'position': 'absolute',
// 			'left': Math.floor(($(window).width() - 800) / 2) + 'px',
// 			'top': $(window).scrollTop() + 100 + 'px'
// 		})
// 		.fadeIn('slow');
// 	});
//
// 	$(".back-curtain, .largeImage").click(function(){
// 		$('.largeImage').fadeOut('slow', function() {
// 			$('.back-curtain').hide();
// 		});
// 	});
// });
// </script> -->
