<?php
/**
 * Edit node
 */
require_once("tree.php");
$result=-1;
if (isset($_POST["name"])&&isset($_POST["id"])) {
    if (isset($_POST["parent_id"]))
        $parent_id = intval($_POST["parent_id"]);
    else
        $parent_id =0;
    $name=addslashes($_POST["name"]);
    $id=intval($_POST["id"]);
    $tree=new Tree();
    $tree->EditNode($id,$parent_id,$name);
}
echo $result;
?>