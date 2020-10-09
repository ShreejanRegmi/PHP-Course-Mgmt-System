<?php 
require '../../db/dbconnect.php';
require '../../classes/generateTable.php';
require '../../classes/Table.php';


$record_p_p=10;
$page='';
$output='';


if(isset($_POST['page']))
	$page=$_POST['page'];
else
	$page= 1;

if(isset($_POST['level'])){
	$level=$_POST['level'];
	$start_from= ($page-1)*$record_p_p;
	$query="SELECT * FROM students WHERE level='$level' ORDER BY s_id DESC LIMIT $start_from, $record_p_p";
	$students=$pdo->prepare($query);
	$students->execute();
	$output.="
		 <table class='table is-bordered is-striped is-narrow is-hoverable is-fullwidth'>  
               <tr class='header'> 
                    <th>Id</th> 
	               <th >Name</th>  
	               <th >Address</th>  
	               <th >Email</th>  
	               <th >Action</th>  
	           </tr>
	";
	foreach ($students as $student) {
		$output.='
            <tr>
                <td><button class="button showStut" id="'. $student['s_id'].'">'.$student['s_id'].'</button></td> 
			   <td>' .$student['s_firstname'].' '.$student['s_lastname'].'</td> 
			   <td>'.$student['s_address'].'</td>
			   <td>'.$student['s_email_address'].'</td>
               <td>
                    <button class="button editStut is-success" id="'. $student['s_id'].'"><i class="fas fa-edit" style="margin-right:10px;"></i>Edit</button>
                    <button class="button deleteStut is-danger" id="'.$student['s_id'].'"><i class="fas fa-trash" style="margin-right:10px;"></i>Delete</button>
               </td>
			</tr>
		';
	}
	$output.='</table><br/><div>';
	$page_query= "SELECT COUNT(s_id) AS numrows FROM students WHERE level='$level'";
	$page_data=$pdo->prepare($page_query);
	$page_data->execute();
	$tot_rec=$page_data->fetch();
    $total_pages= ceil($tot_rec['numrows']/$record_p_p);
    $output.='<nav class="pagination  is-centered is-medium" role="navigation"  aria-label="pagination"><ul style="text-align:center;"  class="pagination-list">';
	for ($i=1; $i <=$total_pages ; $i++) { 
		 $output.= "

		 <span class='pagination_link' style='cursor:pointer;text-align:center;' id='".$i."'>

		 <a class='pagination-link'>".$i."</a>
		 </span>";
    }
    $output.='  </ul></nav>'; 
	$output.='</div><br/><br/>';

	echo $output;
}

?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
<style>

.header th{
text-align:center;
background-color:#004c4c; 
padding:10px;
color:white;

}


</style>



<script>


$(".showStut").click(function(){
    $("#showStutDetails").toggleClass('is-active');
    $.ajax({
			url:"../other/admin/fetchSDetails.php",
			method:"POST",
			data:{s_id:$(this).attr('id')},
            success:function(data){
                console.log(data);
                $("#specificStutcontent").html(data);
            }

	});
});

$('.delete').click(function(){
	$(".modal").removeClass('is-active');
});

$('.editStut').click(function(){
	$("#editStudentModal").toggleClass('is-active');
	$.ajax({
			url:"../classes/getDetails.php",
			method:"POST",
			data:{table:'students',field:'s_id',value:$(this).attr('id')},
             success:function(data){
            
                $("#eStud_s_id").val(data.s_id);
                $("#eStud_firstname").val(data.s_firstname);
                $("#eStud_lastname").val(data.s_lastname);
                $("#eStud_address").val(data.s_address);
                $("#eStud_contact").val(data.s_contact);
                $("#eStud_email_address").val(data.s_email_address);
                $("#eStud_level").val(data.level);
				$("#eStud_pat").val(data.staff_id);
				$("#confirmStudentEdit").val(data.s_id);
      }

	});

});

$('.deleteStut ').click(function(){
 	$('#deleteStudentModal').toggleClass('is-active');
 	$("#title_student_id").html($(this).attr('id'));
 	$("#confirmStudentDelete").val($(this).attr('id')); 
});

$('#confirmStudentDelete').click(function(){
    $.ajax({
			url:"../other/admin/deleteStudent.php",
			method:"POST",
			data:{s_id:$(this).val()},
             success:function(data){
            if(data == 'studentDeleted'){
                loadStudents();
            }
      }

	});


});





</script>