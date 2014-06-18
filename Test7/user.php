<?php
class User {
	
    var $link;
    var $host='localhost';
    var $dbname="";
    var $dbuser='';
    var $password="";

	function __constructor(){
    
	}

	function addUser($first_name,$last_name,$email,$age){
		$this->connect();
        $query="INSERT INTO users (first_name,last_name,email,age)
              VALUES ('".$first_name."','".$last_name."','".$email."',".$age.");";
        mysql_query($query) or die('Query fault: ' . mysql_error());
        $this->disconnect();
	}

	function deleteUser($id){
        $this->connect();
        $query="DELETE FROM `users` WHERE `index`=".$id;
        mysql_query($query) or die('Query fault: ' . mysql_error());
        $this->disconnect();
	}

	function searchByName($name){
        $this->connect();
	 	$query = "SELECT * FROM users WHERE first_name LIKE '%".$name."%' ORDER BY `index`";
        $result = mysql_query($query) or die('Query fault: ' . mysql_error());
        $str=$this->table($result);
        $this->disconnect();
        return $str;
	}

	function searchByLastName($last_name){
        $this->connect();
	 	$query = "SELECT * FROM users WHERE last_name LIKE '%".$last_name."%' ORDER BY `index`";
        $result = mysql_query($query) or die('Query fault: ' . mysql_error());
        $str=$this->table($result);
        $this->disconnect();
        return $str;
	}

    function searchByemail($email){
        $this->connect();
	 	$query = "SELECT * FROM users WHERE last_name LIKE '%".$email."%' ORDER BY `index`";
        $result = mysql_query($query) or die('Query fault: ' . mysql_error());
        $str=$this->table($result);
        $this->disconnect();
        return $str;
	}	

	
	 function getUsers(){
	 	$this->connect();
	 	$query = 'SELECT * FROM users ORDER BY `index`';
        $result = mysql_query($query) or die('Query fault: ' . mysql_error());
        $str='<form action="/delete.php" method="POST">';
        $str.=$this->table($result);
        $str.='<input type="submit"></form>';
        $this->disconnect();
        return $str;
	 }

	 function export(){
	  	$this->connect();
	 	 $query = 'SELECT * FROM users ORDER BY `index`';
         $result = mysql_query($query) or die('Query fault: ' . mysql_error());
	 	 $data=array();
         while($row=mysql_fetch_assoc($result)){
          $data[]=array("index"=>$row["index"],"first_name"=>$row["first_name"],"last_name"=>$row["last_name"],"email"=>$row["email"],"age"=>$row["age"]);
         }
       $this->disconnect();
       return $data;  
	 }

	 function table($result){
        $str="<table border=\"1\" width=\"60%\">";
        $str.="<tr>";
        $str.="<td width=\"10%\">";
        $str.="No #";
        $str.="</td>";
        $str.="<td width=\"20%\">";
        $str.="First name";
        $str.="</td>";
        $str.="<td width=\"20%\">";
        $str.="Last name";
        $str.="</td>";
        $str.="<td width=\"20%\">";
        $str.="Email";
        $str.="</td>";
        $str.="<td width=\"20%\">";
        $str.="Age";
        $str.="</td>";
        $str.="<td width=\"10%\">";
        $str.="Delete";
        $str.="</td>";
        $str.="</tr>";
     
        while($row=mysql_fetch_assoc($result)){
         	$str.="<tr><td width=\"5%\">".$row["index"]."</td><td width=\"20%\">".$row["first_name"]."</td><td width=\"20%\">"
         	      .$row["last_name"]."</td><td width=\"20%\">".$row["email"]."</td><td width=\"20%\">".$row["age"]
         	      ."</td><td width=\"10%\"><input type=\"checkbox\" id=\"chk\" name=\"chk[]\" value=\"".$row["index"]."\"/></td>";
        }
        $str.="</table>"; 
        return $str;
	 }

    function connect(){
        $this->link = mysql_connect($this->host, $this->dbuser,$this->password);
        if (!$this->link) {
         die('Connection error: ' . mysql_error());
        }
        mysql_select_db($this->dbname) or die('Database error: ' . mysql_error());	

    }

    function disconnect(){
     if (isset($this->link)) 	
      mysql_close($this->link);
   }

}
?>