<?php
/**
 * Crawl ebay
 */
error_reporting(E_ALL);  // Turn on all errors, warnings and notices for easier debugging

function constructPostCallAndGetResponse($endpoint, $query, $appid,$max_price)
{
     // create the xml request that will be POSTed
    $xmlRequest = '<?xml version="1.0" encoding="utf-8"?>
                   <findItemsAdvancedRequest xmlns="http://www.ebay.com/marketplace/search/v1/services">
                   <itemFilter>
                   <name>MaxPrice</name>
                   <value>'.$max_price.'</value>
                   <paramName>Currency</paramName>
                   <paramValue>USD</paramValue>
                   </itemFilter>
                   <keywords>'.$query.'</keywords>
                   <descriptionSearch>true</descriptionSearch>
                   <paginationInput>
                   <entriesPerPage>35</entriesPerPage>
                   <pageNumber>1</pageNumber>
                   </paginationInput>
                   <outputSelector>SellerInfo</outputSelector>
                   </findItemsAdvancedRequest>';

    $session  = curl_init($endpoint);                       // create a curl session

    curl_setopt($session, CURLOPT_POST, true);              // POST request type
    curl_setopt($session, CURLOPT_POSTFIELDS, $xmlRequest); // set the body of the POST
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);    // return values as a string - not to std out

    $callName = 'findItemsAdvanced';
    $globalID = 'EBAY-US';
    $apiVersion = "1.12.0";
    $hdrs[] = "Content-Type: text/xml";
    $hdrs[] = "X-EBAY-SOA-OPERATION-NAME: $callName";
    $hdrs[] = "X-EBAY-SOA-SECURITY-APPNAME: $appid";
    $hdrs[] = "X-EBAY-SOA-SERVICE-VERSION: $apiVersion";
    $hdrs[] = "X-EBAY-SOA-SERVICE-NAME: FindingService";
    $hdrs[] = "X-EBAY-SOA-REQUEST-DATA-FORMAT: XML";
    $hdrs[] = "X-EBAY-SOA-RESPONSE-DATA-FORMAT: XML";
    $hdrs[] = "X-EBAY-SOA-GLOBAL-ID: $globalID";

    $ch = curl_init($endpoint);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $hdrs);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);

    $response = curl_exec($ch);
    return $response;
} // function


echo "Crawl ebay<br/>";
//Global variables
$query = 'ipod';  // Supply a query
$endpoint = "http://svcs.ebay.com/services/search/FindingService/v1";
$appid = 'Need AppID for script';  // Replace with your own AppID
$max_price="0.10";

$resp = simplexml_load_string(constructPostCallAndGetResponse($endpoint, $query,$appid,$max_price));

// Check to see if the response was loaded, else print an error
if ($resp) {
    $results = '';
    // If the response was loaded, parse it and build links
    foreach($resp->searchResult->item as $item) {
        $link  = $item->viewItemURL;
        $title = $item->title;
        $id=$item->productId;
        $bid=$item->sellingStatus->convertedCurrentPrice;
        echo '<a href="'.$link.'">ID{'.$id.'} '.$title.'  BID Price{'.$bid."}</a><br/>";
    }
}
// If there was no response, print an error
else {
    $results = "Oops! Must not have gotten the response!";
}
