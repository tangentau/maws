<?php if ($NewUser): ?>
  <h1>Поздравляем с успешной регистрацией!</h1>

  Теперь вы можете авторизоваться и получить доступ ко всем возможностям МАВС.
<?php endif; ?>

<h1>Список пользователей МАВС</h1>
<table border="1" cellpadding="5" cellspacing="1">
  <thead>
    <tr>
      <th>Id</th>
      <th>Логин</th>
      <th>Зарегистрировался</th>
      <th>Последний раз заходил на сайт</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($sfGuardUsers as $sfGuardUser): ?>
    <tr>
      <td><?php echo $sfGuardUser->getId() ?></td>
      <td>
		<?php if ($UserId == $sfGuardUser->getId()): ?>
			  <a href="<?php echo url_for('user/show?id='.$sfGuardUser->getId()) ?>"><?php echo $sfGuardUser->getUsername() ?></a>
		<?php else: ?>
			  <?php echo $sfGuardUser->getUsername() ?>
		<?php endif; ?>
	  </td>
      <td><?php echo $sfGuardUser->getCreatedAt() ?></td>
      <td><?php echo $sfGuardUser->getLastLogin() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<hr />
<div class="links_list">
  <a href="<?php echo url_for('user/new') ?>">Зарегистрировать нового пользователя</a>
</div>
  
