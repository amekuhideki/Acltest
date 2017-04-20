<style>
#wrapper{
	width: 960px;
	margin: 0 auto;
}
label {
	white-space: nowrap;
}
.header{
	border-bottom: 1px solid #000;
}
</style>
<div id="wrapper">
	<div class="posts form">
		<div class="header">
			<?php echo $this->element('header2'); ?>
		</div>
		<?php echo $this->Form->create('Post', array('type' => 'file')); ?>
		<?php echo $this->Form->input('status', array('type' => 'hidden', 'value' => 0)); ?>
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
						<lavel class="col-sm-3"><?php echo(__('タグ')); ?></lavel>
					</th>
					<td>
						<div class="col-sm-9">
							<?php
								echo $this->Form->input('Tag.tag', array('label' => false));
								?>
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
</div>
