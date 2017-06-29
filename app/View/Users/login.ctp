<style>
  .container {
      width: 400px;
      padding-top: 100px;
  }
  .center   {
      width: 100%;
      margin: 0 auto;
      padding: 15px;
      border: solid 1px;
  }
  .text{
    text-align: center;
  }
  .text .btn{
    margin: 5px;
    width:300px;
  }
  
  .btn:hover{
    filter:alpha(opacity=80);
    opacity:0.8;
  }
  h3{
    margin: 0 auto;
    margin-left: -15px;
    margin-right: -15px;
    padding-bottom: 10px; 
    /*border-bottom: solid 1px;*/
    text-align: center;
    margin-top: 10px;
  }
.btn-default {
  margin: auto;
  margin-bottom: 30px;
}
</style>
<div class="container">
  <div class="center">
    <div class="form-group">
      <legend><h3>ログイン/新規会員登録</h3></legend>
      <?php
      echo $this->Form->create('User', array(
          'url' => array(
              'controller' => 'users',
              'action' => 'login'
          )
      ));?>
    </div>
    <div class="form-group">
      <?php 
        echo $this->Form->input('User.email', array('label' => false, 'type' => "email", 'class' => "form-control", 'placeholder' => 'メールアドレス'));
      ?>
    </div>
    <div class="form-group">
      <?php
        echo $this->Form->input('User.password', array('label' => false, 'type' => "password", 'class' => "form-control", 'placeholder' => 'パスワード'));
      ?>
    </div>
    <div class="form-group">
      <?php
        echo $this->Form->submit(__('メールアドレスでログイン'), array('class' => "btn btn-default btn-block", 'style' => "width:200px;"));
      ?>
    </div>
    <div class="form-group">
      <div class="text">
        <?php echo $this->Html->link(__('twitterでログイン/登録'), array('controller' => '', 'action' => 'auth/twitter'), array('class' => 'btn', 'style' => "background-color:#00aced;  color:white;")); ?><br>
        <?php echo $this->Html->link(__('Facebookでログイン/登録'), array('controller' => '', 'action' => 'auth/facebook'), array('class' => 'btn', 'style' => "background-color:#305097; color:white;")); ?><br>
        <?php echo $this->Html->link(__('Googleでログイン/登録'), array('controller' => '', 'action' => 'auth/google'), array('class' => "btn", 'style' => "background-color:#db4a39; color:white;")); ?><br>
        <?php echo $this->Html->link(__('GitHubでログイン/登録'), array('controller' => '', 'action' => 'auth/github'), array('class' => "btn", 'style' => "background-color:#2c4762; color:white;")); ?><br><br>
        <?php echo (__('会員登録されていない方')); ?><br>
        <?php echo $this->Html->link(__('アカウントを作成'), array('action' => 'add'), array('class' => "btn", 'style' => "background-color:#00b389; color:white;")); ?>
      </div>
    </div>

  </div>
</div>
