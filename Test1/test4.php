<?php
interface I{
 public function put($key,$value);
 public function get($key,$expiry);
}

class Casher implements I
{
  public function put($key,$value)
   {
    $fp = fopen('./' . $key, 'w'); 
    fwrite($fp, $value); 
    fclose($fp); 
   }
   
  public function get($key,$expiry) 
   {
    if (file_exists('./' . $key)) { 
      if ((time() - $expiry) > filemtime('./' . $key)) 
        return FALSE; 
      $cache = file('./' . $key); 
      return implode('', $cache); 
    } 
    return FALSE; 
   }   
}

$casher=new Casher(); 
$key="cash.txt";
$content= file_get_contents('http://stackoverflow.com/');
if (!$casher->get($key,100))
 $casher->put($key, $content);

?>