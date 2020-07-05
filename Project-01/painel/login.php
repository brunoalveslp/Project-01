<?php
    if(isset($_COOKIE['remember-project-01-login']))
    {
        $user = $_COOKIE['user'];
        $password = $_COOKIE['passwors'];
        $sql = Mysql::connect()->prepare("SELECT * FROM `tb_admin_users` WHERE user = ? AND password = ?");
        $sql->execute(array($user,$password));
        if($sql->rowCount() == 1)
        {
            $info = $sql->fetch();
            $_SESSION['login'] = true;
            $_SESSION['user'] = $user;
            $_SESSION['password'] = $password;
            $_SESSION['cargo'] = $info['cargo'];
            $_SESSION['nome'] = $info['nome'];
            $_SESSION['img'] = $info['img'];
            header('location: '.INCLUDE_PATH_PAINEL); 
            die();
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Painel</title>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL ?>css/style.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH ?>css/font-awesome.min.css">
</head>
<body>

        
    <div class="login-box">
    <?php
            if(isset($_POST['action']))
            {
                $user = $_POST['username'];
                $password = $_POST['password'];
                $sql = Mysql::connect()->prepare("SELECT * FROM `tb_admin_users` WHERE user = ? AND password = ?");
                $sql->execute(array($user,$password));
                if($sql->rowCount() == 1)
                {
                    if(isset($_POST['remember']))
                    {
                        setcookie('remember-project-01-login',true,time()+(60*60*7),'/');
                        setcookie('user',$user,time()+(60*60*7),'/');
                        setcookie('password',$password,time()+(60*60*7),'/');
                    }
                    $info = $sql->fetch();
                    $_SESSION['login'] = true;
                    $_SESSION['user'] = $user;
                    $_SESSION['password'] = $password;
                    $_SESSION['cargo'] = $info['cargo'];
                    $_SESSION['nome'] = $info['nome'];
                    $_SESSION['img'] = $info['img'];
                    header('location: '.INCLUDE_PATH_PAINEL); 
                    die();
                } else
                {
                    echo '<div class="erro"><h2><i class="fa fa-times"></i> Usuario ou Senha Invalidos!</h2></div>';
                }
            }
        
        ?>
        <form method="post">
            <h2>Sign in</h2>
            <label for="username">Nome de Usuario</label>
            <input type="text" name="username" placeholder="Username">
            <label for="password">Senha</label>
            <input type="password" name="password" placeholder="Password">
            <input type="submit" value="Sign In" name="action">
            <div class="form-group-login">
                <label for="remember">Recordar Senha</label>
                <input type="checkbox" name="remember">
            </div>
        </form>
    </div>
    
</body>
</html>