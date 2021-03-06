<h1>Мои фильтры</h1>

<table border="1" cellpadding="5" cellspacing="1" >
  <thead>
    <tr>
	  <th>Id</th>
      <th>Название</th>
      <th>Описание</th>
      <th>Источник данных</th>
	  <th>Тип источника</th>
      <th>Тип фильтра</th>
	  <th>Тип результата</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($MawsParsers as $MawsParser): ?>
    <tr>
	  <td><?php echo $MawsParser->getId() ?></td>
      <td><a href="<?php echo url_for('parser/show?id='.$MawsParser->getId()) ?>"><?php echo $MawsParser->getName() ?></a></td>
      <td><?php echo $MawsParser->getDescription() ?></td>
      <td><?php echo $MawsParser->getResourceUrl() ?></td>
	  <td><?php echo $MawsParser->getResourceType(1) ?></td>
      <td><?php echo $MawsParser->getFilterType(1) ?></td>
      <td><?php echo $MawsParser->getResultType(1) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<br />
<div class="links_list">
  <a href="<?php echo url_for('parser/new') ?>">Добавить новый фильтр</a>
  <a href="<?php echo url_for('parser/foreign') ?>">Остальные фильтры</a>
</div>
