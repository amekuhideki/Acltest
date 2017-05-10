<div class="subCategories form">
<?php echo $this->Form->create('SubCategory'); ?>
	<fieldset>
		<legend><?php echo __('Add Sub Category'); ?></legend>
	<?php
		echo $this->Form->input('category_id');
		echo $this->Form->input('sub_category');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Sub Categories'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
