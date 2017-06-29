<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<style>
	.container{
		width: 400px;
		padding-top: 100px;
	}
	.center{
			margin: 0 auto;
			width: 100%;
			padding: 15px;
			border: solid 1px;
	}
	h2{
		text-align: center;
	}
	.text{
		text-align: center;
	}

</style>
<div class="users form">
	<div class="container">
		<div class="center">
			<?php echo $this->Form->create('User'); ?>
			<fieldset>
				<div class="form-group">
					<legend><h2><?php echo __('アカウント作成'); ?></h2></legend>
				</div>
				<div class="form-group">
					<?php if (isset($this->Session->read()['sns_auth']['username'])): ?>
						<?php echo $this->Form->input('username', array('label' => "アカウント名", 'class' => "form-control", 'value' => $this->Session->read()['sns_auth']['username'])); ?>
					<?php else: ?>
						<?php
							echo $this->Form->input('username', array('label' => "アカウント名", 'class' => "form-control"));
						?>
					<?php endif; ?>
				</div>
				<div>
					<?php if (isset($this->Session->read()['sns_auth']['email'])): ?>
						<?php echo $this->Form->input('email', array('label' => "メールアドレス", 'class' => "form-control", 'value' => $this->Session->read()['sns_auth']['email'])); ?>
					<?php else: ?>
						<?php 
							echo $this->Form->input('email', array('label' => "メールアドレス", 'class' => "form-control"));
						?>
				<?php endif; ?>
				</div>
				<div class="form-group">
					<?php
						echo $this->Form->input('password', array('label' => "パスワード", 'class' => "form-control"));
					?>
				</div>
				<div>
					<?php 
						echo $this->Form->input('password_confirm', array('label' => "パスワード(確認)", 'type' => 'password', 'class' => "form-control")); ?>
				</div>
				<div class="form-group">
					<?php
						echo $this->Form->input('group_id', array('type' => 'hidden', 'label' => "権限", 'class' => "form-control", 'value' => '3'));
					?>
				</div>
			</fieldset>
			<div class="form-group">
				<?php echo $this->Form->end(array('label' => "アカウント作成", 'class' => "btn btn-primary form-control")) ?>
			</div>
			<div>
				<div class="text">
					<?php echo $this->Html->link(__('サインイン'), array('action' => 'login')) ?>
				</div>
			</div>
		</div>
	</div>
</div>
