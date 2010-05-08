<?php if(isset($form)): ?>
  <h1>Редактирование пользовательских настроек</h1>
  <?php include_partial('form', array('form' => $form)) ?>


  <div class="links_list">
	<a href="<?php echo url_for('user/index') ?>">К списку пользователей</a>
  </div>
<?php else: ?>
  <h1>Доступ закрыт</h1>
<?php endif; ?>

