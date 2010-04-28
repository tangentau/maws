<?php
if (($_GET['param1']=123)&&($_GET['OMG']=='GOSH'))
{
  echo('<b>'.rand(10000, 100000).'</b>');
  echo('-----------<b>hgjhgj</b>---------');
  echo('<b>'.time().'</b>');
}
elseif (($_POST['param1']=123)&&($_POST['OMG']=='GOSH'))
{
    echo('<b>'.rand(10000, 100000).'</b>');
    echo('-------------<b>'.time().'</b>-----------');
	echo('<b>hgjhgj</b>');
}
else
{
  echo('htgh g436243 dfgdsf547 dfg5462 ["'.date('H:i:s').'"] fe62 ["fdg'.rand(25,23523).'hsdy"] 54w 6');
  echo serialize(array('START_MARKER'=>'<','END_MARKER'=>'>',));
  echo('<br><br><pre>');
  print_r(unserialize('a:2:{s:6:"param1";s:4:"1233";s:3:"OMG";s:3:"GGG";}'));
  echo('</pre>');
}
?>
