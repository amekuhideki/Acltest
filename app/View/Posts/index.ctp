<style>
#contents{
	width: 700px;
	margin: 0 auto;
	float: left;
}

#content_details{
	/*margin: 100px;*/
	padding-top: 50px;
  border-bottom: 1px solid;
}

.post_title{
	margin: 20px;
	font-size: 30px;
	text-align: left;
	/*padding-left: 10px;*/
	padding: 10px;
	border-left: 10px solid #7BAEB5;
	border-bottom: 1px solid #7BAEB5;

	width: 680px;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}

.post_body{
	width: 480px;
	margin-top: 50px;
	padding: 26px;
	font-size: 18px;
	float: right;
	text-align: left;

	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
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
	padding-left: 10px;
}
.post_category{
	float: left;
	padding-left: 10px;
	/*padding-right: 20px;*/
  font-size: 16px;
}
.badge_category {
  padding: 3px 6px;
  margin-right: 8px;
  margin-left: 1px;
  font-size: 90%;
  color: #FFFFFF;
  border-radius: 6px;
  box-shadow: 0 0 3px #ddd;
  white-space: nowrap;
  background-color: #4169E1;/*青色*/
}

.post_tags{
	float: right;
	font-size: 14px;
	width: 535px;
}
.image_body{
	clear: both;
}
.post_image{
	width: 180px;
	float: left;
	padding: 10px;
	margin-top: 50px;
}

.contents_footer{
	margin: auto;
	padding: auto;
	clear: both;
	width: 700px;
	text-align: right;
}
#item {
	padding-right: 5px;
}
.sidebar {
	padding-top: 96px;
	padding-left: 30px;
	width: 250px;
	float: right;
}
#calender {
	font-size: 12px;
}
/*.fixBox {
	position: fixed;
	top: 0px;
	right: 0px;
}*/
.news_contents {
	margin: auto;
	padding-top: 10px;
	font-size: 14px;
}
#news h4 {
	border-bottom: 1px solid;
	padding-bottom: 5px;
}
.news_img{
	margin: auto;
}
.news_content {
	padding-top: 4px;
	padding-bottom: 2px;
	border-bottom: dashed 1px;
}
.paginate{
	text-align: right;
}

</style>
<script>
$(window).load(function () {

      //該当のセレクタなどを代入
	var mainArea = $("#contents"); //メインコンテンツ
	var sideWrap = $(".wrapper_sidebar"); //サイドバーの外枠
	var sideArea = $(".sidebar"); //サイドバー
  /*設定ここまで*/
  var wd = $(window); //ウィンドウ自体
  //メインとサイドの高さを比べる
  var mainH = mainArea.height();
  var sideH = sideArea.height();

  if(sideH < mainH) { //メインの方が高ければ色々処理する
	  //サイドバーの外枠をメインと同じ高さにしてrelaltiveに（#sideをポジションで上や下に固定するため）
	  sideWrap.css({"height": mainH, "position": "relative", "float": "right", 'width': '250px'});

	  //サイドバーがウィンドウよりいくらはみ出してるか
	  var sideOver = wd.height()-sideArea.height();

	  //固定を開始する位置 = サイドバーの座標＋はみ出す距離
	  var starPoint = sideArea.offset().top + (-sideOver);

	  //固定を解除する位置 = メインコンテンツの終点
	  var breakPoint = sideArea.offset().top + mainH;

	  wd.scroll(function() { //スクロール中の処理
	    if(wd.height() < sideArea.height()){ //サイドメニューが画面より大きい場合
	      if(starPoint < wd.scrollTop() && wd.scrollTop() + wd.height() < breakPoint){ //固定範囲内
	            sideArea.css({"position": "fixed", "bottom": "20px", "width": '250px', "float": 'right'});

	      }else if(wd.scrollTop() + wd.height() >= breakPoint){ //固定解除位置を超えた時
	            sideArea.css({"position": "absolute", "bottom": "0"});

	      } else { //その他、上に戻った時
	            sideArea.css("position", "static");

	      }

	    }else{ //サイドメニューが画面より小さい場合
	      var sideBtm = wd.scrollTop() + sideArea.height(); //サイドメニューの終点
	      if(mainArea.offset().top < wd.scrollTop() && sideBtm < breakPoint){ //固定範囲内
	              sideArea.css({"position": "fixed", "top": "0px", });
	      }else if(sideBtm >= breakPoint){ //固定解除位置を超えた時
	                //サイドバー固定場所（bottom指定すると不具合が出るのでtopからの固定位置を算出する）
		      var fixedSide = mainH - sideH;
		      sideArea.css({"position": "absolute", "top": fixedSide});
	      } else {
	        sideArea.css("position", "static");
	      }
	    }
		});
	};
	//datepicker
	$(function(){
    $("#calender").datepicker({
			onSelect: function(dateText, inst) {
				$("#date_val").val(dateText);
			}
		});
	});
});
</script>
<div class="posts index">
	<div class="header">
		<?php echo $this->element('header2'); ?>
	</div>
	<div class="main">
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
              <span class="badge_category">
  							<?php echo ($post['Category']['category']) ?>
              </span>
						</li>
						<!-- <li class="post_tags">
							<span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
							<?php foreach ($tags as $tag): ?>
								<?php if(!empty($tag['Post'][0]) && $tag['Post'][0]['id'] == $post['Post']['id']): ?>
									<?php echo $this->Html->link(__($tag['Tag']['tag']), array('controller' => "tags", 'action' => "view", $tag['Tag']['id'])); ?>
								<?php endif; ?>
							<?php  endforeach; ?>
						</li> -->
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

		<div class="wrapper_sidebar">
			<div class="sidebar">

				<div id="calender">
					<?php echo $this->Form->create('Post'); ?>
					<h4 style="text-align:left;"><?php echo __('カレンダー'); ?></h4>
						<input type=”text” name=”demo” id="date_val">
					<?php echo $this->Form->end(); ?>
				</div>

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
	</div>
</div>
