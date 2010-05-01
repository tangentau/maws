<script type="application/javascript">

  function ResultTypeShowHide(value){

	if (value.toString()== '<?php echo MawsThread::FLOAT_RES ?>'){
	  $('tr.text_filters').hide();
	  $('tr.number_filters').show();
	}
	else {
	  $('tr.text_filters').show();
	  $('tr.number_filters').hide();
	}
  }

  $(document).ready(function(){

	$('#result_type').change(function() {
	  ResultTypeShowHide(this.value);
	  return false;
	});

	ResultTypeShowHide($('#result_type').attr('value'));
	
  });

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
		  <textarea name="description" id="description" rows="5" cols="30"><?php echo $form['description'] ?></textarea>
		</td>
	  </tr>
	  <tr>
		<td>
		  Кто может пользоваться этой лентой?
		</td>
		<td>
		  <select name="access" id="access">
			<?php foreach ($form['arAccessType'] as $key=>$value): ?>
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
			<?php foreach (MawsThread::$arResultType as $key=>$value): ?>
			  <option value="<?php echo $key?>" <?php if ($form['result_type']==$key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
			<?php endforeach; ?>
		  </select>
		</td>
	  </tr>
	  <tr class="text_filters">
		<td>
		  Текстовый фильтр, используемый лентой:
		</td>
		<td>
		  <select name="text_parser" id="text_parser">
			<?php foreach ($form['arTextParsers'] as $key=>$value): ?>
			  <option value="<?php echo $key?>" <?php if ($form['text_parser']==$key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
			<?php endforeach; ?>
		  </select>
		</td>
	  </tr>
	  <tr class="number_filters">
		<td>
		  Числовой фильтр, используемый лентой:
		</td>
		<td>
		  <select name="number_parser" id="number_parser">
			<?php foreach ($form['arNumberParsers'] as $key=>$value): ?>
			  <option value="<?php echo $key?>" <?php if ($form['number_parser']==$key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
			<?php endforeach; ?>
		  </select>
		</td>
	  </tr>
	  <tr>
		<td>
		  Частота обновления ленты:
		</td>
		<td>
		  <select name="update_period" id="update_period">
			<?php foreach (MawsThread::$arUpdatePeriods as $key=>$value): ?>
			  <option value="<?php echo $key?>" <?php if ($form['update_period']==$key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
			<?php endforeach; ?>
		  </select>
		</td>
	  </tr>
	  <tr>
		<td>
		  Когда начинать обновлять ленту:
		</td>
		<td>
		  <input type="text" name="update_start" id="update_start" value="<?php echo $form['update_start'] ?>" />
		</td>
	  </tr>
    </tbody>
  </table>
  <input type="hidden" name="id" id="id" value="<?php echo $form['id'] ?>" />
  <?php if (isset($form_action)): ?>
  <input type="hidden" name="form_action" id="form_action" value="<?php echo $form_action ?>" />
  <?php endif; ?>
</form>
