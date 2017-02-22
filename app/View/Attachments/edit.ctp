<div class="attachments form">
<?php echo $this->Form->create('Attachment'); ?>
	<fieldset>
		<legend><?php echo __('Edit Attachment'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('model');
		echo $this->Form->input('foreign_key');
		echo $this->Form->input('photo_user');
		echo $this->Form->input('photo_menu');
		echo $this->Form->input('dir');
		echo $this->Form->input('type');
		echo $this->Form->input('size');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Attachment.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Attachment.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Attachments'), array('action' => 'index')); ?></li>
	</ul>
</div>
