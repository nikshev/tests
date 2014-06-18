<?php
/**
 * Created by JetBrains PhpStorm.
 * Crawl Google
 */
error_reporting(E_ALL);  // Turn on all errors, warnings and notices for easier debugging

function get_url_contents($url) {
    $crl = curl_init();

    curl_setopt($crl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
    curl_setopt($crl, CURLOPT_URL, $url);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, 5);

    $ret = curl_exec($crl);
    curl_close($crl);
    return $ret;
}

function GetImageFromUrl($link)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch,CURLOPT_URL,$link);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result=curl_exec($ch);
    curl_close($ch);
    return $result;
}

echo "Crawl Google</br>";
$query='aeron';
$json = get_url_contents('http://ajax.googleapis.com/ajax/services/search/images?v=1.0&q='.$query);

$data = json_decode($json);

 foreach ($data->responseData->results as $result) {
    $results[] = array('url' => $result->url, 'alt' => $result->title);
    $sourcecode = GetImageFromUrl($result->url);
    $i=strripos($result->url,"/");
    $str=substr($result->url,$i);
    $path=getcwd()."/".$str.".jpg";

     if(file_exists($path)){
         unlink($path);
     }

    $file = fopen($path, 'w');
    fwrite($file, $sourcecode);
    fclose($file);
 }
echo "Crawl Google successful....</br>";
