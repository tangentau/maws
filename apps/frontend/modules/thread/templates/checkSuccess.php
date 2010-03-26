<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

echo(count($thread_ids).'<hr>');

foreach ($thread_ids as $id)
{
	echo($id['ID'].'<hr>');
}
?>
