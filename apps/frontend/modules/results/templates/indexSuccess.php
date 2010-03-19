<h1>MawsFilterResults List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Filter</th>
      <th>Thread</th>
      <th>Result</th>
      <th>Created at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($MawsFilterResults as $MawsFilterResult): ?>
    <tr>
      <td><a href="<?php echo url_for('results/show?id='.$MawsFilterResult->getId()) ?>"><?php echo $MawsFilterResult->getId() ?></a></td>
      <td><?php echo $MawsFilterResult->getName() ?></td>
      <td><?php echo $MawsFilterResult->getFilterId() ?></td>
      <td><?php echo $MawsFilterResult->getThreadId() ?></td>
      <td><?php echo $MawsFilterResult->getResult() ?></td>
      <td><?php echo $MawsFilterResult->getCreatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('results/new') ?>">New</a>
