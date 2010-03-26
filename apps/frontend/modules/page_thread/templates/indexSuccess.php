<h1>MawsPageThreads List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Page</th>
      <th>Thread</th>
      <th>Sort order</th>
      <th>Show period</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($MawsPageThreads as $MawsPageThread): ?>
    <tr>
      <td><a href="<?php echo url_for('page_thread/show?id='.$MawsPageThread->getId()) ?>"><?php echo $MawsPageThread->getId() ?></a></td>
      <td><?php echo $MawsPageThread->getPageId() ?></td>
      <td><?php echo $MawsPageThread->getThreadId() ?></td>
      <td><?php echo $MawsPageThread->getSortOrder() ?></td>
      <td><?php echo $MawsPageThread->getShowPeriod() ?></td>
      <td><?php echo $MawsPageThread->getCreatedAt() ?></td>
      <td><?php echo $MawsPageThread->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('page_thread/new') ?>">New</a>
