<style>
#contents {
  width: 650px;
  margin: 0 auto;
  margin-top: 40px;
}
#category_title {
  border-bottom: 1px dotted;
}
.content_details {
  border: 1px solid Silver;
  margin-bottom: 20px;
  padding: 20px;
  height: 200px;
}
</style>
<div class="categories view">
  <div class="header">
		<?php echo $this->element('header2'); ?>
	</div>
  <div id="contents">
    <div id="category_title">
      <h2><?php echo h($category['Category']['category']); ?></h2>
    </div>

    <div class="related">
    	<h3><?php echo __($category['Category']['category']) . 'に関する記事一覧'; ?></h3>
    	<?php if (!empty($category['Post'])): ?>
    	<table cellpadding = "0" cellspacing = "0">
    	<?php foreach ($category['Post'] as $post): ?>
        <?php echo "<pre>"; var_dump($post); ?>
        <div class="content_details">
    			<?php echo $post['category_id'] ?>
          <?php echo $post['created']; ?>
    			<?php echo $post['title']; ?>
    			<?php echo $post['body']; ?>
    			<div class="actions">
    				<?php echo $this->Html->link(__('View'), array('controller' => 'posts', 'action' => 'view', $post['id'])); ?>
    				<?php echo $this->Html->link(__('Edit'), array('controller' => 'posts', 'action' => 'edit', $post['id'])); ?>
    				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'posts', 'action' => 'delete', $post['id']), array('confirm' => __('Are you sure you want to delete # %s?', $post['id']))); ?>
    			</div>
    		</div>
    	<?php endforeach; ?>
    	</table>
    <?php endif; ?>

    	<div class="actions">
    		<ul>
    			<li><?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add')); ?> </li>
    		</ul>
    	</div>
    </div>
  </div>
</div>
