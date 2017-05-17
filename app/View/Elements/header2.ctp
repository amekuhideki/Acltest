<style>
.header_header{
  width: 960px;
  margin-left: 40px;
  margin-right: 40px;
  margin: 0 auto;
  margin-top: 20px;
  padding-top: 20px;

}
.header_title{
  float: left;
  margin-bottom: 30px;
  padding-top: 14px;
}
.search_section{
  position: relative;
  float: right;
  width: 300px;
  height: auto;
}
.search_box{
  margin: auto;
  float: left;
}
.search_bottun{
  float: left;
  padding-top: 16px;
}

.header_category{
  /*padding-top: 20px;*/
  clear: both;
  margin: 0 auto;
  background-color: #000;

}
.header_category_inner{
  width: 960px;
  margin: 0 auto;
}
  nav ul{
    padding: 0;
    padding-top: 8px;
    padding-bottom: 8px;
    text-align: center;
  }
  nav li{
    display: inline;
    margin-left: 26px;
  }
  nav a{
    color: white;
    text-decoration: none;
  }
  nav a:hover{
    color: #69c;
    position: relative;
    top:2px;
    left:2px;
  }
  nav li a{
    font-size: 18px;
  }
  #site_name {
    font-size: 30px

  }
  ul{
    list-style: none;
  }
@media only screen and (max-width: 400px) {

}

</style>
<header>
  <div class="header_header">
    <div class="header_title">
      <h2 id="site_name">AMEブログ</h2>
    </div>
    <div class="search_section">
      <ul>
        <?php echo $this->Form->create('Post', array('novalidate' => true, 'url' => array_merge(
          array('action' => 'index'), $this->params['pass']) )); ?>
        <li class="search_box">
          <?php
            echo $this->Form->input('keyword', array('label' => '', 'empty' => true, 'placeholder' => 'キーワード検索', 'size' => '25'));
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
    <div class="header_category_inner">
      <nav>
        <ul>
          <?php if (isset($_SESSION['Auth']['User']['username'])): ?>
            <li><a><?php echo $this->Html->link(__('MyPage'), array('controller' => 'users', 'action' => 'view', $_SESSION['Auth']['User']['id']),
                                                             array('role' => "presentation")); ?> </a></li>
          <?php endif;?>
          <li><a><?php echo $this->Html->link(__('Article create'), array('controller' => 'posts', 'action' => 'add'),
                                                          array('role' => "presentation")); ?></a></li>
      		<li><a><?php echo $this->Html->link(__('List of articles'), array('controller' => 'posts','action' => 'index'),
                                                         array('role' => "presentation")); ?></a></li>
      		<li><a><?php echo $this->Html->link(__('Category'), array('controller' => 'categories', 'action' => 'index'),
                                                          array('role' => "presentation")); ?> </a></li>
      		<li><a><?php echo $this->Html->link(__('Tag'), array('controller' => 'tags', 'action' => 'index'),
                                                      array('role' => "presentation")); ?> </a></li>
          <li><a><?php echo $this->Html->link(__('Contact'), array('controller' => 'contacts', 'action' => 'contact'),
                                                      array('role' => "presentation")); ?> </a></li>
          <?php if ($_SESSION['lang'] === 'eng'): ?>
            <?php if ($this->action === 'view' || $this->action === 'edit'): ?>
              <?php if (isset($post['Post']['id'])){
                      $id = $post['Post']['id'];
                    } elseif (isset($user['User']['id'])){
                      $id = $user['User']['id'];
                    } elseif (isset($category['Category']['id'])){
                      $id = $category['Category']['id'];
                    }
              ?>
              <li><a><?php echo $this->Html->link(__('japanese'), array('controller' => $this->name, 'action' => $this->action . "/" . $id, 'parameter' => 'jpn'),
                                                            array('role' => 'presentation', 'class' => 'language')); ?></a></li>
            <?php else: ?>
              <li><a><?php echo $this->Html->link(__('japanese'), array('controller' => $this->name, 'action' => $this->action, 'parameter' => 'jpn'),
                                                            array('role' => 'presentation', 'class' => 'language')); ?></a></li>
            <?php endif; ?>
            <?php else: ?>
            <?php if ($this->action === 'view' || $this->action === 'edit'): ?>
              <?php if (isset($post['Post']['id'])){
                      $id = $post['Post']['id'];
                    } elseif (isset($user['User']['id'])){
                      $id = $user['User']['id'];
                    } elseif (isset($category['Category']['id'])){
                      $id = $category['Category']['id'];
                    }
              ?>
              <li><a><?php echo $this->Html->link(__('English'), array('controller' => $this->name, 'action' => $this->action . "/" . $id, 'parameter' => 'eng'),
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
  </div>
</header>
