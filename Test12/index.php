<?php
/**
* Get numbers from stdin and convert into bit
* if before exist equal number
* if after exist equal number
*/

$d=array();

$k=intval(read_stdin());

//Get numbers from stdin
for($i=0;$i<$k;$i++){
 $d[]=intval(read_stdin());
}

//Create strings
$first_line="";
$second_line="";
for ($i=0;$i<$k;$i++){
 $first_line.="".in_array_before($i-1,$d,$d[$i]);
 $second_line.="".in_array_after($i+1,$d,$d[$i]);
}

//Write strings to STDOUT
fwrite(STDOUT, $first_line.PHP_EOL);
fwrite(STDOUT, $second_line.PHP_EOL);


/**
 * Search in array after position
 * @param $k - position
 * @param $arr - source array
 * @param $num - number for compare
 * @return int - return bit
 */
function in_array_after($k,$arr,$num){
    $in_array_after=0;
    for ($i=$k;$i<count($arr);$i++){
       if (intval($arr[$i])==intval($num)){
           $in_array_after=1;
       }
    }
    return $in_array_after;
}

/**
 * Search in array before  position
 * @param $k - position
 * @param $arr - source array
 * @param $num - number for compare
 * @return int - return bit
 */
function in_array_before($k,$arr,$num){
    $in_array_before=0;
    if ($k>0) {
        for ($i = $k; $i > -1; $i--) {
            if (intval($arr[$i]) == intval($num)) {
                $in_array_before = 1;
            }
        }
    }
    return $in_array_before;
}

/**
 * read STDIN
 * @return string
 */
function read_stdin()
{
    $fr=fopen("php://stdin","r");   // open our file pointer to read from stdin
    $input = fgets($fr,128);        // read a maximum of 128 characters
    $input = rtrim($input);         // trim any trailing spaces.
    fclose ($fr);                   // close the file handle
    return $input;                  // return the text entered
}
