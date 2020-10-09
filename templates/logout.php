<?php
session_start(); //starts the session
session_unset(); // unsets all the sesssion variables
session_destroy();//destroys the created session
header('Location:../public_html'); //redirects to the index page
?>