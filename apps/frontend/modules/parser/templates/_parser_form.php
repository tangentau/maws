<script type="application/javascript">
  String.prototype.replaceAll = function(search, replace){
	return this.split(search).join(replace);
  }

  function ResourceParamsShowHide(value)
  {
	  if (value.toString() == '<?=MawsParser::HTTP_RESOURCE?>') // http page
	  {
		$('.tr_login,_.tr_pass, .tr_params').show();
		$('.tr_filters').hide();
		$('.tr_resource_url').show();
	  }
	  else if (value.toString() == '<?=MawsParser::FTP_RESOURCE?>') // ftp catalog
	  {
		$('.tr_login, .tr_pass').show();
		$('.tr_params').hide();
		$('.tr_filters').hide();
		$('.tr_resource_url').show();
	  }
	  else if (value.toString() == '<?=MawsParser::HTTP_FILE_RESOURCE?>') // http-file
	  {
		$('.tr_login, .tr_pass, .tr_params').show();
		$('.tr_filters').hide();
		$('.tr_resource_url').show();
	  }
	  else if (value.toString() == '<?=MawsParser::FTP_FILE_RESOURCE?>') // ftp-file
	  {
		$('.tr_login, .tr_pass').show();
		$('.tr_params').hide();
		$('.tr_filters').hide();
		$('.tr_resource_url').show();
	  }
	  else if (value.toString() == '<?=MawsParser::FILTER_RESOURCE?>') // фильтр
	  {
		$('.tr_login, .tr_pass, .tr_params').hide();
		$('.tr_filters').show();
		$('.tr_resource_url').hide();
	  }
  }


  function FilterParamsShowHide(value)
  {
	  if (value.toString() == '<?=MawsParser::REGEXP_FILTER?>') // regexp
	  {
		$('.tr_regexp').show();
		$('.tr_domselect, .tr_markers').hide();
	  }
	  else if (value.toString() == '<?=MawsParser::DOM_FILTER?>') // DOM
	  {
		$('.tr_domselect').show();
		$('.tr_regexp, .tr_markers').hide();
	  }
	  else if (value.toString() == '<?=MawsParser::MATCH_FILTER?>') // match
	  {
		$('.tr_markers').show();
		$('.tr_domselect, .tr_regexp').hide();
	  }
  }

  function ActionParamsShowHide(value)
  {
	  if (value.toString() == '<?=MawsParser::GET_ALL?>') // GET_ALL
	  {
		$('.tr_n, .tr_m').hide();
	  }
	  else if (value.toString() == '<?=MawsParser::GET_FIRST_N?>') // GET_FIRST_N
	  {
		$('.tr_n').show();
		$('.tr_m').hide();
	  }
	  else if (value.toString() == '<?=MawsParser::GET_LAST_N?>') // GET_LAST_N
	  {
		$('.tr_n').show();
		$('.tr_m').hide();
	  }
	  else if (value.toString() == '<?=MawsParser::GET_COUNT?>') // GET_COUNT
	  {
		$('.tr_n, .tr_m').hide();
	  }
	  else if (value.toString() == '<?=MawsParser::GET_RANDOM?>') // GET_RANDOM
	  {
		$('.tr_n, .tr_m').hide();
	  }
	  else if (value.toString() == '<?=MawsParser::GET_MNTH?>') // GET_MNTH
	  {
		$('.tr_n, .tr_m').show();
	  }
  }


  $(document).ready(function(){
	$('a.add_resource_param').click(function(){
	  $('#resource_params').append($('#resource_param').attr('innerHTML').toString().replaceAll('#i#',i.toString()));
	  i++;
	  return false;
	})

	$('#resource_type').change(function(){
	  ResourceParamsShowHide(this.value);
	  return false;
	});

	$('#filter_type').change(function(){
	  FilterParamsShowHide(this.value);
	  return false;
	});

	$('#action_type').change(function(){
	  ActionParamsShowHide(this.value);
	  return false;
	});

	ResourceParamsShowHide($('#resource_type').attr('value'));
	FilterParamsShowHide($('#filter_type').attr('value'));
	ActionParamsShowHide($('#action_type').attr('value'));
  });



</script>
<?php foreach ($errors as $error):?>
<div class="error_message"><?php echo $error?></div>
<?php endforeach; ?>
<?php if (isset($form_action)): ?>
  <?php $form_action_str = ''; ?>
<?php else: ?>
  <?php $form_action_str = url_for('parser/new'); ?>
<?php endif; ?>
<form action="<?php echo $form_action_str ?>" method="post">
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" value="Сохранить этот фильтр" />
        </td>
      </tr>
    </tfoot>
    <tbody>
	  <tr>
		<td>
		  Название фильтра:
		</td>
		<td>
		  <input type="text" name="name" id="name" value="<?php echo $form['name'] ?>" />
		</td>
	  </tr>
	  <tr>
		<td>
		  Описание фильтра:
		</td>
		<td>
		  <textarea name="description" id="description" rows="5" cols="30"><?php echo $form['description'] ?></textarea>
		</td>
	  </tr>
	  <tr>
		<td>
		  Кто может пользоваться этим фильтром?
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
		  Результат фильтра:
		</td>
		<td>
		  <select name="result_type" id="result_type">
			<?php foreach (MawsParser::$arResultType as $key=>$value): ?>
			  <option value="<?php echo $key?>" <?php if ($form['result_type']==$key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
			<?php endforeach; ?>
		  </select>
		</td>
	  </tr>
	  <tr>
		<td colspan="2">
		  <h2>Что будем фильтровать?</h2>
		</td>
	  </tr>
	  <tr>
		<td>
		  Тип источника:
		</td>
		<td>
		  <select name="resource_type" id="resource_type">
			<?php foreach (MawsParser::$arResourceType as $key=>$value): ?>
			  <option value="<?php echo $key?>" <?php if ($form['resource_type']==$key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
			<?php endforeach; ?>
		  </select>
		</td>
	  </tr>
	  <tr class="tr_resource_url">
		<td>
		  Адрес (URL):
		</td>
		<td>
		  <input type="text" name="resource_url" id="resource_url" value="<?php echo $form['resource_url'] ?>" />
		</td>
	  </tr>
	  <tr class="tr_filters">
		<td>
		  Фильтр:
		</td>
		<td>
		  <select name="parser_id" id="parser_id">
			<?php foreach ($form['parsers'] as $key=>$value): ?>
			  <option value="<?php echo $key?>" <?php if ($form['resource_url']==$key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
			<?php endforeach; ?>
		  </select>
		</td>
	  </tr>
	  <tr class="tr_login">
		<td>
		  Логин:
		</td>
		<td>
  		  <input type="text" name="resource_login" id="resource_login" value="<?php echo $form['resource_login'] ?>" />
		</td>
	  </tr>
	  <tr class="tr_pass">
		<td>
		  Пароль:
		</td>
		<td>
  		  <input type="text" name="resource_pass" id="resource_pass" value="<?php echo $form['resource_pass'] ?>" />
		</td>
	  </tr>
	  <tr class="tr_params">
		<td>
		  Как отправлять параметры:
		</td>
		<td>
		  <select name="resource_method" id="resource_method">
			<?php foreach (MawsParser::$arResourceMethod as $key=>$value): ?>
			  <option value="<?php echo $key?>" <?php if ($form['resource_method']==$key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
			<?php endforeach; ?>
		  </select>
		</td>
	  </tr>
	  <tr class="tr_params">
		<td>
		  Параметры:
		</td>
		<td>
		  <div id="resource_params">
			<?php $i = 0; ?>
			<?php foreach ($form['resource_param_name'] as $id => $name): ?>
			  <span>
				Название:<input type="text" name="resource_param_name[<?=$i?>]" id="resource_param_name[<?=$i?>]" value="<?php echo $name ?>" />
				Значение: <input type="text" name="resource_param_value[<?=$i?>]" id="resource_param_value[<?=$i?>]" value="<?php echo $form['resource_param_value'][$id] ?>" /><br />
				<?php $i++; ?>
			  </span>
			<?php endforeach; ?>
		  </div>
		  <script type="application/javascript">
			  var i = <?=$i?>;
		  </script>
		  <div style="display: none;" id="resource_param">
			<span>
			  Название:<input type="text" name="resource_param_name[#i#]" id="resource_param_name[#i#]" value="" />
			  Значение: <input type="text" name="resource_param_value[#i#]" id="resource_param_value[#i#]" value="" /><br />
			</span>
		  </div>
		  <a href="#" class="add_resource_param">Добавить параметр</a>
		</td>
	  </tr>
	  <tr>
		<td colspan="2">
		  <h2>Как фильтровать?</h2>
		</td>
	  </tr>
	  <tr>
		<td>
		  Тип фильтра:
		</td>
		<td>
		  <select name="filter_type" id="filter_type">
			<?php foreach (MawsParser::$arFilterType as $key=>$value): ?>
			  <option value="<?php echo $key?>" <?php if ($form['filter_type']==$key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
			<?php endforeach; ?>
		  </select>
		</td>
	  </tr>
	  <tr class="tr_regexp">
		<td>
		  Регулярное выражение:
		</td>
		<td>
  		  <input type="text" name="filter_params[regexp]" id="filter_params[regexp]" value="<?php echo $form['filter_params']['regexp'] ?>" />
		</td>
	  </tr>
	  <tr class="tr_regexp">
		<td>
		  Взять в качестве результата:
		</td>
		<td>
		  <select name="filter_params[regexp_type]" id="filter_params[regexp_type]">
			<?php foreach (MawsParser::$arRegexpFilterType as $key=>$value): ?>
			  <option value="<?php echo $key?>" <?php if ($form['filter_params']['regexp_type']==$key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
			<?php endforeach; ?>
		  </select>
		</td>
	  </tr>
	  <tr class="tr_domselect">
		<td>
		  XPATH-селектор:
		</td>
		<td>
  		  <input type="text" name="filter_params[xpath]" id="filter_params[xpath]" value="<?php echo $form['filter_params']['xpath'] ?>" />
		</td>
	  </tr>
	  <tr class="tr_domselect">
		<td>
		  Что взять из найденных элементов:
		</td>
		<td>
  		  <select name="filter_params[xpath_param]" id="filter_params[xpath_param]">
			<?php foreach (MawsParser::$arXpathFilterType as $key=>$value): ?>
			  <option value="<?php echo $key?>" <?php if ($form['filter_params']['xpath_param']==$key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
			<?php endforeach; ?>
		  </select>
		</td>
	  </tr>
	  <tr class="tr_domselect">
		<td>
		  Атрибут (если требуется):
		</td>
		<td>
  		  <input type="text" name="filter_params[dom_attr]" id="filter_params[dom_attr]" value="<?php echo $form['filter_params']['dom_attr'] ?>" />
		</td>
	  </tr>
	  <tr class="tr_markers">
		<td>
		  Начальный маркер:
		</td>
		<td>
  		  <input type="text" name="filter_params[start_marker]" id="filter_params[start_marker]" value="<?php echo $form['filter_params']['start_marker'] ?>" />
		</td>
	  </tr>
	  <tr class="tr_markers">
		<td>
		  Конечный маркер:
		</td>
		<td>
  		  <input type="text" name="filter_params[end_marker]" id="filter_params[end_marker]" value="<?php echo $form['filter_params']['end_marker'] ?>" />
		</td>
	  </tr>
	  <tr>
		<td colspan="2">
		  <h2>Что делать с результатами?</h2>
		</td>
	  </tr>
	  <tr>
		<td>
		  Варианты действий:
		</td>
		<td>
		  <select name="action_type" id="action_type">
			<?php foreach (MawsParser::$arActionType as $key=>$value): ?>
			  <option value="<?php echo $key?>" <?php if ($form['action_type']==$key) : ?> selected="" <?php endif; ?> ><?php echo $value ?></option>
			<?php endforeach; ?>
		  </select>
		</td>
	  </tr>
	  <tr class="tr_n">
		<td>
		  N:
		</td>
		<td>
  		  <input type="text" name="action_params[n]" id="action_params[n]" value="<?php echo $form['action_params']['n'] ?>" />
		</td>
	  </tr>
	  <tr class="tr_m">
		<td>
		  M:
		</td>
		<td>
  		  <input type="text" name="action_params[m]" id="action_params[m]" value="<?php echo $form['action_params']['m'] ?>" />
		</td>
	  </tr>
	  <tr>
		<td colspan="2">
		</td>
	  </tr>
    </tbody>
  </table>
  <input type="hidden" name="id" id="id" value="<?php echo $form['id'] ?>" />
  <?php if (isset($form_action)): ?>
  <input type="hidden" name="form_action" id="form_action" value="<?php echo $form_action ?>" />
  <?php endif; ?>
</form>
