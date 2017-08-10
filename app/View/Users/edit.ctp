<?php echo $this->Html->css('common.css'); ?>
<script>
$(function() {
    $('input[type=file]').change(function() {
      var file = $(this).prop('files')[0];

      if (file) {
        if (!file.type.match('image.*')) {
            $('span').html('');
            $('.image_thumbnail').text('画像ファイルを指定してください');
           return;
        }
        var reader = new FileReader();
            reader.onload = function() {
            var img_src = $('<img>').attr({'src': reader.result, 'width': '200px'});
                $('.image_thumbnail').html(img_src);
            };
           reader.readAsDataURL(file);
      } else {
        $('.image_thumbnail').text('画像ファイルを指定してください');
      }
    });
    
});
</script>
<div id="edit">
  <div class="users form">
    <div class="content">
      <div class="add_center">
        <fieldset>
          <legend><h2><?php echo __('Edit Account'); ?></h2></legend>
          
          <?php if (!empty($this->Session->read()['Message']['flash'])): ?>
            <?php if ($this->Session->read()['Message']['flash']['element'] === 'Flash/error'): ?>
              <div id="flash_message" class="alert alert-danger">
                <?php echo $this->Session->flash(); ?>
              </div>
            <?php else: ?>
              <div id="flash_message" class="alert alert-success">
                <?php echo $this->Session->flash(); ?>
              </div>
            <?php endif; ?>
          <?php endif; ?>
          
          <div class="user_conf">
            <?php echo $this->Form->create('User', array('url' => array('action' => 'edit'), 'type' => 'file')); ?>
            <form>
              <div class="input-group user_edit_sm">
                <label><?php echo(__('Image selection')); ?></label>
                <div class="edit_user_image form-group">
                  <?php echo $this->Form->input('userImage.user_image', array('type' => "file", 'label' => false, 'accept' => "user_image/*", 'id' => "add_user_image_sm exampleInputFile")); ?>
                  <?php echo $this->Form->input('dir', array('type' => 'hidden')); ?>
                  <div class="control-group">
                    <label class="control-label" for="fileInput">サムネイル画像</label>
                    <div class="controls">
                      <div class="image_thumbnail">
                        <?php if (!empty($user['userImage']['id'])): ?>
                          <?php echo $this->Html->image('/files/user_image/user_image' . '/' . $user['userImage']['dir'] . '/' . $user['userImage']['user_image'], array('class' => 'thumbnail img-rounded', 'width' => '200px')); ?>
                          <?php echo $this->Form->postLink(__('画像削除'),
                                      array('action' => 'deleteUserImage', $user['userImage']['id'], $user['User']['id']),
                                      array('class' => 'btn btn-danger btn-xs', 'inline' => false, 'confirm' => __('Are you sure you want to delete # %s?', $user['userImage']['id']))); ?>
                        <?php else: ?>
                          <?php echo $this->Html->image('/images/no_user.png', array('class' => "thumbnail img-rounded", 'width' => '200px')); ?>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
                echo $this->Form->input('userImage.model', array('type' => "hidden", 'value' => "User"));
              ?>
              <?php
                echo $this->Form->input('id');
              ?>
              <div class="form-group">
                <label><?php echo (__('Name')); ?></label>
                <?php echo $this->Form->input('User.username', array('label' => false, 'type' => 'text', 'maxlength' => 255, 'class' => 'form-control contact_text', 'style' => 'width:80%;')); ?>
              </div>
              <div class="form-group">
                <label><?php echo (__('Mail Address')); ?></label>
                <?php echo $this->Form->input('User.email', array('label' => false, 'type' => 'text', 'maxlength' => 255, 'style' => 'width:80%;', 'class' => 'form-control contact_text')); ?>
              </div>
              <div class="form-group">
                <label><?php echo (__('Password')); ?></label>
                <?php echo $this->Form->input('password', array('label' => false, 'value' => '', 'type' => 'password', 'class' => 'form-control contact_text', 'style' => 'width:80%;')); ?>
              </div>
              <div class="form-group">
                <label><?php echo (__('Password Confirm')); ?></label>
                <?php echo $this->Form->input('password_confirm', array('label' => false, 'value' => '', 'type' => 'password', 'class' => 'form-control contact_text', 'style' => 'width:80%;')); ?>
              </div>
              <p class="annotation">
                <?php echo __('*入力しない場合、変更はありません。'); ?>
              </p><br>
              <div class="form-group">
                <label><?php echo (__('Self-introduction')); ?></label>
                <?php echo $this->Form->input('User.introduction', array('label' => false, 'type' => 'textarea', 'label' => false, 'maxlength' => 3000, 'class' => 'form-control contact_text', "cols" => 40, "rows" => 7)); ?>
              </div>
              <div class="form-group user_edit_sm" align="center">
                <?php echo $this->Form->submit(__('Post'), array('class' => 'btn btn-primary btn-lg btn-block')); ?>
                <?php
                  echo $this->Form->end();
                ?>
              </div>
            </form>
            <?php echo $this->fetch('postLink'); ?>
          </div>
        </fieldset>
      </div>
    </div>
  </div>
</div>
