<style>
#contact_details {
  width: 400px;
	margin: 0 auto;
  margin-top: 40px;
  text-align: left;
  padding: 40px;
  border: solid 1px;
}
.text {
  margin: 5px;
}
</style>
<?php echo $this->Html->css('contacts/contact.css') ?>
<div id="contact">
  <div class="header">
    <?php echo $this->element('header2'); ?>
  </div>

    <div id="contact_details">
    <legend><?php echo __('Contact'); ?></legend>
    <?php
      echo $this->Session->flash();

      echo $this->Form->create('Contact');

      echo $this->Form->input('name', array(
              'type' => 'text',
              'label' => '・お名前',
              'maxlength' => 255,
              'style' => 'width:300px;',
              'class' => 'text',
              )
           );

      echo $this->Form->input('email', array(
              'type' => 'email',
              'label' => '・メールアドレス',
              'maxlength' => 255,
              'style' => 'width:300px;',
              'class' => 'text',
              )
           );

      echo $this->Form->input('subject', array(
              'type' => 'text',
              'label' => '・題名',
              'maxlength' => 255,
              'style' => 'width:300px;',
              'class' => 'text',
              )
          );

      echo $this->Form->input('ContactUs', array(
              'type' => 'textarea',
              'label' => '・お問い合わせ内容',
              'maxlength' => 3000,
              'style' =>'width:300px;height:200px;',
              'class' => 'text',
              )
          );

      echo $this->Form->button('確認する', array(
              'type' => 'submit',
              'name' => 'confirm',
              'value' => 'confirm',
              'class' => 'text',
          ));

      echo $this->Form->end();
    ?>
    </div>
</div>
