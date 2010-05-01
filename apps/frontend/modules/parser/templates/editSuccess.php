<h1>Редактирование фильтра</h1>
<?php if ($owner): ?>
  <?php include_partial('parser_form', array('form' => $form, 'errors' => $errors, 'form_action'=> $form_action)) ?>
<?php else: ?>
  Это не ваш фильтр, вы не можете его редактировать.
<?php endif; ?>
<div  class="links_list">
  <a href="<?php echo url_for('parser/index') ?>">Перейти к списку фильтров</a>
  <a href="<?php echo url_for('parser/show?id='.$id) ?>">Просмотр фильтра</a>
  <?php if ($owner): ?>
	<a class="delete" href="<?php echo url_for('parser/delete?id='.$id) ?>" onclick="return confirm('Вы действительно хотите удалить этот фильтр?');">Удалить фильтр</a>
  <?php endif; ?>
</div>
<br />
<hr />

<h2>Проверочное получение результатов фильтра</h2>

<table border="1" cellpadding="5" cellspacing="1">
  <tbody align="left">
	<?php if (strlen($strMawsParserContent) > 0): ?>
	<tr>
	  <td colspan="2">
		<h2>Результаты фильтра:</h2>
	  </td>
	</tr>
	  <?php if (count($arMawsParserResults) > 0): ?>
		<?php foreach ($arMawsParserResults as $i => $value): ?>
		<tr>
		  <th>#<?php echo $i+1 ?>:</th>
		  <td><?php echo $value ?></td>
		</tr>
		<?php endforeach; ?>
	  <?php else: ?>
		Нет результатов.
	  <?php endif; ?>
	<tr>
      <td colspan="2">Загруженные данные:</td>
    </tr>
	<tr>
      <td colspan="2"><?php echo $strMawsParserContent ?> </td>
    </tr>
	<?php else: ?>
	<tr>
      <td colspan="2">Не удалось загрузить данные для фильтра!:</td>
    </tr>
	<?php endif; ?>
  </tbody>
</table>
<br />