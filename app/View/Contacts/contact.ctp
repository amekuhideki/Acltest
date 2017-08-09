<?php echo $this->Html->css('common.css'); ?>
<div id="contact">
  <div class="main">
    <div id="contact_details">
    <legend><?php echo __('Contact'); ?></legend>
    <?php echo $this->Session->flash(); ?>

    <?php echo $this->Form->create('Contact'); ?>
    <from>
      <div class="form-group">
        <label><?php echo '・' . (__('Name')); ?></label>
        <?php echo $this->Form->input('name', array(
                'type' => 'text',
                'label' => false,
                'maxlength' => 255,
                'style' => 'width:300px;',
                'class' => 'contact_text form-control',
                )
             ); ?>
      </div>
      <div class="form-group">
        <label><?php echo '・' . (__('Mail Address')); ?></label>
        <?php echo $this->Form->input('email', array(
                'type' => 'email',
                'label' => false,
                'maxlength' => 255,
                'style' => 'width:300px;',
                'class' => 'contact_text form-control',
                )
             ); ?>
      </div>
      <div class="form-group">
        <label><?php echo '・' . (__('Subject')); ?></label>
        <?php echo $this->Form->input('subject', array(
                'type' => 'text',
                'label' => false,
                'maxlength' => 255,
                'style' => 'width:300px;',
                'class' => 'contact_text form-control',
                )
            ); ?>
      </div>
      <div class="form-group">
        <label><?php echo '・' . (__('Content of inquiry')); ?></label>
        <?php echo $this->Form->input('ContactUs', array(
                'type' => 'textarea',
                'label' => false,
                'maxlength' => 3000,
                'style' =>'width:400px;height:200px;',
                'class' => 'contact_text form-control',
                )
            ); ?>
      </div>
      <?php echo $this->Form->button(__('Confirm'), array(
              'type' => 'submit',
              'name' => 'confirm',
              'value' => 'confirm',
              'class' => 'text',
          ));

      echo $this->Form->end();
    ?>
      </from>
    </div>
  </div>
</div>
