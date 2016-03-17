<?php
/**
 * Delete node
 */
require_once("tree.php");
$result=-1;
if (isset($_POST["id"])) {
    $id = intval($_POST["id"]);
    $tree=new Tree();
    $tree->DeleteNode($id);
}
echo $result;
?>