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
      <th>Filter:</th>
      <td><?php echo $MawsThread->getFilterId() ?></td>
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
