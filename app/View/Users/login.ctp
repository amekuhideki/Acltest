<style>
  .container {
      width: 300px;
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
  }
  h2{
    text-align: center;
  }
.btn-default {
  margin: auto;
  margin-bottom: 30px;
}
</style>
<div class="container">
  <div class="center">
    <div class="form-group">
      <h2>サインイン</h2>
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
        echo $this->Form->input('User.email', array('label' => "メールアドレス", 'type' => "email", 'class' => "form-control"));
      ?>
    </div>
    <div class="form-group">
      <?php
        echo $this->Form->input('User.password', array('label' => "パスワード", 'type' => "password", 'class' => "form-control"));
      ?>
    </div>
    <div class="form-group">
      <?php
        echo $this->Form->submit(__('メールアドレスでログイン'), array('class' => "btn btn-default btn-block", 'style' => "width:200px;"));
      ?>
    </div>
    <div class="form-group">
      <div class="text">
        <?php echo $this->Html->link(__('twitterでログイン/登録'), array('controller' => '', 'action' => 'auth/twitter'), array('class' => 'btn', 'style' => "width:200px; background-color:#00aced;  color:white;")); ?><br>
        <?php echo $this->Html->link(__('Facebookでログイン/登録'), array('controller' => '', 'action' => 'auth/facebook'), array('class' => 'btn', 'style' => "width:200px; background-color:#305097; color:white;")); ?><br>
        <?php echo $this->Html->link(__('Googleでログイン/登録'), array('controller' => '', 'action' => 'auth/google'), array('class' => "btn", 'style' => "width:200px; background-color:#db4a39; color:white;")); ?><br>
        <?php echo $this->Html->link(__('GitHubでログイン/登録'), array('controller' => '', 'action' => 'auth/github'), array('class' => "btn", 'style' => "width:200px; background-color:#2c4762; color:white;")); ?><br>
        <?php echo (__('会員登録されていない方')); ?>
        <?php echo $this->Html->link(__('アカウントを作成'), array('action' => 'add'), array('class' => "btn", 'style' => "width:200px; background-color:#00b389; color:white;")); ?>
      </div>
    </div>

  </div>
</div>
