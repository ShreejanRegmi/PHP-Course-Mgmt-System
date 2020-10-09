
<?php 
$pdo = new PDO('mysql:dbname=csy2027e;host=localhost', 'root', '',
 [PDO::ATTR_ERRMODE =>  PDO::ERRMODE_EXCEPTION ]);


function getChartTitle($level){
    global $pdo;
    $title=[];
    $cH  = $pdo->prepare('SELECT * FROM modules WHERE level=:lev ORDER BY m_code');
    $cH->execute(['lev'=>$level]);
        foreach($cH as $tops){
        $title[]= $tops['m_code'];
        }
    echo json_encode($title);
}






function getChartValue($level){
    global $pdo;
    $value=[];
    $pH  = $pdo->prepare('SELECT * FROM modules WHERE level=:lev ORDER BY m_code');
    $pH->execute(['lev'=>$level]);
        foreach($pH as $ops){
        $value[]= (int)$ops['m_points'];
        }
    echo json_encode($value);
  }





?>
