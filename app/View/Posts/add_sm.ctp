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
  <div class="posts_add_sm">
    <div class="header_sm">
      <?php echo $this->element('header_sm'); ?>
    </div>
    
    <div class="row main_sm">
      <div class="main_header_sm">
        <h4><?php echo (__('New Post')); ?></h4>
      </div>
      <div class="add_details_sm">
        <?php echo $this->Form->create('Post', array('type' => 'file')); ?>
        <?php echo $this->Form->input('status', array('type' => 'hidden', 'value' => 0)); ?>  
        <form class="add_table_sm">
          <div class="form-group">
            <label><?php echo (__('Title')); ?></label>
            <?php echo $this->Form->input('Post.title', array('type' => 'text', 'label' => false, 'class' => "form-control")); ?>
          </div>
          <div class="form-group">
            <label><?php echo (__('Category')); ?></label>
            <?php echo $this->Form->input('Post.category_id', array('type' => 'select', 'label' => false, 'class' => "form-control", 'empty' => __('Please select'), 'options' => $categories));?>
          </div>
          <div class="form-group">
            <label><?php echo(__('Body')); ?></label>
            <?php echo $this->Form->input('Post.body', array('label' => false, 'id' => "text_box_sm", 'class' => "form-control")); ?>
          </div>
          <div class="form-group">
            <label><?php echo(__('Image selection')); ?></label>
            <?php echo $this->Form->input('Image.0.attachment', array('type' => "file", 'label' => false, 'accept' => "image/*", 'id' => "add_image_sm")); ?>
          </div>
          
          <?php 
            echo $this->Form->input('Image.0.model', array('type' => "hidden", 'value' => "Post", 'class' => 'thumbnail'));
            echo $this->Form->hidden('Post.user_id', array('value' => $users));
          ?>
          <div class="form-group">
            <label class="control-label" for="fileInput">サムネイル画像</label>
            <div class="controls">
              <div class="image_thumbnail">
                
              </div>
            </div>
          </div>
          <div align="center">
            <?php echo $this->Form->submit(__('Post'), array('class' => "btn btn-primary btn-lg btn-block")); ?>
          </div>
        </form>
        
      </div>
    </div>
    
  </div>
</div>