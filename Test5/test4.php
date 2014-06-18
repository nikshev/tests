<?php
/**
 * Crawl craigslist.org
 * http://losangeles.craigslist.org/search/sss?maxAsk=350&query=herman%20miller&sort=rel
 * http://losangeles.craigslist.org/search/sss?s=100&maxAsk=350&query=herman%20miller&sort=rel
 * http://losangeles.craigslist.org/search/sss?s=200&maxAsk=350&query=herman%20miller&sort=rel
 * http://losangeles.craigslist.org/search/sss?s=300&maxAsk=350&query=herman%20miller&sort=rel
 * http://losangeles.craigslist.org/search/sss?s=400&maxAsk=350&query=herman%20miller&sort=rel
 */

require_once("simple_html_dom.php");

/**
 * User: nikshev
 * Date: 5/26/14
 * Get page by url
*/
function getStrByUrl($url){
  //Get the page
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($curl, CURLOPT_HEADER, false);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_REFERER, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  $str = curl_exec($curl);
  curl_close($curl);
  return ($str);
}

/**
 * User: nikshev
 * Date: 5/26/14
 * Get page by url
 */

function getAllLinks($html){
 $tmp_str="";
 $tmp_links=array();
 if (count($html->find('span[class=pl]'))>0)
     foreach ($html->find('span[class=pl] a') as $ahref)
     {
         $tmp_str=$tmp_str.'<a href="http://losangeles.craigslist.org'.$ahref->href.'">'.$ahref->innertext.'</a><br/>';
         $tmp_links[]='<a href="http://losangeles.craigslist.org'.$ahref->href.'">'.$ahref->innertext.'</a>';

     }
  return  $tmp_links;
}

echo "Crawl craigslist.org<br/>";
$search_string="herman%20miller";
$max_price=350; //$USD
$url="http://losangeles.craigslist.org/search/sss?maxAsk=".$max_price."&query=".$search_string."&sort=rel";


echo "Url=".$url."<br/>";
// Create a DOM object
$html = new simple_html_dom();
// Load HTML from a string
$str=getStrByUrl($url);
$html->load($str);


//Get the page count
if (count($html->find('span'))>0)
    foreach ($html->find('span') as $element)
        if ($element->class==="button pagenum")
         $page_num_str=$element->innertext;

if (isset($page_num_str)){
    $first_space=strpos($page_num_str, ' ',0);
    $second_space=strpos($page_num_str, ' ',$first_space+1);
    $third_space=strpos($page_num_str, ' ',$second_space+1);
    $needed_space=strpos($page_num_str, ' ',$third_space+1);
    $page_num=substr($page_num_str,$needed_space);
}

if (!isset($page_num))
    $page_num=1;
else
    $page_num=round($page_num/100,0,PHP_ROUND_HALF_UP);

echo "pages number=".$page_num."<br/>";
$links[]=getAllLinks($html);

for ($i=1;$i<$page_num;$i++){
    $p=$i*100;
    $url="http://losangeles.craigslist.org/search/sss?s=".$p."&maxAsk=".$max_price."&query=".$search_string."&sort=rel";
    $str=getStrByUrl($url);
    $html->load($str);
    $links[]=getAllLinks($html);
}

var_dump($links);
