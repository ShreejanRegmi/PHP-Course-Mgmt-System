<script>

$(".showTut").click(function(){
    $("#showTutDetails").toggleClass('is-active');
    $.ajax({
			url:"../other/admin/fetchtDetails.php",
			method:"POST",
			data:{staff_id:$(this).attr('id')},
            success:function(data){
                console.log(data);
                $("#specificTutcontent").html(data);
            }

	});
});


$('.deleteTut ').click(function(){
 $('#deleteTutorModal').toggleClass('is-active');
 $("#title_staff_id").html($(this).attr('id'));
 $("#confirmTutorDelete").val($(this).attr('id')); 
});

$('#confirmTutorDelete').click(function(){
    $.ajax({
			url:"../other/admin/deleteTuts.php",
			method:"POST",
			data:{staff_id:$(this).val()},
             success:function(data){
            console.log(data);
            if(data == 'tutorDeleted'){
                loadTutors();
            }
      }

	});


});


$('.editTut').click(function(){
    $("#newTutModal").toggleClass('is-active');
    $("#confirmNewTut").val($(this).attr('id'));

    $.ajax({
			url:"../classes/getDetails.php",
			method:"POST",
			data:{table:'staff',field:'staff_id',value:$(this).attr('id')},
             success:function(data){
                $("#t_id").prop('disabled', true);
                $("#t_id").val(data.staff_id);
                $("#t_firstname").val(data.s_firstname);
                $("#t_lastname").val(data.s_lastname);
                $("#t_address").val(data.s_address);
                $("#t_contact").val(data.s_contact);
                $("#t_email").val(data.s_email);
                $("#t_type").val(data.s_type);
                $("#t_st_reason").val(data.s_status_reason);
                $("#t_status").val(data.s_status);
        
      }

	});

});


</script>

