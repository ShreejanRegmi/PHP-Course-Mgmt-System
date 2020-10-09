<?php
  require 'db_connect.php';
  function import($file){
	  global $pdo;
	  $theFile= fopen($file, 'r');
	  
	  while ($eachRow=fgetcsv($theFile)) {
	  	 // echo '<pre>';
	  	 // print_r($eachRow);
	  	 // echo '</pre>';
	  	  $arguments= "'".implode("','", $eachRow)."'";
	  	//echo $arguments.'<br>';
	  	$insertStmt=$pdo->prepare("INSERT INTO applications(s_firstname, s_lastname, s_address, s_contact, s_dob, s_email, level, intake, s_qualifications) VALUES (".$arguments.")");
	  	if($insertStmt->execute()){
	  		echo "OK";
	  	}
	  	else{
	  		echo "fail";
	  	}
	  }
  }
?>