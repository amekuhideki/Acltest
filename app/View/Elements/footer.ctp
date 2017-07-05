<?php echo $this->Html->css('common.css'); ?>
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
  <button type="button">
  <img src="/AclTest/images/shesha.png" style="width:50px;"><br>
  <font size="2">ページトップへ</font>
  </button>
</div>