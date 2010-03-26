<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $MawsParser->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $MawsParser->getName() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $MawsParser->getDescription() ?></td>
    </tr>
    <tr>
      <th>Access:</th>
      <td><?php echo $MawsParser->getAccess() ?></td>
    </tr>
    <tr>
      <th>Resource url:</th>
      <td><?php echo $MawsParser->getResourceUrl() ?></td>
    </tr>
    <tr>
      <th>Resource type:</th>
      <td><?php echo $MawsParser->getResourceType() ?></td>
    </tr>
    <tr>
      <th>Resource params:</th>
      <td><?php echo $MawsParser->getResourceParams() ?></td>
    </tr>
    <tr>
      <th>Resource method:</th>
      <td><?php echo $MawsParser->getResourceMethod() ?></td>
    </tr>
    <tr>
      <th>Resource login:</th>
      <td><?php echo $MawsParser->getResourceLogin() ?></td>
    </tr>
    <tr>
      <th>Resource pass:</th>
      <td><?php echo $MawsParser->getResourcePass() ?></td>
    </tr>
    <tr>
      <th>Filter type:</th>
      <td><?php echo $MawsParser->getFilterType() ?></td>
    </tr>
    <tr>
      <th>Filter params:</th>
      <td><?php echo $MawsParser->getFilterParams() ?></td>
    </tr>
    <tr>
      <th>Action type:</th>
      <td><?php echo $MawsParser->getActionType() ?></td>
    </tr>
    <tr>
      <th>Action params:</th>
      <td><?php echo $MawsParser->getActionParams() ?></td>
    </tr>
    <tr>
      <th>Result type:</th>
      <td><?php echo $MawsParser->getResultType() ?></td>
    </tr>
    <tr>
      <th>Owner:</th>
      <td><?php echo $MawsParser->getOwnerId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $MawsParser->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $MawsParser->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('parser/edit?id='.$MawsParser->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('parser/index') ?>">List</a>
