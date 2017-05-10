<style>
.header{
	border-bottom: 1px solid #000;
}
#edit {
}
.content {
	width: 800px;
	margin: 0 auto;

}
.content_detail {
	padding: 40px;
	margin: 10px;
	margin-top: 30px;
	border: 1px solid black;
}
.annotation {
	font-size: 12px;
	text-align: left;
}
.user_conf {
	float: left;
	margin-right: 100px;
}
.user_introduction {
	float: left;
}
.content_footer {
	clear: left;
}
</style>
<div id="edit">
	<div class="users form">
		<div class="header">
			<?php echo $this->element('header2'); ?>
		</div>
		<div class="content">
			<div class="content_detail">
				<fieldset>
					<legend><?php echo __('Edit User'); ?></legend>
					<div class="user_conf">
						<?php echo $this->Form->create('User'); ?>

						<?php
							echo $this->Form->input('id');
						?>
						<?php
							echo $this->Form->input('username');
						?>
						<?php
							echo $this->Form->input('password_edit', array('label' => 'Password', 'value' => '', 'type' => 'password'));
						?>
						<p class="annotation">
							<?php
								echo __('*入力しない場合、変更はありません。');
							?>
						</p>
					</div>
					<div class="user_introduction">
						<?php
							echo $this->Form->input('introduction', array('type' => 'textarea', 'style' => 'width:350px; height:180px'));
						?>
					</div>
					<div class="content_footer">
						<?php
							echo $this->Form->end(__('Submit'));
						?>
					</div>
				</fieldset>
			</div>
		</div>
	</div>
</div>
