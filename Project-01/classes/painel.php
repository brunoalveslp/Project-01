<?php
    class Painel
    {
        public static function login()
        {
             return isset($_SESSION['login']) ? true : false;
         }

         public static function loggout(){
			session_destroy();
			header('Location: '.INCLUDE_PATH_PAINEL);
		}
    }


?>