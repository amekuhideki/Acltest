<style>
.header_header{
  padding-top: 20px;
}
.header_title{
  float: left;
  margin-top: auto;
  padding-top: 14px;
}
.search_section{
  float: right;
}
.search_box{
  margin: auto;
  float: left;
}
.search_bottun{
  float: right;
  padding-top: 14px;
}

.header_category{
  padding-top: 20px;
  clear: both;
}

  nav li{
    display: inline;
    margin-left: 26px;
  }
  nav a{
    color: #666;
    text-decoration: none;
  }
  nav a:hover{
    color: #69c;
    position: relative;
    top:3px;
    left:3px;
  }
  header a{
    font-size: 18px;
  }
  ul{
    list-style: none;
  }

</style>
<script>
$(function(){

});

</script>
<header>
  <div class="header_header">
    <div class="header_title">
      <a>AMEブロ！</a>
    </div>
    <div class="search_section">
      <ul>
        <?php echo $this->Form->create('Post', array('novalidate' => true, 'url' => array_merge(
          array('action' => 'index'), $this->params['pass']) )); ?>
        <li class="search_box">
          <?php
            echo $this->Form->input('keyword', array('label' => '', 'empty' => true, 'placeholder' => 'キーワード検索'));
            // echo $this->Form->input('category', array('label' => 'カテゴリー', 'class' => 'selectpicker_pre', 'empty' => true, 'options' => $categories));
            // echo $this->Form->input('tag', array('label' => 'タグ', 'empty' => true, 'options' => $tags, 'multiple' => true, 'class' => "form-control", 'style' => "width:250px;"));
          ?>
        </li>
        <li class="search_bottun">
          <?php echo $this->Form->end(array('label' => '検索')); ?>
        </li>
      </ul>
    </div>
  </div>
      <!-- </div>
      <a class="search-button"><span class="btn-lg glyphicon glyphicon-search" aria-hidden="true"></span></a>
    </div> -->
  <div class="header_category">
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
        <?php if ($_SESSION['lang'] === 'eng'): ?>
          <?php if ($this->action === 'view' || $this->action === 'edit'): ?>
            <li><a><?php echo $this->Html->link(__('japanese'), array('controller' => $this->name, 'action' => $this->action . "/" . $post['Post']['id'], 'parameter' => 'jpn'),
                                                          array('role' => 'presentation', 'class' => 'language')); ?></a></li>
          <?php else: ?>
            <li><a><?php echo $this->Html->link(__('japanese'), array('controller' => $this->name, 'action' => $this->action, 'parameter' => 'jpn'),
                                                          array('role' => 'presentation', 'class' => 'language')); ?></a></li>
          <?php endif; ?>
        <?php else: ?>
          <?php if ($this->action === 'view' || $this->action === 'edit'): ?>
            <li><a><?php echo $this->Html->link(__('English'), array('controller' => $this->name, 'action' => $this->action . "/" . $post['Post']['id'], 'parameter' => 'eng'),
                                                        array('role' => 'presentation', 'class' => 'language')); ?></a></li>
          <?php else: ?>
            <li><a><?php echo $this->Html->link(__('English'), array('controller' => $this->name, 'action' => $this->action, 'parameter' => 'eng'),
                                                        array('role' => 'presentation', 'class' => 'language')); ?></a></li>
          <?php endif; ?>
        <?php endif; ?>
        <?php if (!isset($_SESSION['Auth']['User']['username'])): ?>
          <li><a><?php echo $this->Html->link(__('Login'), array('controller' => 'users', 'action' => 'login')) ?> </a></li>
        <?php else: ?>
          <li><a><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'),
                                                         array('confirm' => __('本当にログアウトしますか？'))); ?> </a></li>
        <?php endif; ?>
    	</ul>
    </nav>
  </div>
</header>
