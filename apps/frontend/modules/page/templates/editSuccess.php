<h1>Редактирование сводки</h1>
<?php if ($owner): ?>
  <?php include_partial('page_form', array('form' => $form, 'errors' => $errors, 'form_action'=> $form_action)) ?>
<?php else: ?>
  Это не ваша сводка, вы не можете её редактировать.
<?php endif; ?>

<div class="links_list">
  <a href="<?php echo url_for('page/show?id='.$id) ?>">Просмотр сводки</a>
  <a href="<?php echo url_for('page/index') ?>">Перейти к списку сводок</a>
  <?php if ($owner): ?>
	<a class="delete" href="<?php echo url_for('page/delete?id='.$id) ?>" onclick="return confirm('Вы действительно хотите удалить эту сводку?');">Удалить сводку</a>
  <?php endif; ?>
</div>