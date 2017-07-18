<?php echo $this->Html->css('common.css'); ?>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>

<div class="users form">
  <div class="">
    <div class="content_sm">
      <h2>AMEブログ！！</h2>
      <?php echo $this->Form->create('User'); ?>
      <fieldset>
        <div class="form-group">
          <legend><h4><?php echo __('アカウント作成'); ?></h4></legend>
        </div>
        <div class="form-group">
          <?php if (isset($this->Session->read()['sns_auth']['username'])): ?>
            <?php echo $this->Form->input('username', array('label' => "アカウント名", 'class' => "form-control", 'value' => $this->Session->read()['sns_auth']['username'])); ?>
          <?php else: ?>
            <?php
              echo $this->Form->input('username', array('label' => "アカウント名", 'class' => "form-control"));
            ?>
          <?php endif; ?>
        </div>
        <div>
          <?php if (isset($this->Session->read()['sns_auth']['email'])): ?>
            <?php echo $this->Form->input('email', array('label' => "メールアドレス", 'class' => "form-control", 'value' => $this->Session->read()['sns_auth']['email'])); ?>
          <?php else: ?>
            <?php 
              echo $this->Form->input('email', array('label' => "メールアドレス", 'class' => "form-control"));
            ?>
        <?php endif; ?>
        </div>
        <div class="form-group">
          <?php
            echo $this->Form->input('password', array('label' => "パスワード", 'class' => "form-control"));
          ?>
        </div>
        <div>
          <?php 
            echo $this->Form->input('password_confirm', array('label' => "パスワード(確認)", 'type' => 'password', 'class' => "form-control")); ?>
        </div>
        <div class="form-group">
          <?php
            echo $this->Form->input('group_id', array('type' => 'hidden', 'label' => "権限", 'class' => "form-control", 'value' => '3'));
          ?>
        </div>
      </fieldset>
      <div class="form-group">
        <?php echo $this->Form->end(array('label' => "アカウント作成", 'class' => "btn btn-primary form-control")) ?>
      </div>
      <div>
        <div class="signin_text">
          <?php echo $this->Html->link(__('サインイン'), array('action' => 'login')) ?>
        </div>
      </div>
    </div>
  </div>
</div>