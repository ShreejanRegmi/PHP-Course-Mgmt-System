
<form method="POST" id="gradeForm">
<input type="hidden" name="asn_id" value="<?=$_POST['asn_id']?>">
<?php 
require '../../db/dbconnect.php';
require '../../classes/Table.php';
require '../../classes/generateTable.php';


function previousGrade($id){
    global $pdo;
    
    $studentGrade = $pdo->prepare('SELECT s_grade FROM submission_grade WHERE s_id=:s_id AND asn_id=:asn_id');
    $studentGrade->execute(['s_id'=>$id   , 'asn_id'=>$_POST['asn_id']  ]);

    if($studentGrade->rowCount()>0){
        $grade = $studentGrade->fetchColumn();
        return $grade;
    }
     else{
            return 'A+';
        }
    
}



function checkFile($file){

if($file==''){
    return 'No file submitted';
}

else{
   return ' <a  download ='.$file.' href ="../assignmentSubmission/'.$file.'"><button class="button is-success">'.$file.'</button></a>';
}

}


$slevel = $pdo->prepare('SELECT level FROM modules  WHERE m_code=(SELECT m_code FROM assignments WHERE asn_id =:asn_id)');
$slevel->execute([ 'asn_id'=>$_POST['asn_id']   ]);

$level =$slevel->fetchColumn();


$gradeTable = new createTable();
$gradeTable->setHeaders(["Name","Submission Date","File","Grade"]); 

$listnFile = $pdo->prepare('SELECT s.s_id,s.s_firstname ,s.s_lastname ,sa.submission_file ,sa.submission_date  FROM students s 
                    LEFT JOIN submitted_assignments sa ON s.s_id = sa.s_id AND sa.asn_id=:asn_id where s.level=:slevel');

                    $listnFile->execute(["asn_id" =>$_POST['asn_id'] , 'slevel'=>$level   ]);
                    foreach ($listnFile as $key ) {

                        $grade=' <select name="'.$key['s_id'].'" >
                                    <option value=" "'. ((previousGrade($key['s_id'])=='Z')?'selected="selected"' : '')  .'>Z </option>
                                <option value="A+"'. ((previousGrade($key['s_id'])=='A+')?'selected="selected"' : '')  .'>A+</option>
                                <option value="A"'. ((previousGrade($key['s_id'])=='A')?'selected="selected"' : '')  .' >A</option>
                                <option value="A-"'. ((previousGrade($key['s_id'])=='A-')?'selected="selected"' : '')  .'>A-</option>
                                <option value="B+"'. ((previousGrade($key['s_id'])=='B+')?'selected="selected"' : '')  .' >B+</option>
                                <option value="B"'. ((previousGrade($key['s_id'])=='B')?'selected="selected"' : '')  .'>B</option>
                                <option value="B-" '. ((previousGrade($key['s_id'])=='B-')?'selected="selected"' : '')  .'>B-</option>
                                <option value="C+"'. ((previousGrade($key['s_id'])=='C+')?'selected="selected"' : '')  .'>C+</option>
                                <option value="C" '. ((previousGrade($key['s_id'])=='C')?'selected="selected"' : '')  .'>C</option>
                                <option value="C-"'. ((previousGrade($key['s_id'])=='C-')?'selected="selected"' : '')  .'>C-</option>
                                <option value="D+" '. ((previousGrade($key['s_id'])=='D+')?'selected="selected"' : '')  .'>D+</option>
                                <option value="D"'. ((previousGrade($key['s_id'])=='D')?'selected="selected"' : '')  .'>D</option>
                                <option value="D-" '. ((previousGrade($key['s_id'])=='D-')?'selected="selected"' : '')  .'>D-</option>
                                <option value="F"'. ((previousGrade($key['s_id'])=='F')?'selected="selected"' : '')  .'>F</option>
                        </select>';

                       

                        $file =checkFile($key['submission_file']);

                        $gradeTable->addValues([$key['s_firstname']." ".$key['s_lastname'],
                                    $key['submission_date'], $file   ,$grade]);

                    }

 echo $gradeTable->getValues();
 
?>
<br>
<button class="button is-success is-pulled-right"  id="buttonSubmit" name="gradeThisassignment">Save</button>
<br>
</form>

<script>

$('form#gradeForm').submit(function(e){
e.preventDefault();
$("#buttonSubmit").toggleClass('is-loading');
var formData = new FormData(this);
    $.ajax({
        url:'../other/tutor/gradestudent.php',
        method:'POST',
        data:formData,
        success:function(rest){
          alert(rest.grade);
          $("#markingmodal").removeClass('is-active');
          $("#buttonSubmit").removeClass('is-loading');
        },
        cache: false,
        contentType: false,
        processData: false
    });

});

</script>