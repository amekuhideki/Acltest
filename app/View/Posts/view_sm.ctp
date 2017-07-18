<?php echo $this->Html->css('common.css'); ?>

<script>
$(function() {
  var comment_page = 1 ;
  if (comment_page === <?php echo $comment_page ?>){
    $(".previous").hide();
  }
  var post_id = <?php echo $post['Post']['id']; ?>;
  var comment_total_page = <?php echo $comment_total_page; ?>;
  var div;
  $('.next').click(function(){
    $.ajax({
      type:"POST",
      url:"http://blog.dev/AclTest/Posts/comment/",
      crossDomain: false,
      data: {'comment_page': comment_page + 1,
             'post_id': post_id
            },
      dataType: 'html',
      scriptCharset: 'utf-8',
    }).then(function(data){
      $(".comment_preview").remove();
      console.log(data);
      $(".comment_comment").after().html(data);
      });
      comment_page += 1;
      if(comment_page > 1){
        $('.previous').show();
      }
      if (comment_page >= comment_total_page){
        $('.next').hide();
      }
    });
    //コメント欄の前へを押した時の動作
    $('.previous').click(function(){
      $.ajax({
        type:"POST",
        url: "http://blog.dev/AclTest/Posts/comment/",
        crossDomain: false,
        data: {'comment_page': comment_page - 1,
               'post_id': post_id
               },
        dataType: 'html',
        scriptCharset: 'utf-8',
      }).then(function(data){
        $(".comment_preview").remove();
        console.log(data);
        $(".comment_comment").after().html(data);
        });
        comment_page -= 1;
        if (comment_page <= 1){
          $('.previous').hide();
        }
        if(comment_page < comment_total_page){
          $('.next').show();
        }
      });
  
})
</script>
<div class="posts view">
  <div class="header_sm">
    <?php echo $this->element('header_sm'); ?>
  </div>
  
  <div class="main_sm">
    <div class="main_header_sm">
      <h4><?php echo(__('Article')); ?></h4>
    </div>
    
    <div class="view_content_sm">
      <div class="post_view_header_sm">
        <ul class="view_list", style="list-style:none;">
          <li class="post_view_category">
            <span class="category_badge"><?php echo $this->Html->link($post['Category']['category'], array('controller' => 'categories', 'action' => 'view', $post['Category']['id']), array('style' => 'color:white;')); ?>
            </span>
          </li>
          <li class="post_date">
            <?php 
              $post_date = date('Y年m月d日', strtotime($post['Post']['created']));
              echo h($post_date);
            ?>
            &nbsp;&nbsp;
          </li>
          <li class="post_user">
            <?php if (isset($post['User']['username'])): ?>
              <?php echo $this->Html->link($post['User']['username'], array('action' => 'postUser', $post['User']['id'])); ?>
            <?php else: ?>
              <?php echo (__('ゲストユーザー')); ?>
            <?php endif; ?>
          </li>
        </ul>
      </div>
      
      <div class="view_title_sm">
        <div>
          <h4><?php echo h($post['Post']['title']); ?></h4>
        </div>
      </div>
      
      <div class="social_sm">
        <div class="twitter_sm">
          <a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja" data-count="vertical">ツイート</a>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        </div>
      </div>
      
      <div class="post_view_body_sm">
        <?php echo ($post['Post']['body']); ?>
        &nbsp;
      </div>
      
      <div class="post_image_sm">
        <div class="image_sm">
          <?php if(!empty($post['Image'])): ?>
            <h4><?php echo __('Image list'); ?></h4>
            <ul class="view_image_ul" style="list-style:none">
              <?php foreach ($post['Image'] as $image): ?>
                <div class="image_li_sm">
                <li>
                  <img src=<?php echo '../../files/image/attachment/' . $image["dir"] . "/" . $image["attachment"]; ?> width="98%" class="picture_sm">
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>
      
      <div class="view_item_sm">
        <?php if ($user['id'] === $post['User']['id']): ?>
          <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id']), array('class' => "btn btn-primary btn-sm")); ?>
          ・
          <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $post['Post']['id']), array('class' => 'btn btn-danger btn-sm', 'confirm' => '本当にこの記事を削除しますか？')); ?>
        <?php endif; ?>
      </div>
      
      <div class="post_comment_sm">
        <h4 class='comment_header_sm'><?php echo __('Comments'); ?></h4>
        <div class="comment">
          <div class="comment_comment">
            <?php if (isset($comments[0])): ?>
              <?php foreach($comments as $comment): ?>
                <div class="comment_preview">
                  <div class="comment_commenter">
                    <?php echo $comment['Comment']['commenter']; ?>&nbsp;&nbsp;
                  </div>
                  <div class="comment_created">
                    <?php echo $comment['Comment']['created']; ?><br>
                  </div>
                  <div class="comment_body">
                    <?php echo $comment['Comment']['body']; ?><br>
                  </div>
                  <?php if ($user['id'] === $comment['Comment']['user_id']): ?>
                    <?php echo $this->Html->link(__('編集'), array('controller' => 'comments', 'action' => 'edit', $comment['Comment']['id'])) ?>
                    ・
                    <?php echo $this->Html->link(__('削除'), array('controller' => 'comments', 'action' => 'delete', $comment['Comment']['id']),
                                                            array('confirm' => __('Are you sure you want to delete'))); ?>
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
          </div>
          &nbsp;&nbsp;
          <div id="not_comment">
            <?php echo __('No comment'); ?>
          </div>
          <?php endif; ?>
        </div>
        <div class="comment_pagination">
          <ul class="pagination">
            <li class="previous"><a>前のページ</a></li>&nbsp;
            <?php if (($comment_page * 10) < $comment_total): ?>
            <li class="next"><a>次のページ</a></li>
            <?php endif; ?>
          </ul>
        </div>
        
        <div id='add_comment_sm'>
          <div class="add_comment_contain_sm">
            <h4><?php echo __('Write a comment'); ?></h4>
            <?php if (!isset($user['id'])): ?>
              <?php $user['id'] = -1; ?>
            <?php endif;?>
            <?php echo $this->Form->create('Comment', array('url' => array('controller' => 'comments', 'action' => 'add'),)); ?>
            <form>
              <div class="form-group">
                <label class="col-sm-2"><?php echo (__('Name')); ?></label>
                <?php echo $this->Form->input('commenter', array('label' => false, 'class' => "text_form_sm comment_sm")); ?>
              </div>
                <label class="col-sm-2"><?php echo (__('Body')); ?></label>
              <div class="form-group">
              <?php echo $this->Form->input('body', array('label' => false, 'class' => "text_form_sm comment_sm", 'row'=>3)); ?>
              </div>
              <div class="form-group">
              <?php echo $this->Form->input('Comment.post_id', array('type'=>'hidden', 'value'=>$post['Post']['id'])); ?>
              </div>
              <div class="form-group">
              <?php echo $this->Form->input('status', array('type' => 'hidden', 'value' => 0)); ?>
              </div>
              <div>
              <?php echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $user['id'])); ?>
              </div>
              <div class="form-group">
                <?php echo $this->Form->submit(__('Post'), array('class' => "btn btn-primary btn-xs comment_sm")); ?>
              <?php echo $this->Form->end(); ?>
              </div>
            </form>
          </div>
        </div>
        
      </div>
    </div>
    
  </div>
</div>