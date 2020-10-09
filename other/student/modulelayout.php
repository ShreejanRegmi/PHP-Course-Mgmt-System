<?php 
require '../../classes/Table.php';
require '../../db/dbconnect.php';


$modules = $pdo->prepare('SELECT * FROM modules WHERE level=:levs AND m_code =:mcode');
$modules->execute(['levs'=>$_SESSION['level'],'mcode'=>$code]);

if($modules->rowCount()>0){?>
<input type="hidden" class="curMod" id="<?= $_GET['m_code']?>">
  <div class="columns">
        <div class="column is-3 ">

        <aside class="menu card has-light-background" style="padding:10px;">
            <p class="menu-label">
                <a  class="panel-block">
                  <span class="panel-icon">
                  <i class="fas fa-book" aria-hidden="true"></i>
                </span>
                  <?= $_GET['m_code']?>
                </a>
            </p>
                <ul class="menu-list">
                  <li>
                    <a class="panel-block ">
                    <i class="fas fa-folder"></i>
                       Module Content</a>
                    <ul  class="menus">
                      <li><a  id="studentModules"  class="is-active">Module activities</a></li>
                      <li><a id="studentReadings">Reading and resources</a></li>
                    </ul>
                  </li>
                    <br>
                  <li>
                    <a class="panel-block">
                    <i class="fas fa-tasks"></i>
                    Assessment
                    </a>
                    <ul class="menus">
                      <li><a id="studentAssesments"  >Assesment information</a></li>
                      <li><a id="studentSubmissions">Submit your work</a></li>
                      <li><a id="studentGrade">Grades</a></li>
                    </ul>
                  </li>
                  <br>
                  
                   <li>
                   <a  class="panel-block">
                   <i class="fab fa-connectdevelop"></i>
                   Connect and Learn</a>
                   <ul class="menus">
                    <li>
                      <a id="Discuss">
                       <i class="fas fa-comments"></i>
                        Discussion board
                      </a> 
                      </li>   
                    </ul>  
                    </li> 
                </ul>
        </aside>   

        </div>
  
        <div class="column card" id="studentCardView" style="margin:20px;">
        
        
        </div>

  </div> 
  <br>
<?php    
}

else{
   header('Location:student.php');
}


?>
 

<script>

var module =$('.curMod').attr('id');

function clearStatus(){
     var a = $(".menus li a ");
     a.each(function(idx, a) {
        $(a).removeClass('is-active');
    });
}


 $('.menus li a').click(function(){
    clearStatus();
    $(this ).toggleClass('is-active');
 });

function moduleActivities(){
    $.ajax({
        url:'moduleActivities.php',
        method:'POST',
        data:{m_code:module},
        success:function(data){
          $("#studentCardView").html(data);
        }
    });
}

function readingSources(){
  $.ajax({
        url:'readSource.php',
        method:'POST',
        data:{m_code:module},
        success:function(data){
          $("#studentCardView").html(data);
        }
    });
}

function assessmentInfo(){
  $.ajax({
        url:'asInfo.php',
        method:'POST',
        data:{m_code:module},
        success:function(data){
          $("#studentCardView").html(data);
        }
    });
}

function gradesandResults(){
  $.ajax({
        url:'grade.php',
        method:'POST',
        data:{m_code:module},
        success:function(data){
          $("#studentCardView").html(data);
        }
    });
}


$('#studentGrade').click(function(){
  gradesandResults();
});

function underlyingD(){
  $.ajax({
        url:'disQuestions.php',
        method:'POST',
        data:{m_code:module},
        success:function(data){
          $("#studentCardView").html(data);
        }
    });

}

function submitWork(){
  $.ajax({
    url:'submission.php',
    method:'POST',
    data:{m_code:module},
    success:function(data){
      $("#studentCardView").html(data);
    }

  });
}


function grades(){
  $.ajax({
    url:'myResults.php',
    method:'POST',
    data:{m_code:module},
    success:function(data){
      $("#studentCardView").html(data);
    }
  });
}


$('#studentSubmissions').click(function(){
   submitWork();
});




$('#Discuss').click(function(){
  underlyingD();
});

moduleActivities()


$('#studentModules').click(function(){
    moduleActivities();
});

$('#studentReadings').click(function(){
  readingSources();
});

$('#studentAssesments').click(function(){
   assessmentInfo();
});

</script>