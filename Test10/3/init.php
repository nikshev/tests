<?php
/**
 * Initialization file
 * Create database and tree table
 */
error_reporting(-1);

try {
    unlink('mysqlitedb.db'); //Delete
    $db = new SQLite3('mysqlitedb.db',SQLITE3_OPEN_READWRITE|SQLITE3_OPEN_CREATE);
    chmod('mysqlitedb.db',777); //Add premissions
    $db->exec('CREATE TABLE tree (
            ID INTEGER PRIMARY KEY AUTOINCREMENT,
            PARENT_ID INT NOT NULL,
            NAME STRING NOT NULL,
            CREATE_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            UPDATE_AT TIMESTAMP,
            DELETE_AT TIMESTAMP
           )');
    $db->exec("INSERT INTO tree (PARENT_ID, NAME) VALUES (0,'Root')"); //Add to database first row*/
    $db->exec("INSERT INTO tree (PARENT_ID, NAME) VALUES (1,'Level 1 Item 1')"); //Add to database row
    $db->exec("INSERT INTO tree (PARENT_ID, NAME) VALUES (1,'Level 1 Item 2')"); //Add to database row
    $db->exec("INSERT INTO tree (PARENT_ID, NAME) VALUES (1,'Level 1 Item 3')"); //Add to database row
    $db->exec("INSERT INTO tree (PARENT_ID, NAME) VALUES (2,'Level 2 Item 1')"); //Add to database row
    $db->exec("INSERT INTO tree (PARENT_ID, NAME) VALUES (3,'Level 2 Item 1')"); //Add to database row
    $db->exec("INSERT INTO tree (PARENT_ID, NAME) VALUES (4,'Level 2 Item 1')"); //Add to database row
    $db->exec("INSERT INTO tree (PARENT_ID, NAME) VALUES (5,'Level 3 Item 1')"); //Add to database row
    $db->exec("INSERT INTO tree (PARENT_ID, NAME) VALUES (6,'Level 3 Item 1')"); //Add to database row
    $db->exec("INSERT INTO tree (PARENT_ID, NAME) VALUES (7,'Level 3 Item 1')"); //Add to database row
    echo "Initialization complete....";
} catch (Exception $ex){
    echo "Exception in init routine: ".$ex->getMessage()."<br/>";
}

