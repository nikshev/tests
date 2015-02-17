<?php
/**
 * login feature
 */

require_once("user.php");
$user=new User();
if (!$user->is_authorized()) {
    $email = addslashes($_POST["login"]);
    $pwd = addslashes($_POST["pwd"]);
    $user->check_login($email,$pwd);
}
header("Location:/forge/index.php");

