<?php
class apiBaseClass {
    
       
    //Constructor
    function __construct($dbName=null,$dbHost=null,$dbUser=null,$dbPassword=null) {
   
    }
    
    function __destruct() {
   
    }
    
    //Default JSON for response
    function createDefaultJson() {
        $retObject = json_decode('{}');
        return $retObject;
    }
    
    //Fill JSON object 
    function fillJSON(&$jsonObject, &$stmt) {
        return $jsonObject;
    }
}

?>