//index
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

