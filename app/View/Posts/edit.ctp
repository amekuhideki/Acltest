<div class="posts form">
<?php echo $this->Form->create('Post', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Edit Post'); ?></legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('user_id');
			echo $this->Form->input('category_id');
			echo $this->Form->input('title');
			echo $this->Form->input('body');
			echo $this->Form->input('Image.0.attachment', array('type' => 'file', 'label' => 'Image'));
			echo $this->Form->input('Image.0.model', array('type' => 'hidden', 'value' => 'Post'));
		?>
		</fieldset>

	<?php echo $this->Form->end(__('Submit')); ?>
	<?php foreach ($post['Image'] as $image):?>

		<?php echo $this->Html->image( "/files/image/attachment/" . $image["dir"] . "/" . $image["attachment"] ); ?>
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
