<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $MawsPageThread->getId() ?></td>
    </tr>
    <tr>
      <th>Page:</th>
      <td><?php echo $MawsPageThread->getPageId() ?></td>
    </tr>
    <tr>
      <th>Thread:</th>
      <td><?php echo $MawsPageThread->getThreadId() ?></td>
    </tr>
    <tr>
      <th>Sort order:</th>
      <td><?php echo $MawsPageThread->getSortOrder() ?></td>
    </tr>
    <tr>
      <th>Show period:</th>
      <td><?php echo $MawsPageThread->getShowPeriod() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $MawsPageThread->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $MawsPageThread->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('page_thread/edit?id='.$MawsPageThread->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('page_thread/index') ?>">List</a>
