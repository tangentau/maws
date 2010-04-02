<span class="auth">
<table>
  <tr>
    <td>
	  <?php print_r($UserName); ?>
	</td>
	<?php if ($isAnonymous): ?>
	<td>
	  <?php include_stylesheets_for_form($login_form) ?>
	  <?php include_javascripts_for_form($login_form) ?>
	  <form method="post" action="<?php echo url_for('main/login') ?>">
		<span style="text-align: right; float:left;">
		  <label for="signin_username">Username</label><input name="signin[username]" id="signin_username" type="text" class="slim"><br />
		  <label for="signin_password">Password</label><input name="signin[password]" id="signin_password" type="password" class="slim">
		</span>
		<span style="text-align: right; float:right;">
		  <label for="signin_remember">Remember</label><input name="signin[remember]" id="signin_remember" type="checkbox" class="slim"><br />
		  <input type="submit" class="slim" value="sign in">
		</span>
	  </form>
	</td>
	<td>
	  <?php echo link_to('register', 'main/register') ?><br />
	  <?php echo link_to('password', 'main/password') ?>
	</td>
	<?php else: ?>
	<td>
	  <?php echo link_to('logout', 'main/logout') ?>
	</td>
	<?php endif; ?>
	</tr>
  </table>
</span>

