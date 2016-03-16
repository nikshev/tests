<?php
 require_once("user.php");
 $user=new User();
?>
<a href="/export.php">Export to Excel</a>
<h1>Add user</h1><br/>
<form action="/adduser.php" method="POST">
	<label for ="fn">First name</label>
	<input type="text" id="fn" name="fn" value=""/>
	<label for ="ln">Last name</label>
	<input type="text" id="ln" name="ln" value=""/>
	<label for ="email">Email</label>
	<input type="text" id="email" name="email" value=""/>
	<label for ="age">Age</label>
	<input type="text" id="age" name="age" value=""/>
	<input type="submit"/>
</form>	
<h1>Users</h1><br/>
<?php echo $user->getUsers(); ?>

<h1>Search</h1>
<form action="/search.php" method="POST">
	<label for ="search">Search</label>
	<input type="text" id="search" name="search" value=""/><br/>
	<label for ="chk1">By first name</label>
	<input type="checkbox" id="chk1" name="chk[]" />
    <label for ="chk2">By last name</label>
	<input type="checkbox" id="chk2" name="chk[]"/>
    <label for ="chk3">By email</label>
	<input type="checkbox" id="chk3" name="chk[]"/><br/>
    <input type="submit">
</form>		