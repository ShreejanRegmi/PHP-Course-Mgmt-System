<?php 
require '../../db/dbconnect.php';
require '../../classes/databasetable.php';


if(isset($_POST['m_code'])){
    $module = new DatabaseTable('modules');
    $module->delete('m_code',(string)$_POST['m_code']);

    echo 'moduleDeleted';
}


?>