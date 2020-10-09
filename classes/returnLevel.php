<?php

$pdo= new PDO('mysql:dbname=csy2027e;host=localhost', 'root', '');



if(isset($_POST['id'])){
	$id =$_POST['id'];
	global $pdo;
	// $staffquery= $pdo->prepare("SELECT * FROM staff WHERE staff_id=:staff_id");
	// $staffquery->execute(['staff_id'=>$id]);
 	// if($staffquery->rowCount()>0){
	// 	$levelquery=$pdo->prepare("SELECT m.level FROM teacher_modules tm JOIN modules m ON tm.m_code=m.m_code WHERE staff_id =:staff_id LIMIT 1" );
	// 	$levelquery->execute(['staff_id'=>$id]);
	// 	if($levelquery->rowCount() > 0){
	// 		foreach ($levelquery as $level) {
					
	// 			echo $level['level'];
	// 		}
	// 	}
	// 	else{
	// 		echo 'The staff is not enrolled on any modules on any level';
	// 	}	
	// }
	// else{
			$studentquery= $pdo->prepare("SELECT * FROM students WHERE s_id=:s_id");
			$studentquery->execute(['s_id'=>$id]);
			if($studentquery->rowCount()>0){
				$student=$studentquery->fetch();
				echo $student['level'];
			}
			else{
				//NO USERID MATCHING
				echo 'Not enrolled';
			}
		}


// }





?>