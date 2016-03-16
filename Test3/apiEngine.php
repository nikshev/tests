<?php
require_once ('apiConstants.php');

class APIEngine {

    private $apiFunctionName;
    private $apiFunctionParams;

    //��������� ������� ��� ����������� API �� ������ API ��� ������������� � �������
    static function getApiEngineByName($apiName) {
        require_once 'apiBaseClass.php';
        require_once $apiName . '.php';
        $apiClass = new $apiName();
        return $apiClass;
    }
    
    //�����������
    //$apiFunctionName - �������� API � ����������� ������ � ������� apitest_helloWorld
    //$apiFunctionParams - JSON ��������� ������ � ��������� �������������
    function __construct($apiFunctionName, $apiFunctionParams) {
        $this->apiFunctionParams = stripcslashes($apiFunctionParams);
        //������ �� ������ �� ���� ��������� [0] - �������� API, [1] - �������� ������ � API
        $this->apiFunctionName = explode('_', $apiFunctionName);
    }

    //JSON Response
    function createDefaultJson() {
        $retObject = json_decode('{}');
        $response = APIConstants::$RESPONSE;
        $retObject->$response = json_decode('{}');
        return $retObject;
    }
    
    //Call Api function with or without argumentes
    function callApiFunction() {
        $resultFunctionCall = $this->createDefaultJson();
        $apiName = strtolower($this->apiFunctionName[0]);
        if (file_exists($apiName . '.php')) {
            $apiClass = APIEngine::getApiEngineByName($apiName);
            $apiReflection = new ReflectionClass($apiName);
            try {
                $functionName = $this->apiFunctionName[1];
                $apiReflection->getMethod($functionName);
                $response = APIConstants::$RESPONSE;
                $jsonParams = json_decode($this->apiFunctionParams);
                if ($jsonParams) {
                    if (isset($jsonParams->responseBinary)){
                        return $apiClass->$functionName($jsonParams);
                    }else{
                        $resultFunctionCall->$response = $apiClass->$functionName($jsonParams);
                    }
                } else {
                    
                    $resultFunctionCall->errno = APIConstants::$ERROR_ENGINE_PARAMS;
                    $resultFunctionCall->error = 'Error given params';
                }
            } catch (Exception $ex) {
                
                $resultFunctionCall->error = $ex->getMessage();
            }
        } else {
            
            $resultFunctionCall->errno = APIConstants::$ERROR_ENGINE_PARAMS;
            $resultFunctionCall->error = 'File not found';
            $resultFunctionCall->REQUEST = $_REQUEST;
        }
        return json_encode($resultFunctionCall);
    }
}

?>

?>c