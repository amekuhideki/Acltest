<?php echo $this->Html->css('common.css'); ?>
<div id="edit">
  <div class="users form">
    <div class="header">
      <?php echo $this->element('header2'); ?>
    </div>
    <div class="content">
      <div class="content_detail">
        <fieldset>
          <legend><?php echo __('Edit User'); ?></legend>
          <div class="user_conf">
            <?php echo $this->Form->create('User'); ?>

            <?php
              echo $this->Form->input('id');
            ?>
            <?php
              echo $this->Form->input('username');
            ?>
            <?php
              echo $this->Form->input('password_edit', array('label' => 'Password', 'value' => '', 'type' => 'password'));
            ?>
            <p class="annotation">
              <?php
                echo __('*入力しない場合、変更はありません。');
              ?>
            </p>
          </div>
          <div class="user_introduction">
            <?php
              echo $this->Form->input('introduction', array('type' => 'textarea', 'style' => 'width:350px; height:180px'));
            ?>
          </div>
          <div class="content_footer">
            <?php
              echo $this->Form->end(__('Submit'));
            ?>
          </div>
        </fieldset>
      </div>
    </div>
  </div>
</div>
