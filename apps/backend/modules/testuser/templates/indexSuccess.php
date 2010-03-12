<h1>SfGuardUsers List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Username</th>
      <th>Algorithm</th>
      <th>Salt</th>
      <th>Password</th>
      <th>Created at</th>
      <th>Last login</th>
      <th>Is active</th>
      <th>Is super admin</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($SfGuardUsers as $SfGuardUser): ?>
    <tr>
      <td><a href="<?php echo url_for('testuser/show?id='.$SfGuardUser->getId()) ?>"><?php echo $SfGuardUser->getId() ?></a></td>
      <td><?php echo $SfGuardUser->getUsername() ?></td>
      <td><?php echo $SfGuardUser->getAlgorithm() ?></td>
      <td><?php echo $SfGuardUser->getSalt() ?></td>
      <td><?php echo $SfGuardUser->getPassword() ?></td>
      <td><?php echo $SfGuardUser->getCreatedAt() ?></td>
      <td><?php echo $SfGuardUser->getLastLogin() ?></td>
      <td><?php echo $SfGuardUser->getIsActive() ?></td>
      <td><?php echo $SfGuardUser->getIsSuperAdmin() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('testuser/new') ?>">New</a>
