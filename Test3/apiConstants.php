<?php
class APIConstants {

    //Result of a request-parameter JSON in response
    public static $RESULT_CODE="resultCode";
    
    //Response parameter
    public static $RESPONSE="response";
    
    //No errors
    public static $ERROR_NO_ERRORS = 0;
    
    //Errors in parametres
    public static $ERROR_PARAMS = 1;
    
    //Errors in SQL (we are not used SQL)
    public static $ERROR_STMP = 2;

    //Record not found (we are not used SQL)
    public static $ERROR_RECORD_NOT_FOUND = 3;
    
    //Engine parametres error
    public static $ERROR_ENGINE_PARAMS = 100;
    
    //Zip error
    public static $ERROR_ENSO_ZIP_ARCHIVE = 1001;
    
}
?>