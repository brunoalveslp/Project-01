<?php
    class User 
    {
        public static function RefreshUser($name,$pass,$img)
        {
            $sql = MySql::Connect()->prepare("UPDATE `tb_admin_users` SET nome = ?, password = ?, img = ? WHERE user = ?");
            if($sql->execute(array($name,$pass,$img['name'],$_SESSION['user'])))
            {
                return true;
            } else
            {
                return false;
            }
        }

        public static function UserExists($user)
        {
            $sql = MySql::Connect()->prepare("SELECT `id` FROM `tb_admin_users` WHERE user = ?");
            $sql->execute(array($user));
            if($sql->rowCount() == 1)
                return true;
            else
                return false;

        }

        public static function NewUser($login,$senha,$imagem,$nome,$cargo)
        {

        }
    }

?>