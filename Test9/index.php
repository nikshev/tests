<?php
/**
* Index page
*/
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
 <title>Test task (Comment form) - Eugene Shkurnikov</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <meta name="Lawsuit and calculation" content="Lawsuit and calculation">
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" media="screen" />
</head>
<body>
<div class="container">
 <div class="row clearfix">

  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-6  column col-sm-offset-0 col-md-offset-2 col-lg-offset-3">
   <a href="http://api.hostinger.com.ua/redir/5450818" target="_blank"><img src="http://hostinger.com.ua/banners/ru/hostinger-728x90-1.gif" alt="Бесплатный Хостинг" border="0" width="728" height="90" /></a>


   <?
   require_once("comment.php");
   require_once("observer.php");
   $form=new Comment();
   Observer::addObserver(Event::ON_SUBMIT,$form);
   $parameters=array();
   if (isset($_POST["subject"]))
    $parameters["subject"]=addslashes($_POST["subject"]);
   if (isset($_POST["name"]))
    $parameters["name"]=addslashes($_POST["name"]);
   if (isset($_POST["email"]))
    $parameters["email"]=addslashes($_POST["email"]);
   if (isset($_POST["comment"]))
    $parameters["comment"]=addslashes($_POST["comment"]);
   if (count($parameters)>0)
    $form->update($parameters);
   ?>
   <legend>Comment Form</legend>
   <a href="http://ua.linkedin.com/pub/eugene-shkurnikov/79/b13/124">About me</a>

   <?php
   $form->show();
   ?>

  </div>
 </div>
</div>
</body>
</html>
