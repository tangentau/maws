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
  <?php if ($MawsThread->getResultType() == MawsThread::STRING_RES): ?>
  <table  border="1" cellpadding="5" cellspacing="1" >
	<tbody>
	  <tr>
		<th>Время</th>
		<th>#</th>
		<th>Результат</th>
	  </tr>
	  <?php foreach($MawsThreadContent as $res): ?>
		<?php $arRes = unserialize($res->getResult()); ?>
		<?php $date_time = str_replace(' ', '<br />',$res->getCreatedAt()); ?>
		<?php if (count($arRes) > 0) { $rowspan = count($arRes); } else { $rowspan = 1; } ?>
		<tr>
		  <td rowspan="<?php echo $rowspan ?>"><span title="<?php echo $res->getID() ?>"><?php echo $date_time ?></span></td>
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
  <table  border="1" cellpadding="5" cellspacing="1" >
	<tbody>
	  <tr>
		<th>Время</th>
		<th>Результаты</th>
		<th>Мин.</th>
		<th>Макс.</th>
		<th>Среднее</th>
		<th>Сумма</th>
		<th>Количество</th>
	  </tr>
	  <?php foreach($MawsThreadContent as $res): ?>
		<?php $arRes = unserialize($res->getResult()); ?>
		<?php foreach($arRes as $i => $n): ?>
		  <?php $arRes[$i] = toolBox::floatval($n); ?>
		<?php endforeach; ?>
		<?php $ar_sum = array_sum($arRes); ?>
		<?php $ar_count = count($arRes); ?>
		<?php $date_time = str_replace(' ', '<br />',$res->getCreatedAt()); ?>
		<tr>
		  <td><span title="<?php echo $res->getID() ?>"><?php echo $date_time ?></span></td>
		  <?php if (count($arRes) > 0): ?>
		  <td>
			<?php echo implode(', ',$arRes) ?>
		  </td>
		  <td>
			<?php echo min($arRes) ?>
		  </td>
		  <td>
			<?php echo max($arRes) ?>
		  </td>
		  <td>
			<?php echo round($ar_sum/$ar_count,2) ?>
		  </td>
		  <td>
			<?php echo $ar_sum ?>
		  </td>
		  <td>
			<?php echo $ar_count ?>
		  </td>
		  <?php else: ?>
		  <td>
			  Нет результатов.
		  </td>
		  <td>
			  0
		  </td>
		  <td>
			  0
		  </td>
		  <td>
			  0
		  </td>
		  <td>
			  0
		  </td>
		  <td>
			  0
		  </td>
		  <?php endif; ?>
		</tr>
	  <?php endforeach; ?>
	</tbody>
  </table>
  <?php endif; ?>
<?php else: ?>
  Нет результатов.
<?php endif; ?>
<hr />
<div class="links_list">
  <a href="<?php echo url_for('thread/index') ?>">Перейти к списку лент</a>
  <?php if ($owner): ?>
  <a href="<?php echo url_for('thread/edit?id='.$MawsThread->getId()) ?>">Редактировать ленту</a>
  <a class="delete" href="<?php echo url_for('thread/delete?id='.$id) ?>" onclick="return confirm('Вы действительно хотите удалить эту ленту?');">Удалить ленту</a>
  <?php endif; ?>
</div>


