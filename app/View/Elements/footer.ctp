<style>

.footer{
  width: 100%;
  clear: both;
  max-width: 960px;
  /*height: 10px;*/
  margin: 0 auto;
  padding-top: 100px;
}

p{
  text-align: center;
}

.page-top {
  position: fixed;
  right: 10px;
  bottom: 10px;
  z-index: 99;
}

</style>
<script>
$(function(){
  /*Top-pageボタン制御*/
  var topBtn = $('.page-top');
  topBtn.hide();
  //スクロールが100に達したらボタン表示
  $(window).scroll(function(){
    if($(this).scrollTop() > 100){
      topBtn.fadeIn();
    } else {
      topBtn.fadeOut();
    }
  });
  //スクロールしてトップ
  topBtn.click(function(){
    $('body,html').animate({
      scrollTop: 0
    }, 500);
    return false;
  });
});
</script>
<div class="push"></div>
<div id="wrapper_footer">
  <div class="footer">
    <p>Copyright © 2017 Hideki Ameku All Right Reserved.</p>
  </div>
</div>

<div class="page-top">
  <a>ページトップへ</a>
</div>