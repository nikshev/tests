<?php
/**
* Switch language feature
 */
require_once("user.php");
$user=new User();
$user->switch_lang();
header("Location:/forge/index.php");
