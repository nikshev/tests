<?php
/**
 * logout feature
 */
require_once("user.php");
$user=new User();
if ($user->is_authorized()) {
    $user->logout();
}
header("Location:/forge/index.php");