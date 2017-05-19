<!-- <?php echo $this->Html->css('posts/view.css'); ?> -->
<style>
.header{
	/*border-bottom: 1px solid #000;*/
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
	margin: 0 auto;
	font-size: large;
	text-align: center;
	border-bottom: solid 1px;
	padding: 10px;
	width: 600px;
}
#modal_window ul{
	margin: 0 auto;
	width: 600px;
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

#post_header{
	margin: auto;
	padding: 1px;
	padding-top: 10px;
	padding-bottom: 10px;
	overflow: hidden;
	border-bottom: 1px dotted;
}
#list{
	margin: auto;
	padding-left: 1px;
}
.post_category{
	float: left;
	font-size: 15px;
}
.category_badge {
	padding: 3px 6px;
	margin-right: 8px;
	margin-left: 1px;
	font-size: 90%;
	border-radius: 6px;
	box-shadow: 0 0 3px #ddd;
	white-space: nowrap;
	background-color: #4169E1;
}
.post_date{
	float:left;
	font-size: 14px;
	margin-left: 10px;
}
.post_tags{
	float: left;
	font-size: 14px;
}
.post_body{
	clear: right;
	/*border-bottom: 1px dashed black;*/
	padding-bottom: 40px; /* 内容と線との間隔量 */
}
.post_body p {
	text-align: left;
}
#content{
  width: 960px;
	margin-left: 40px;
	margin-right: 40px;
	margin: 0 auto;
	margin-top: 40px;
	padding: 50px;
	border: 1px solid;
	background-color: white;
}
#title{
	padding: 20px;
	margin-bottom: 30px;
	border-bottom: 1px dotted;
	/*border-left: 10px solid #7BAEB5;
	border-bottom: 1px solid #7BAEB5;*/
}
#title h3 {
	margin: 0;
	font-weight: bold;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}
#social {
	float: right;
	height: 100px;

}
#twitter {
	float: left;
	/*height: 80px;*/
}
#facebook {
	margin-left: 20px;
	float: left;
}
#bookmark {
	margin-left: 20px;
	float: left;
}
#googleplus {
	margin-left: 20px;
	float: left;
}
#post_comment{
	clear: both;
}
#add_comment{
	margin: 0 auto;
	padding: 10px;
}
#add_comment_contain{
	margin: 0 auto;
}
.comment_header{
	text-align: left;
	border-bottom: 1px solid black;
	padding-top: 30px;
	padding-bottom: 10px;
	font-weight: 900;
}
.comment_preview{
	padding-top: 8px;
	padding-left: 10px;
	padding-bottom: 20px;
	border-bottom: 1px dashed black;
	font-size: 14px;
}
.comment_commenter{
	float: left;
}
li.previous{
	float: left;
}
li.next{
	margin-left: 20px;
	float:left;
}
#not_comment{
	padding-left: 10px;
}
#item {
	margin: auto;
	float: right;
	padding-right: 5px;
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
		  slideCurrent = $("#modal_window li a").index(this);
			$('.slideSet').stop().animate({
				left: slideCurrent * -slideWidth
			});

			$(".slider-close").on('click', function(){
				$(".slider").fadeOut();
				$("#mom_layer").fadeOut();
				var slideCurrent = 0;
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

		var comment_page = 1 ;
		if (comment_page === <?php echo $comment_page ?>){
			$(".previous").hide();
		}
		var post_id = <?php echo $post['Post']['id']; ?>;
		var comment_total_page = <?php echo $comment_total_page; ?>;
		var div;
		//コメント欄の次へを押した時の動作
		$('.next').click(function(){
			$.ajax({
				type:"POST",
				url:"http://blog.dev/AclTest/Posts/comment/",
				crossDomain: false,
				data: {'comment_page': comment_page + 1,
							 'post_id': post_id
						  },
				dataType: 'html',
				scriptCharset: 'utf-8',
			}).then(function(data){
				$(".comment_preview").remove();
				console.log(data);
				$(".comment_comment").after().html(data);
				});
				comment_page += 1;
				if(comment_page > 1){
					$('.previous').show();
				}
				if (comment_page >= comment_total_page){
					$('.next').hide();
				}
			});
			//コメント欄の前へを押した時の動作
			$('.previous').click(function(){
				$.ajax({
					type:"POST",
					url: "http://blog.dev/AclTest/Posts/comment/",
					crossDomain: false,
					data: {'comment_page': comment_page - 1,
								 'post_id': post_id
							 	},
					dataType: 'html',
					scriptCharset: 'utf-8',
				}).then(function(data){
					$(".comment_preview").remove();
					console.log(data);
					$(".comment_comment").after().html(data);
					});
					comment_page -= 1;
					if (comment_page <= 1){
						$('.previous').hide();
					}
					if(comment_page < comment_total_page){
						$('.next').show();
					}
				});
			// });
  });
</script>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.9";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>


<div class="posts view">
  <div class="header">
  	<?php echo $this->element('header2'); ?>
  </div>
  <div id="content">
		<div id="post_header">
			<ul id="list">
				<li class="post_category">
					<span class="category_badge"><?php echo $this->Html->link($post['Category']['category'],
																						 array('controller' => 'categories', 'action' => 'view', $post['Category']['id']), array('style' => 'color:white;'));
																			 ?>
		      </span>
				</li>
				<li class="post_date">
					<?php $post_date = date('Y年m月d日 H:i:s', strtotime($post['Post']['modified']));
								echo h($post_date);
					 ?>
												 &nbsp;&nbsp;
				</li>
				<li class="post_tag">
					<span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
						<?php foreach ($post['Tag'] as $tag): ?>
							<?php echo $this->Html->link(__($tag['tag']), array('controller' => 'tags', 'action' => 'view', $tag['id'])); ?>
						<?php endforeach; ?>
						&nbsp;
				</li>
			</ul>
		</div>

  	<div id="title">
  		<div>
  			<h3><?php echo h($post['Post']['title']); ?></h3>
  		</div>
  	</div>

		<div id="social">
			<div id="twitter">
				<a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja" data-count="vertical">ツイート</a>
			  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			</div>
			<div id="facebook">
				<div id="fb-root"></div>
				<div class="fb-like" data-href="http://blog.dev/AclTest/posts" data-layout="box_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
			</div>
			<div id="bookmark">
				<a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="vertical-normal" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a>
				<script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
			</div>
			<div id="googleplus">
				<div class="g-plus" data-action="share" data-annotation="vertical-bubble" data-height="60" data-href="http://blog.dev/AclTest/posts"></div>
			</div>
		</div>

  	<div class="post_body">
  		<?php echo ($post['Post']['body']); ?>
  		&nbsp;
  	</div>

  	<div id="item">
  		<?php if ($user['id'] === $post['User']['id']): ?>
  			<?php echo $this->Html->link(__('編集'), array('action' => 'edit', $post['Post']['id'])); ?>
  			・
  			<?php echo $this->Html->link(__('削除'), array('action' => 'delete', $post['Post']['id']),
  																							 array('confirm' => '本当にこの記事を削除しますか？')); ?>
  		<?php endif; ?>
  	</div>

  	<div class="post_image">
  		<div class="image">
  			<?php if(!empty($post['Image'])): ?>
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
  			<?php endif; ?>
  		</div>
  	</div>

  	<div id="post_comment">
  		<h4 class='comment_header'><?php echo __('コメント'); ?></h4>
  		<div class="comment">
  			<div class="comment_comment">
  				<?php if (isset($comments[0])): ?>
  					<?php foreach($comments as $comment): ?>
  						<div class="comment_preview">
  							<div class="comment_commenter">
  								<?php echo $comment['Comment']['commenter']; ?>&nbsp;&nbsp;
  							</div>
  							<div class="comment_created">
  								<?php echo $comment['Comment']['created']; ?><br>
  							</div>
  							<div class="comment_body">
  								<?php echo $comment['Comment']['body']; ?><br>
  							</div>
  							<?php if ($user['id'] === $comment['Comment']['user_id']): ?>
  								<?php echo $this->Html->link(__('編集'), array('controller' => 'comments', 'action' => 'edit', $comment['Comment']['id'])) ?>
  								・
  								<?php echo $this->Html->link(__('削除'), array('controller' => 'comments', 'action' => 'delete', $comment['Comment']['id']),
  																												array('confirm' => __('Are you sure you want to delete'))); ?>
  							<?php endif; ?>
  						</div>
  					<?php endforeach; ?>
  				<?php else: ?>
  			</div>
  			&nbsp;&nbsp;
  			<div id="not_comment">
  				<?php echo __('コメントはまだありません。'); ?>
  			</div>
  			<?php endif; ?>
  		</div>
  		<div class="comment_pagination">
  			<ul class="pagination">
  				<li class="previous"><a>前のページ</a></li>&nbsp;
  				<?php if (($comment_page * 10) < $comment_total): ?>
  				<li class="next"><a>次のページ</a></li>
  				<?php endif; ?>
  			</ul>
  		</div>

  		<div id='add_comment'>
  			<div class="add_comment_contain">
  				<h4>コメントを書く</h4>
  				<?php if (!isset($user['id'])): ?>
  					<?php $user['id'] = -1; ?>
  				<?php endif;?>
  				<?php
  				echo $this->Form->create('Comment', array('url' => array(
  																							'controller' => 'comments', 'action' => 'add'),
  																							));
  				echo $this->Form->input('commenter', array('label' => '名前'));
  				echo $this->Form->input('body', array('label' => '本文', 'row'=>3));
  				echo $this->Form->input('Comment.post_id', array('type'=>'hidden', 'value'=>$post['Post']['id']));
  				echo $this->Form->input('status', array('type' => 'hidden', 'value' => 0));
  				echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $user['id']));
  				echo $this->Form->end('投稿する');
  				?>
  			</div>
  		</div>

  		<p><?php echo $this->Html->link(__('記事一覧に戻る'), array('action' => "index")); ?></p>
  	</div>
  </div>
</div>
<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'ja'}
</script>
