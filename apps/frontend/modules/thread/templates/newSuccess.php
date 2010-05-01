<h1>Добавление новой ленты</h1>

<?php include_partial('thread_form', array('form' => $form, 'errors' => $errors)) ?>

<div class="links_list">
  <a href="<?php echo url_for('thread/index') ?>">Перейти к списку лент</a>
</div>