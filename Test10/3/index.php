<?php
/**
 * Index file
 */
require_once("tree.php");
$tree=new Tree();
$tree=$tree->GetTree();
?>
<head>
    <title>Test task 3</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/tree.css">
    <script src="http://code.jquery.com/jquery-1.7.2.min.js" type="text/javascript"> </script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="js/tree.js" type="text/javascript"> </script>
</head>
<body>
  <div id="wrapper">
   <div class="tree">
     <?=$tree?>
   </div>
  </div>
</body>
