<div class="posts form">
<?php echo $this->element('header'); ?>
<?php echo $this->Form->create('Post', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('記事編集'); ?></legend>
		<?php
			echo $this->Form->input('id', array('label' => 'ユーザ名'));
			echo $this->Form->input('category_id', array('label' => 'カテゴリー'));
			echo $this->Form->input('title', array('label' => 'タイトル'));
			echo $this->Form->input('body', array('label' => '本文'));
			echo $this->Form->input('Image.0.attachment', array('type' => 'file', 'label' => '画像ファイルの追加'));
			echo $this->Form->input('Image.0.model', array('type' => 'hidden', 'value' => 'Post'));
		?>
		</fieldset>

	<?php echo $this->Form->end(__('Submit')); ?><br>
	<legend><h4><?php echo (__('画像一覧')); ?></h4></legend>
	<?php foreach ($post['Image'] as $image):?>

		<!-- <?php echo $this->Html->image( "/files/image/attachment/" . $image["dir"] . "/" . $image["attachment"], array('width' => "256")); ?> -->
		<a href=<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?>
			 data-lightbox="group01" data-title=""/>
			 <img src=<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?>
			 width="256"></a>
		<?php echo ($this->Form->postLink(__('Delete'), array('action' => 'deleteImage', $image['id'], $post['Post']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $image['id'])))); ?>

		<!-- <?php
		echo $this->Form->input('Image.0.attachment.remove', array('type' => 'checkbox', 'label' => 'Remove existing file'));
		?> -->
	<?php endforeach; ?>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Post.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Post.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>

<script type="text/javascript">
</script>
