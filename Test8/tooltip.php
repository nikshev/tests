<?php
/**
 * Tool tip feature
 */

require_once("user.php");
$user=new User();
$const=$_POST["const"];
if (!empty($const))
    echo $user->get_lang_constant($const);
