
<?php
if(!isset($_SESSION)){session_start();}  
header('Content-Type: application/json');
	$pdo= new PDO('mysql:dbname=csy2027e;host=localhost', 'root', '');

	$query =$pdo->prepare("DELETE FROM announcement WHERE ann_date < CURRENT_DATE");
	$query->execute();

	$process=[];
	if(isset($_POST['id']) && isset($_POST['password'])){
		$user =$_POST['id'];
		$password=$_POST['password'];

		$loginstmt= $pdo->prepare("SELECT * FROM staff WHERE staff_id=:staff_id");
		$loginstmt->execute(['staff_id'=>$user]);
		if($loginstmt->rowCount()>0){
			$staff=$loginstmt->fetch();
			if(password_verify($password, $staff['s_password'])){
				$process['status']='LoggedIn';
				$_SESSION['username']=$staff['s_firstname']." ".$staff['s_lastname'];
				$_SESSION['type']=$staff['s_type'];
				$_SESSION['id']=$staff['staff_id'];
				$_SESSION['table']='staff';
				
				
			}
			else{
				$process['status']='Error';
			}
		}
		else{
			$loginstmt= $pdo->prepare("SELECT * FROM students WHERE s_id=:s_id");
			$loginstmt->execute(['s_id'=>$user]);
			if($loginstmt->rowCount()>0){
				$student=$loginstmt->fetch();
				if(password_verify($password, $student['s_password'])){
					
					$process['status']='LoggedIn';
					$_SESSION['username']=$student['s_firstname']." ".$student['s_lastname'];
					$_SESSION['type']='Student';
					$_SESSION['id']=$student['s_id'];
					$_SESSION['level']=$student['level'];
					$_SESSION['patteacher']=$student['staff_id'];
					$_SESSION['table']='students';
				}
				else{
					
					$process['status']='Error';
				}
			}
			else{
				
				$process['status']='Error';
			}
		}
	}


	echo json_encode($process);
?>