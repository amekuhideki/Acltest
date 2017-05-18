<style>
.main{
	width: 960px;
	margin: 0 auto;
	margin-top: 40px;
}
</style>

<div class="tags index">
	<div class="header">
		<?php echo $this->element('header2'); ?>
	</div>
	<div class="main">
		<h3><?php echo __('タグ一覧'); ?></h3>
		<table cellpadding="0" cellspacing="0" class="table table-striped">
		<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('tag'); ?></th>
				<th><?php echo $this->Paginator->sort('tagSlug'); ?></th>
				<th><?php echo $this->Paginator->sort('created'); ?></th>
				<th><?php echo $this->Paginator->sort('modified'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($tags as $tag): ?>
		<tr>
			<td><?php echo h($tag['Tag']['id']); ?>&nbsp;</td>
			<td><?php echo h($tag['Tag']['tag']); ?>&nbsp;</td>
			<td><?php echo h($tag['Tag']['tagSlug']); ?>&nbsp;</td>
			<td><?php echo h($tag['Tag']['created']); ?>&nbsp;</td>
			<td><?php echo h($tag['Tag']['modified']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $tag['Tag']['id']),
																								 array('type' => "button", 'class' => "btn btn-primary")); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $tag['Tag']['id']),
																								 array('type' => "button", 'class' => "btn btn-primary")); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $tag['Tag']['id']),
				 																							 array('confirm' => __('Are you sure you want to delete # %s?', $tag['Tag']['id']),
																										 				 'type' => "button", 'class' => "btn btn-danger")); ?>
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
</div>
