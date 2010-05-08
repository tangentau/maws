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

  /**
   * mod of
   *   http://www.php.net/manual/en/function.date.php#71397
   * Converts a date and time string from one format to another (e.g. d/m/Y => Y-m-d, d.m.Y => Y/d/m, ...)
   *
   *	Usage:
   *
   *	  $df_src = 'd/m/Y H:i:s';
   *	  $df_des = 'Y-m-d H:i:s';
   *
   *	  echo dates_interconv( $df_src, $df_des, '25/12/2005 23:59:59');
   *
   *	Output:
   *
   *  2005-12-25 23:59:59
   *
   * @param string $date_format1
   * @param string $date_format2
   * @param string $date_str
   * @return string
   */
  public static function dates_interconv($date_format1, $date_format2, $date_str)
  {

      $base_struc     = split('[:/.\ \-]', $date_format1);
      $date_str_parts = split('[:/.\ \-]', $date_str );

      // print_r( $base_struc ); echo "\n"; // for testing
      // print_r( $date_str_parts ); echo "\n"; // for testing

      $date_elements = array();

      $p_keys = array_keys( $base_struc );
      foreach ( $p_keys as $p_key )
      {
          if ( !empty( $date_str_parts[$p_key] ))
          {
              $date_elements[$base_struc[$p_key]] = $date_str_parts[$p_key];
          }
          else
              return false;
      }

      // print_r($date_elements); // for testing

      if (array_key_exists('M', $date_elements)) {
        $Mtom=array(
          "Jan"=>"01",
          "Feb"=>"02",
          "Mar"=>"03",
          "Apr"=>"04",
          "May"=>"05",
          "Jun"=>"06",
          "Jul"=>"07",
          "Aug"=>"08",
          "Sep"=>"09",
          "Oct"=>"10",
          "Nov"=>"11",
          "Dec"=>"12",
        );
        $date_elements['m']=$Mtom[$date_elements['M']];
      }

      // print_r($date_elements); // for testing

      $dummy_ts = mktime(
        $date_elements['H'],
        $date_elements['i'],
        $date_elements['s'],
        $date_elements['m'],
        $date_elements['d'],
        $date_elements['Y']
      );

      return date( $date_format2, $dummy_ts );
  }

}
?>