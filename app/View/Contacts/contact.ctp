<?php echo $this->Html->css('common.css'); ?>
<div id="contact">
  <div class="header">
    <?php echo $this->element('header2'); ?>
  </div>
  <div class="main">
    <div id="contact_details">
    <legend><?php echo __('Contact'); ?></legend>
    <?php
      echo $this->Session->flash();

      echo $this->Form->create('Contact');

      echo $this->Form->input('name', array(
              'type' => 'text',
              'label' => '・' . __('Name'),
              'maxlength' => 255,
              'style' => 'width:300px;',
              'class' => 'contact_text',
              )
           );

      echo $this->Form->input('email', array(
              'type' => 'email',
              'label' => '・' . __('Mail Address'),
              'maxlength' => 255,
              'style' => 'width:300px;',
              'class' => 'contact_text',
              )
           );

      echo $this->Form->input('subject', array(
              'type' => 'text',
              'label' => '・' . __('Subject'),
              'maxlength' => 255,
              'style' => 'width:300px;',
              'class' => 'contact_text',
              )
          );

      echo $this->Form->input('ContactUs', array(
              'type' => 'textarea',
              'label' => '・' . __('Content of inquiry'),
              'maxlength' => 3000,
              'style' =>'width:400px;height:200px;',
              'class' => 'contact_text',
              )
          );

      echo $this->Form->button(__('Confirm'), array(
              'type' => 'submit',
              'name' => 'confirm',
              'value' => 'confirm',
              'class' => 'text',
          ));

      echo $this->Form->end();
    ?>
    </div>
  </div>
</div>
