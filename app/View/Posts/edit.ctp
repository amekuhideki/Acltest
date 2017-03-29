<style>
	label {
		white-space: nowrap;
	}
</style>
<div class="posts form">
	<?php echo $this->element('header'); ?>
	<?php echo $this->Form->create('Post', array('type' => 'file')); ?>
	<div class="center">
		<h3><?php echo __('記事編集'); ?></h3>
		<table class="table">
			<tr>
				<th>
					<label class="col-sm-3">タイトル</label>
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
					<label class="col-sm-3">カテゴリー</label>
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
					<label class="col-sm-3">本文</label>
				</th>
				<td>
					<div class="col-sm-9">
						<?php
							echo $this->Form->input('body', array('label' => false, 'style' => 'width:400px; height:200px'));
						?>
					</div>
				</td>
			</tr>
			<tr>
				<th>
					<label class="col-sm-3">画像ファイルの追加</label>
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
		<div align="center">
			<?php echo $this->Form->end(array('label' => '再投稿する', 'class' => 'btn btn-primary')); ?><br>
		</div>
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

<script type="text/javascript">
</script>
