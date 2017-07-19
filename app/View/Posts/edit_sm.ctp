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
</script>
<div class="posts edit">
  <div class="header_sm">
    <?php echo $this->element('header_sm'); ?>
  </div>
  
  <div class="main_sm">
    <div class="main_header_sm">
      <h4><?php echo (__('Edit Post'));?></h4>
    </div>
  </div>
  
  <div class="add_details_sm">
    <?php echo $this->Form->create('Post', array('type' => 'file')); ?>
    <form>
      <div class="form-group">
        <label class="col-sm-2"><?php echo (__('Title')); ?></label>
        <?php echo $this->Form->input('title', array('label' => false, 'style' => "width: 80%", 'class' => "text_form_sm")); ?>
      </div>
      <div class="form-group">
        <label class="col-sm-2"><?php echo (__('Category')); ?></label>
        <?php echo $this->Form->input('category_id', array('label' => false, 'class' => "text_form_sm")); ?>
      </div>
      <div class="form-group">
        <label class="col-sm-2"><?php echo (__('Body')); ?></label>
        <?php echo $this->Form->input('body', array('label' => false, 'style' => 'width:80%; height:200px;', 'id' => 'text_box_sm', 'class' => "text_form_sm")); ?>
      </div>
      <div class="form-group">
        <label class="col-sm-2"><?php echo(__('Image selection')); ?></label>
        <?php
          echo $this->Form->input('Image.0.attachment', array('type' => 'file', 'label' => false, 'id' => 'image'));
        ?>
      </div>
      <?php
        echo $this->Form->input('Image.0.model', array('type' => 'hidden', 'value' => 'Post'));
        echo $this->Form->hidden('id');
      ?>
      <div class="submit_button_sm">
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
  </div>
  
</div>