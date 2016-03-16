<?php
  if (isset($_POST['fn'])&&isset($_POST['ln'])&&isset($_POST['email'])&&isset($_POST['age'])){
     require_once("user.php");
     $user=new User();
     $fn=addslashes($_POST['fn']);
     $ln=addslashes($_POST['ln']);
     $email=addslashes($_POST['email']);
     $age=intval($_POST['age'],0);
     $user->addUser( $fn,$ln,$email,$age);
     echo 'User added succesfully:<br/><a href="test.php">Back</a>';
  }
  else
  	echo 'Error! Complete user add form! <a href="test.php">Back</a>';
?>