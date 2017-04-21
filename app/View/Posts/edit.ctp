<style>
	#wrapper {
		width: 960px;
		margin: auto;
	}
	label {
		white-space: nowrap;
	}
	.center{
		margin: 50px;
		padding: 20px;
	}
	.submit_button {
		margin: auto;
		padding-top: 20px;
		padding-bottom: 100px;
	}
	#image{
		margin: auto;
		padding: 50px;
	}
	#image h4{
		text-align: center;
		border-bottom: solid;
	}
</style>
<?php echo $this->Html->script('tinymce/tinymce.min.js'); ?>
<script>
tinymce.init({
	selector: "#text_box"
});
</script>
<div id="wrapper">
	<div class="posts form">
		<?php echo $this->element('header2'); ?>
		<?php echo $this->Form->create('Post', array('type' => 'file')); ?>
		<div class="center">
			<h3><?php echo __('記事編集'); ?></h3>
			<table class="table">
				<tr>
					<th>
						<label class="col-sm-3"><?php echo(__('タイトル')); ?></label>
					</th>
					<td>
						<div class="col-sm-9">
							<?php
								echo $this->Form->input('title', array('label' => false, 'style' => "width: 400px"));
							?>
						</div>
					</td>
				</tr>
				<tr>
					<th>
						<label class="col-sm-3"><?php echo(__('カテゴリー')); ?></label>
					</th>
					<td>
						<div class="col-sm-9">
							<?php
								echo $this->Form->input('category_id', array('label' => false));
							?>
						</div>
					</td>
				</tr>
				<tr>
					<th>
						<label class="col-sm-3"><?php echo(__('本文')); ?></label>
					</th>
					<td>
						<div class="col-sm-9">
							<?php
								echo $this->Form->input('body', array('label' => false, 'style' => 'width:400px; height:200px', 'id' => 'text_box'));
							?>
						</div>
					</td>
				</tr>
				<tr>
					<th>
						<label class="col-sm-3"><?php echo(__('画像ファイルの追加')); ?></label>
					</th>
					<td>
						<div class="col-sm-9">
							<?php
								echo $this->Form->input('Image.0.attachment', array('type' => 'file', 'label' => false));
							?>
						</div>
					</td>
				</tr>
				<?php
					echo $this->Form->input('Image.0.model', array('type' => 'hidden', 'value' => 'Post'));
					echo $this->Form->hidden('id');
					// echo $this->Form->hidden('Post.post_id', array('value' => $post['Post']['id']));
				?>
			</table>
			<!-- <div align="center"> -->
			<div class="submit_button">
				<div class="col-sm-3 col-sm-offset-4">
					<?php echo $this->Form->submit(__('投稿する'), array('class' => "btn btn-primary")); ?>
					<?php echo $this->Form->end(); ?>
				</div>
				<div class="col-sm-3">
					<?php echo $this->Form->postLink(__('削除'), array('action' => "delete", $post['Post']['id']),
																											array('confirm' => __('Are you sure you want to delete # %s?', $post['Post']['id']), 'type' => "button", 'class' =>"btn btn-danger")); ?>
				</div>
			</div>
			<div id="image">
				<?php if(!empty($post['Image'])): ?>
					<legend><h4><?php echo (__('画像一覧')); ?></h4></legend>
				<?php endif; ?>
				<?php foreach ($post['Image'] as $image):?>

					<a href=<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?>>
						 <img src=<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?>
						 width="256"></a>
					<?php echo $this->Form->postLink(__('削除'),
											array('action' => 'deleteImage', $image['id'], $post['Post']['id']),
											array('confirm' => __('Are you sure you want to delete # %s?', $image['id']))); ?>

				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
	<!-- <script type="text/javascript">
	</script> -->
