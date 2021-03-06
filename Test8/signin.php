<?php
/**
 * Signin feature
 */

require_once("user.php");
$user=new User();
$userdata=array();

if (!$user->is_authorized()) {

    $uploaddir = getcwd()."/images/";
    $uploadfile = $uploaddir.date("Y_m_d_H_i_s")."_".basename($_FILES['av']['name']);

    $av_url=null;
    /*var_dump($_FILES);
    echo "<br/>tmpFileName=".$_FILES['av']['tmp_name'];
    echo "<br/>uploadfile=".$uploadfile;
    echo "<br/>result=".move_uploaded_file($_FILES['av']['tmp_name'], $uploadfile);*/
    if (move_uploaded_file($_FILES['av']['tmp_name'], $uploadfile))
       $av_url="/forge/images/".date("Y_m_d_H_i_s")."_".basename($_FILES['av']['name']);
   //echo "<br/>av_url=".$av_url;
   $userdata = array("login" => $user->validate("login", addslashes($_POST["newlogin"])),
        "first" => $user->validate("first", addslashes($_POST["first"])),
        "last" => $user->validate("last", addslashes($_POST["last"])),
        "phone" => $user->validate("phone", addslashes($_POST["phone"])),
        "pwd" => $user->validate("pwd", addslashes($_POST["pwd"])),
        "av_url" => $av_url,
        "birth" => $user->validate("birth", addslashes($_POST["birth"])),
        "marital" => $user->validate("marital", addslashes($_POST["marital"])),
        "ed" => $user->validate("ed", addslashes($_POST["ed"])),
        "ex" => $user->validate("ex", addslashes($_POST["ex"])),
        "ad" => $user->validate("ad", addslashes($_POST["ad"])),
    );

    $error=$user->set_data($userdata);
    if (empty($error))
        header("Location: /forge/index.php");
    else
        echo "Error: ".$error;
} else
    header("Location: /forge/index.php");

