<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
	<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="/js/colorpicker.js"></script>
	<script type="text/javascript" src="/js/eye.js"></script>
	<script type="text/javascript" src="/js/utils.js"></script>
	<?php include_stylesheets() ?>
    <?php include_javascripts() ?>
	<link rel="stylesheet" media="screen" type="text/css" href="/css/colorpicker.css" />
  </head>
  <body>
    <div class="body">
	  <div class="header">
		<div class="menu">
		  <?php include_component('main', 'MenuHeader') ?>
		</div>
		<div class="auth">
		  <?php include_component('main', 'AuthHeader') ?>
		</div>
	  </div>
	  <div class="content">
		<?php echo $sf_content ?>
	  </div>
	  <div class="clearfloat"></div>
	  <div class="empty"></div>
	</div>
	<div class="footer">
	  <?php include_partial('main/footer') ?>
	</div>
  </body>
</html>
