<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $SfTest->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $SfTest->getName() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('default/edit?id='.$SfTest->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('default/index') ?>">List</a>
