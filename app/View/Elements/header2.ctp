<style>
.header_header{
  height: 200px;
  width: 960px;
  margin-left: 40px;
  margin-right: 40px;
  margin: 0 auto;
  margin-top: 20px;
  padding-top: 20px;
  background-image: url("/AclTest/images/syurijo.png"),
										url("/AclTest/images/header_shisa.png"),
										url("/AclTest/images/header_shisa2.png"),
                    url("/AclTest/images/haibisukasu.png");
	background-size: 400px 200px,
									 140px 140px,
									 140px 140px,
                   180px 180px;
	background-repeat: no-repeat,
										 no-repeat,
										 no-repeat,
                     no-repeat;
	background-position: center,
											 138px 56px,
    									 684px 56px,
                       10px 0px;
	background-attachment: local,local,local,local;
}
.header_title{
  float: left;
  margin-bottom: 100px;
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
    display: table;
    table-layout: fixed;
    width: 100%;
    margin: 0;
    padding: 0;
    text-align: center;
    table-layout:fixed
  }
  nav li{
    display: table-cell;
    vertical-align: middle;
    /*display: inline;*/
    margin-left: 26px;
    margin: 0;
    padding: 10px;
    border-left: 1px solid white;
  }
  .list_logout {
    border-right: 1px solid white;
  }
  nav a{
    text-decoration: none;
  }
  nav a:hover{
    color: #69c;
    position: relative;
    top:2px;
    left:2px;
  }
  nav li a{
    color: white;
    font-size: 18px;
  }
  #site_name {
    font-size: 30px

  }
  ul{
    list-style: none;
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
            <li><?php echo $this->Html->link(__('MyPage'), array('controller' => 'users', 'action' => 'view', $_SESSION['Auth']['User']['id']),
                                                             array('role' => "presentation")); ?> </li>
          <?php endif;?>
          <li><?php echo $this->Html->link(__('Article create'), array('controller' => 'posts', 'action' => 'add'),
                                                          array('role' => "presentation")); ?></li>
      		<li><?php echo $this->Html->link(__('List of articles'), array('controller' => 'posts','action' => 'index'),
                                                         array('role' => "presentation")); ?></li>
      		<li><?php echo $this->Html->link(__('Category'), array('controller' => 'categories', 'action' => 'index'),
                                                          array('role' => "presentation")); ?> </li>
      		<li><?php echo $this->Html->link(__('Tag'), array('controller' => 'tags', 'action' => 'index'),
                                                      array('role' => "presentation")); ?> </li>
          <li><?php echo $this->Html->link(__('Contact'), array('controller' => 'contacts', 'action' => 'contact'),
                                                      array('role' => "presentation")); ?> </li>
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
              <li><?php echo $this->Html->link(__('japanese'), array('controller' => $this->name, 'action' => $this->action . "/" . $id, 'parameter' => 'jpn'),
                                                            array('role' => 'presentation', 'class' => 'language')); ?></li>
            <?php else: ?>
              <li><?php echo $this->Html->link(__('japanese'), array('controller' => $this->name, 'action' => $this->action, 'parameter' => 'jpn'),
                                                            array('role' => 'presentation', 'class' => 'language')); ?></li>
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
              <li><?php echo $this->Html->link(__('English'), array('controller' => $this->name, 'action' => $this->action . "/" . $id, 'parameter' => 'eng'),
                                                          array('role' => 'presentation', 'class' => 'language')); ?></li>
            <?php else: ?>
              <li><?php echo $this->Html->link(__('English'), array('controller' => $this->name, 'action' => $this->action, 'parameter' => 'eng'),
                                                          array('role' => 'presentation', 'class' => 'language')); ?></li>
            <?php endif; ?>
          <?php endif; ?>
          <?php if (!isset($_SESSION['Auth']['User']['username'])): ?>
            <li class="list_logout"><?php echo $this->Html->link(__('Login'), array('controller' => 'users', 'action' => 'login')) ?></li>
          <?php else: ?>
            <li class="list_logout"><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'),
                                                           array('confirm' => __('本当にログアウトしますか？'))); ?></li>
          <?php endif; ?>
      	</ul>
      </nav>
    </div>
  </div>
</header>
