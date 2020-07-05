<?php 
    include('../config.php');
    if(painel::Login() == false)
     {
         include('login.php');
     } else
     {
        include('main.php');
    }
?>