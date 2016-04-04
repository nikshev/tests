<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 4/4/16
 * Time: 9:19 AM
 */
class MyClass{
    /**
     * Function for calling
     */
    public function my_function($arg){
        return date("Y-m-d H:i:s")." ".time().": Argument: $arg".PHP_EOL;
    }
}