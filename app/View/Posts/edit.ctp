<?php echo $this->Html->css('common.css'); ?>
<?php echo $this->Html->script('tinymce/tinymce.min.js'); ?>
<script>
tinymce.init({
  selector: "#text_box",
  language: "ja",
  menubar: false,
  statusbar: false,
  toolbar: [
    "undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
    "fontsizeselect forecolor image link"
  ],
});

$(function(){
  $('#image').change(function(){
    if ($('.thumbnail').size()) {
      $('.thumbnail').remove();
    }
    var file = $(this).prop('files')[0];
    if (! file.type.match('image.*')) {
      $('this').val('');
      $('span').html('');
      return;
    } else {
      $('#image').after('<span class="thumbnail" style="width:200px;"></span>');
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
<div class="posts form">
  <div class="header">
    <?php echo $this->element('header2'); ?>
  </div>
  <?php echo $this->Form->create('Post', array('type' => 'file')); ?>
  <div class="add_center">
    <h2><?php echo __('Edit Post'); ?></h2>
    <form>
      <div class="form-group">
        <label><?php echo(__('Title')); ?></label>
        <?php echo $this->Form->input('title', array('label' => false, 'type' => 'text', 'style' => "width: 100%", 'class' => 'form-control')); ?>
      </div>
      <div class="form-group">
        <label><?php echo(__('Category')); ?></label>
        <?php echo $this->Form->input('category_id', array('label' => false, 'type' => 'select', 'class' => 'form-control')); ?>
      </div>
      <div>
        <label class="col-sm-3"><?php echo(__('Body')); ?></label>
        <?php echo $this->Form->input('body', array('label' => false, 'type' => 'text', 'style' => 'width:400px; height:200px;', 'id' => 'text_box', 'class' => 'form-control')); ?>
      </div>
      <div>
        <label><?php echo(__('Image selection')); ?></label>
        <?php echo $this->Form->input('Image.0.attachment', array('type' => 'file', 'label' => false, 'id' => 'image')); ?>
      </div>
      <?php
        echo $this->Form->input('Image.0.model', array('type' => 'hidden', 'value' => 'Post'));
        echo $this->Form->hidden('id');
      ?>
    </form>
    <div class="submit_button">
      <div class="col-sm-3 col-sm-offset-4">
        <?php echo $this->Form->submit(__('Post'), array('class' => "btn btn-primary")); ?>
        <?php echo $this->Form->end(); ?>
      </div>
      <div class="col-sm-3">
        <?php echo $this->Form->postLink(__('Delete'), array('action' => "delete", $post['Post']['id']),
                                                    array('confirm' => __('Are you sure you want to delete # %s?', $post['Post']['id']), 'type' => "button", 'class' =>"btn btn-danger")); ?>
      </div>
    </div>
    <div id="image">
      <?php if(!empty($post['Image'])): ?>
        <legend><h4><?php echo (__('Image list')); ?></h4></legend>
      <?php endif; ?>
      <?php foreach ($post['Image'] as $image):?>

        <a href=<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?>>
           <img src=<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?>
           width="200"></a>
        <?php echo $this->Form->postLink(__('Delete'),
                    array('action' => 'deleteImage', $image['id'], $post['Post']['id']),
                    array('confirm' => __('Are you sure you want to delete # %s?', $image['id']))); ?>
      <?php endforeach; ?>
    </div>
  </div>
</div>
