<h2><?php echo $MawsPage->getName() ?></h2>

<script type="text/javascript">

  $(document).ready(function(){

  <?php foreach ($MawsPageThreads as $i => $MawsPageThread): ?>
	  $('.thr_color<?php echo $i ?>').css('backgroundColor', '#<?php echo $MawsPageThread['color'] ?>');
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
		  <td class="thr_color<?php echo $i ?>">
			<?php if ((isset($MawsPageResult[$MawsPageThread['id']])) && (is_array($MawsPageResult[$MawsPageThread['id']]))): ?>
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
			<?php endif; ?>
		  </td>
		  <?php endforeach; ?>
		</tr>
		<?php endforeach; ?>
	</tbody>
  </table>
<?php else: ?>
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
		<?php foreach ($MawsPageResults as $i => $MawsPageResult): ?>
		<tr>
		  <td>
			<?php $date_time = str_replace(' ', '<br />',$i); ?>
			<?php echo $date_time ?>
		  </td>
		  <?php foreach ($MawsPageThreads as $MawsPageThread): ?>
			<?php $id = $MawsPageThread['id']; ?>
			<?php if ((isset($MawsPageResult[$MawsPageThread['id']])) && (is_array($MawsPageResult[$MawsPageThread['id']]))): ?>
			  <td class="thr_color<?php echo $id ?>">
				<?php $arRes = $MawsPageResult[$MawsPageThread['id']]; ?>
				<?php foreach($arRes as $i => $n): ?>
				  <?php $arRes[$i] = toolBox::floatval($n); ?>
				<?php endforeach; ?>
				<?php $ar_sum = array_sum($arRes); ?>
				<?php $ar_count = count($arRes); ?>
				<?php echo implode(', ',$arRes) ?>
			  </td>
			  <td class="thr_color<?php echo $id ?>"><?php echo min($arRes); ?>
			  </td>
			  <td class="thr_color<?php echo $id ?>"><?php echo max($arRes); ?>
			  </td>
			  <td class="thr_color<?php echo $id ?>"><?php echo round($ar_sum/$ar_count,2); ?>
			  </td>
			  <td class="thr_color<?php echo $id ?>"><?php echo ($ar_sum); ?>
			  </td>
			  <td class="thr_color<?php echo $id ?>"><?php echo ($ar_count); ?>
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
		  <?php endforeach; ?>
		</tr>
		<?php endforeach; ?>
	</tbody>
  </table>
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
<hr />

<br />
<div class="links_list">
  <a href="<?php echo url_for('page/index') ?>">Перейти к списку сводок</a>
  <?php if ($owner): ?>
  <a href="<?php echo url_for('page/edit?id='.$MawsPage->getId()) ?>">Редактировать эту сводку</a>
  <a class="delete" href="<?php echo url_for('page/delete?id='.$id) ?>" onclick="return confirm('Вы действительно хотите удалить эту сводку?');">Удалить сводку</a>
  <?php endif; ?>
</div>
