<?php echo $this->Html->css('common.css'); ?>
<div class="contact_sm">
  <div class="header_sm">
    <?php echo $this->element('header_sm'); ?>
  </div>
  
  <div class="main_sm">
    <div class="main_header_sm">
      <h4><?php echo(__('Contact')); ?></h4>
    </div>
      <div class="add_details_sm">
        <?php echo $this->Form->create('Contact'); ?>
        <form>
          <div class="form-group">
            <label class="col-sm-2"><?php echo (__('Name')); ?></label>
            <?php echo $this->Form->input('name', array('label' => false, 'type' => 'text', 'maxlength' => 255, 'style' => 'width:80%;', 'class' => 'contact_text text_form_sm')); ?>
          </div>
          <div class="form-group">
            <label class="col-sm-2"><?php echo (__('Mail Address')); ?></label>
            <?php echo $this->Form->input('email', array('label' => false, 'type' => 'email', 'maxlength' => 255, 'style' => 'width:80%;', 'class' => 'contact_text text_form_sm')); ?>
          </div>
          <div class="form-group">
            <label class="col-sm-2"><?php echo (__('Subject')); ?></label>
            <?php echo $this->Form->input('subject', array( 'type' => 'text', 'label' => false, 'maxlength' => 255, 'style' => 'width:80%;', 'class' => 'contact_text text_form_sm'));?>
          </div>
          <div class="form-group">
            <label class="col-sm-2"><?php echo (__('Content of inquiry')); ?></label>
            <?php echo $this->Form->input('ContactUs', array('type' => 'textarea', 'label' => false, 'maxlength' => 3000, 'style' => 'width:80%;', 'class' => 'contact_text text_form_sm'));?>
          </div>
          <div calss="form-group">
            <div class="col-sm-2">
            <?php echo $this->Form->submit(__('Confirm'), array( 'type' => 'submit', 'name' => 'confirm', 'value' => 'confirm', 'class' => 'text btn btn-primary btn-xs ')); ?>
            <?php echo $this->Form->end(); ?>
            </div>
          </div>
      </form>
    </div>
  </div>
</div>