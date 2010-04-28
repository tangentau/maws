<table  border="1" cellpadding="5" cellspacing="1">
  <tbody>
    <tr>
      <th>Название</th>
	  <th>Описание</th>
	  <th>Тип</th>
	  <th>Доступ к ленте</th>
	  <th>Используемый фильтр</th>
	  <th>Начало обновления</th>
	  <th>Частота обновления, с</th>
	  <th>Последнее обновление</th>
    </tr>
    <tr>
      <td><?php echo $MawsThread->getName() ?></td>
      <td><?php echo $MawsThread->getDescription() ?></td>
      <td><?php echo $MawsThread->getResultType(1) ?></td>
      <td><?php echo $MawsThread->getAccess(1) ?></td>
      <td>[<?php echo $MawsThread->getParserId() ?>] <?php echo $MawsThread->strParserName ?></td>
      <td><?php echo $MawsThread->getUpdateStart() ?></td>
      <td><?php echo $MawsThread->getUpdatePeriod() ?></td>
      <td><?php echo $MawsThread->getCheckedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />
<h1>Содержимое ленты</h1>
<?php $MawsThreadContent = $sf_data->getRaw('MawsThreadContent'); ?>
<?php if (count($MawsThreadContent) > 0): ?>
<table  border="1" cellpadding="5" cellspacing="1" >
  <tbody>
    <tr>
	  <th>id</th>
      <th>Время</th>
	  <th>#</th>
	  <th>Результат</th>
    </tr>
	<?php foreach($MawsThreadContent as $res): ?>
	  <?php $arRes = unserialize($res->getResult()); ?>
	  <?php $date_time = str_replace(' ', '<br />',$res->getCreatedAt()); ?>
	  <?php if (count($arRes) > 0) { $rowspan = count($arRes); } else { $rowspan = 1; } ?>
	  <tr>
		<td rowspan="<?php echo $rowspan ?>"><?php echo $res->getID() ?></td>
		<td rowspan="<?php echo $rowspan ?>"><?php echo $date_time ?></td>
		<?php if (count($arRes) > 0): ?>
		  <?php foreach($arRes as $i => $result): ?>
			  <?php if ($i>=1): ?>
				</tr>
				<tr>
			  <?php endif; ?>
				<td>
				  #<?php echo $i+1 ?>
				</td>
				<td>
				  <?php echo $result ?>
				</td>
			  <?php if ($i==($rowspan-1)): ?>
				</tr>
			  <?php endif; ?>
			  <?php endforeach; ?>
			<?php else: ?>
			  <td>
				Нет результатов.
			  </td>
			  </tr>
			<?php endif; ?>
	<?php endforeach; ?>
  </tbody>
</table>
<?php else: ?>
  Нет результатов.
<?php endif; ?>
<hr />
<div>
  <a href="<?php echo url_for('thread/edit?id='.$MawsThread->getId()) ?>">Редактировать ленту</a>
  <br />
</div>
<div>
  <a href="<?php echo url_for('thread/delete?id='.$id) ?>" onclick="return confirm('Вы действительно хотите удалить эту ленту?');">Удалить ленту</a>
  <br />
</div>
<div>
  <a href="<?php echo url_for('thread/index') ?>">Перейти к списку</a>
  <br />
</div>


