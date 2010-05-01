<script type="application/javascript">

  function ResultTypeShowHide(value){

	if (value.toString()== '<?php echo MawsPage::FLOAT_RES ?>'){
	  $('tr.text_threads').hide();
	  $('tr.number_threads').show();
	}
	else {
	  $('tr.text_threads').show();
	  $('tr.number_threads').hide();
	}
  }

  // показывает ленту, уже входящую в сводку
  function ShowThread(thread_id,thread_color,thread_sort){

  }

  // добавляет ленту в сводку
  function AddThread(thread_id){

  }

  // удаляет ленту из сводки
  function RemoveThread(thread_id){

  }

  $(document).ready(function(){

	$('#result_type').change(function() {

	  ResultTypeShowHide(this.value);
	  return false;
	});
  
	$('a#add_text_thread').click(function() {
	  selected_value = $('select#text_thread').attr('value');
	  
	  selected_text = $('select#text_thread option:selected').text();
	  selected_name = selected_text.replace(/\[[0-9]+\]/g,'');

	  added_thread = '<tr id="thr' + selected_value + '">'
						+ '<td><input type="hidden" class="thread_name" name="added_text_threads[' + selected_value + '][name]" value="' + selected_text  + '" /> '
							+ selected_name + '</td>'
						+ '<td><input type="text" name="added_text_threads[' + selected_value + '][sort]" value="100" /></td>'
						+ '<td><div id="thr_color' + selected_value + '" class="colorSelector">'
							+ '<div></div><input type="hidden" id="added_text_threads[' + selected_value + '][color]" name="added_text_threads[' + selected_value + '][color]" value="0000ff" />'
						+ '</div></td>'
						+ '<td><a href="javascript: void(0)" class="remove_text_thread" id="del_thr' + selected_value + '"> Убрать </a>'
							+ '<input type="hidden" name="added_text_threads[' + selected_value + '][id]" value="' + selected_value  + '" />'
						+ '</td>'
					+ '</tr>';

	  $('td#page_text_threads table').append(added_thread);

	  $('#thr_color' + selected_value).ColorPicker({
		color: '#0000ff',
		onShow: function (cp) {
			$(cp).fadeIn(500);
			return false;
		},
		onHide: function (cp) {
			$(cp).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#thr_color' + selected_value +' div')
					.css('backgroundColor', '#'+hex);
			$('#added_text_threads\\[' + selected_value + '\\]\\[color\\]').attr('value',hex);
		}
	  });

	  $('select#text_thread option:selected').remove();
	  if ($('select#text_thread option').length == 0)
	  {
		$('a#add_text_thread').hide();
	  }
	  $('td#page_text_threads table').show();
	  $('td#page_text_threads div#add_text').hide();

	$('a.remove_text_thread').unbind('click').bind('click',function() {
		added_thread_id = this.id.toString().substr(7, 10);
		added_thread_name = $('td#page_text_threads table tr#thr' + added_thread_id + ' input.thread_name').attr('value');
		$('td#page_text_threads table tr#thr' + added_thread_id).remove();
		if ($('select#text_thread option').length == 0)
		{
		  $('a#add_text_thread').show();
	    }
		if ($('td#page_text_threads table tr').length <= 1)
		{
		  $('td#page_text_threads table').hide();
		  $('td#page_text_threads div#add_text').show();
	    }

		$('select#text_thread').append('<option value="' + added_thread_id + '" >' + added_thread_name  + '</option>');
		return false;
	  });

	  return false;
	});

	$('a#add_number_thread').click(function() {
	  selected_value = $('select#number_thread').attr('value');

	  selected_text = $('select#number_thread option:selected').text();
	  selected_name = selected_text.replace(/\[[0-9]+\]/g,'');

	  added_thread = '<tr id="thr' + selected_value + '">'
						+ '<td><input type="hidden" class="thread_name" name="added_number_threads[' + selected_value + '][name]" value="' + selected_text  + '" /> '
							+ selected_name + '</td>'
						+ '<td><input type="text" name="added_number_threads[' + selected_value + '][sort]" value="100" /></td>'
						+ '<td><div id="thr_color' + selected_value + '" class="colorSelector">'
							+ '<div></div><input type="hidden" id="added_number_threads[' + selected_value + '][color]" name="added_number_threads[' + selected_value + '][color]" value="0000ff" />'
						+ '</div></td>'
						+ '<td><a href="javascript: void(0)" class="remove_number_thread" id="del_thr' + selected_value + '"> Убрать </a>'
							+ '<input type="hidden" name="added_number_threads[' + selected_value + '][id]" value="' + selected_value  + '" />'
						+ '</td>'
					+ '</tr>';

	  $('td#page_number_threads table').append(added_thread);

	  $('#thr_color' + selected_value).ColorPicker({
		color: '#0000ff',
		onShow: function (cp) {
			$(cp).fadeIn(500);
			return false;
		},
		onHide: function (cp) {
			$(cp).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#thr_color' + selected_value +' div')
					.css('backgroundColor', '#'+hex);
			$('#added_number_threads\\[' + selected_value + '\\]\\[color\\]').attr('value',hex);
		}
	  });

	  $('select#number_thread option:selected').remove();
	  if ($('select#number_thread option').length == 0)
	  {
		$('a#add_number_thread').hide();
	  }
	  $('td#page_number_threads table').show();
	  $('td#page_number_threads div#add_text').hide();

	$('a.remove_number_thread').unbind('click').bind('click',function() {
		added_thread_id = this.id.toString().substr(7, 10);
		//$('#thr_color' + added_thread_id).u unset('ColorPicker');
		added_thread_name = $('td#page_number_threads table tr#thr' + added_thread_id + ' input.thread_name').attr('value');
		$('td#page_number_threads table tr#thr' + added_thread_id).remove();
		if ($('select#number_thread option').length == 0)
		{
		  $('a#add_number_thread').show();
	    }
		if ($('td#page_number_threads table tr').length <= 1)
		{
		  $('td#page_number_threads table').hide();
		  $('td#page_number_threads div#add_text').show();
	    }

		$('select#number_thread').append('<option value="' + added_thread_id + '" >' + added_thread_name  + '</option>');
		return false;
	  });

	  return false;
	});

<?php foreach ($form['arAddedTextThreads'] as $arAddedTextThread): ?>
	  $('#thr_color<?php echo $arAddedTextThread['id'] ?> div').css('backgroundColor', '#<?php echo $arAddedTextThread['color'] ?>');
	  $('#thr_color<?php echo $arAddedTextThread['id'] ?>').ColorPicker({
		color: '#<?php echo $arAddedTextThread['color'] ?>',
		onShow: function (cp) {
			$(cp).fadeIn(500);
			return false;
		},
		onHide: function (cp) {
			$(cp).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#thr_color<?php echo $arAddedTextThread['id'] ?> div')
					.css('backgroundColor', '#'+hex);
			$('#added_text_threads\\[<?php echo $arAddedTextThread['id'] ?>\\]\\[color\\]').attr('value',hex);
		}
	  });

	  $('a#del_thr<?php echo $arAddedTextThread['id'] ?>').bind('click',function() {
		added_thread_id = '<?php echo $arAddedTextThread['id'] ?>';
		added_thread_name = '<?php echo $arAddedTextThread['name'] ?>'
		$('td#page_text_threads table tr#thr<?php echo $arAddedTextThread['id'] ?>').remove();
		if ($('select#text_thread option').length == 0)
		{
		  $('a#add_text_thread').show();
	    }
		if ($('td#page_text_threads table tr').length <= 1)
		{
		  $('td#page_text_threads table').hide();
		  $('td#page_text_threads div#add_text').show();
	    }

		$('select#text_thread').append('<option value="' + added_thread_id + '" >' + added_thread_name  + '</option>');
		return false;
	  });
<?php endforeach; ?>


<?php foreach ($form['arAddedNumberThreads'] as $arAddedNumberThread): ?>
	  $('#thr_color<?php echo $arAddedNumberThread['id'] ?> div').css('backgroundColor', '#<?php echo $arAddedNumberThread['color'] ?>');
	  $('#thr_color<?php echo $arAddedNumberThread['id'] ?>').ColorPicker({
		color: '#<?php echo $arAddedNumberThread['color'] ?>',
		onShow: function (cp) {
			$(cp).fadeIn(500);
			return false;
		},
		onHide: function (cp) {
			$(cp).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#thr_color<?php echo $arAddedNumberThread['id'] ?> div')
					.css('backgroundColor', '#'+hex);
			$('#added_number_threads\\[<?php echo $arAddedNumberThread['id'] ?>\\]\\[color\\]').attr('value',hex);
		}
	  });

	  $('a#del_thr<?php echo $arAddedNumberThread['id'] ?>').bind('click',function() {
		added_thread_id = '<?php echo $arAddedNumberThread['id'] ?>';
		added_thread_name = '<?php echo $arAddedNumberThread['name'] ?>'
		$('td#page_number_threads table tr#thr' + added_thread_id).remove();
		if ($('select#number_thread option').length == 0)
		{
		  $('a#add_number_thread').show();
	    }
		if ($('td#page_number_threads table tr').length <= 1)
		{
		  $('td#page_number_threads table').hide();
		  $('td#page_number_threads div#add_text').show();
	    }

		$('select#number_thread').append('<option value="' + added_thread_id + '" >' + added_thread_name  + '</option>');
		return false;
	  });
<?php endforeach; ?>
	ResultTypeShowHide($('#result_type').attr('value'));
	
  });

</script>
<?php foreach ($errors as $error):?>
<div class="error_message"><?php echo $error?></div>
<?php endforeach; ?>
<?php if (isset($form_action)): ?>
  <?php $form_action_str = ''; ?>
<?php else: ?>
  <?php $form_action_str = url_for('page/new'); ?>
<?php endif; ?>
<form action="<?php echo $form_action_str ?>" method="post">
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" value="Сохранить эту сводку" />
        </td>
      </tr>
    </tfoot>
    <tbody>
	  <tr>
		<td>
		  Название сводки:
		</td>
		<td>
		  <input type="text" name="name" id="name" value="<?php echo $form['name'] ?>" />
		</td>
	  </tr>
	  <tr>
		<td>
		  Описание сводки:
		</td>
		<td>
		  <textarea name="description" id="description" rows="5" cols="30"><?php echo $form['description'] ?></textarea>
		</td>
	  </tr>
	  <tr>
		<td>
		  Кто может пользоваться этой сводкой?
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
		  Тип данных в сводке:
		</td>
		<td>
		  <select name="result_type" id="result_type">
			<?php foreach (MawsPage::$arResultType as $key=>$value): ?>
			  <option value="<?php echo $key?>" <?php if ($form['result_type']==$key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
			<?php endforeach; ?>
		  </select>
		</td>
	  </tr>
	  <tr class="text_threads">
		<td>
		  Текстовые ленты, которые можно добавить в сводку:
		</td>
		<td>
		  <select name="text_thread" id="text_thread">
			<?php $text_thread_count=0; ?>
			<?php foreach ($form['arTextThreads'] as $key=>$value): ?>
			  <?php if (!isset($form['arAddedTextThreads'][$key])):?>
			  <option value="<?php echo $key?>" ><?php echo $value ?></option>
			  <?php $text_thread_count++; ?>
			  <?php endif; ?>
			<?php endforeach; ?>
		  </select>
		  <a href="javascript: void(0);" id="add_text_thread" style="display:<?php echo (($text_thread_count>0) ? "inline" : "none") ?>"> Добавить </a>
		</td>
	  </tr>
  	  <tr class="text_threads" >
		<td>
		 Текстовые ленты в составе сводки:
		</td>
		<td id="page_text_threads">
		  <div id="add_text" style="display: <?php echo (count($form['arAddedTextThreads'])>0 ? "none" : "block") ?>" >Нет ни одной ленты, добавьте хотя бы одну.</div>
		  <table cellpadding="5" border="1" style="display: <?php echo (count($form['arAddedTextThreads'])>0 ? "block" : "none") ?>">
			<tr>
			  <th>
				Название ленты
			  </th>
			  <th>
				Сортировка
			  </th>
			  <th>
				Цвет
			  </th>
			  <th>
			  </th>
			</tr>
			<?php foreach ($form['arAddedTextThreads'] as $arAddedTextThread): ?>
			<?php $trid = $arAddedTextThread['id']; ?>
			<tr id="thr<?php echo $trid ?>">
			  <td>
				<input type="hidden" class="thread_name" name="added_text_threads[<?php echo $trid ?>][name]" value="<?php echo $arAddedTextThread['name'] ?>" />
				<?php echo str_replace('['.$trid.']','',$arAddedTextThread['name']) ; ?>
			  </td>
			  <td>
				<input type="text" name="added_text_threads[<?php echo $trid ?>][sort]" value="<?php echo $arAddedTextThread['sort'] ?>" />
			  </td>
			  <td>
				<div id="thr_color<?php echo $trid ?>" class="colorSelector">
				  <div></div>
				  <input type="hidden" id="added_text_threads[<?php echo $trid ?>][color]" name="added_text_threads[<?php echo $trid ?>][color]" value="<?php echo $arAddedTextThread['color'] ?>" />
				</div>
			  </td>
			  <td>
				<a href="javascript: void(0)" class="remove_text_thread" id="del_thr<?php echo $trid ?>"> Убрать </a>
				<input type="hidden" name="added_text_threads[<?php echo $trid ?>][id]" value="<?php echo $trid ?>" />
			  </td>
			</tr>
			<?php endforeach; ?>
		  </table>
		</td>
	  </tr>
	  <tr class="number_threads">
		<td>
		  Числовые ленты, которые можно добавить в сводку:
		</td>
		<td>
		  <select name="number_thread" id="number_thread">
			<?php $number_thread_count = 0; ?>
			<?php foreach ($form['arNumberThreads'] as $key=>$value): ?>
			  <?php if (!isset($form['arAddedNumberThreads'][$key])):?>
			  <option value="<?php echo $key?>" ><?php echo $value ?></option>
			  <?php $number_thread_count++; ?>
			  <?php endif; ?>
			<?php endforeach; ?>
		  </select>
		  <a href="javascript: void(0);" id="add_number_thread"  style="display:<?php echo (($number_thread_count>0) ? "inline" : "none") ?>"> Добавить </a>
		</td>
	  </tr>
  	  <tr class="number_threads" >
		<td>
		 Числовые ленты в составе сводки:
		</td>
		<td id="page_number_threads">
		  <div id="add_text" style="display: <?php echo (count($form['arAddedNumberThreads'])>0 ? "none" : "block") ?>" >Нет ни одной ленты, добавьте хотя бы одну.</div>
		  <table cellpadding="5" border="1" style="display: <?php echo (count($form['arAddedNumberThreads'])>0 ? "block" : "none") ?>">
			<tr>
			  <th>
				Название ленты
			  </th>
			  <th>
				Сортировка
			  </th>
			  <th>
				Цвет
			  </th>
			  <th>
			  </th>
			</tr>
			<?php foreach ($form['arAddedNumberThreads'] as $arAddedNumberThread): ?>
			<?php $trid = $arAddedNumberThread['id']; ?>
			<tr id="thr<?php echo $trid ?>">
			  <td>
				<input type="hidden" class="thread_name" name="added_number_threads[<?php echo $trid ?>][name]" value="<?php echo $arAddedNumberThread['name'] ?>" />
				<?php echo str_replace('['.$trid.']','',$arAddedNumberThread['name']) ; ?>
			  </td>
			  <td>
				<input type="text" name="added_number_threads[<?php echo $trid ?>][sort]" value="<?php echo $arAddedNumberThread['sort'] ?>" />
			  </td>
			  <td>
				<div id="thr_color<?php echo $trid ?>" class="colorSelector">
				  <div></div>
				  <input type="hidden" id="added_number_threads[<?php echo $trid ?>][color]" name="added_number_threads[<?php echo $trid ?>][color]" value="<?php echo $arAddedNumberThread['color'] ?>" />
				</div>
			  </td>
			  <td>
				<a href="javascript: void(0)" class="remove_number_thread" id="del_thr<?php echo $trid ?>"> Убрать </a>
				<input type="hidden" name="added_number_threads[<?php echo $trid ?>][id]" value="<?php echo $trid ?>" />
			  </td>
			</tr>
			<?php endforeach; ?>
		  </table>
		</td>
	  </tr>
	  <tr>
		<td>
		 Период, за который отображается сводка:
		</td>
		<td>
		  <select name="show_period" id="show_period">
			<?php foreach (MawsPage::$arShowPeriods as $key=>$value): ?>
			  <option value="<?php echo $key?>" <?php if ($form['show_period']==$key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
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
