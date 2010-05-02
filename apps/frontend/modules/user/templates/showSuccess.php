<h2> Данные пользователя <?php echo $sfGuardUser->getUsername() ?></h2>
<?php if ($owner) :?>
<table border="1" cellpadding="5" cellspacing="1">
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $sfGuardUser->getId() ?></td>
    </tr>
    <tr>
      <th>Логин:</th>
      <td><?php echo $sfGuardUser->getUsername() ?></td>
    </tr>
    <tr>
      <th>e-mail:</th>
      <td><?php echo $sfGuardUser->getAlgorithm() ?></td>
    </tr>
    <tr>
      <th>Главная лента:</th>
      <td><?php echo $sfGuardUser->getAlgorithm() ?></td>
    </tr>
    <tr>
      <th>Главная сводка:</th>
      <td><?php echo $sfGuardUser->getSalt() ?></td>
    </tr>
  </tbody>
</table>
<hr />
<div class="links_list">
  <a href="<?php echo url_for('user/edit?id='.$sfGuardUser->getId()) ?>">Редактировать</a>
  <a href="<?php echo url_for('user/index') ?>">К списку пользователей</a>
</div>
<?php else: ?>
  Доступ закрыт.
<?php endif; ?>
