<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 4/1/16
 * Time: 11:20 AM
 */
require_once('RateLimiter.php');

//Setup and configure memcache
$memcache=new Memcache();
$memcache->connect('127.0.0.1', 11211) or die ("Could not connect");

//Create object instance
$rateLimiter = new RateLimiter($memcache, 'rate',10);
$rateLimiter->AddFunctionForRun(array($rateLimiter,'my_function'));

//Call function through Rate limiter object
for ($i=0; $i<100000; $i++) {
    try {
        $rateLimiter->Run();
    } catch (RateExceededException $e) {
        echo date("Y-m-d H:i:s")." ".time().": Limit exceed!!!!".PHP_EOL;
    } catch (NotSetCallableFunctionException $e) {
        echo date("Y-m-d H:i:s") ." ".time(). ": Not set callable function!!!!".PHP_EOL;
    }
}