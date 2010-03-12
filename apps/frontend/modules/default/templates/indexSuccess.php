<h1>SfTests List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($SfTests as $SfTest): ?>
    <tr>
      <td><a href="<?php echo url_for('default/show?id='.$SfTest->getId()) ?>"><?php echo $SfTest->getId() ?></a></td>
      <td><?php echo $SfTest->getName() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('default/new') ?>">New</a>
