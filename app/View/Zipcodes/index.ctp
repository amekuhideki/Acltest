<script type="text/javascript">
$(document).ready(function(){

    $('.number').on('keydown', function(e) {
      var k = e.keyCode;
      if(!((k >= 48 && k <= 57) || (k >=96 && k <= 105) ||
            k == 32 || k == 8 || k == 46 || k == 39 || k == 37 | k == 9)){
        return false;
      }
    });
    $("#lookup").click(function(){
      if($('#select_address').size()){
        $('#select_address').remove();
      }
      if($('#address').size()){
        $('#address').val('');
      }
        var zip1 = $.trim($('#zip1').val());
        var zip2 = $.trim($('#zip2').val());
        var zipcode = zip1 + zip2;
        if ($('#zip1').val() == '' || $('#zip2').val() == '') {
          alert('郵便番号を入力してください');
          return false;
        }
        $.ajax({
            type: "post",
            url: "http://blog.dev/AclTest/Zipcodes/getdata/",
            data: {'zipcode' : zipcode},
            crossDomain: false,
            dataType : "json",
            scriptCharset: 'utf-8'
        }).then(function(data){
          // console.log($.isArray(data[1]));
          if($.isArray(data[1])){
            var select = '<select name="select_address" id="select_address" height="20px">';
            select += '<option>以下から選択してください</option>'
            var address = '';
            $(data).each(function(index, val){
              // $('#address').remove();
              address = data[index][0] + data[index][1] + data[index][2];
              // console.log(address);
              select += '<option value="'+address+'">'+address+'</option>';
              // $('#address').val(data[index][0] + data[index][1] + data[index][2]);
            })
            select += '</select>';
            // console.log(select);
            $('.address_name').prepend(select);
            $('#select_address').change(function(){
              if($('#select_address').val() === '以下から選択してください'){
                $('#address').val('');
              } else {
                var new_address = $('#select_address').val();
                $('#address').val(new_address);
                $('#select_address').remove();
              }
            });

          } else {
            if(data[0][0] == ""){
                alert('見つかりませんでした。');
            } else {
                $('#address').val(data[0][0] + data[0][1] + data[0][2]);
            }
          }
          });

     });
     //郵便番号の結合
    //  $('#zip1' && '#zip2').change(function(){
    //    var zip1 = $.trim($('#zip1').val());
    //    var zip2 = $.trim($('#zip2').val());
    //    var zipcode = zip1 + zip2;
    //   //  console.log(zipcode)
    //    $('<input>').attr({
    //      type: 'hidden',
    //      name: 'post_code',
    //      value: zipcode
    //    }).appendTo('.zipcode');
    //  });
     //パスワード表示・非表示
     $('#masking').click(function(){
       var pass = $('#password').val();
       var type = $('#password').attr('type');
       var masking_child = $('#masking span');
       if (type == 'password') {
         type = 'text';
         masking_child.replaceWith('<span class="btn glyphicon glyphicon-eye-close"></span>')
         $('input[type=submit]').attr('disabled','disabled');
       } else {
         type = 'password';
         masking_child.replaceWith('<span class="btn glyphicon glyphicon-eye-open"></span>')
         $('input[type=submit]').removeAttr('disabled');
       }
       var input = '<input type=\"' + type + '\"id=\"password\">';
       $('#password').replaceWith(input);
       $("#password").attr({
         name: 'password',
         value: pass,
       });
  });

  $('#form').submit(function(){
      var zip1 = $('#zip1').val();
      var zip2 = $('#zip2').val();
      var zip1zip2 = zip1 + zip2;
      $('#zip1zip2').val(zip1zip2);
  });

});
</script>
<style>
  .center {
    text-align: center;
  }
</style>
<?php echo $this->element('header'); ?>

<form id="form" class="form-horizontal" action="Zipcodes/add" method="post">
  <div class="form-group">
    <div class="col-sm-12 center">
      <h1>ユーザ情報の入力</h1>
    </div>
  </div>
  <div class="form-group">
    <label for="name" class="col-sm-5 control-label">名前:</label>
    <div class="col-sm-7">
      <input type="text" name="name" size="20" placeholder="田中 太郎" required>
    </div>
  </div>
  <div class="form-group">
    <label for="kananame" class="col-sm-5 control-label">フリガナ:</label>
    <div class="col-sm-7">
      <input type="text" name="kananame" size="20" placeholder="タナカ タロウ" required>
    </div>
  </div>
  <div class="form-group">
    <label for="age" class="col-sm-5 control-label">年齢:</label>
    <div class="col-sm-7">
      <input type="number" class="number" name="age" max="100" min="10" required>歳
    </div>
  </div>
  <div class="form-group">
    <label for="gender" class="col-sm-5 control-label">性別:</label>
    <div class="col-sm-7">
      <input type="radio" name="gender" value="0" checked required>男性
      <input type="radio" name="gender" value="1" required>女性
    </div>
  </div>
  <div class="form-group">
    <label for="mail" class="col-sm-5 control-label">メールアドレス:</label>
    <div class="col-sm-7">
      <input type="email" name="mail" placeholder="123456789@xxx.co.jp" required>
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-5 control-label">パスワード:</label>
    <div class="col-sm-7">
      <input type="password" id="password" name="password" placeholder="******" required>
      <a class="button" id="masking"><span class="btn glyphicon glyphicon-eye-open"></span></a>
    </div>
  </div>
  <div class='form-group'>
    <label for="post_code" class="col-sm-5 control-label">郵便番号:</label>
    <div class="col-sm-7 zipcode">
      <input type="text" name="zip1" id="zip1" class="number" size="3" maxlength="3" placeholder="123" required>-
      <input type="text" name="zip2" id="zip2" class="number" size="4" maxlength="4" placeholder="4567" required>
      <input type="hidden" name="post_code" id="zip1zip2" value="zip1zip2"/>
      <input type="button" id="lookup" value="住所検索">
    </div>
  </div>
  <div class="form-group">
    <label for="address" class="col-sm-5 control-label">住所:</label>
    <div class="col-sm-7 address_name">
      <input size="50" type="text" name="address" id="address" required>
    </div>
  </div>
  <div class="form-group">
    <label for="mail_delivery" class="col-sm-5 control-label">メール配信:</label>
    <div class="col-sm-7">
      <input type="checkbox" name="mail_delivery" value="1" checked>配信を希望する
    </div>
  </div>
  <div class="col-sm-5"></div>
  <div class="col-sm-7">
    <input type="submit" class="btn btn-primary" id='submit' value="ユーザ情報を登録">
  </div>
</form>
