<?php
require_once "../../api/config/database.php";

class DataModelBase {
public function  connection(){
    $config = new Database;
    return $config->getConnection(); 
    }  
}

?>