<div class="posts form">
<?php echo $this->Form->create('Post'); ?>
	<fieldset>
		<legend><?php echo __('Add Post'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('category_id');
		echo $this->Form->input('title');
		echo $this->Form->input('body');
	?>
	<?php echo $this->Form->create('User', array('type' => 'file')); ?>
<!-- nameフィールドもあると仮定します。 -->
<?php echo $this->Form->input('Image.0.name', array('type' => 'file')); ?>
<!-- インデックス0をつけてモデル名を指定してあげるのがポイント -->
<?php echo $this->Form->hidden('Image.0.model', array('value'=>'Person'));?>
<!-- ファイルを選択するボタン -->
<?php echo $this->Form->input('Image.0.photo_person', array('type' => 'file')); ?>

	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
	</ul>
</div>
