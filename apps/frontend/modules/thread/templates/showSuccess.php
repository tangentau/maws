<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $MawsThread->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $MawsThread->getName() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $MawsThread->getDescription() ?></td>
    </tr>
    <tr>
      <th>Access:</th>
      <td><?php echo $MawsThread->getAccess() ?></td>
    </tr>
    <tr>
      <th>Parser:</th>
      <td><?php echo $MawsThread->getParserId() ?></td>
    </tr>
    <tr>
      <th>Update start:</th>
      <td><?php echo $MawsThread->getUpdateStart() ?></td>
    </tr>
    <tr>
      <th>Update period:</th>
      <td><?php echo $MawsThread->getUpdatePeriod() ?></td>
    </tr>
    <tr>
      <th>Result type:</th>
      <td><?php echo $MawsThread->getResultType() ?></td>
    </tr>
    <tr>
      <th>Owner:</th>
      <td><?php echo $MawsThread->getOwnerId() ?></td>
    </tr>
    <tr>
      <th>Checked at:</th>
      <td><?php echo $MawsThread->getCheckedAt() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $MawsThread->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $MawsThread->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('thread/edit?id='.$MawsThread->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('thread/index') ?>">List</a>
