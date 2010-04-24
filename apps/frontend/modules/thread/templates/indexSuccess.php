<h1>Мои ленты</h1>

<table border="1" cellpadding="5" cellspacing="1" >
  <thead>
    <tr>
      <th>Название</th>
      <th>Описание</th>
	  <th>Тип данных</th>
      <th>Фильтр</th>
	  <th>Владелец</th>
	  <th>Частота обновления</th>
      <th>Последнее обновление</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach ($MawsThreads as $MawsThread): ?>
    <tr>
      <td><a href="<?php echo url_for('thread/show?id='.$MawsThread->getId()) ?>"><?php echo $MawsThread->getId() ?></a></td>
      <td><?php echo $MawsThread->getName() ?></td>
      <td><?php echo $MawsThread->getDescription() ?></td>
	  <td><?php echo $MawsThread->getResultType(1) ?></td>
      <td><?php echo $MawsThread->strParserName ?></td>
	  <td><?php echo $MawsThread->strOwnerName ?></td>
      <td><?php echo $MawsThread->getCheckedAt() ?></td>
      <td><?php echo $MawsThread->getUpdatePeriod() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('thread/new') ?>">Создать новую ленту</a>
