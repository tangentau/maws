<?php

class toolBox
{

  public static function toColor($n)
  {
	return(substr("000000".dechex($n),-6));
  }

  public static function floatval($n)
  {
	return floatval(str_replace(',', '.', $n));
  }
}

?>