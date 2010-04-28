<h1>Редактирование ленты</h1>

<?php include_partial('thread_form', array('form' => $form, 'errors' => $errors, 'form_action'=> $form_action)) ?>

<div>
  <a href="<?php echo url_for('thread/show?id='.$id) ?>">Просмотр ленты</a>
  <br />
</div>
<div>
  <a href="<?php echo url_for('thread/delete?id='.$id) ?>" onclick="return confirm('Вы действительно хотите удалить эту ленту?');">Удалить ленту</a>
  <br />
</div>
