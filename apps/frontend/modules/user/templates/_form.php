<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('user/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" value="Сохранить данные" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
<?php if (!$form->getObject()->isNew()): ?>
  <div class="links_list">
	<?php echo link_to('Удалить пользователя', 'user/delete?id='.$form->getObject()->getId(), array('class' => 'delete','method' => 'delete', 'confirm' => 'Вы действительно хотите удолить пользователя?')) ?>
  </div>
<?php endif; ?>
