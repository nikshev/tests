<?php
/**
 * Class: Base
 */
class Base {
	
    var $link;
    var $host='mysql.hostinger.com.ua                        ';
    var $dbname='u781633213_task';
    var $dbuser='u781633213_task';
    var $password='ueFV8ocbuq';
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
     * Check email in database
     * @param string $email
     * @return bool
     */
    public function check_email($email="")
    {
        $notInBase=true;
        if (!empty($email)) {
            $query = "SELECT id FROM user WHERE email='".$email."';";
            $this->connect();
            $result=mysql_query($query) or die('Query fault: Query=' . $query . "<br/> Error=" . mysql_error());
            $num_rows = mysql_num_rows($result);
            if ($num_rows>0)
                $notInBase=false;
            $this->disconnect();
        }
        return $notInBase;
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

          if (!empty($userdata["marital"])){
              $sql_command.=$point."marital";
              $sql_value.=$point."'".$userdata["marital"]."'";
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
              $retval = "Login is null or incorrect or already in database! <br/>";
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
        if (!empty($userid)&&$userid>-1) {
            $query = "SELECT * FROM user WHERE id=".$userid;
            $this->connect();
            $result=mysql_query($query) or die('Query fault: Query=' . $query . "<br/> Error=" . mysql_error());
            $row=mysql_fetch_assoc($result);

            if (isset($row["ad"]))
                $user_data["ad"]=$row["ad"];
            else
                $user_data["ad"]="";

            if (isset($row["ex"]))
                $user_data["ex"]=$row["ex"];
            else
                $user_data["ex"]="";

            if (isset($row["ed"]))
                $user_data["ed"]=$row["ed"];
            else
                $user_data["ed"]="";

            if (isset($row["marital"]))
                $user_data["marital"]=$row["marital"];
            else
                $user_data["marital"]="";

            if (isset($row["birth"]))
                $user_data["birth"]=$row["birth"];
            else
                $user_data["birth"]="";

            if (isset($row["email"]))
                $user_data["email"]=$row["email"];
            else
                $user_data["email"]="";

            if (isset($row["phone"]))
                $user_data["phone"]=$row["phone"];
            else
                $user_data["phone"]="";

            if (isset($row["last"]))
                $user_data["last"]=$row["last"];
            else
                $user_data["last"]="";

            if (isset($row["first"]))
                $user_data["first"]=$row["first"];
            else
                $user_data["first"]="";

            if (isset($row["av"]))
                $user_data["av"]=$row["av"];
            else
                $user_data["av"]="";
            $this->disconnect();
            return $user_data;
        } else
        return null;
    }

    /**
     * Check login
     * @param string $email
     * @param string $pwd
     * @return bool
     */
    public function check_login($email="",$pwd="")
    {
        $userid=-1;
        if (!empty($email)) {
            $query = "SELECT id FROM user WHERE email='".$email."' and pwd='".$pwd."'";
            $this->connect();
            $result=mysql_query($query) or die('Query fault: Query=' . $query . "<br/> Error=" . mysql_error());
            $row=mysql_fetch_assoc($result);
            $userid=$row["id"];
            $this->disconnect();
        }
        return $userid;
    }


 }