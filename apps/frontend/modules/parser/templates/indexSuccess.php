<h1>MawsParsers List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Description</th>
      <th>Access</th>
      <th>Resource url</th>
      <th>Resource type</th>
      <th>Resource params</th>
      <th>Resource method</th>
      <th>Resource login</th>
      <th>Resource pass</th>
      <th>Filter type</th>
      <th>Filter params</th>
      <th>Action type</th>
      <th>Action params</th>
      <th>Result type</th>
      <th>Owner</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($MawsParsers as $MawsParser): ?>
    <tr>
      <td><a href="<?php echo url_for('parser/show?id='.$MawsParser->getId()) ?>"><?php echo $MawsParser->getId() ?></a></td>
      <td><?php echo $MawsParser->getName() ?></td>
      <td><?php echo $MawsParser->getDescription() ?></td>
      <td><?php echo $MawsParser->getAccess() ?></td>
      <td><?php echo $MawsParser->getResourceUrl() ?></td>
      <td><?php echo $MawsParser->getResourceType() ?></td>
      <td><?php echo $MawsParser->getResourceParams() ?></td>
      <td><?php echo $MawsParser->getResourceMethod() ?></td>
      <td><?php echo $MawsParser->getResourceLogin() ?></td>
      <td><?php echo $MawsParser->getResourcePass() ?></td>
      <td><?php echo $MawsParser->getFilterType() ?></td>
      <td><?php echo $MawsParser->getFilterParams() ?></td>
      <td><?php echo $MawsParser->getActionType() ?></td>
      <td><?php echo $MawsParser->getActionParams() ?></td>
      <td><?php echo $MawsParser->getResultType() ?></td>
      <td><?php echo $MawsParser->getOwnerId() ?></td>
      <td><?php echo $MawsParser->getCreatedAt() ?></td>
      <td><?php echo $MawsParser->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('parser/new') ?>">New</a>
