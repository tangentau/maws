<script type="application/javascript">

</script>
<?php foreach ($errors as $error):?>
<div class="error_message"><?php echo $error?></div>
<?php endforeach; ?>
<?php if (isset($form_action)): ?>
  <?php $form_action_str = ''; ?>
<?php else: ?>
  <?php $form_action_str = url_for('thread/new'); ?>
<?php endif; ?>
<form action="<?php echo $form_action_str ?>" method="post">
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('thread/index') ?>">Перейти к списку лент</a>
          <input type="submit" value="Сохранить эту ленту" />
        </td>
      </tr>
    </tfoot>
    <tbody>
	  <tr>
		<td>
		  Название ленты:
		</td>
		<td>
		  <input type="text" name="name" id="name" value="<?php echo $form['name'] ?>" />
		</td>
	  </tr>
	  <tr>
		<td>
		  Описание ленты:
		</td>
		<td>
		  <textarea name="description" rows="5" cols="30"><?php echo $form['description'] ?></textarea>
		</td>
	  </tr>
	  <tr>
		<td>
		  Кто может пользоваться этой лентой?
		</td>
		<td>
		  <select name="access" id="access">
			<?php foreach (MawsParser::$arAccessType as $key=>$value): ?>
			  <option value="<?php echo $key?>" <?php if ($form['access']==$key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
			<?php endforeach; ?>
		  </select>
		</td>
	  </tr>
	  <tr>
		<td>
		  Тип данных в ленте:
		</td>
		<td>
		  <select name="result_type" id="result_type">
			<?php foreach (MawsParser::$arResultType as $key=>$value): ?>
			  <option value="<?php echo $key?>" <?php if ($form['result_type']==$key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
			<?php endforeach; ?>
		  </select>
		</td>
	  </tr>
    </tbody>
  </table>
  <input type="hidden" name="id" id="id" value="<?php echo $form['id'] ?>" />
  <?php if (isset($form_action)): ?>
  <input type="hidden" name="form_action" id="form_action" value="<?php echo $form_action ?>" />
  <?php endif; ?>
</form>
