<style>
label {
	white-space: nowrap;
}
</style>
<div class="posts form">
	<?php echo $this->element('header2'); ?>
	<?php echo $this->Form->create('Post', array('type' => 'file')); ?>
	<div class="center">
		<h3><?php echo __('記事作成'); ?></h3>
		<table class="table">
			<tr>
				<th>
					<label class="col-sm-3"><?php echo(__('タイトル')); ?></label>
				</th>
				<td>
					<div class="col-sm-9">
						<?php
							echo $this->Form->input('Post.title', array('label' => false, 'style' => 'width:400px'));
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
							echo $this->Form->input('Post.category_id', array('label' => false));
						?>
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
							echo $this->Form->input('Post.body', array('label' => false, 'style' => 'width:400px; height: 200px'));
						?>
					</div>
				</td>
			</tr>
			<tr>
				<th>
					<label class="col-sm-3"><?php echo(__('画像選択')); ?></label>
				</th>
				<td>
					<div class="col-sm-9">
						<?php
							echo $this->Form->input('Image.0.attachment', array('type' => "file", 'label' => false));
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
