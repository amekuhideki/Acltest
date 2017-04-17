<?php if (isset($comments[0])): ?>
  <?php foreach ($comments as $comment): ?>
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
    </div>
  <?php endforeach; ?>
<?php endif; ?>
