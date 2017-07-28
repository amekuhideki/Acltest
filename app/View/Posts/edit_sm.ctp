<?php echo $this->Html->css('common.css'); ?>
<?php echo $this->Html->script('tinymce/tinymce.min.js'); ?>
<script>
tinymce.init({
	selector: "#text_box_sm",
	language: "ja",
  toolbar: false,
  menubar: false,
  statusbar: false,
});
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
            var img_src = $('<img>').attr({'src': reader.result, 'width': '30%'});
                $('.image_thumbnail').html(img_src);
            };
           reader.readAsDataURL(file);
      } else {
        $('.image_thumbnail').text('画像ファイルを指定してください');
      }
    });
});
</script>
<div class="container">
  <div class="posts edit">
    <div class="header_sm">
      <?php echo $this->element('header_sm'); ?>
    </div>
    
    <div class="row main_sm">
      <div class="main_header_sm">
        <h4><?php echo (__('Edit Post'));?></h4>
      </div>
    
    <div class="add_details_sm">
      <?php echo $this->Form->create('Post', array('type' => 'file')); ?>
      <form>
        <div class="form-group user_edit_sm">
          <label><?php echo (__('Title')); ?></label>
          <?php echo $this->Form->input('title', array('label' => false, 'class' => "form-control")); ?>
        </div>
        <div class="form-group user_edit_sm">
          <label><?php echo (__('Category')); ?></label>
          <?php echo $this->Form->input('category_id', array('label' => false, 'class' => "form-control")); ?>
        </div>
        <div class="form-group user_edit_sm">
          <label><?php echo (__('Body')); ?></label>
          <?php echo $this->Form->input('body', array('label' => false, 'id' => 'text_box_sm', 'class' => "form-control", "cols" => 50, "rows" => 7)); ?>
        </div>
        <div class="form-group user_edit_sm">
          <label><?php echo(__('Image selection')); ?></label>
          <?php
            echo $this->Form->input('Image.0.attachment', array('type' => 'file', 'label' => false, 'id' => 'image'));
          ?>
        </div>
        <div class="form-group user_edit_sm">
          <?php
            echo $this->Form->input('Image.0.model', array('type' => 'hidden', 'value' => 'Post', 'class' => 'thumbnail'));
            echo $this->Form->hidden('id');
          ?>
        </div>
        <div class="form-group">
          <label class="control-label" for="fileInput">サムネイル画像</label>
          <div class="controls">
            <div class="image_thumbnail">
              
            </div>
          </div>
        </div>
        <div class="form-group">
          <?php if (!empty($post['Image'])): ?>
            <label class="control-label"><?php echo(__('Image list')); ?></label><br>
          <?php endif; ?>
          <?php foreach ($post['Image'] as $image): ?>
            <a href=<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?>>
               <img src=<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?> width="30%"></a>
            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'deleteImage', $image['id'], $post['Post']['id']), array('class' => 'img-rounded', 'inline' => false, 'confirm' => __('Are you sure you want to delete # %s?', $image['id']))); ?>
          <?php endforeach; ?>
        </div>
        <div class="form-group submit_button_sm user_edit_sm">
          <ul>
            <li class="">
              <?php echo $this->Form->hidden('id'); ?>
              <?php echo $this->Form->submit(__('Post'), array('class' => "btn btn-primary btn-xs")); ?>
              <!-- <?php echo $this->Form->end(); ?> -->
            </li>
            <li class="col-sm-3">
              <?php echo $this->Form->postLink(__('Delete'), array('action' => "delete", $post['Post']['id']),
                                                          array('confirm' => __('Are you sure you want to delete # %s?', $post['Post']['id']), 'type' => "button", 'class' =>"btn btn-danger btn-xs")); ?>
            </li>
          </ul>
        </div>
        
      </form>
      <div class="edit_item_sm">
        <?php echo $this->Html->link(__('詳細に戻る'), array('action' => 'view', $post['Post']['id']), array('class' => "btn btn-primary btn-xs")); ?>
      </div>
      <?php echo $this->fetch('postLink'); ?>

    </div>
    
  </div>
</div>