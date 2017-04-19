<div id='add_comment'>
  <div class="add_comment_contain">
    <h4>コメントを書く</h4>
    <?php if (!isset($user['id'])): ?>
      <?php $user['id'] = -1; ?>
    <?php endif;?>
    <?php
    echo $this->Form->create('Comment', array('url' => array(
                                          'controller' => 'comments', 'action' => 'edit'),
                                          ));
    echo $this->Form->input('commenter', array('label' => '名前'));
    echo $this->Form->input('body', array('label' => '本文', 'row'=>3));
    echo $this->Form->input('Comment.id', array('type'=>'hidden', 'value'=>$comments['Comment']['id']));
    // echo $this->Form->input('status', array('type' => 'hidden', 'value' => 0));
    // echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $user['id']));
    echo $this->Form->end('投稿する');
    ?>
  </div>
</div>
