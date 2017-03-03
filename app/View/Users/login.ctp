<div class="container">
  <h2>Please sign in</h2>
  <?php
  echo $this->Form->create('User', array(
      'url' => array(
          'controller' => 'users',
          'action' => 'login'
      )
  ));
  echo $this->Form->input('User.username', array('type' => "username", 'class' => "form-control", 'style' => "width:250px"));
  echo $this->Form->input('User.password', array('type' => "password", 'class' => "form-control", 'style' => "width:250px;"));
  echo $this->Form->end(array('label' => 'Login', 'class' => "btn btn-lg btn-primary btn-block", 'style' => "width:250px;"));
  ?>
</div>
