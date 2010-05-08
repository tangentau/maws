<?php if ($access): ?>
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
		<?php if ((count($arRes) == 1) && ($arRes[0]==MawsParser::EMPTY_FILTER_RESULT)): ?>
			<tr>
			  <td><span title="<?php echo $res->getID() ?>"><?php echo $date_time ?></span></td>
			  <td colspan="2">
				Пусто.
			  </td>
			</tr>
		<?php else: ?>
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
				  Нет результатов.
				</td>
				</tr>
			  <?php endif; ?>
		<?php endif; ?>


		
	  <?php endforeach; ?>
	</tbody>
  </table>
  <?php else: ?>
<br>
<h3>График</h3>
<script type="text/javascript">

  $(document).ready(function(){

	var options = {
	  series: {
		lines: { show: true },
		points: { show: true }
	  },
	  xaxis: {
                mode: "time"
			 }
	};

	var data = <?php
  $matrix = array();
  $i=0;

  if (!$col)
  {
	$col = each(MawsThread::$arGraphColumns);
	$colName = $col['value'];
	$col = $col['key'];
  }
  else
  {
	$colName = MawsThread::$arGraphColumns[$col];
  }

	$matrix = array(
						  'label' => $MawsThread->getName().' ('.$colName.')',
						  'lines' => array('show' => true, 'steps' => true),
						  'color' => '#000000',
						);

  $prev_value = array();

  $i = 0;
  krsort($MawsThreadContent);
  
  foreach($MawsThreadContent as $res)
  {
	$arRes = unserialize($res->getResult());
	$date_time = toolBox::dates_interconv('Y-m-d H:i:s', 'U',$res->getCreatedAt()) * 1000;
	foreach($arRes as $j => $n)
	{
	  $arRes['values'][$j] = toolBox::floatval($n);
	}

	if (count($arRes) > 0)
	{
	  $ar_sum = array_sum($arRes['values']);
	  $ar_count = count($arRes['values']);

	  $arRes['min'] = min($arRes['values']);
	  $arRes['max'] = max($arRes['values']);
	  $arRes['mid'] = round($ar_sum/$ar_count,2);
	  $arRes['sum'] = $ar_sum;
	  $arRes['count'] = $ar_count;

	  $matrix['data'][$i] = array($date_time ,floatval($arRes[$col]));
	  $prev_value = floatval($arRes[$col]);
	}
	else
	{
	  if (($smooth) && (isset($prev_value)))
	  {
		$matrix['data'][$i] = array($date_time,$prev_value);
	  }
	  else
	  {
	    $matrix['data'][$i] = array($date_time,0);
	  }
	}
	$i++;
  }

  echo json_encode(array($matrix));
?>;

	$.plot($("#flot"), data, options);

  });

</script>

<div id="flot"></div>
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
<br>

<?php if (isset(MawsThread::$arShowPeriods[$period])): ?>
  <?php $strPeriod = MawsThread::$arShowPeriods[$period]; ?>
<?php else: ?>
  <?php $strPeriod = "$period секунд"; ?>
<?php endif; ?>
Показаны результаты за период: [<?php echo $strPeriod; ?>]
<br>
<br>

<form action="<?php echo url_for('thread/show?id='.$id) ?>" method="get" >
  Показать за:
  <select name="period" id="period">
	<?php foreach (MawsThread::$arShowPeriods as $key => $value): ?>
	  <option value="<?php echo $key?>" <?php if ($period == $key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
	<?php endforeach; ?>
  </select>
<?php if ($MawsThread->getResultType() == MawsThread::FLOAT_RES): ?>
  <br>
  <input type="checkbox" name="smooth" id="smooth" <?php if($smooth): ?>checked="checked"<?php endif; ?>/> <label for="smooth">Сглаживать периоды отсутствия данных на графике</label>
  <br>
  <br>
  График по колонке:
  <select name="col" id="col">
	<?php foreach (MawsPage::$arGraphColumns as $key => $value): ?>
	  <option value="<?php echo $key?>" <?php if ($col == $key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
	<?php endforeach; ?>
  </select>
  <br>
  <?php endif; ?>
  <input type="submit" value="Показать" />
</form>

<hr />
<div class="links_list">
  <a href="<?php echo url_for('thread/index') ?>">Перейти к списку лент</a>
  <?php if ($owner): ?>
  <a href="<?php echo url_for('thread/edit?id='.$MawsThread->getId()) ?>">Редактировать ленту</a>
  <a class="delete" href="<?php echo url_for('thread/delete?id='.$id) ?>" onclick="return confirm('Вы действительно хотите удалить эту ленту?');">Удалить ленту</a>
  <?php endif; ?>
</div>
<?php else: ?>
  Доступ закрыт.
<?php endif; ?>

