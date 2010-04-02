<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $MawsPage->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $MawsPage->getName() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $MawsPage->getDescription() ?></td>
    </tr>
    <tr>
      <th>Access:</th>
      <td><?php echo $MawsPage->getAccess() ?></td>
    </tr>
    <tr>
      <th>Result type:</th>
      <td><?php echo $MawsPage->getResultType() ?></td>
    </tr>
    <tr>
      <th>Owner:</th>
      <td><?php echo $MawsPage->getOwnerId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $MawsPage->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $MawsPage->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('page/edit?id='.$MawsPage->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('page/index') ?>">List</a>
