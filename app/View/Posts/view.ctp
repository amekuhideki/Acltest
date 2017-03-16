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
	z-index: 1;
}
#kids_layer{
	display: none;
	position: fixed;
	top: 50%;
	left: 50%;
	margin-top: -240px;
	margin-left: -320px;
	z-index: 2;
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
.slide {
	margin: 100px;
  width: 400px;
  height: 400px;
  /*border: 10px solid black;*/
  float: left;
	pointer-events: none;
}
.slider {
	margin-top: 100px;
	margin-left: 200px;
  width: 600px;
  height: 600px;
  overflow: hidden;
  position: absolute;
	display: none;
	z-index: 2;

}
.slideSet {
  position: absolute;
}
.slider-next{
	top: 300px;
	right: 60px;
	position: absolute;
	z-index: 3;
}
.slider-prev{
	top: 300px;
	left: 60px;
	position: absolute;
	z-index: 3;
}
.slider-close{
	top: 100px;
	right: 70px;
	position: absolute;
	z-index: 3;
}

</style>
<script>
$(function(){
    $("body").append("<div id='mom_layer'></div><div class='slider'></div>");
    $("#mom_layer").on('click', function(){
      $(this).fadeOut();
      $(".slider").fadeOut();
　  });
    $("a.modal_picture").on('click',function(){
      $("#mom_layer").fadeIn();
			$(".slider").fadeIn();
			var slideCurrent = $("#modal_window li a").index(this);
			console.log(slideCurrent);
			$('.slideSet').stop().animate({
				left: slideCurrent * -slideWidth
			});
			// $(".slider").append("<button class='slider-prev'>前へ</button><button class='slider-next'>次へ</button>")
      // $("#kids_layer").fadeIn().html("<img src='../../images/close.png' class='close'/>"+
			// 														 "<img src='"+$(this).attr("href")+"' width='400'>");


			$(".slider-close").on('click', function(){
				$(".slider").fadeOut();
				$("#mom_layer").fadeOut();
			});
      return false;
    });
		var slideWidth = $('.slide').outerWidth()+200;
		var slideNum = $('.slide').length;
		var slideSetWidth = slideWidth * slideNum;
		$('.slideSet').css('width', slideSetWidth);
		var slideCurrent = '';
		var sliding = function(){
			if (slideCurrent < 0 ){
				slideCurrent = slideNum - 1;
			} else if (slideCurrent > slideNum - 1){
					slideCurrent = 0;
				}
			$('.slideSet').stop().animate({
				left: slideCurrent * -slideWidth
			});
		}
		$('.slider-prev').click(function(){
			slideCurrent--;
			sliding();
		})
		$('.slider-next').click(function(){
			slideCurrent++;
			sliding();
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
					<?php $i = 0; ?>
					<?php foreach ($post['Image'] as $image): ?>
					  <li><a href=<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?> class="modal_picture" img_group=<?php echo $i; $i++?>>
						<img src=<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?>
								 width="250" class="picture"></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</tr>
		<?php endif; ?>

		<?php if(!empty($post['Image'])): ?>
			<div class="slider">
				<div>
				<div class="slideSet">
					<?php foreach ($post['Image'] as $image): ?>
						<div class="slide">
							<a href=<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?>>
							<img src=<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?>
								 width="400"></a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<p class="slider-close"><img src="../../images/close.png" ></p>
			<p class="slider-prev"><img src="../../images/prev.png" width="20" height="100"></p>
			<p class="slider-next"><img src="../../images/next.png" width="20" height="100"></p>
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
