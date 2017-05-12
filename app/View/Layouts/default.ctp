<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?php echo __('CakePHP: the rapid development php framework:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
    <!-- Bootstrap -->
	<?php echo $this->Html->css('bootstrap.min'); ?>

  <!-- JQuery -->
  <!-- <?php echo $this->Html->css('lightbox.css') ?> -->
  <!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.0.js"></script> -->
  <?php echo $this->Html->script('jquery-1.9.0.min'); ?>
  <!-- Le styles -->
	<style>
    html {
      /*padding-top: 50px;*/
      padding-left: 100px;
      padding-right: 100px;
      padding-bottom: 100px;
      /*padding-top: 10px;*/
     /*background: #ebe6d3;*/
     font: 16px/20px "ヒラギノ角ゴ Pro W3","Hiragino Kaku Gothic Pro",'メイリオ',Meiryo,Helvetica,Arial,Sans-Serif;
     color: #666;
}

a{ color: #69c;}
     a:hover{color:#069;}
    }
    .starter-template {
      padding: 40px 15px;
      text-align: center;
    }
    #flash_message {
      width: 960px;
    }
    #wrapper {
      width: 960px;
      margin: 0 auto;
    }
    /*.footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      height: 100%;
    }
    .content {
      padding-bottom: 100px;
    }*/
	</style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div id='flash_message'>
      <?php echo $this->Session->flash(); ?>
    </div>
    <div id="wrapper">
      <?php echo $this->fetch('content'); ?>
      <?php echo $this->element('footer'); ?>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php echo $this->Html->script('bootstrap.min'); ?>
    <?php echo $this->fetch('script'); ?>
    <!-- <?php echo $this->Html->script('lightbox.js')?> -->
    <?php echo $this->Js->writeBuffer(); ?>
  </body>
</html>
