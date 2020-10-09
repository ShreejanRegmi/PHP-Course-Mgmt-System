
<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';

        $fName= md5(rand()) . '.' .$_FILES['newRoutine']['name'];
        move_uploaded_file($_FILES['newRoutine']['tmp_name'],"../../csv/{$fName}");

        $editRoutine= $pdo -> prepare("UPDATE level_timetable SET routine=:routine WHERE level=:lev");
           
        $pass=["lev"=>$_POST ["rLevel"],
                    "routine"=> $fName];

        if($editRoutine->execute($pass)){ 
            header('Location:../../public_html');
        }

    
    
?>