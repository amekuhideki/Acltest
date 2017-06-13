<style>
#main{
	width: 650px;
	margin: 0 auto;
	margin-top: 40px;
	border: 1px solid Silver;
	background: white;
}
#category_title h3 {
	margin: 0;
	padding: 20px 40px;
	border-bottom: 1px solid Silver	;
	background-color: #F5F5F5	;
}
#category_list {
	padding: 20px 40px;
}
#category_list ul {
	padding: 0;
}
#category_list li {
	padding-bottom: 10px;
}
</style>

<div class="categories index">
	<div class="header">
		<?php echo $this->element('header2'); ?>
	</div>
	<div id="main">
		<div id="category_title">
			<h3><?php echo __('カテゴリ一'); ?></h3>
		</div>
		<div id="category_list">
			<ul>
				<?php foreach ($categories as $category): ?>
					<li>><?php echo $this->Html->link(__($category['Category']['category']), array('action' => 'view', $category['Category']['id'])); ?></li>
				<?php endforeach; ?>
			</ul>
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
</div>
