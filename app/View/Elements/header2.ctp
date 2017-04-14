<!-- <script>
$(document).ready(function(){
  $('.search-button').prevAll().hide();
  $('.search-button').click(function(){
    $('.target').slideToggle();
  });
});

</script> -->
<style>
.header_title{
  /*float: left;*/
  margin-top: 40px;

}

  nav li{
    display: inline;
    margin-left: 50px;
  }
  nav a{
    color: #666;
    text-decoration: none;
  }
  nav a:hover{color: #69c;}
  header a{
    font-size: 18px;
  }
  ul{
    list-style: none;
  }
  .search_box{
    float: right;
  }
  .search_bottun{
    float: right;
  }
</style>
<header>
  <div class="header_title col-sm-3">
    <a>AMEブロ！</a>
  </div>
  <div class="search_section col-sm-4 col-sm-offset-5">
    <ul>
      <?php echo $this->Form->create('Post', array('novalidate' => true, 'url' => array_merge(
        array('action' => 'index'), $this->params['pass']) )); ?>
      <li class="search_box">
        <?php
          echo $this->Form->input('keyword', array('label' => '', 'empty' => true, 'placeholder' => 'キーワード検索', 'style' => "width:250px;"));
          // echo $this->Form->input('category', array('label' => 'カテゴリー', 'class' => 'selectpicker_pre', 'empty' => true, 'options' => $categories));
          // echo $this->Form->input('tag', array('label' => 'タグ', 'empty' => true, 'options' => $tags, 'multiple' => true, 'class' => "form-control", 'style' => "width:250px;"));
        ?>
      </li>
      <li class="search_bottun">
        <?php echo $this->Form->end(array('label' => '', 'class' => "btn glyphicon glyphicon-search")); ?>
      </li>
    </ul>
  </div>
      <!-- </div>
      <a class="search-button"><span class="btn-lg glyphicon glyphicon-search" aria-hidden="true"></span></a>
    </div> -->
  <nav>
    <ul>
      <li><a><?php echo $this->Html->link(__('Article create'), array('controller' => 'posts', 'action' => 'add'),
                                                      array('role' => "presentation")); ?></a></li>
  		<li><a><?php echo $this->Html->link(__('List of articles'), array('controller' => 'posts','action' => 'index'),
                                                     array('role' => "presentation")); ?></a></li>
  		<li><a><?php echo $this->Html->link(__('User'), array('controller' => 'users', 'action' => 'index'),
                                                       array('role' => "presentation")); ?> </a></li>
  		<li><a><?php echo $this->Html->link(__('Category'), array('controller' => 'categories', 'action' => 'index'),
                                                      array('role' => "presentation")); ?> </a></li>
  		<li><a><?php echo $this->Html->link(__('Tag'), array('controller' => 'tags', 'action' => 'index'),
                                                  array('role' => "presentation")); ?> </a></li>
      <li><a><?php echo $this->Html->link(__('Contact'), array('controller' => 'contacts', 'action' => 'contact'),
                                                  array('role' => "presentation")); ?> </a></li>
      <li><a><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'),
                                                     array('confirm' => __('本当にログアウトしますか？'))); ?> </a></li>
  	</ul>
  </nav>
</header>
