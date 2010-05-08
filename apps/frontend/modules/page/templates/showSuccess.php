<h2><?php echo $MawsPage->getName() ?></h2>
<?php if ($access): ?>

<?php $MawsPageResults = $sf_data->getRaw('MawsPageResults'); ?>
<?php if ($MawsPage->getResultType() == MawsPage::STRING_RES): ?>
<script type="text/javascript">

  $(document).ready(function(){

  <?php foreach ($MawsPageThreads as $i => $MawsPageThread): ?>
	  $('.thr_color<?php echo $i ?>').css("background-color", "#<?php echo $MawsPageThread['color'] ?>");
  <?php endforeach; ?>
  });
</script>
  <table border="1" cellpadding="5" cellspacing="1" class="summary">
	<tbody align="left">
		<tr>
		  <th>
			Дата
		  </th>
		  <?php foreach ($MawsPageThreads as $i => $MawsPageThread): ?>
			<td class="thr_color<?php echo $i ?>">
			  <?php echo $MawsPageThread['thread']->getName(); ?>
			</td>
		  <?php endforeach; ?>
		</tr>
		<?php foreach ($MawsPageResults as $i => $MawsPageResult): ?>
		<tr>
		  <td>
			<?php $date_time = str_replace(' ', '<br />',$i); ?>
			<?php echo $date_time ?>
		  </td>
		  <?php foreach ($MawsPageThreads as $MawsPageThread): ?>
			<?php if ((isset($MawsPageResult[$MawsPageThread['id']])) && (is_array($MawsPageResult[$MawsPageThread['id']]))): ?>
			  <?php if ((count($MawsPageResult[$MawsPageThread['id']]['data']) == 0) || ($MawsPageResult[$MawsPageThread['id']]['data'][0]==MawsParser::EMPTY_FILTER_RESULT)): ?>
			  <td>
				Пусто.
			  </td>
			  <?php else: ?>
			  <td class="thr_color<?php echo $MawsPageThread['id'] ?>">
				<table border="1" cellpadding="5" cellspacing="1">
				<?php foreach ($MawsPageResult[$MawsPageThread['id']]['data'] as $j => $MawsParserResult): ?>
				  <tr>
					<td>
					  #<?php echo $j+1 ?>
					</td>
					<td>
					  <?php echo $MawsParserResult ?>
					</td>
				  </tr>
				<?php endforeach; ?>
				</table>
			  </td>
			  <?php endif; ?>
			<?php else: ?>
			  <td>
				
			  </td>
			<?php endif; ?>
		  <?php endforeach; ?>
		</tr>
		<?php endforeach; ?>
	</tbody>
  </table>
<?php else: ?>
<script type="text/javascript">

  $(document).ready(function(){

  <?php foreach ($MawsPageThreads as $i => $MawsPageThread): ?>
	  $('.thr_color<?php echo $i ?>').css("color", "#<?php echo $MawsPageThread['color'] ?>");
  <?php endforeach; ?>
  });
</script>
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
  $j=0;

  if (!$col)
  {
	$col = each(MawsPage::$arGraphColumns);
	$colName = $col['value'];
	$col = $col['key'];
  }
  else
  {
	$colName = MawsPage::$arGraphColumns[$col];
  }
  
  foreach ($MawsPageThreads as $MawsPageThread)
  {

	$matrix[$j] = array(
						  'label' => $MawsPageThread['thread']->getName().' ('.$colName.')',
						  'lines' => array('show' => true, 'steps' => true),
						  'color' => '#'.$MawsPageThread['color'],
						);
	$j++;
  }

  $prev_value = array();
  foreach ($MawsPageResults as $date => $MawsPageResult)
  {
	$date_time = toolBox::dates_interconv('Y-m-d H:i:s', 'U', $date.':00') * 1000;
	$j = 0;
	foreach ($MawsPageThreads as $MawsPageThread)
	{
	  $id = $MawsPageThread['id'];

	  if (isset($MawsPageResult[$id]))
	  {
		$matrix[$j]['data'][$i] = array($date_time,floatval($MawsPageResult[$id][$col]));
		$prev_value[$id] = floatval($MawsPageResult[$id][$col]);
	  }
	  else
	  {
		if (($smooth) && (isset($prev_value[$id])))
	    {
			$matrix[$j]['data'][$i] = array($date_time,$prev_value[$id]);
		}
		else
		{
		  $matrix[$j]['data'][$i] = array($date_time,0);
		}
	  }
	  $j++;
	}
	$i++;
  }

  echo json_encode($matrix);
?>;

	$.plot($("#flot"), data, options);

  });

</script>

<div id="flot"></div>
<br>
<pre>
<?php //print_r($MawsPageResults); ?>
</pre>
<h3>Данные</h3>
<div id="data">
  <table border="1" cellpadding="5" cellspacing="1" class="summary">
	<tbody align="left">
		<tr>
		  <th rowspan="2">
			Дата
		  </th>
		  <?php foreach ($MawsPageThreads as $i => $MawsPageThread): ?>
			<th colspan="6" class="thr_color<?php echo $i ?>">
			  <?php echo $MawsPageThread['thread']->getName(); ?>
			</th>
		  <?php endforeach; ?>
		</tr>
		<tr>
		  <?php foreach ($MawsPageThreads as $i => $MawsPageThread): ?>
			<th class="thr_color<?php echo $i ?>">Результаты
			</th>
			<td class="thr_color<?php echo $i ?>">Мин.
			</td>
			<td class="thr_color<?php echo $i ?>">Макс.
			</td>
			<td class="thr_color<?php echo $i ?>">Среднее
			</td>
			<td class="thr_color<?php echo $i ?>">Сумма
			</td>
			<td class="thr_color<?php echo $i ?>">Кол-во
			</td>
		  <?php endforeach; ?>
		</tr>
		<?php $arColumns = array('data','min','max','mid','sum','count');?>
		<?php foreach ($MawsPageResults as $i => $MawsPageResult): ?>
		<tr>
		  <td>
			<?php $date_time = str_replace(' ', '<br />',$i); ?>
			<?php echo $date_time ?>
		  </td>
		  <?php foreach ($MawsPageThreads as $MawsPageThread): ?>
			<?php $id = $MawsPageThread['id']; ?>
			<?php if (isset($MawsPageResult[$id])): ?>
			  <?php $arRes = $MawsPageResult[$id]; ?>
			  <?php foreach ($arColumns as $column): ?>
			    <td class="<?php echo $column."_".$id ?>"><?php echo $arRes[$column] ?>
			    </td>
			  <?php endforeach; ?>
			<?php else: ?>
				<?php foreach ($arColumns as $column): ?>
				  <td class="empty <?php echo $column."_".$id ?>">
				  </td>
				<?php endforeach; ?>
			<?php endif; ?>
		  <?php endforeach; ?>
		</tr>
		<?php endforeach; ?>
	</tbody>
  </table>
</div>
<?php endif; ?>
<br />
<table border="1" cellpadding="5" cellspacing="1">
  <tbody align="left">
    <tr>
      <th>Описание сводки:</th>
	  <th>Кто имеет доступ<br/> к этой сводке:</th>
	  <th>Тип данных:</th>
	  <th>Владелец:</th>
    </tr>
    <tr>
      <td><?php echo $MawsPage->getDescription() ?></td>
      <td><?php echo $MawsPage->getAccess(1) ?></td>
	  <td><?php echo $MawsPage->getResultType(1) ?></td>
	  <td><?php echo $MawsPage->getOwnerName() ?></td>
    </tr>
  </tbody>
</table>
<br>
<br>
<?php if (isset(MawsPage::$arShowPeriods[$period])): ?>
  <?php $strPeriod = MawsPage::$arShowPeriods[$period]; ?>
<?php else: ?>
  <?php $strPeriod = "$period секунд"; ?>
<?php endif; ?>
Показаны результаты за период: [<?php echo $strPeriod; ?>] <?php if($smooth): ?>, при отсутствии данных на графике показываются предыдущие данные<?php endif; ?>
<br>
<br>
<form action="<?php echo url_for('page/show?id='.$MawsPage->getId()) ?>" method="get" >
  Показать за:
  <select name="period" id="period">
	<?php foreach (MawsPage::$arShowPeriods as $key => $value): ?>
	  <option value="<?php echo $key?>" <?php if ($period == $key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
	<?php endforeach; ?>
  </select>
  <br>
  <?php if ($MawsPage->getResultType() == MawsPage::FLOAT_RES): ?>
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
<br />
<div class="links_list">
  <a href="<?php echo url_for('page/index') ?>">Перейти к списку сводок</a>
  <?php if ($owner): ?>
  <a href="<?php echo url_for('page/edit?id='.$MawsPage->getId()) ?>">Редактировать эту сводку</a>
  <a class="delete" href="<?php echo url_for('page/delete?id='.$MawsPage->getId()) ?>" onclick="return confirm('Вы действительно хотите удалить эту сводку?');">Удалить сводку</a>
  <?php endif; ?>
</div>
<?php else: ?>
  Доступ закрыт.
<?php endif; ?>