<style>
  #contact_confirm_form {
    width: 400px;
    margin: 0 auto;
    margin-top: 40px;
    text-align: center;

  }
  #contact_confirm_details {
    border: solid 1px;
  }
  .contact_confirm_name {
    padding: 10px;
    text-align: left;
    background-color: #A9A9A9;
  }
  .contact_confirm_value{
    padding: 20px;
  }
  #contact_confirm_bottun {
    margin: 10px;
  }
</style>
<div id="contact">
  <div id="contact_confirm_form">
    <p>以下の内容で作成します。よろしいですか？</p>
    <div id="contact_confirm_details">
      <dl>
      <?php foreach ($this->request->data['Contact'] as $name => $val): ?>
          <dt class="contact_confirm_name"><?php echo h($name); ?></dt>
          <dd class="contact_confirm_value"><?php echo h($val); ?></dd>
      <?php endforeach; ?>
      </dl>
    </div>
    <div id=contact_confirm_bottun>
      <?php
      echo $this->Form->create('Contact');

      foreach ($this->request->data['Contact'] as $name => $val) {
          echo $this->Form->hidden($name, array('value' => $val));
      }

      echo $this->Form->button('修正する', array(
              'type' => 'submit',
              'name' => 'confirm',
              'value' => 'revise'
          ));

      echo $this->Form->button('送信する', array(
              'type' => 'submit',
              'name' => 'confirm',
              'value' => 'send'
          ));

      echo $this->Form->end();
      ?>
    </div>
  </div>
</div>
