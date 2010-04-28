<h1>Мои ленты</h1>

<table border="1" cellpadding="5" cellspacing="1" >
  <thead>
    <tr>
	  <th>Id</th>
      <th>Название</th>
      <th>Описание</th>
	  <th>Тип данных</th>
      <th>Фильтр</th>
	  <th>Частота обновления</th>
      <th>Последнее обновление</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach ($MawsThreads as $MawsThread): ?>
    <tr>
	  <td><?php echo $MawsThread->getId() ?></td>
      <td><a href="<?php echo url_for('thread/show?id='.$MawsThread->getId()) ?>"><?php echo $MawsThread->getName() ?></a></td>
      <td><?php echo $MawsThread->getDescription() ?></td>
	  <td><?php echo $MawsThread->getResultType(1) ?></td>
      <td>[<?php echo $MawsThread->getParserId() ?>] <?php echo $MawsThread->strParserName ?></td>
	  <td><?php echo $MawsThread->getUpdatePeriod() ?></td>
      <td><?php echo $MawsThread->getCheckedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<br />
<div>
  <a href="<?php echo url_for('thread/new') ?>">Создать новую ленту</a>	<br />
  <a href="<?php echo url_for('thread/foreign') ?>">Остальные ленты</a>
</div>