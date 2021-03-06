<?php
    class Site
    {
        public static function updateUsers()
        {
            if(isset($_SESSION['online']))
            {
                $token = $_SERVER['REMOTE_ADDR'];
                $horarioAtual = date('y-m-d H:i:s');
                $check = MySql::connect()->prepare("SELECT `id` FROM `tb_admin_online` WHERE token = ?");
                $check->execute(array($token));
                if($check->rowCount() == 1){
                    $sql = MySql::connect()->prepare("UPDATE `tb_admin_online` SET ultima_acao = ? WHERE token = ?");
                    $sql->execute(array($horarioAtual,$token));
                }else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $token = $_SERVER['REMOTE_ADDR'];
                    $horarioAtual = date('y-m-d H:i:s');
                    $sql = MySql::connect()->prepare("INSERT INTO `tb_admin_online` VALUES (null,?,?,?)");
                    $sql->execute(array($ip,$horarioAtual,$token));
                }
            }
            else {
                $ip = $_SERVER['REMOTE_ADDR'];
                $token = $_SERVER['REMOTE_ADDR'];
                $horarioAtual = date('y-m-d H:i:s');
                $_SESSION['online'] = uniqid();
                $sql = MySql::connect()->prepare("INSERT INTO `tb_admin_online` VALUES (null,?,?,?)");
                $sql->execute(array($ip,$horarioAtual,$token));
            }
            
        }

        public static function counter()
        {
            if(!isset($_COOKIE['visita']))
            {
                setcookie('visita',true,time()+(60*60*24*7));
                $sql = MySql::connect()->prepare("INSERT INTO `tb_admin_visitas` VALUES (null,?,?)");
                $sql->execute(array($_SERVER['REMOTE_ADDR'],date('y-m-d')));
            }
        }

    }

?>