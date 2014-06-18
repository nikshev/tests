<?php

class apitest extends apiBaseClass {

    public $journey=array();
	
 //http://www.example.com/api/?apitest.helloAPI={}
    function helloAPI() {
        $retJSON = $this->createDefaultJson();
        $retJSON->withoutParams = 'It\'s method called without parameters';
        return $retJSON;
    }
  
    //http://localhost/index.php?apitest.UOAPI={}
    function UOAPI() {
		 //Sorry, I don't have time for debug
        return json_encode($this->journey);
    }

	 //http://localhost/index.php?apitest.SOAPI={}
    function SOAPI() {
	    //Sorry, I don't have time for debug
		$tmp_arr=amsort($this->journey, "Position")
        return json_encode($tmp_arr);
    }
	
	//http://localhost/index.php?apitest.AddPositionAPI={"Postion":1,"Transport":"train","From":"Georg","To":"dddd","Seat":"48"}
    function AddPositionAPI($apiMethodParams) {
	 
       $retJSON = $this->createDefaultJson();
       if (isset($apiMethodParams->Position)&&isset($apiMethodParams->Transport)
	       &&isset($apiMethodParams->From)&&isset($apiMethodParams->To)&&isset($apiMethodParams->Seat)){
	        array_push($this->journey,array("Position"=>$apiMethodParams->Position, 
			                 "Transport"=>$apiMethodParams->Transport,
                             "From"=>$apiMethodParams->From,
                             "To"=> $apiMethodParams->To,
                             "Seat"=>$apiMethodParams->Seat));
            //if all ok return position
            $retJSON->retParameter=$apiMethodParams->Position;
        }else{
            $retJSON->errorno=  APIConstants::$ERROR_PARAMS;
        }
        return $retJSON;
    }
}

//Sorted by key
function amsort($array, $key) {
	$result = array();
	$values = array();
 
	foreach ($array as $id => $value) {
		$values[$id] = $value[$key];
	}
 
	asort($values);
 
	foreach ($values as $key => $value) {
		$result[$key] = $array[$key];
	}
 
	return $result;
}
 
for($i=0; $i<100000; $i++){
	$data_tmp=$data;
	amsort($data_tmp);
}
?>