<?php echo $this->Html->css('common.css'); ?>
<div class="contact_confirm_sm">
  <div class="header_sm">
    <?php echo $this->element('header_sm'); ?>
  </div>

  <div class="main_sm">
    <div class="main_header_sm">
      <h4><?php echo (__('Contact')); ?> </h4>
    </div>
    <div class="contact_confirm_form_sm">
      <p><?php echo (__('It creates it with the following contents. Is it OK?')); ?></p>
      <div class="add_details_sm">
        <div class="contact_confirm_details_sm">
          <dl>
            <?php foreach ($this->request->data['Contact'] as $name => $val): ?>
              <?php if ($name === 'name'): ?>
                <?php echo (__('Name')); ?>
              <?php elseif ($name === 'email'): ?>
                <?php echo (__('Mail Address')); ?>
              <?php elseif ($name === 'subject'): ?>
                <?php echo (__('Subject')); ?>
              <?php elseif ($name === 'ContactUs'): ?>
                <?php echo (__('Content of inquiry')); ?>
              <?php else: ?>
                <dt class="contact_confirm_name_sm"><?php echo h($name); ?></dt>
              <?php endif; ?>

                <dd class="contact_confirm_value_sm"><?php echo h($val); ?></dd>
            <?php endforeach; ?>
          </dl>
        </div>
        <div class="contact_confirm_bottun_sm">
          <?php
            echo $this->Form->create('Contact');

            foreach ($this->request->data['Contact'] as $name => $val) {
                echo $this->Form->hidden($name, array('value' => $val));
            }

            echo $this->Form->button('修正する', array('type' => 'submit', 'name' => 'confirm', 'value' => 'revise', 'calss' => "btn btn-primary btn-sm"));

            echo $this->Form->button('送信する', array('type' => 'submit', 'name' => 'confirm', 'value' => 'send'));

            echo $this->Form->end();
          ?>
        </div>
      </div>
    </div>
  </div>
  
  
</div>