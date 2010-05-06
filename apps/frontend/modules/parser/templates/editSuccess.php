<h1>Редактирование фильтра</h1>
<?php if ($owner): ?>
  <?php include_partial('parser_form', array('form' => $form, 'errors' => $errors, 'form_action'=> $form_action)) ?>

  <div  class="links_list">
	<a href="<?php echo url_for('parser/index') ?>">Перейти к списку фильтров</a>
	<a href="<?php echo url_for('parser/show?id='.$id) ?>">Просмотр фильтра</a>
	<?php if ($owner): ?>
	  <a class="delete" href="<?php echo url_for('parser/delete?id='.$id) ?>" onclick="return confirm('Вы действительно хотите удалить этот фильтр?');">Удалить фильтр</a>
	<?php endif; ?>
  </div>
  <br />
  <hr />
  <?php $strContent = $sf_data->getRaw('strMawsParserContent'); ?>
  <h2>Проверочное получение результатов фильтра</h2>
  <pre>
  <?php print_r($MawsParser) ?>
  </pre>
  <table border="1" cellpadding="5" cellspacing="1">
	<tbody align="left">
	  <?php if (((is_array($strContent)) && (count($strContent) > 0))
			|| ((is_string($strContent)) && (strlen($strContent) > 0))): ?>
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
		  <tr>
			<td style="color:red">
			  Нет результатов.
			</td>
		  </tr>
		<?php endif; ?>
	  <tr>
		<td colspan="2">Загруженные данные:</td>
	  </tr>
	  <tr>
		<td colspan="2">
		<?php
		  
		  if (is_array($strContent))
		  {
			$i=1;
			echo('<table border="1" cellpadding="5" cellspacing="1">');
			foreach ($strContent as $content)
			{
			  echo('<tr><td>#'.$i.'</td><td>'. nl2br($content).'</td></tr>');
			  $i++;
			}
			echo('</table>');
		  }
		  else
		  {
			echo (nl2br($strContent));
		  }
		  ?>
		</td>
	  </tr>
	  <?php else: ?>
	  <tr>
		<td colspan="2">Не удалось загрузить данные для фильтра!</td>
	  </tr>
	  <?php endif; ?>
	</tbody>
  </table>
  <br />
<?php else: ?>
  Это не ваш фильтр, вы не можете его редактировать.
  <div  class="links_list">
	<a href="<?php echo url_for('parser/index') ?>">Перейти к списку фильтров</a>
	<a href="<?php echo url_for('parser/show?id='.$id) ?>">Просмотр фильтра</a>
	<?php if ($owner): ?>
	  <a class="delete" href="<?php echo url_for('parser/delete?id='.$id) ?>" onclick="return confirm('Вы действительно хотите удалить этот фильтр?');">Удалить фильтр</a>
	<?php endif; ?>
  </div>
  <br />
  <hr />
<?php endif; ?>
