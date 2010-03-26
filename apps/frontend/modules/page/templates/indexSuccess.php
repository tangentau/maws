<h1>MawsPages List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Description</th>
      <th>Access</th>
      <th>Result type</th>
      <th>Owner</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($MawsPages as $MawsPage): ?>
    <tr>
      <td><a href="<?php echo url_for('page/show?id='.$MawsPage->getId()) ?>"><?php echo $MawsPage->getId() ?></a></td>
      <td><?php echo $MawsPage->getName() ?></td>
      <td><?php echo $MawsPage->getDescription() ?></td>
      <td><?php echo $MawsPage->getAccess() ?></td>
      <td><?php echo $MawsPage->getResultType() ?></td>
      <td><?php echo $MawsPage->getOwnerId() ?></td>
      <td><?php echo $MawsPage->getCreatedAt() ?></td>
      <td><?php echo $MawsPage->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('page/new') ?>">New</a>
