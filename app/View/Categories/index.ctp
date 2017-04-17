<style>
#wrapper{
	width: 960px;
	margin: 0 auto;
}
</style>
<div id="wrapper">
	<div class="categories index">
		<?php echo $this->element('header2'); ?>
		<h3><?php echo __('カテゴリ一覧'); ?></h3>
		<table class="table table-striped">
		<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('category'); ?></th>
				<th><?php echo $this->Paginator->sort('created'); ?></th>
				<th><?php echo $this->Paginator->sort('modified'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($categories as $category): ?>
		<tr>
			<td><?php echo h($category['Category']['id']); ?>&nbsp;</td>
			<td><?php echo h($category['Category']['category']); ?>&nbsp;</td>
			<td><?php echo h($category['Category']['created']); ?>&nbsp;</td>
			<td><?php echo h($category['Category']['modified']); ?>&nbsp;</td>
			<td class="actions">
			  <?php echo $this->Html->link(__('View'), array('action' => 'view', $category['Category']['id']),
				 																				 array('type' => "button", 'class' => "btn btn-primary")); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category['Category']['id']),
																								 array('type' => 'button', 'class' => "btn btn-primary")); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category['Category']['id']),
				 																							 array('confirm' => __('Are you sure you want to delete # %s?', $category['Category']['id']),
																										 				 'type' => "button",
																														 'class' => "btn btn-danger")); ?>
			</td>
		</tr>
	<?php endforeach; ?>
		</tbody>
		</table>
		<p>
		<?php
		echo $this->Paginator->counter(array(
			'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		));
		?>	</p>
		<nav>
			<ul class="pagination">
		         <?php
		             echo $this->Paginator->prev(__('前へ'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
		             echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
		             echo $this->Paginator->next(__('次へ'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
		             ?>
		  </ul>
		</nav>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('New Post '), array('controller' => 'posts', 'action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List Post '), array('controller' => 'posts', 'action' => 'index')); ?></li>
		</ul>
	</div>
</div>
