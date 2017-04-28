<?php echo $this->Html->css('posts/view.css'); ?>
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
<div class="posts view">
<div class="header">
	<?php echo $this->element('header2'); ?>
</div>
<div id="content">
	<div id="title">
		<div>
			<h2 align="left"><?php echo h($post['Post']['title']); ?></h2>
		</div>
	</div>
	<div id="post_header">
		<ul id="list">
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
			<li class="post_category">
				<?php echo __('カテゴリー：');
				      echo $this->Html->link($post['Category']['category'], array('controller' => 'categories', 'action' => 'view', $post['Category']['id'])); ?>
			</li>
		</ul>
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
