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
      $('#image').after('<span class="thumbnail"></span>');
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
  <div class="main">
    <h3><?php echo __('Edit Post'); ?></h3>
    <table class="table">
      <tr>
        <th>
          <label class="col-sm-3"><?php echo(__('Title')); ?></label>
        </th>
        <td>
          <div class="col-sm-9">
            <?php
              echo $this->Form->input('title', array('label' => false, 'style' => "width: 100%"));
            ?>
          </div>
        </td>
      </tr>
      <tr>
        <th>
          <label class="col-sm-3"><?php echo(__('Category')); ?></label>
        </th>
        <td>
          <div class="col-sm-9">
            <?php
              echo $this->Form->input('category_id', array('label' => false,));
            ?>
          </div>
        </td>
      </tr>
      <?php
        $this->Js->get('#PostCategoryId')->event(
          'change',
          $this->Js->request(
            array('controller' => 'sub_categories','action' => 'getdata2'),
            array(
              'update' => '.SubCategory',
              'dataExpression' => true,
              'data' => '$("#PostCategoryId").val()',
              // 'complete' => '$("#SubCategory2")',
              'async' => true,
              'evalScripts' => true,
            )
          )
        );
      ?>
      <div>
          <tr>
            <?php if (isset($post['Post']['sub_category_id'])): ?>
            <th>
              <label class="col-sm-3">
                <?php echo(__('Child category')); ?>
              </label>
            </th>
            <td class="SubCategory">
              <div class="col-sm-9">
                <select name="data[Post][sub_category_id]">
                <!-- <select name="" -->
                <?php foreach ($sub_categories as $sub_category): ?>
                  <?php if ($post['Post']['category_id'] == $sub_category['SubCategory']['category_id']): ?>
                    <?php if ($post['Post']['sub_category_id'] === $sub_category['SubCategory']['id']): ?>
                      <option value="<?php echo $sub_category['SubCategory']['id']; ?>" selected><?php echo $sub_category['SubCategory']['sub_category']; ?> </option>
                    <?php else: ?>
                      <option value="<?php echo $sub_category['SubCategory']['id']; ?>"><?php echo $sub_category['SubCategory']['sub_category']; ?> </option>
                    <?php endif; ?>
                    <?php var_dump($sub_category['SubCategory']['sub_category']); ?>
                  <?php endif; ?>
                <?php endforeach; ?>
               </select>
              </div>
            </td>
          <?php else: ?>
              <th>
                <label class="col-sm-3">
                  <?php echo(__('Child category')); ?>
                </label>
              </th>
              <td class="SubCategory">
              </td>
          <?php endif;?>
          </tr>

      </div>
      <tr>
        <th>
          <label class="col-sm-3"><?php echo(__('Body')); ?></label>
        </th>
        <td>
          <div class="col-sm-9">
            <?php
              echo $this->Form->input('body', array('label' => false, 'style' => 'width:400px; height:200px;', 'id' => 'text_box'));
            ?>
          </div>
        </td>
      </tr>
      <tr>
        <th>
          <label class="col-sm-3"><?php echo(__('Image selection')); ?></label>
        </th>
        <td>
          <div class="col-sm-9">
            <?php
              echo $this->Form->input('Image.0.attachment', array('type' => 'file', 'label' => false, 'id' => 'image'));
            ?>
          </div>
        </td>
      </tr>
      <?php
        echo $this->Form->input('Image.0.model', array('type' => 'hidden', 'value' => 'Post'));
        echo $this->Form->hidden('id');
      ?>
    </table>
    <!-- <div align="center"> -->
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
           width="256"></a>
        <?php echo $this->Form->postLink(__('Delete'),
                    array('action' => 'deleteImage', $image['id'], $post['Post']['id']),
                    array('confirm' => __('Are you sure you want to delete # %s?', $image['id']))); ?>
      <?php endforeach; ?>
    </div>
  </div>
</div>
