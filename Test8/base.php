<?php
/**
 * Class: Base
 */
class Base {
	
    var $link;
    var $host='                        ';
    var $dbname='';
    var $dbuser='';
    var $password='';
  /**
  * Constructor for Base
  */
  function __constructor(){
    

  }

 /**
  * Connect with database
  */
  function connect(){
        $this->link = mysql_connect($this->host, $this->dbuser,$this->password);
        if (!$this->link) {
         die('Connection error: ' . mysql_error());
        }
        mysql_select_db($this->dbname) or die('Database error: ' . mysql_error());	

    }

  /**
   * Disconnect 
   */
    function disconnect(){
     if (isset($this->link)) 	
      mysql_close($this->link);
   }

    /**
     * Function insert user data to table
     * @param $userdata
     * @return null
     */
    public function save_user_data($userdata){
      $retval="";
      $sql_command="INSERT INTO user (";
      $sql_value="VALUES(";
      $value_count=0;
      if (isset($userdata)) {

          $point="";
          if (!empty($userdata["av_url"])){
              $sql_command.=$point."av";
              $sql_value.=$point."'".$userdata["av_url"]."'";
              $value_count++;
              $point=",";
          }

          if (!empty($userdata["birth"])){
              $sql_command.=$point."birth";
              $sql_value.=$point."'".$userdata["birth"]."'";
              $value_count++;
              $point=",";
          }

          if (!empty($userdata["martial"])){
              $sql_command.=$point."martial";
              $sql_value.=$point."'".$userdata["martial"]."'";
              $value_count++;
              $point=",";
          }

          if (!empty($userdata["ed"])){
              $sql_command.=$point."ed";
              $sql_value.=$point."'".$userdata["ed"]."'";
              $value_count++;
              $point=",";
          }

          if (!empty($userdata["ex"])){
              $sql_command.=$point."ex";
              $sql_value.=$point."'".$userdata["ex"]."'";
              $value_count++;
              $point=",";
          }

          if (!empty($userdata["ad"])){
              $sql_command.=$point."ad";
              $sql_value.=$point."'".$userdata["ad"]."'";
              $value_count++;
              $point=",";
          }

          if (!empty($userdata["login"])){
              $sql_command.=$point."email";
              $sql_value.=$point."'".$userdata["login"]."'";
              $value_count++;
              $point=",";
          }
          else {
              $retval = "Login is null or incorrect! <br/>";
              $value_count=0;
          }

          if (!empty($userdata["first"])){
              $sql_command.=$point."first";
              $sql_value.=$point."'".$userdata["first"]."'";
              if ($value_count>0)
               $value_count++;
              $point=",";
          }
          else {
              $retval .= "First is null or incorrect! <br/>";
              $value_count = 0;
          }

          if (!empty($userdata["last"])){
              $sql_command.=$point."last";
              $sql_value.=$point."'".$userdata["last"]."'";
              if ($value_count>0)
                  $value_count++;
              $point=",";
          }
          else {
              $retval .= "Last is null or incorrect! <br/>";
              $value_count = 0;
          }

          if (!empty($userdata["phone"])){
              $sql_command.=$point."phone";
              $sql_value.=$point."'".$userdata["phone"]."'";
              if ($value_count>0)
                  $value_count++;
              $point=",";
          }
          else {
              $retval .= "Phone is null or incorrect!<br/> ";
              $value_count = 0;
          }

          if (!empty($userdata["pwd"])){
              $sql_command.=$point."pwd";
              $sql_value.= $point."'".$userdata["pwd"]."'";
              if ($value_count>0)
                  $value_count++;
          }
          else {
              $retval .= "Password is null or incorrect!<br/> ";
              $value_count = 0;
          }


          $sql_command.=") ";
          $sql_value.=");";
          $query=$sql_command.$sql_value;
          if ($value_count>0) {
              $this->connect();
              mysql_query($query) or die('Query fault: Query=' . $query . "<br/> Error=" . mysql_error());
              $this->disconnect();
          }
      }
      return $retval;
    }

    /**
     * Function update user data by userid
     * @param $userid
     * @param $userdata
     */
    public function update_user_data($userid, $userdata){

    }

    /**
     * @param $userid
     * @return array
     */
    public function get_user_data($userid){
        $ret_arr=array();
        return $ret_arr;
    }


 }