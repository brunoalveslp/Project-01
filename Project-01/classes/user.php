<?php
    class User 
    {
        public static function refreshUser($name,$pass,$img)
        {
            $sql = MySql::connect()->prepare("UPDATE `tb_admin_users` SET nome = ?, password = ?, img = ? WHERE user = ?");
            if($sql->execute(array($name,$pass,$img['name'],$_SESSION['user'])))
            {
                return true;
            } else
            {
                return false;
            }
        }

        public static function userExists($user)
        {
            $sql = MySql::connect()->prepare("SELECT `id` FROM `tb_admin_users` WHERE user = ?");
            $sql->execute(array($user));
            if($sql->rowCount() == 1)
                return true;
            else
                return false;

        }

        public static function newUser($login,$senha,$imagem,$nome,$cargo)
        {
            $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.usuarios` VALUES (null,?,?,?,?,?)");
			$sql->execute(array($user,$senha,$imagem,$nome,$cargo));
        }
    }

?>