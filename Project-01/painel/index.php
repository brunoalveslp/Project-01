<?php 
    include('../config.php');
    if(painel::login() == false)
     {
         include('login.php');
     } else
     {
        include('main.php');
    }
?>