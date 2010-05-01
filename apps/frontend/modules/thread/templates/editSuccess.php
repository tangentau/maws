<h1>Редактирование ленты</h1>
<?php if ($owner): ?>
  <?php include_partial('thread_form', array('form' => $form, 'errors' => $errors, 'form_action'=> $form_action)) ?>
<?php else: ?>
  Это не ваша лента, вы не можете её редактировать.
<?php endif; ?>
<div class="links_list">
  <a href="<?php echo url_for('thread/index') ?>">Перейти к списку лент</a>
  <a href="<?php echo url_for('thread/show?id='.$id) ?>">Просмотр ленты</a>
  <?php if ($owner): ?>
	<a class="delete" href="<?php echo url_for('thread/delete?id='.$id) ?>" onclick="return confirm('Вы действительно хотите удалить эту ленту?');">Удалить ленту</a>
  <?php endif; ?>
</div>
