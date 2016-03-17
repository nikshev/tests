<?php
/**
 * Tree class
 */

class Tree {

    /**
     * Add node to database
     */
    public function AddNode($parent_id,$name){
        $result=-1;
        try {
            $db = new SQLite3('mysqlitedb.db', SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
            if (isset($name)&&isset($parent_id)){
                $db->exec("INSERT INTO tree (PARENT_ID, NAME) VALUES ($parent_id,'$name')");
                $result=$db->lastInsertRowID();
            }
            $db->close();
        }  catch (Exception $ex) {
            echo "Exception in Tree->AddNode: " . $ex->getMessage() . "<br/>";
            $db->close();
        }

        return $result;
    }

    /**
     * Update node in database
     */
    public function EditNode($id,$parent_id,$name){
        $result=-1;
        try {
            $db = new SQLite3('mysqlitedb.db', SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
            if (isset($name)&&isset($parent_id)&&isset($id)){
                $result=$db->exec("UPDATE tree SET PARENT_ID=$parent_id, NAME='$name' WHERE ID=$id");
            }
            $db->close();
        }  catch (Exception $ex) {
            echo "Exception in Tree->EditNode: " . $ex->getMessage() . "<br/>";
            $db->close();
        }
        return $result;
    }

    /**
     * Delete node from database
     */
    public function DeleteNode($id){
        $result=-1;
        try {
            $db = new SQLite3('mysqlitedb.db', SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
            if (isset($id)){
                $result=$db->exec("UPDATE tree SET DELETE_AT=CURRENT_TIMESTAMP WHERE ID=$id");
                $result+=$db->exec("UPDATE tree SET DELETE_AT=CURRENT_TIMESTAMP WHERE PARENT_ID=$id");
            }
            $db->close();
        }  catch (Exception $ex) {
            echo "Exception in Tree->DeleteNode: " . $ex->getMessage() . "<br/>";
            $db->close();
        }
        return $result;
    }

    /**
     * Get whole tree
     * @param null $nodes
     * @return string
     */
    public function GetTree($nodes=null,$parent_id=null){
        $tree="";
        try {
            if (is_null($nodes))
                $nodes=$this->GetAllNodes();
            if (count($nodes)>0) {
                $tree .= "<ul>";
                foreach ($nodes as $node) {
                    $tree .= "<li>";
                    if (is_null($parent_id))
                        $tree .= '<a class="link" data-id="' . $node["ID"] . '">';
                    else
                        $tree .= '<a class="link" data-id="' . $node["ID"] . '" data-parentid="' . $parent_id . '">';
                    $tree .= $node["NAME"];
                    $tree .= '</a><span class="delete" style="color:blue">&nbspDelete</span><span class="input-span"><input type="text" /><a class="save" style="color:blue">&nbsp;Save</a></span>';
                    $tree .=$this->GetTree($node["NODES"],$node["ID"]);
                    $tree .= "</li>";
                }
                if (!is_null($parent_id)) {
                    $tree .= "<li>";
                    $tree .= '<span class="level-link"><a class="add-level" data-id="-1" data-parentid="' . $parent_id . '">';
                    $tree .= "Add level";
                    $tree .= "</a></span>";
                    $tree .='<span class="level-input"><input type="text" /><a class="save-level" style="color:blue">&nbsp;Save</a></span>';
                    $tree .= "</li>";
                    $tree .= "<li>";
                    $tree .= '<span class="item-link"><a class="add-item" data-id="0" data-parentid="' . $parent_id . '">';
                    $tree .= "Add item";
                    $tree .= "</a></span>";
                    $tree .='<span class="item-input"><input type="text" /><a class="save-item" style="color:blue">&nbsp;Save</a></span>';
                    $tree .= "</li>";
                }
                $tree .= "</ul>";
            }
         }  catch (Exception $ex) {
            echo "Exception in Tree->GetTree: " . $ex->getMessage() . "<br/>";
        }
        return $tree;
    }

    /**
     * Get all nodes from database
     * @return array all nodes
     */
    private function GetAllNodes(){
        $tree = array();
        try {
            $db = new SQLite3('mysqlitedb.db', SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
            $result = $db->query('SELECT * FROM tree WHERE DELETE_AT IS NULL AND PARENT_ID=0');
            if (!is_bool($result)) {
                while ($row = $result->fetchArray()) {
                    $nodes = $this->GetNodesByParentId($db, $row["ID"]);
                    $tree[] = array("ID" => $row["ID"], "NAME" => $row["NAME"], "NODES" => $nodes);
                }
            }
            $db->close();
        }  catch (Exception $ex) {
            echo "Exception in Tree->GetAllNodes: " . $ex->getMessage() . "<br/>";
            $db->close();
        }
        return $tree;
    }

    /**
     * Get nodes by parent id
     * @param $db - database connection
     * @param $parent_id - parent tree id
     * @return array - nodes
     */
    private function GetNodesByParentId($db,$parent_id){
        $tree = array();
        try {
            if (intval($parent_id)>0) {
                $result = $db->query('SELECT * FROM tree WHERE DELETE_AT IS NULL AND PARENT_ID=' . $parent_id);
                if (!is_bool($result)) {
                    while ($row = $result->fetchArray()) {
                        $nodes = $this->GetNodesByParentId($db,$row["ID"]);
                        $tree[] = array("ID" => $row["ID"], "NAME" => $row["NAME"], "NODES" => $nodes);
                    }
                }
            }
        }  catch (Exception $ex) {
            echo "Exception in Tree->GetAllNodes: " . $ex->getMessage() . "<br/>";
        }
        return $tree;
    }

}
?>