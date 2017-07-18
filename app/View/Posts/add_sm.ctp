<?php echo $this->Html->css('common.css'); ?>
<?php echo $this->Html->script('tinymce/tinymce.min.js'); ?>

<div class="posts_add_sm">
  <div class="header_sm">
    <?php echo $this->element('header_sm'); ?>
  </div>
  
  <div class="main_sm">
    <div class="main_header_sm">
      <h4><?php echo (__('New Post')); ?></h4>
    </div>
    <div class="add_details_sm">
      <input type="file" accept="image/*;capture=camera">
      <?php echo $this->Form->create('Post', array('type' => 'file')); ?>
      <?php echo $this->Form->input('status', array('type' => 'hidden', 'value' => 0)); ?>
      <form class="add_table_sm">
        <div class="form-group">
          <label class="col-sm-2"><?php echo (__('Title')); ?></label>
          <?php echo $this->Form->input('Post.title', array('label' => false, 'style' => 'width:80%', 'class' => "text_form_sm")); ?>
        </div>
        <div class="form-group">
          <label class="col-sm-2"><?php echo (__('Category')); ?></label>
          <?php echo $this->Form->input('Post.category_id', array('label' => false, 'class' => "caategory text_form_sm", 'empty' => __('Please select')));?>
        </div>
        <div class="form-group">
          <label class="col-sm-2"><?php echo(__('Body')); ?></label>
          <?php echo $this->Form->input('Post.body', array('label' => false, 'style' => "width:80%;", 'id' => "text_box", 'class' => "text_form_sm")); ?>
        </div>
        <div class="form-group">
          <label class="col-sm-2"><?php echo(__('Image selection')); ?></label>
          <?php echo $this->Form->input('Image.0.attachment', array('type' => "file", 'label' => false, 'accept' => "image/*", 'id' => "add_image_sm", 'class' => "text_form_sm")); ?>
        </div>
        
        <?php 
          echo $this->Form->input('Image.0.model', array('type' => "hidden", 'value' => "Post"));
          echo $this->Form->hidden('Post.user_id', array('value' => $users));
        ?>
        <div align="center">
          <?php echo $this->Form->submit(__('Post'), array('class' => "btn btn-primary")); ?>
        </div>
      </form>
      
    </div>
  </div>
  
</div>