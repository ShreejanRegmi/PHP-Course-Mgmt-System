<?php
require '../../db/dbconnect.php';
require '../../classes/Table.php';

if(isset($_GET['table'])){

    $datas = new Table($_GET['table']);
    $data = $datas-> groupProjectFindAll();
    $header=array_keys($data->fetch(PDO::FETCH_ASSOC));
    $export="";

    foreach($header as $topic){
    $export.='"'.$topic.'",';
    }
    $export.="\n";

    foreach($data as $mo) {
        for ($i = 0; $i < count($header); $i++) {
        $export .='"'.$mo["$i"].'",';
        }
    $export .="\n";
    }

    $filename = $_GET['table'].".csv";
    header('Content-type: application/csv');
    header('Content-Disposition: attachment; filename='.$filename);
    echo $export;
    
}
?>