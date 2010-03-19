<h1>MawsFilters List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Resource</th>
      <th>Resource type</th>
      <th>Resource method</th>
      <th>Resource login</th>
      <th>Resource pass</th>
      <th>Resource params</th>
      <th>Filter</th>
      <th>Filter type</th>
      <th>Action</th>
      <th>Action type</th>
      <th>Action param1</th>
      <th>Action param2</th>
      <th>Action param3</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($MawsFilters as $MawsFilter): ?>
    <tr>
      <td><a href="<?php echo url_for('filter2/show?id='.$MawsFilter->getId()) ?>"><?php echo $MawsFilter->getId() ?></a></td>
      <td><?php echo $MawsFilter->getName() ?></td>
      <td><?php echo $MawsFilter->getResource() ?></td>
      <td><?php echo $MawsFilter->getResourceType() ?></td>
      <td><?php echo $MawsFilter->getResourceMethod() ?></td>
      <td><?php echo $MawsFilter->getResourceLogin() ?></td>
      <td><?php echo $MawsFilter->getResourcePass() ?></td>
      <td><?php echo $MawsFilter->getResourceParams() ?></td>
      <td><?php echo $MawsFilter->getFilter() ?></td>
      <td><?php echo $MawsFilter->getFilterType() ?></td>
      <td><?php echo $MawsFilter->getAction() ?></td>
      <td><?php echo $MawsFilter->getActionType() ?></td>
      <td><?php echo $MawsFilter->getActionParam1() ?></td>
      <td><?php echo $MawsFilter->getActionParam2() ?></td>
      <td><?php echo $MawsFilter->getActionParam3() ?></td>
      <td><?php echo $MawsFilter->getCreatedAt() ?></td>
      <td><?php echo $MawsFilter->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('filter2/new') ?>">New</a>
