<?php echo $this->Html->css('common.css'); ?>
<?php echo $this->Html->script('tinymce/tinymce.min.js'); ?>
<script>
tinymce.init({
	selector: "#text_box",
	language: "ja",
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

	$('.category').change(function(){
		$('tr.sub_categories').remove();

		var category_id = $(this).val();
		// console.log(category_id);
		$.ajax({
			type: "post",
			url: "http://blog.dev/AclTest/subcategories/getdata/",
			data: {'category_id' : category_id},
			crossDomain: false,
			dataType: "json",
			scriptCharset: "utf-8"
		}).then(function(data){

			if ($.isArray(data)){
				var tag = '<tr class="sub_categories"><th><label class="col-sm-3"><?php echo(__('子カテゴリ')); ?></label></th>';
				tag += '<td><div class="col-sm-9"><select name="data[Post][sub_category_id]">';
				var key;
				var value;
				var array=[];
				$(data).each(function(index, val){
					key = val['SubCategory']['id'];
					value = val['SubCategory']['sub_category'];
					array += {key : value};
					tag += '<option value="' + val['SubCategory']['id'] + '">' + val['SubCategory']['sub_category'] + '</option>';
				});


				tag += '</select></div></td></tr>';
				$('.categories').after(tag);
				console.log(tag);

			} else if (data === 'false'){
			}

		});
	});
});
</script>
<div class="posts form">
	<div class="header">
		<?php echo $this->element('header2'); ?>
	</div>
	<?php echo $this->Form->create('Post', array('type' => 'file')); ?>
	<?php echo $this->Form->input('status', array('type' => 'hidden', 'value' => 0)); ?>
	<div class="center">
		<h3><?php echo __('New Post'); ?></h3>
		<table class="table">
			<tr>
				<th>
					<label class="col-sm-3"><?php echo __('Title'); ?></label>
				</th>
				<td>
					<div class="col-sm-9">
						<?php
							echo $this->Form->input('Post.title', array('label' => false, 'style' => 'width:100%'));
						?>
					</div>
				</td>
			</tr>
			<tr class="categories">
				<th>
					<label class="col-sm-3"><?php echo(__('カテゴリ')); ?></label>
				</th>
				<td>
					<div class="col-sm-9">
						<?php
							echo $this->Form->input('Post.category_id', array('label' => false, "class" => 'category', "empty" => '選択してください'));
						?>
					</div>
				</td>
			</tr>
			<tr>
				<th>
					<label class="col-sm-3"><?php echo(__('本文')); ?></label>
				</th>
				<td>
					<div class="col-sm-9">
						<?php
							echo $this->Form->input('Post.body', array('label' => false, 'style' => 'width:400px; height: 200px;', 'id' => "text_box"));
						?>
					</div>
				</td>
			</tr>
			<!-- <tr>
				<th>
					<lavel class="col-sm-3"><?php echo(__('タグ')); ?></lavel>
				</th>
				<td>
					<div class="col-sm-9">
						<?php
							echo $this->Form->input('Tag.tag', array('label' => false));
							?>
				</td>
			</tr> -->
			<tr>
				<th>
					<label class="col-sm-3"><?php echo(__('画像選択')); ?></label>
				</th>
				<td>
					<div class="col-sm-9">
						<?php
							echo $this->Form->input('Image.0.attachment', array('type' => "file", 'label' => false, 'accept' => "image/*", 'id' => 'image'));
						?>
					</div>
				</td>
			</tr>
			<?php
				echo $this->Form->input('Image.0.model', array('type' => "hidden", 'value' => "Post"));
				echo $this->Form->hidden('Post.user_id', array('value' => $users));
			?>
		</table>
			<div align="center">
				<?php echo $this->Form->submit(__('投稿する'), array('class' => "btn btn-primary")); ?>
			</div>
	</div>
</div>
