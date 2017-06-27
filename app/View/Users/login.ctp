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
  h2{
    text-align: center;
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
        echo $this->Form->input('User.username', array('label' => "ユーザー名", 'type' => "username", 'class' => "form-control"));
      ?>
    </div>
    <div class="form-group">
      <?php
        echo $this->Form->input('User.password', array('label' => "パスワード", 'type' => "password", 'class' => "form-control"));
      ?>
    </div>
    <div class="form-group">
      <?php
        echo $this->Form->submit(__('サインイン'), array('class' => "btn btn-lg btn-primary btn-block"));
      ?>
    </div>
    <div class="form-group">
      <div class="text">
        <?php echo $this->Html->link(__('アカウントを作成'), array('action' => 'add')); ?><br>
        <?php echo $this->Html->link(__('twitterでログイン'), array('controller' => '', 'action' => 'auth/twitter')); ?><br>
        <?php echo $this->Html->link(__('Facebookでログイン'), array('controller' => '', 'action' => 'auth/facebook')); ?><br>
        <?php echo $this->Html->link(__('Googleでログイン'), array('controller' => '', 'action' => 'auth/google')); ?><br>
        <?php echo $this->Html->link(__('GitHubでログイン'), array('controller' => '', 'action' => 'auth/github')); ?><br>
      </div>
    </div>

  </div>
</div>
