<h1>Мои сводки</h1>

<table border="1" cellpadding="5" cellspacing="1" >
  <thead>
    <tr>
	  <th>Id</th>
      <th>Название</th>
      <th>Описание</th>
      <th>Тип данных</th>
      <th>Период показа</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($MawsPages as $MawsPage): ?>
    <tr>
      <td><?php echo $MawsPage->getId() ?></td>
	  <td><a href="<?php echo url_for('page/show?id='.$MawsPage->getId()) ?>"><?php echo $MawsPage->getName() ?></a></td>
      <td><?php echo $MawsPage->getDescription() ?></td>
      <td><?php echo $MawsPage->getResultType(1) ?></td>
      <td><?php echo $MawsPage->getShowPeriod(1) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<br />
<div class="links_list">
  <a href="<?php echo url_for('page/new') ?>">Добавить новую сводку</a>
  <a href="<?php echo url_for('page/foreign') ?>">Остальные сводки</a>
</div>
