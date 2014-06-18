<?php
 function parse_int($string)
 {
   $j=0;
   $number=0;
   for ($i=strlen($string); $i>0; $i--)
    {
	  $current_number=0;
	  if ($string[$i-1]==='0')
	   { 
	    $j++; 
	   }
	  else if ($string[$i-1]==='1')
	  {
	   $current_number=pow(10,$j);
	   $j++; 
	  }
	  else if($string[$i-1]==='2')
	  {
	   $current_number=pow(10,$j)*2;
	   $j++;
	  }
	  else if($string[$i-1]==='3')
	  {
	   $current_number=pow(10,$j)*3;
	   $j++; 
	  }
	  else if($string[$i-1]==='4')
	  {
	   $current_number=pow(10,$j)*4;
	   $j++;
	  }
	  else if($string[$i-1]==='5')
	  {
	   $current_number=pow(10,$j)*5;
	   $j++; 
	  }
	  else if($string[$i-1]==='6')
	  {
	   $current_number=pow(10,$j)*6;
	   $j++; 
	  }
	  else if($string[$i-1]==='7')
	  {
	   $current_number=pow(10,$j)*7;
	   $j++; 
	  }
	  else if($string[$i-1]==='8')
	  {
	   $current_number=pow(10,$j)*8;
	   $j++; 
	  }
	  else if($string[$i-1]==='9')
	  {
	   $current_number=pow(10,$j)*9;
	   $j++; 
	  }
	 $number+=$current_number;
	// echo "i=".$i."current_number=".$current_number." number=".$number."<br/>";
	}
   return $number;	
 }

 $string="12345"; 
 echo "string=".$string."<br/>";
 echo "Integer=". parse_int($string)."<br/>";
 $string="a1b2c3d4e5"; 
 echo "string=".$string."<br/>";
 echo "Integer=". parse_int($string)."<br/>";
 $string="a1b2cd34e565"; 
 echo "string=".$string."<br/>";
 echo "Integer=". parse_int($string)."<br/>";
?>