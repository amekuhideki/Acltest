<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
	<title>
		<?php echo __('CakePHP: the rapid development php framework:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
    <!-- Bootstrap -->
	<?php echo $this->Html->css('bootstrap.min'); ?>
  <?php echo $this->Html->css('bootstrap.min.css'); ?>
  <!-- JQuery -->
  <!-- <?php echo $this->Html->css('lightbox.css') ?> -->
  <!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.0.js"></script> -->
  <!-- <?php echo $this->Html->script('jquery-1.9.0.min'); ?> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/humanity/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js
"></script>

  <!-- Le styles -->
  <?php echo $this->Html->css('common.css'); ?>
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <?php $ua = env('HTTP_USER_AGENT'); ?>
    <?php if ((strpos($ua, 'iPhone') !== false) || (strpos($ua, 'iPad') !== false) || strpos($ua, 'Android') !== false): ?>
      <div id="wrapper_sm">
    <?php else: ?>
      <div id='flash_message'>
        <?php echo $this->Session->flash(); ?>
      </div>
      <div id="wrapper">
      <?php endif; ?>
      
      <?php echo $this->fetch('content'); ?>
      <!-- <?php $ua = env('HTTP_USER_AGENT'); ?>
      <?php if ((strpos($ua, 'iPhone') !== false) || (strpos($ua, 'iPad') !== false) || strpos($ua, 'Android') !== false): ?>
        <?php echo $this->element('footer_sm'); ?>
      <?php else: ?>
        <?php echo $this->element('footer'); ?>
      <?php endif; ?> -->
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php echo $this->Html->script('bootstrap.min'); ?>
    <?php echo $this->fetch('script'); ?>
    <!-- <?php echo $this->Html->script('lightbox.js')?> -->
    <?php echo $this->Js->writeBuffer(); ?>
  </body>
</html>
