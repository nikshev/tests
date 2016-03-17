<?php
/**
 * Add node to tree
 */
require_once("tree.php");
$result=-1;
if (isset($_POST["parent_id"])&&isset($_POST["name"])) {
    $parent_id = intval($_POST["parent_id"]);
    $name=addslashes($_POST["name"]);
    $tree=new Tree();
    $result=$tree->AddNode($parent_id,$name);
}
echo $result;
?>