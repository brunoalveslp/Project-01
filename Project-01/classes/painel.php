<?php
    class Painel
    {
        public static $Permition = array('0'=>'Normal','1'=>'Sub-Administrador','2'=>'Administrador');
        public static function login()
        {
             return isset($_SESSION['login']) ? true : false;
        }

         public static function loggout()
        {
            setcookie('remember',true,time()-1,'/');
			session_destroy();
			header('Location: '.INCLUDE_PATH_PAINEL);
        }
        
        public static function LoadPage()
        {
            if(isset($_GET['url']))
            {
                $url = explode('/',$_GET['url']);
                if(file_exists('pages/'.$url[0].'.php'))
                {
                    include('pages/'.$url[0].'.php');
                }else
                {
                    header('location: '.INCLUDE_PATH_PAINEL);
                }
            }else
            {
                include('pages/home.php');
            }
        }

        public static function ListUsers()
        {
            self::CleanUsers();
            $sql = MySql::Connect()->prepare("SELECT * FROM `tb_admin_online`");
            $sql->execute();
            return $sql->fetchAll();
        }

        public static function CleanUsers()
        {
            $time = date('y-m-d H:i:s'); 
            $sql = MySql::Connect()->exec("DELETE FROM `tb_admin_online` WHERE ultima_acao < '$time' - INTERVAL 1 MINUTE");
        }

        public static function Alert($aswer,$msg)
        {
            if($aswer == 'success')
            {
                echo '<div class="sucesso"><i class="fa fa-check"></i>'.$msg.'</div>';
            } else if($aswer == 'error')
            {
                echo '<div class="erro"><i class="fa fa-times"></i>'.$msg.'</div>';
            }
        }

        public static function ValidateImg($image)
        {
			if($image['type'] == 'image/jpeg' ||
				$image['type'] == 'image/jpg' ||
				$image['type'] == 'image/png'){

				$tamanho = intval($image['size']/1024);
				if($tamanho < 3000)
					return true;
				else
					return false;
			}else{
				return false;
			}
		}

        public static function UploadFile($file){
            // $imgFormat = explode('.',$file['name']);
            // $img = uniqid().'.'.$imgFormat[count($imgFormat) - 1];
            if(move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'uploads/'.$file['name']))
            {
                return $file;
            }else
            {
                return false;
            }
        }

        public static function DeleteFile($file)
        {
                @unlink(BASE_DIR_PAINEL.'uploads/'.$file);
        }
        
        public static function Insert($arr)
        {
            $certo = true;
            $nome_tabela = $arr['nome_tabela'];
            $query = "INSERT INTO `$nome_tabela` VALUES(null";
            foreach($arr as $key => $value)
            {
                $nome = $key;
                $valor = $value;
                if($nome == 'action' || $nome == 'nome_tabela')
                    {
                        continue;
                    }
                    if($value == '')
                    {
                        $certo = false;
                        break;
                    }
                $query.=",?";
                $parametros[] = $value;
            }
            $query.=")";
            if($certo == true)
            {
                $sql = MySql::Connect()->prepare($query);
                $sql->execute($parametros);
            }

            return $certo;
        }

        public static function SelectAll($tabela ,$start = null ,$end = null)
        {
            if($start == null && $end == null)
                $sql = MySql::Connect()->prepare("SELECT * FROM `$tabela`");
            else
                $sql = MySql::Connect()->prepare("SELECT * FROM `$tabela` LIMIT $start,$end");
            $sql->execute();
            return $sql->fetchAll();
        }
        
        public static function Delete($table,$id=false)
        {
            if($id==false)
            {
                $sql = MySql::Connect()->prepare("DELETE FROM `$table`");
            }else
            {
                $sql = MySql::Connect()->prepare("DELETE FROM `$table` WHERE id =$id");
            }

            $sql->execute();
        }
        
        public static function Redirect($url)
        {
            echo '<script>Location.href="$url"</script>'
            die();
        }
    }


?>