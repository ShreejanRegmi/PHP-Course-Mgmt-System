<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Page Title</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="../jquery.js"></script>
  <link rel="stylesheet" href="css/font-awesome.css">
 <?php  require '../templates/links.php';?>
      <script src="../js/particle.js" ></script>
      <script>
          particlesJS.load('particles-js', 'particles.json', function() {
          console.log('callback - particles.js config loaded');
          });
          </script>

</head>
<body>
 
  <div class="columns">

  <div class="collegetab column is-half"  id="particles-js" style="text-align: center"  >
      <p class="title is-1 has-text-white-ter">Woodlands</p>
      <p class="subtitle is-5">University College</p>
        <br><br><br>
        <img  src="../images/w.png" style="
        width:180px;border-radius:11px;
        z-index: 1;

      border:5px solid rgba(255,255,255,0.6);
      padding:5px;    
        " alt="logo">
  </div>
  
<div class="formslog column  is-half">

        <div class="loginform card">
             <h1 class="title is-3 " style="text-align: center">Login Portal</h1>
             <hr>
            <div class="card-image">
              
                  <figure style="text-align: center" >
                    <img src="../images/responsive.svg" style="width:85%;height:250px;"  alt="Placeholder image">
                  </figure>
              </div>
              <div class="box">

             
                  <!-- ID of the user -->
                    <div class="field">
                        <p class="control has-icons-left has-icons-right">
                        <input class="input is-hovered"  placeholder="Id" id="id">
                        <span class="icon is-small is-left">
                            <i class="fas fa-id-badge"></i>
                        </span>
                        </p>
                    </div>

              <!-- password of the user -->
              <div class="field">
                <p class="control has-icons-left">
                  <input class="input is-hovered"  id="myPass" type="password" placeholder="Password">
                  <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                  </span>
                </p>
              </div>
                   
                   

                  <!-- Show Password -->
                  <div class="field is-grouped is-grouped-centered">
                      <span class="icon is-small is-right" style="cursor:pointer;font-size:25px;color:#b9c1d1;">
                          <i  id="showPass" class="fas fa-eye"></i>
                        </span>
                  </div>
               <!-- --------------------------------------------------- -->
              <div class="field is-grouped is-grouped-centered">  
                <p class="control">
                  <button class="button is-success" id="login">
                  <i style="padding:10px;"class="fas fa-sign-in-alt"></i> Login
                  </button>
                </p>
              </div>


              <div class="field is-grouped is-grouped-centered">
                    <a href="forgetPassID.php">Forgot Password</a>
                     <p style="margin-right:5px;margin-left:5px;">|</p>
                       <a href="application.php" target="_blank">Apply?</a>

              </div>
              </div>
        </div>

</div>  


</div>






</body>




<!-- Wrong cred Modal -->

<div class="modal" id="errorModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head"> 
      <p class=" modal-card-title">Wrong Credentials</p> 
      <button class="delete" aria-label="close"></button>
    </header>
    <section class=" modal-card-body">
        The provided  credentials are wrong please enter again.
    </section>
    <footer class="modal-card-foot">
    </footer>
  </div>
</div>


<style>
.loginform{
 padding: 7px;
margin: 20px;


}
.collegetab{
  background: #00c9ff; /* fallback for old browsers */
  background: -webkit-linear-gradient(to right, #00c9ff, #92fe9d); /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to right, #00c9ff, #92fe9d); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}

.columns{
height: 635px;
}

.particles-js-canvas-el{
  height:20px;
}


</style>

<script>
function clearValues(){
  $("#id").val("");
$("#myPass").val("");
}

clearValues();

$(".delete").click(function(){
  $("#errorModal").removeClass("is-active");
});

var showP =document.getElementById("showPass");
var pField =document.getElementById("myPass");

showP.addEventListener("click", function(){ 

  if(pField.type == 'password'){
    pField.type="text";
    showP.classList.add("fa-eye-slash");
  }

  else{
    pField.type="password";
    showP.classList.remove("fa-eye-slash");
  }

}); 


$("#login").click(function(){
      var id =$("#id").val();
			var password=$("#myPass").val();

            if(id!="" && password!=""){
                $("#loginUsername").val('');
                $("#loginPassword").val('');
                    $.ajax({
                        url:"../templates/trythis.php",
                        method:"POST",
                        data:{id:id,password:password},
                        dataType: "json",
                        success:function(data){
                            console.log(data);
                            if(data.status == 'LoggedIn'){
                              window.location.href = 'index.php'; 
                            }
                            else if(data.status=='Error') {
                              $("#errorModal").toggleClass("is-active"); 
                              clearValues();
							              }
							
                        }
                    });
            }      
            else{
                alert("Enter all the needed credentials");
            }  
        });


</script>


