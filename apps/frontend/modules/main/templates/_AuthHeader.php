<span class="auth">
<table>
  <tr>
    <td>
	  Привет,
	  <div class="username"><?php print_r($UserName); ?></div>
	</td>
	<?php if ($isAnonymous): ?>
	<td>
	  <?php include_stylesheets_for_form($login_form) ?>
	  <?php include_javascripts_for_form($login_form) ?>
	  <form method="post" action="<?php echo url_for('main/login') ?>">
		<span style="text-align: right; float:left;">
		  <label for="signin_username"></label><input name="signin[username]" id="signin_username" type="text" class="slim" value="Логин"><br />
		  <label for="signin_password"></label><input name="signin[password]" id="signin_password" type="password" class="slim" value="Пароль">
		</span>
		<span style="text-align: right; float:right;">
		  <!--<label for="signin_remember">Запомнить меня</label><input name="signin[remember]" id="signin_remember" type="checkbox" class="slim"><br />-->
		  <input type="submit" style="height:45px;" value="Войти">
		</span>
	  </form>
	</td>
	<td>
	  <div class="user_menu">
		<?php echo link_to('Регистрация', 'user/new') ?><br />
		<?php echo link_to('Забыл пароль', 'user/password') ?>
	  </div>
	</td>
	<?php else: ?>
	<td>
	  <div class="user_menu">
		<?php echo link_to('Сменить настройки', 'user/edit?id='.$UserId) ?><br/>
		<?php echo link_to('Выйти', 'main/logout') ?>
	  </div>
	</td>
	<?php endif; ?>
	</tr>
  </table>
</span>

