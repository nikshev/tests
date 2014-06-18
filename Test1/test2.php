<?php
 function getDateTime($string)
 {
   // строка полученная из Access
   $date_time_string = $string;

   // Разбиение строки в 3 части - date, time and AM/PM 
   $dt_elements = explode(' ',$date_time_string);

    // Разбиение даты
    $date_elements = explode('/',$dt_elements[0]);

    // Разбиение времени
    $time_elements =  explode(':',$dt_elements[1]);

    // Если у нас время в формате PM мы можем добавить 12 часов для получения  24 часового формата времени
    if (isset($dt_elements[2]))
	 if ($dt_elements[2] == 'PM')
      $time_elements[0] += 12;
    

    // вывод результата
    return mktime($time_elements[0], $time_elements[1],$time_elements[2], $date_elements[0],$date_elements[1], $date_elements[2]);
 }

 date_default_timezone_set('Europe/Kiev');
 $string="01/18/2014 01:02:03"; 
 echo "string=".$string."<br/>";
 echo "Date=". date("d-m-Y H:i:s",getDateTime($string))."<br/>";
 $string="12/20/2013 01:52:05"; 
 echo "string=".$string."<br/>";
 echo "Date=".  date("d-m-Y H:i:s",getDateTime($string))."<br/>";
 
?>