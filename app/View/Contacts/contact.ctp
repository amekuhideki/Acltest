<?php
echo $this->Session->flash();

echo $this->Form->create('Contact');

echo $this->Form->input('name', array(
        'type' => 'text',
        'label' => 'お名前',
        'maxlength' => 255,
        )
     );

echo $this->Form->input('email', array(
        'type' => 'email',
        'label' => 'メールアドレス',
        'maxlength' => 255,
        )
     );

echo $this->Form->input('subject', array(
        'type' => 'text',
        'label' => '題名',
        'maxlength' => 255,
        )
    );

echo $this->Form->input('body', array(
        'type' => 'textarea',
        'label' => 'お問い合わせ内容',
        'maxlength' => 3000,
        )
    );

echo $this->Form->button('確認する', array(
        'type' => 'submit',
        'name' => 'confirm',
        'value' => 'confirm'
    ));

echo $this->Form->end();
