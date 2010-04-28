<table border="1" cellpadding="5" cellspacing="1">
  <tbody align="left">
	<tr>
	  <td colspan="2">
		<h2>Фильтр "<?php echo $MawsParser->getName() ?>"</h2>
	  </td>
	</tr>
    <tr>
      <th>Описание фильтра:</th>
      <td><?php echo $MawsParser->getDescription() ?></td>
    </tr>
    <tr>
      <th>Кто имеет доступ<br/> к этому фильтру:</th>
      <td><?php echo $MawsParser->getAccess(1) ?></td>
    </tr>
	<tr>
	  <td colspan="2">
		<h2>Что фильтруется:</h2>
	  </td>
	</tr>
    <tr>
      <th>Тип источника данных:</th>
      <td><?php echo $MawsParser->getResourceType(1) ?></td>
    </tr>
    <tr>
      <th>Адрес источника данных:</th>
      <td><?php echo $MawsParser->getResourceUrl() ?></td>
    </tr>
	<?php if (in_array($MawsParser->getResourceType(),array(MawsParser::HTTP_RESOURCE,MawsParser::HTTP_FILE_RESOURCE))): ?>
    <tr>
      <th>Параметры:</th>
      <td>
		<?php $arResourceParams = $MawsParser->getResourceParams(1); ?>
		<table border="1" cellpadding="3" cellspacing="1">
		  <tr>
			<th>Название</th>
			<th>Значение</th>
		  </tr>
		<?php foreach ($arResourceParams as $name => $value): ?>
		  <tr>
			<td><?php echo $name ?></td>
			<td><?php echo $value ?></td>
		  </tr>
		<?php endforeach; ?>
		</table>
	  </td>
    </tr>
    <tr>
      <th>Метод передачи параметров:</th>
      <td><?php echo $MawsParser->getResourceMethod(1) ?></td>
    </tr>
	<?php endif; ?>
    <tr>
      <th>Логин:</th>
      <td><?php echo $MawsParser->getResourceLogin() ?></td>
    </tr>
    <tr>
      <th>Пароль:</th>
      <td><?php echo $MawsParser->getResourcePass() ?></td>
    </tr>
	<tr>
	  <td colspan="2">
		<h2>Как фильтруется:</h2>
	  </td>
	</tr>
    <tr>
      <th>Тип фильтра:</th>
      <td><?php echo $MawsParser->getFilterType(1) ?></td>
    </tr>
    <tr>
      <th>Параметры фильтра:</th>
	  <?php $arFilterParams = $MawsParser->getFilterParams(1); ?>
	  <?php if ($MawsParser->getFilterType()==MawsParser::REGEXP_FILTER): ?>
      <td>Регулярное выражение: <?php echo $arFilterParams['regexp'] ?></td>
	  <?php elseif ($MawsParser->getFilterType()==MawsParser::DOM_FILTER): ?>
	  <td>XML-селектор: <?php echo $arFilterParams['dom_select'] ?></td>
	  <?php elseif ($MawsParser->getFilterType()==MawsParser::MATCH_FILTER): ?>
	  <td>
		<table border="1" cellpadding="3" cellspacing="1">
		  <tr>
			<td>Начальный маркер:</td>
			<td><?php echo $arFilterParams['start_marker'] ?></td>
		  </tr>
		  <tr>
			<td>Конечный маркер:</td>
			<td><?php echo $arFilterParams['end_marker'] ?></td>
		  </tr>
		</table>
	  </td>
	  <?php endif; ?>
    </tr>
	<tr>
	  <td colspan="2">
		<h2>Результаты фильтра:</h2>
	  </td>
	</tr>
    <tr>
      <th>Результат фильтра:</th>
      <td><?php echo $MawsParser->getResultType(1) ?></td>
    </tr>
    <tr>
      <th>Действие над результатами:</th>
      <td><?php echo $MawsParser->getActionType(1) ?></td>
    </tr>
	<?php if (in_array($MawsParser->getActionType(),array(MawsParser::GET_FIRST_N,MawsParser::GET_LAST_N,MawsParser::GET_MNTH))): ?>
    <tr>
      <th>Параметры действия:</th>
	  <?php $arActionParams = $MawsParser->getActionParams(1); ?>
      <td>
		<?php if (in_array($MawsParser->getActionType(),array(MawsParser::GET_FIRST_N,MawsParser::GET_LAST_N,MawsParser::GET_MNTH))): ?>
		N: <?php echo $arActionParams['n']?>
		<?php endif; ?>
		<?php if (in_array($MawsParser->getActionType(),array(MawsParser::GET_MNTH))): ?>
		<br />M: <?php echo $arActionParams['m']?>
		<?php endif; ?>
	  </td>
    </tr>
	<?php endif; ?>
	<tr>
	  <td colspan="2">
		<h2>Прочие параметры:</h2>
	  </td>
	</tr>
    <tr>
      <th>Владелец фильтра:</th>
      <td><?php echo $strOwnerName ?></td>
    </tr>
    <tr>
      <th>Создан:</th>
      <td><?php echo $MawsParser->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Изменён:</th>
      <td><?php echo $MawsParser->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>
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
<div>
<a href="<?php echo url_for('parser/edit?id='.$MawsParser->getId()) ?>">Редактировать этот фильтр</a>
  <br />
</div>
<div>
<a href="<?php echo url_for('parser/index') ?>">Перейти к списку фильтров</a>
  <br />
</div>
<div>
  <a href="<?php echo url_for('parser/delete?id='.$id) ?>" onclick="return confirm('Вы действительно хотите удалить этот фильтр?');">Удалить фильтр</a>
  <br />
</div>
