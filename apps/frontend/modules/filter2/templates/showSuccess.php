<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $MawsFilter->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $MawsFilter->getName() ?></td>
    </tr>
    <tr>
      <th>Resource:</th>
      <td><?php echo $MawsFilter->getResource() ?></td>
    </tr>
    <tr>
      <th>Resource type:</th>
      <td><?php echo $MawsFilter->getResourceType() ?></td>
    </tr>
    <tr>
      <th>Resource method:</th>
      <td><?php echo $MawsFilter->getResourceMethod() ?></td>
    </tr>
    <tr>
      <th>Resource login:</th>
      <td><?php echo $MawsFilter->getResourceLogin() ?></td>
    </tr>
    <tr>
      <th>Resource pass:</th>
      <td><?php echo $MawsFilter->getResourcePass() ?></td>
    </tr>
    <tr>
      <th>Resource params:</th>
      <td><?php echo $MawsFilter->getResourceParams() ?></td>
    </tr>
    <tr>
      <th>Filter:</th>
      <td><?php echo $MawsFilter->getFilter() ?></td>
    </tr>
    <tr>
      <th>Filter type:</th>
      <td><?php echo $MawsFilter->getFilterType() ?></td>
    </tr>
    <tr>
      <th>Action:</th>
      <td><?php echo $MawsFilter->getAction() ?></td>
    </tr>
    <tr>
      <th>Action type:</th>
      <td><?php echo $MawsFilter->getActionType() ?></td>
    </tr>
    <tr>
      <th>Action param1:</th>
      <td><?php echo $MawsFilter->getActionParam1() ?></td>
    </tr>
    <tr>
      <th>Action param2:</th>
      <td><?php echo $MawsFilter->getActionParam2() ?></td>
    </tr>
    <tr>
      <th>Action param3:</th>
      <td><?php echo $MawsFilter->getActionParam3() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $MawsFilter->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $MawsFilter->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('filter2/edit?id='.$MawsFilter->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('filter2/index') ?>">List</a>
