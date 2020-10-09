<script>

function updateApplicants($aID,$status){
    $.ajax({
        url:'../other/admin/updateApplication.php',
        method:'POST',
        data:{a_id:$aID,status:$status},
        success:function(data){
            if(data =='applicationUpdated'){
                loadApplications();
            }
        }
    });
}

function allApplied(){
    $.ajax({
        url:'../other/admin/pendingapps.php',
        method:'POST',
        success:function(data){
            $('.allapplicants').html(data);
        }

    });
}

function appToStudent($aid){
    $.ajax({
        url:'../other/admin/addtotheStudent.php',
        method:'POST',
        data:{a_id:$aid},
        success:function(data){
            finalizedApp('accepted');
        }
    });
}

function finalizedApp($status){
    $.ajax({
        url:'../other/admin/finalizedapplicants.php',
        method:'POST',
        data:{status:$status},
        success:function(data){
            $('.allapplicants').html(data);
        }

    });
}

function showConditionalApplicants(){
    $.ajax({
        url:'../other/admin/conApplications.php',
        method:'POST',
        success:function(data){
            $('.allapplicants').html(data);
        }
    });
}

function detailOfApp($aID){
    $.ajax({
            url:'../other/admin/fetchapplicantDetails.php',
            method:'POST',
            data:{a_id:$aID},
            success:function(data){
                $("#applicantDetails").html(data);
            }
    });
}

$('.showApplicant').click(function(){
    $('#applicantModal').toggleClass('is-active');
    detailOfApp($(this).attr('id'))
});
</script>