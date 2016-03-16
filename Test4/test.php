<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nikshev
 * Date: 5/20/14
 * Time: 12:10 PM
 * To change this template use File | Settings | File Templates.
 */

/*
 * Source array
 */
$source=array(-2,0,1,2,3,10,11,11,12,13,13,13);

echo "<h1>Problem#1 solution</h1><br/>";
echo "Source array:";
print_r($source);
echo "<br/>";
/*
 * Search min and max
 */
$min=$source[0];
$max=0;
for($i=0;$i<count($source);$i++){
   if ($min>$source[$i])
       $min=$source[$i];
   if ($max<$source[$i])
       $max=$source[$i];
}

echo "min=".$min." max=".$max."<br/>";

/*
 * Looking for missing numbers
 */
$missing = array();
for ($i = $min; $i < $max+1; $i++) {
    if (!in_array($i,$source))
        $missing[]=$i;
}

echo "<br/>Missing numbers array:<br/>";
print_r($missing);
echo "<br/>";

/*
 * Looking for duplicate values
 */
echo "<br/>Duplicate numbers:<br/>";
$new_array = array();
foreach ($source as $key => $value) {
    if(isset($new_array[$value]))
        $new_array[$value] += 1;
    else
        $new_array[$value] = 1;
}
foreach ($new_array as $val => $n) {
    if($n > 1){
        echo $val;
        echo "($n) time(s)<br/>";
    }
}