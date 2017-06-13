<style>
.main {
	width: 960px;
	margin-left: 40px;
	margin-right: 40px;
	margin: 0 auto;
}

#contents{
	/*width: 700px;*/
	width: 650px;
	margin: 0 auto;
	margin-top: 40px;
	float: left;
}
#contents_title {
	width:650px;
	margin: 0;
	padding: 0;
	height: 70px;
	padding-top: 20px;
	border-bottom: 2px dotted;
	padding-bottom: 10px;

}
#contents_img {
	float: left;
}
#list {
	float: left;
}
#contents_title h3 {
	padding-top: 8px;
	margin: 0;
	float:left;
	/*border-bottom: 2px dotted ;*/
}
#content_details{
	clear: left;
	/*margin: 100px;*/
	margin-top: 50px;
  border: 1px solid Silver;
	background-color: white;
	height: 200px;
}
.image {
	float: left;
	margin: 0 auto;
	margin: 10px;
}
.post_contents {
	float: left;
}
.post_image{
	width: 180px;
	float: left;
	padding: 10px;
	margin-top: 5px;
}

.header{
	margin: 0 auto;
}

.post_header{
	margin: 0;
	height: 60px;
	padding: 0;
	padding-top: 20px;
	/*padding-bottom: 10px;*/
	border-bottom: 1px dotted;
}
.post_category{
	float: left;
  font-size: 16px;
}
.post_date{
	float:left;
	font-size: 14px;
	padding-left: 10px;
}
.post_writer {
	float: right;
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
.post_title{
	clear: both;
	padding: 10px;
	font-size: 16px;
	font-weight: bold;
	text-align: left;
	border-bottom: 1px dotted;
	width: 440px;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}
.post_body{
	/*width: 450px;*/
	width: 440px;
	padding: 10px;
	font-size: 14px;
	text-align: left;

	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}


.contents_footer{
	margin: auto;
	padding: auto;
	clear: both;
	/*width: 700px;*/
	width: 440px;
	text-align: right;
}
#item {
	padding-right: 5px;
}
.sidebar {
	padding-top: 	50px;
	padding-left: 30px;
	padding-right: 10px;
	width: 300px;
	float: right;
}
#calender {
	font-size: 14px;
}
#calender_header {
	margin-bottom: 10px;
	height: 40px;
	padding-bottom: 1px;
	border-bottom: 1px solid;

}
#calender_icon {
	float: left;
	/*padding-bottom: 4px;*/
}
#calender_title {
	float: left;
	margin: 0;
	margin-bottom: 10px;
}
#calender h4 {
	width: 200px;
	margin: 0;
	margin-top: 5px;
}
#news_header {
	margin-top: 20px;
	margin-bottom: 10px;
	height: 40px;
	padding-bottom: 1px;
	border-bottom: 1px solid;
}
#news_icon {
	float: left;
}
#news_title {
	float: left;
	margin: 0;
	margin-bottom: 10px;
}
#news h4 {
	width: 200px;
	margin: 0;
	margin-top: 5px;
	/*border-bottom: 1px solid;
	padding-bottom: 5px;*/
}
.news_contents {
	clear: left;
	margin: auto;
	padding-top: 10px;
	font-size: 14px;
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
	var sideCale = $("#calender");
	// console.log(sideCale.height());
  /*設定ここまで*/
  var wd = $(window); //ウィンドウ自体
  //メインとサイドの高さを比べる
  var mainH = mainArea.height();
  var sideH = sideArea.outerHeight(true) + sideCale.outerHeight(true);
	console.log(sideArea.offset().top);
  if(sideH < mainH) { //メインの方が高ければ色々処理する
	  //サイドバーの外枠をメインと同じ高さにしてrelaltiveに（#sideをポジションで上や下に固定するため）
	  sideWrap.css({"height": mainH, "position": "relative", "float": "right", 'width': '300px'});

	  //サイドバーがウィンドウよりいくらはみ出してるか
	  var sideOver = wd.height()-(sideArea.outerHeight(true) + sideCale.outerHeight(true) + sideCale.innerHeight());

	  //固定を開始する位置 = サイドバーの座標＋はみ出す距離
	  var starPoint = sideArea.offset().top + (-sideOver);

	  //固定を解除する位置 = メインコンテンツの終点
	  var breakPoint = sideArea.offset().top + mainH;

	  wd.scroll(function() { //スクロール中の処理
	    if(wd.height() < sideArea.outerHeight(true) + sideCale.outerHeight(true)){ //サイドメニューが画面より大きい場合
	      if(starPoint < wd.scrollTop() && wd.scrollTop() + wd.height() < breakPoint){ //固定範囲内
	            sideArea.css({"position": "fixed", "bottom": "20px", "width": '300px', "float": 'right'});

	      }else if(wd.scrollTop() + wd.height() >= breakPoint){ //固定解除位置を超えた時
	            sideArea.css({"position": "absolute", "bottom": "0"});

	      } else { //その他、上に戻った時
	            sideArea.css("position", "static");

	      }

	    }else{ //サイドメニューが画面より小さい場合
	      var sideBtm = wd.scrollTop() + sideArea.outerHeight(true) + sideCale.outerHeight(true); //サイドメニューの終点
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
	// datepicker
	$(document).ready(function(){
			$.ajax({
				type: 'post',
				url: "http://blog.dev/AclTest/posts/getdate/",
				clossDomain: false,
				dataType: "json",
				scriptCharset: "utf-8",
			}).then(function(data){
				console.log('成功');
			});
	});

		var $date = new Date();
		// console.log($date.getMonth());
    $("#calender").datepicker({
			onSelect: function(dateText, inst) {
				$("#date_val").val(dateText);
			},
			maxDate: $date,
		});
// 		$( "#calender" ).datepicker('option','beforeShowDay',function(date){
//     var ret = [(date.getDay() != 1 && date.getDay() != 6)];
// 		var month = date.getMonth() + 1;
// 		console.log(date);
//     return ret;
// });
});
</script>
<div class="posts index">
	<div class="header">
		<?php echo $this->element('header2'); ?>
	</div>
	<div class="main">
			<div id="contents">
				<div id="contents_title">

						<div id="contents_img">
							<?php echo $this->Html->image('/images/shisa.png', array('width' => '50')); ?>
						</div>
						<div id="list">
							<h3>記事一覧</h3>
						</div>

				</div>
			<?php foreach ($posts as $post): ?>
				<div id="content_details">
					<div class="image">
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
					</div>
					<div class="post_contents">
						<ul class="post_header">
							<li class="post_category">
								<span class="badge_category">
									<?php echo ($post['Category']['category']) ?>
								</span>
							</li>
							<li class="post_date">
								<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
								<?php $post_date = date('Y年m月d日', strtotime($post['Post']['modified']));
											echo h($post_date);
								 ?>
								 &nbsp;&nbsp;
							</li>
							<li class="post_writer">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
								<?php if (isset($post['User']['username'])): ?>
									<?php echo __($post['User']['username']); ?>
								<?php else: ?>
									<?php echo __('未登録者'); ?>
								<?php endif; ?>
								&nbsp;&nbsp;
							</li>
						</ul>

						<div class="post_title">
							<?php echo h($post['Post']['title']); ?><br>
						</div>

						<div class="post_body">
							<?php
								$body = strip_tags($post['Post']['body']);
								$limit_body = mb_substr($body, 0, 100, 'utf-8');
								if (mb_strlen($body, 'utf-8') > '100'){
									$limit_body = $limit_body . '...';
								}
							 echo ($limit_body); ?>
						 </div>

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
					<div id="calender_header">
						<div id="calender_icon">
							<img src="/AclTest/images/sidebar_img.png", width="30">
						</div>
						<div id="calender_title">
							<h4 style="text-align:left;"><?php echo __('カレンダー'); ?></h4>
						</div>
					</div>
							<input type=”text” name=”demo” id="date_val">
				</div>

				<div id="news">
					<div id="news_header">
						<div id="news_icon">
							<img src="/AclTest/images/sidebar_img.png", width="30">
						</div>
						<div id="news_title">
							<h4><?php echo __('まとめニュース'); ?></h4>
						</div>
					</div>
					<?php $i = 1 ?>
					<?php foreach ($news as $new): ?>
						<div class="news_contents">
							<div class="news_img">
								<a href=<?php echo $new['url'];  ?>><img src="<?php echo $new['img']; ?>" width="260"> </a><br>
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
