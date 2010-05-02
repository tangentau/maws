<h1>Регистрация нового пользователя</h1>

<?php include_partial('form', array('form' => $form)) ?>

<div class="links_list">
  <a href="<?php echo url_for('user/index') ?>">Перейти к списку пользователей</a>
</div>