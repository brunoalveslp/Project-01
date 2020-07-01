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

        public static function UploadSlide($file){
            // $imgFormat = explode('.',$file['name']);
            // $img = uniqid().'.'.$imgFormat[count($imgFormat) - 1];
            if(move_uploaded_file($file['tmp_name'],SLIDE_PATH.$file['name']))
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
                $lastId = MySql::Connect()->lastInsertId();
                $sql = MySql::Connect()->prepare("UPDATE `$nome_tabela` SET order_id = ? WHERE id = $lastId");
                $sql->execute(array($lastId));

            }

            return $certo;
        }

        public static function SelectAll($tabela ,$start = null ,$end = null)
        {
            if($start == null && $end == null)
                $sql = MySql::Connect()->prepare("SELECT * FROM `$tabela`ORDER BY order_id ASC");
            else
                $sql = MySql::Connect()->prepare("SELECT * FROM `$tabela` ORDER BY order_id ASC LIMIT $start,$end");
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
            echo '<script>Location.href="$url"</script>';
            die();
        }

        //method for only one register
        
        public static function Select($table,$id = '')
        {
            if($id != false)
            {
                $sql = MySql::Connect()->prepare("SELECT * FROM `$table` WHERE id = ?");
                $sql->execute(array($id));
            }else
            {
                $sql = MySql::Connect()->prepare("SELECT * FROM `$table`");
                $sql->execute(array());
            }
            return $sql->fetch();
        }

        public static function Update($arr,$single = false)
        {
			$certo = true;
			$first = false;
			$nome_tabela = $arr['nome_tabela'];

			$query = "UPDATE `$nome_tabela` SET ";
			foreach ($arr as $key => $value) {
				$nome = $key;
				$valor = $value;
				if($nome == 'action' || $nome == 'nome_tabela' || $nome == 'id')
					continue;
				if($value == ''){
					$certo = false;
					break;
				}
				
				if($first == false){
					$first = true;
					$query.="$nome=?";
				}
				else{
					$query.=",$nome=?";
				}

				$parametros[] = $value;
			}

			if($certo == true){
				if($single == false){
					$parametros[] = $arr['id'];
					$sql = MySql::Connect()->prepare($query.' WHERE id=?');
					$sql->execute($parametros);
				}else{
					$sql = MySql::Connect()->prepare($query);
					$sql->execute($parametros);
				}
			}
			return $certo;
        }
        
        public static function OrderItem($tabela,$orderType,$idItem)
        {
            if($orderType == 'up'){
				$infoItemAtual = Painel::Select($tabela,$idItem);
                $order_id = $infoItemAtual['order_id'];
                $itemBefore = MySql::Connect()->prepare("SELECT * FROM `$tabela` WHERE order_id < $order_id ORDER BY order_id DESC LIMIT 1");
				$itemBefore->execute();
				if($itemBefore->rowCount() == 0)
					return;
				$itemBefore = $itemBefore->fetch();
				Painel::Update(array('nome_tabela'=>$tabela,'id'=>$itemBefore['id'],'order_id'=>$infoItemAtual['order_id']));
				Painel::Update(array('nome_tabela'=>$tabela,'id'=>$infoItemAtual['id'],'order_id'=>$itemBefore['order_id']));
            }else if($orderType == 'down')
            {
                $infoItemAtual = Painel::Select($tabela,$idItem);
                $order_id = $infoItemAtual['order_id'];
                $itemBefore = MySql::Connect()->prepare("SELECT * FROM `$tabela` WHERE order_id > $order_id ORDER BY order_id ASC LIMIT 1");
				$itemBefore->execute();
				if($itemBefore->rowCount() == 0)
					return;
                $itemBefore = $itemBefore->fetch();
                Painel::Update(array('nome_tabela'=>$tabela,'id'=>$itemBefore['id'],'order_id'=>$infoItemAtual['order_id']));
                Painel::Update(array('nome_tabela'=>$tabela,'id'=>$infoItemAtual['id'],'order_id'=>$itemBefore['order_id']));
				
            }
        }
    }


?>