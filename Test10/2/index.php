<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 3/17/16
 * Time: 1:47 PM
 */
error_reporting(E_ALL);
if (isset($argv[1])) {
    $html = file_get_contents(trim($argv[1]));
//Create a new DOM document
    $dom = new DOMDocument;

//Parse the HTML. The @ is used to suppress any parsing errors
//that will be thrown if the $html string isn't valid XHTML.
    $dom->loadHTML($html);

//Get all links. You could also use any other tag name here,
//like 'img' or 'table', to extract other tags.
    $links = $dom->getElementsByTagName('a');

//Iterate over the extracted links and display their URLs
    $result=array();
    foreach ($links as $link) {
        //Extract and show the "href" attribute.
        $result[md5($link->getAttribute('href'))] = $link->getAttribute('href');
    }

    var_dump($result);
}