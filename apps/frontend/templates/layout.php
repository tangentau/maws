<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
	<?php use_javascript('jquery-1.4.2.min.js') ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
	<div id="main">
	  <div class="header">
		<span class="menu">
		  <?php include_component('main', 'MenuHeader') ?>
		</span>
		<span class="auth">
		  <?php include_component('main', 'AuthHeader') ?>
		</span>
	  </div>
	  <div class="body">
		<?php echo $sf_content ?>
	  </div>
	  <div class="footer">
		<?php include_partial('main/footer') ?>
	  </div>
	</div>
  </body>
</html>
