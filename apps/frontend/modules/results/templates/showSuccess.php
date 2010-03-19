<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $MawsFilterResult->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $MawsFilterResult->getName() ?></td>
    </tr>
    <tr>
      <th>Filter:</th>
      <td><?php echo $MawsFilterResult->getFilterId() ?></td>
    </tr>
    <tr>
      <th>Thread:</th>
      <td><?php echo $MawsFilterResult->getThreadId() ?></td>
    </tr>
    <tr>
      <th>Result:</th>
      <td><?php echo $MawsFilterResult->getResult() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $MawsFilterResult->getCreatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('results/edit?id='.$MawsFilterResult->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('results/index') ?>">List</a>
