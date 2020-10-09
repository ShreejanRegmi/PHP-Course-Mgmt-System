var myPass =document.getElementById("myPasswords");
var oldP =document.getElementById("oldP");
var newP =document.getElementById("newP");

myPass.addEventListener("click", function(){ 

  if(oldP.type == 'password'){
    oldP.type="text";
    newP.type="text";
    myPass.classList.add("fa-eye-slash");
  }

  else{
    oldP.type="password";
    newP.type="password";
    myPass.classList.remove("fa-eye-slash");
  }

}); 




$("#changeP").click(function() {
    $("#changePModal").toggleClass("is-active");
    $("#oldP").val('');
    $("#newP").val('');
});

$("#closeP").click(function() {
    
    $("#changePModal").removeClass("is-active");
});