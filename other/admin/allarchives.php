<?php 
require '../../classes/headerInfo.php';
require '../../classes/levels.php';



$archives= new setHeader();
$archives->setInfo('<i class="fas fa-archive"></i> Archives');
$archives->addactionButtons([]);

echo $archives->placeHeader();


?>

<br>
<br>


<div class="tile is-ancestor">


  <div class="tile is-parent ">
    <article class="tile is-child  box">
    <a  href="../other/admin/downloadCSV.php?table=archive_level_timetable">
      <p class="title"><i class="fas fa-clock"></i>Routines</p>
    </a> 
    </article>
  </div>
 

  <div class="tile is-parent">
    <article class="tile is-child box">
    <a  href="../other/admin/downloadCSV.php?table=archive_modules">
      <p class="title" ><i class="fas fa-book"></i>Modules</p>
    </a>
    </article>
  </div>

</div>

<br>

<div class="tile is-ancestor">


  <div class="tile is-parent ">
    <article class="tile is-child  box">
    <a  href="../other/admin/downloadCSV.php?table=archive_staff">
      <p class="title"><i class="fas fa-chalkboard-teacher"></i>Staff</p>
    </a>  
    </article>
  </div>

  <div class="tile is-parent">
    <article class="tile is-child box">
    <a  href="../other/admin/downloadCSV.php?table=archive_students">
      <p class="title" ><i class="fas fa-user"></i>Students</p>
    </a>  
    </article>
  </div>

</div>

<br>

<div class="tile is-ancestor">

  <div class="tile is-parent ">
    <article class="tile is-child  box">
    <a  href="../other/admin/downloadCSV.php?table=archive_attendances">
      <p class="title" ><i class="fas fa-clipboard-check"></i>Attendences</p>
    </a>  
    </article>
  </div>

  <div class="tile is-parent">
    <article class="tile is-child box">
    <a  href="../other/admin/downloadCSV.php?table=archive_assignments">
      <p class="title"><i class="fas fa-tasks"></i>Assignments</p>
    </a>  
    </article>
  </div>

</div>


<br>

<div class="tile is-ancestor">

  <div class="tile is-parent ">
    <article class="tile is-child  box">
    <a  href="../other/admin/downloadCSV.php?table=archive_assignment_files">
      <p class="title" ><i class="fas fa-file"></i>Assignment Files</p>
    </a>  
    </article>
  </div>

  <div class="tile is-parent">
    <article class="tile is-child box">
    <a  href="../other/admin/downloadCSV.php?table=archive_submitted_assignments">
      <p class="title"><i class="fas fa-file-upload"></i>Submissions</p>
    </a>  
    </article>
  </div>

</div>






<style>

i{
    margin-right:10px;
}
a{
    text-decoration:none;
}


</style>