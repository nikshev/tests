<?
require_once("user.php");
$user=new User();
if (isset($_POST['chk'])){
	$chk=$_POST['chk'];
	for($i=0;$i<count($chk);$i++){
      if (isset($chk[$i]))
      	$user->deleteUser($chk[$i]);
	}
}
echo 'User deleted succesfully:<br/><a href="test.php">Back</a>';

?>