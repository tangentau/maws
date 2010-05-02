<h2><?php echo $MawsPage->getName() ?></h2>
<?php if ($access): ?>
<script type="text/javascript">

  $(document).ready(function(){

  <?php foreach ($MawsPageThreads as $i => $MawsPageThread): ?>
	  $('.thr_color<?php echo $i ?>').css("color", "#<?php echo $MawsPageThread['color'] ?>");
  <?php endforeach; ?>
  });
</script>
<?php $MawsPageResults = $sf_data->getRaw('MawsPageResults'); ?>
<?php if ($MawsPage->getResultType() == MawsPage::STRING_RES): ?>
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
			  <?php if ((count($MawsPageResult[$MawsPageThread['id']]) == 1) && ($MawsPageResult[$MawsPageThread['id']][0]==MawsParser::EMPTY_FILTER_RESULT)): ?>
			  <td>
				Пусто.
			  </td>
			  <?php else: ?>
			  <td class="thr_color<?php echo $MawsPageThread['id'] ?>">
				<table border="1" cellpadding="5" cellspacing="1">
				<?php foreach ($MawsPageResult[$MawsPageThread['id']] as $j => $MawsParserResult): ?>
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
<br>
<h3>График</h3>
<script type="text/javascript">

  $(document).ready(function(){

	var options = {
	  series: {
		lines: { show: true },
		points: { show: true }
	  }
	};

	var data = <?php
  $matrix = array();
  $i=0;
  $j=0;
  foreach ($MawsPageThreads as $MawsPageThread)
  {
	$matrix[$j] = array(
						  'label' => $MawsPageThread['thread']->getName(),
						  'lines' => array('show' => true, 'steps' => true),
						  'color' => '#'.$MawsPageThread['color'],
						);
	$j++;
  }

  foreach ($MawsPageResults as $date => $MawsPageResult)
  {
	$date_time = str_replace(' ', '<br />',$date);
	$j = 0;
	foreach ($MawsPageThreads as $MawsPageThread)
	{
	  $id = $MawsPageThread['id'];
	  if (isset($MawsPageResult[$id]))
	  {
		$matrix[$j]['data'][$i] = array($i,floatval($MawsPageResult[$id]['mid']));
	  }
	  else
	  {
		$matrix[$j]['data'][$i] = array($i,0);
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
			  <?php foreach ($arColumns as $col): ?>
			    <td class="<?php echo $col."_".$id ?>"><?php echo $arRes[$col] ?>
			    </td>
			  <?php endforeach; ?>
			<?php else: ?>
				<?php foreach ($arColumns as $col): ?>
				  <td class="empty <?php echo $col."_".$id ?>">
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
Показаны результаты за период: [<?php echo $strPeriod; ?>]
<br>
<br>
<form action="<?php echo url_for('page/show?id='.$MawsPage->getId()) ?>" method="get" >
  Показать за:
  <select name="period" id="period">
	<?php foreach (MawsPage::$arShowPeriods as $key => $value): ?>
	  <option value="<?php echo $key?>" <?php if ($period == $key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
	<?php endforeach; ?>
  </select>
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