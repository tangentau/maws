<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $SfGuardUser->getId() ?></td>
    </tr>
    <tr>
      <th>Username:</th>
      <td><?php echo $SfGuardUser->getUsername() ?></td>
    </tr>
    <tr>
      <th>Algorithm:</th>
      <td><?php echo $SfGuardUser->getAlgorithm() ?></td>
    </tr>
    <tr>
      <th>Salt:</th>
      <td><?php echo $SfGuardUser->getSalt() ?></td>
    </tr>
    <tr>
      <th>Password:</th>
      <td><?php echo $SfGuardUser->getPassword() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $SfGuardUser->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Last login:</th>
      <td><?php echo $SfGuardUser->getLastLogin() ?></td>
    </tr>
    <tr>
      <th>Is active:</th>
      <td><?php echo $SfGuardUser->getIsActive() ?></td>
    </tr>
    <tr>
      <th>Is super admin:</th>
      <td><?php echo $SfGuardUser->getIsSuperAdmin() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('testuser/edit?id='.$SfGuardUser->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('testuser/index') ?>">List</a>
