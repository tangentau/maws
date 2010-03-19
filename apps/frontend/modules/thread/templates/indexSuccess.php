<h1>MawsThreads List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Filter</th>
      <th>Update start</th>
      <th>Update period</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($MawsThreads as $MawsThread): ?>
    <tr>
      <td><a href="<?php echo url_for('thread/show?id='.$MawsThread->getId()) ?>"><?php echo $MawsThread->getId() ?></a></td>
      <td><?php echo $MawsThread->getName() ?></td>
      <td><?php echo $MawsThread->getFilterId() ?></td>
      <td><?php echo $MawsThread->getUpdateStart() ?></td>
      <td><?php echo $MawsThread->getUpdatePeriod() ?></td>
      <td><?php echo $MawsThread->getCreatedAt() ?></td>
      <td><?php echo $MawsThread->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('thread/new') ?>">New</a>
