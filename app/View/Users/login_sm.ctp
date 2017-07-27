<?php echo $this->Html->css('common.css'); ?>
<div clas="container">
  <div class="content_sm">
    <?php echo $this->Form->create('User', array(
      'url' => array(
        'controller' => 'users',
        'action' => 'login'
      )
    )); ?>
    <form class="form-sign">
      <h2 class="form-signin-heading">AMEブログ！！</h2>
      <div class="form-group">
        <legend><h4>ログイン/新規会員登録</h4></legend>
  
      </div>
      <label for="inputEmail" class="sr-only">Email address</label>
        <?php 
          echo $this->Form->input('User.email', array('label' => false, 'type' => "email", 'class' => "form-control", 'placeholder' => 'メールアドレス'));
        ?>
      <label for="inputPassword" class="sr-only">Password</label>
        <?php
          echo $this->Form->input('User.password', array('label' => false, 'type' => "password", 'class' => "form-control", 'placeholder' => 'パスワード'));
        ?>
      <div class="checkbox">
        <label>
          <input type="checkbox" value="remember-me">Remember me
        </label>
      </div>
      <label class="sr-only">Sign In</label>
        <?php
          echo $this->Form->submit(__('メールアドレスでログイン'), array('class' => "btn btn-lg btn-default btn-block"));
        ?>
    </form>
    <div class="form-group">
      <div class="sns_login">
        <label class="sr-only">Twitterでログイン/登録</label>
        <?php echo $this->Html->link(__('twitterでログイン/登録'), array('controller' => '', 'action' => 'auth/twitter'), array('class' => 'btn btn-lg btn-block', 'style' => "background-color:#00aced;  color:white;")); ?><br>
        
        <label class="sr-only">Facebookでログイン/登録</label>
        <?php echo $this->Html->link(__('Facebookでログイン/登録'), array('controller' => '', 'action' => 'auth/facebook'), array('class' => 'btn btn-lg btn-block', 'style' => "background-color:#305097; color:white;")); ?><br>
        
        <label class="sr-only">Googleでログイン/登録</label>
        <?php echo $this->Html->link(__('Googleでログイン/登録'), array('controller' => '', 'action' => 'auth/google'), array('class' => "btn btn-lg btn-block", 'style' => "background-color:#db4a39; color:white;")); ?><br>
        
        <label class="sr-only">GitHubでログイン/登録</label>
        <?php echo $this->Html->link(__('GitHubでログイン/登録'), array('controller' => '', 'action' => 'auth/github'), array('class' => "btn btn-lg btn-block", 'style' => "background-color:#2c4762; color:white;")); ?><br><br>
        <label>
          <?php echo (__('会員登録されていない方')); ?><br>
        </label>
        <label class="sr-only">アカウントを作成</label>
        <?php echo $this->Html->link(__('アカウントを作成'), array('action' => 'add'), array('class' => "btn btn-lg btn-block", 'style' => "background-color:#00b389; color:white;")); ?>
      </div>
    </div>
  </div>
</div>