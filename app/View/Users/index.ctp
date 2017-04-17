<style>
#wrapper{
	width: 960px;
	margin: 0 auto;
}

</style>
<div id="wrapper">
	<div class="users index">
		<?php echo $this->element('header2'); ?>
		<h3><?php echo __('ユーザー一覧'); ?></h3>
			<table class="table table-striped">
				<thead>
					<tr>
							<th>id</th>
							<th>username</th>
							<th>group_id</th>
							<th>created</th>
							<th>modified</th>
							<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($users as $user): ?>
					<tr>
						<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
						<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
						<td>
							<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
						</td>
						<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
						<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link(__('詳細'), array('action' => 'view', $user['User']['id']),
																											 array('type' => "button", 'class' => "btn btn-primary")); ?>
						　<?php if ($user_auth['user_group'] == 1 || $user_auth['user_name'] == $user['User']['username']): ?>
							<?php echo $this->Html->link(__('編集'), array('action' => 'edit', $user['User']['id']),
																											 array('type' => "button", 'class' => "btn btn-primary")); ?>
							<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $user['User']['id']),
							 																							 array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']), 'type' => "button", 'class' => "btn btn-danger")); ?>
							<?php endif; ?>
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
