<h1>Редактирование фильтра</h1>

<?php include_partial('parser_form', array('form' => $form, 'errors' => $errors, 'form_action'=> $form_action)) ?>

<div>
  <a href="<?php echo url_for('parser/show?id='.$id) ?>">Просмотр фильтра</a>
  <br />
</div>
<div>
  <a href="<?php echo url_for('parser/delete?id='.$id) ?>" onclick="return confirm('Вы действительно хотите удалить этот фильтр?');">Удалить фильтр</a>
  <br />
</div>