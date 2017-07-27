<?php echo $this->Html->css('common.css'); ?>
<script>
$(function(){
  $('#add_user_image_sm').hide();
  
  $(document).on('click','.thumbnail',function(){
    $('#add_user_image_sm').trigger("click");
  });
  
  $('#add_user_image_sm').change(function(){
    if ($('.thumbnail').size()) {
      $('.thumbnail').remove();
    }
    var file = $(this).prop('files')[0];
    if (! file.type.match('image.*')) {
      $('this').val('');
      $('span').html('');
      return;
    } else {
      $('.now_user_icon').hide();
      $('#add_user_image_sm').after('<span class="thumbnail" style="width:30%"></span>');
    }
    var reader = new FileReader();
    reader.onload = function() {
      var img_src = $('<img>').attr('src', reader.result);
      $('.thumbnail').html(img_src);
    }
    reader.readAsDataURL(file);
  });
  
});
</script>
<div class="user edit">
  <div class="header_sm">
    <?php echo $this->element('header_sm'); ?>
  </div>
  
  <div class="main_sm">
    <div class="main_header_sm">
      <h4><?php echo (__('Edit Account')); ?></h4>
    </div>
    <div class="add_details_sm">
      <?php echo $this->Form->create('User', array('url' => array('action' => 'edit'), 'type' => 'file')); ?>
      <form> 
        <div class="form-group">
          <label class="col-sm-2"><?php echo(__('Image selection')); ?></label>
          <div class="edit_user_image">
            <?php echo $this->Form->input('userImage.user_image', array('type' => "file", 'label' => false, 'accept' => "user_image/*", 'id' => "add_user_image_sm", 'class' => "text_form_sm")); ?>
            <?php echo $this->Form->input('dir', array('type' => 'hidden')); ?>
            <?php if (!empty($user['userImage']['id'])): ?>
              <?php echo $this->Html->image('/files/user_image/user_image' . '/' . $user['userImage']['dir'] . '/' . $user['userImage']['user_image'], array('class' => 'thumbnail', 'width' => '26%')); ?>
            <?php else: ?>
              <?php echo $this->Html->image('/images/no_user.png', array('class' => "thumbnail", 'width' => '26%')); ?>
            <?php endif; ?>
          </div>
        </div>
        <?php 
          echo $this->Form->input('userImage.model', array('type' => "hidden", 'value' => "User"));
        ?>
        <?php echo $this->Form->input('id'); ?>
        <div class="form-group">
          <label><?php echo (__('Name')); ?></label>
          <?php echo $this->Form->input('User.username', array('label' => false, 'type' => 'text', 'maxlength' => 255, 'style' => 'width:80%;', 'class' => 'contact_text text_form_sm')); ?>
        </div>
        <div class="form-group">
          <label><?php echo (__('Mail Address')); ?></label>
          <?php echo $this->Form->input('User.email', array('label' => false, 'type' => 'email', 'maxlength' => 255, 'style' => 'width:80%;', 'class' => 'contact_text text_form_sm')); ?>
        </div>
        <div class="form-group">
          <label><?php echo(__('Phone Number')); ?></label>
          <p class="annotation">
            <?php
              echo __('*ハイフンは入りません');
            ?>
          </p>
          <?php echo $this->Form->input('User.phone_number', array('label' => false, 'type' => "tel", 'maxlength' => 11, 'class' => 'contact_text text_form_sm')); ?>
        </div>
        <div class="form-group">
          <label><?php echo (__('Password')); ?></label>
          <?php echo $this->Form->input('password', array('label' => false, 'value' => '', 'type' => 'password', 'style' => 'width:80%;', 'class' => 'contact_text text_form_sm')); ?>
        </div>
        <div class="form-group">
          <label><?php echo (__('Password Confirm')); ?></label>
          <?php echo $this->Form->input('password_confirm', array('label' => false, 'type' => 'password', 'style' => 'width:80%;', 'class' => "contact_text text_form_sm"));?>
        </div>
        <p class="annotation">
          <?php
            echo __('*入力しない場合、変更はありません。');
          ?>
        </p>
        <div class="form-group">
          <label><?php echo (__('Self-introduction')); ?></label>
          <?php echo $this->Form->input('User.introduction', array('label' => false, 'type' => 'textarea', 'label' => false, 'maxlength' => 3000, 'style' => 'width:80%;', 'class' => 'contact_text text_form_sm')); ?>
        </div>
        <div class="form-group">
          <?php echo $this->Form->submit(__('Post'), array('class' => 'btn btn-primary btn-xs')); ?>
          <?php echo $this->Form->end(); ?>
        </div>
      </form>
    </div>
  </div>
  
</div>