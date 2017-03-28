<script>
$(document).ready(function(){
  $('.search-button').prevAll().hide();
  $('.search-button').click(function(){
    $('.target').slideToggle();
  });
});

</script>
<nav class="navbar navbar-default">
  <div class="navbar-header">
   <a class="navbar-brand">AMEブロ！</a>
   </div>
  	<ul class="nav nav-tabs">
      <li><?php echo $this->Html->link(__('記事作成'), array('controller' => 'posts', 'action' => 'add'),
                                                      array('role' => "presentation")); ?></li>
  		<li><?php echo $this->Html->link(__('記事一覧'), array('controller' => 'posts','action' => 'index'),
                                                     array('role' => "presentation")); ?></li>
  		<li><?php echo $this->Html->link(__('ユーザ一覧'), array('controller' => 'users', 'action' => 'index'),
                                                       array('role' => "presentation")); ?> </li>
  		<li><?php echo $this->Html->link(__('カテゴリ'), array('controller' => 'categories', 'action' => 'index'),
                                                      array('role' => "presentation")); ?> </li>
  		<li><?php echo $this->Html->link(__('タグ'), array('controller' => 'tags', 'action' => 'index'),
                                                  array('role' => "presentation")); ?> </li>
      <li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'),
                                                     array('confirm' => __('本当にログアウトしますか？'))); ?> </li>
                                                     <li>
                                                       <div class="search-section">
                                                         <div class="target">
                                                         <ul>
                                                           <?php echo $this->Form->create('Post', array('novalidate' => true, 'url' => array_merge(
                                                             array('action' => 'index'), $this->params['pass']) )); ?>
                                                           <?php
                                                             echo $this->Form->input('title', array('label' => 'タイトル', 'empty' => true, 'placeholder' => '例）検索ワードを入力してください。', 'style' => "width:250px;"));
                                                             echo $this->Form->input('category', array('label' => 'カテゴリー', 'class' => 'selectpicker_pre', 'empty' => true, 'options' => $categories));
                                                             echo $this->Form->input('tag', array('label' => 'タグ', 'empty' => true, 'options' => $tags, 'multiple' => true, 'class' => "form-control", 'style' => "width:250px;"));
                                                             echo $this->Form->end(array('label' => '検索', 'class' => "btn btn-default"));
                                                           ?>
                                                         </ul>
                                                         </div>
                                                         <a class="search-button"><span class="btn-lg glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                                       </div>
                                                       <!-- <form class="navbar-form navbar-left" role="search">
                                                         <div class="form-group">
                                                           <input type="text" class="form-control" placeholder="Search">
                                                         </div>
                                                         <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                                       </form> -->
                                                     </li>

  	</ul>

  </div>
</nav>
