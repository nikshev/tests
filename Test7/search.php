 <?
 if (isset($_POST['search'])&&isset($_POST['chk'])){
     require_once("user.php");
     $user=new User();
     $search=addslashes($_POST['search']);
     $chk=$_POST['chk'];
     $str="";
     if (isset($chk[0]))
       if ($chk[0]==="on")
        $str.=$user->searchByName($search);
     if (isset($chk[1]))
      if ($chk[1]==="on")
       $str.=$user->searchByLastName($search);
     if (isset($chk[2]))
      if ($chk[2]==="on")
       $str.=$user->searchByemail($search);
    echo 'Search results:<form action="/delete.php" method="POST">'.$str.'<br/><input type="submit"></form><a href="test.php">Back</a>';
  }
  else
  	echo 'Error! Complete user add form! <a href="test.php">Back</a>';
  ?>