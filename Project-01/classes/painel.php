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
        
        public static function loadPage()
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

        public static function listUsers()
        {
            self::cleanUsers();
            $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin_online`");
            $sql->execute();
            return $sql->fetchAll();
        }

        public static function cleanUsers()
        {
            $time = date('y-m-d H:i:s'); 
            $sql = MySql::connect()->exec("DELETE FROM `tb_admin_online` WHERE ultima_acao < '$time' - INTERVAL 1 MINUTE");
        }

        public static function alert($aswer,$msg)
        {
            if($aswer == 'success')
            {
                echo '<div class="sucesso"><i class="fa fa-check"></i>'.$msg.'</div>';
            } else if($aswer == 'error')
            {
                echo '<div class="erro"><i class="fa fa-times"></i>'.$msg.'</div>';
            }
        }

        public static function validateImg($image)
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

        public static function uploadFile($file){
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

        public static function uploadSlide($file){
            // $imgFormat = explode('.',$file['name']);
            // $img = uniqid().'.'.$imgFormat[count($imgFormat) - 1];
            if(move_uploaded_file($file['tmp_name'],BASE_DIR_PAINEL.'/uploads/'.$file['name']))
            {
                return $file;
            }else
            {
                return false;
            }
        }

        public static function deleteFile($file)
        {
                @unlink(BASE_DIR_PAINEL.'uploads/'.$file);
        }
        
        public static function insert($arr)
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
                $sql = MySql::connect()->prepare($query);
                $sql->execute($parametros);
                $lastId = MySql::connect()->lastInsertId();
                $sql = MySql::connect()->prepare("UPDATE `$nome_tabela` SET order_id = ? WHERE id = $lastId");
                $sql->execute(array($lastId));

            }

            return $certo;
        }

        public static function selectAll($tabela ,$start = null ,$end = null)
        {
            if($start == null && $end == null)
                $sql = MySql::connect()->prepare("SELECT * FROM `$tabela`ORDER BY order_id ASC");
            else
                $sql = MySql::connect()->prepare("SELECT * FROM `$tabela` ORDER BY order_id ASC LIMIT $start,$end");
            $sql->execute();
            return $sql->fetchAll();
        }
        
        public static function delete($table,$id=false)
        {
            if($id==false)
            {
                $sql = MySql::connect()->prepare("DELETE FROM `$table`");
            }else
            {
                $sql = MySql::connect()->prepare("DELETE FROM `$table` WHERE id =$id");
            }

            $sql->execute();
        }
        
        public static function redirect($url)
        {
            echo '<script>Location.href="$url"</script>';
            die();
        }

        //method for only one register
        
        public static function select($table,$id = '')
        {
            if($id != false)
            {
                $sql = MySql::connect()->prepare("SELECT * FROM `$table` WHERE id = ?");
                $sql->execute(array($id));
            }else
            {
                $sql = MySql::connect()->prepare("SELECT * FROM `$table`");
                $sql->execute(array());
            }
            return $sql->fetch();
        }

        public static function update($arr,$single = false)
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
					$sql = MySql::connect()->prepare($query.' WHERE id=?');
					$sql->execute($parametros);
				}else{
					$sql = MySql::connect()->prepare($query);
					$sql->execute($parametros);
				}
			}
			return $certo;
        }
        
        public static function orderItem($tabela,$orderType,$idItem)
        {
            if($orderType == 'up'){
				$infoItemAtual = Painel::select($tabela,$idItem);
                $order_id = $infoItemAtual['order_id'];
                $itemBefore = MySql::connect()->prepare("SELECT * FROM `$tabela` WHERE order_id < $order_id ORDER BY order_id DESC LIMIT 1");
				$itemBefore->execute();
				if($itemBefore->rowCount() == 0)
					return;
				$itemBefore = $itemBefore->fetch();
				Painel::update(array('nome_tabela'=>$tabela,'id'=>$itemBefore['id'],'order_id'=>$infoItemAtual['order_id']));
				Painel::update(array('nome_tabela'=>$tabela,'id'=>$infoItemAtual['id'],'order_id'=>$itemBefore['order_id']));
            }else if($orderType == 'down')
            {
                $infoItemAtual = Painel::select($tabela,$idItem);
                $order_id = $infoItemAtual['order_id'];
                $itemBefore = MySql::connect()->prepare("SELECT * FROM `$tabela` WHERE order_id > $order_id ORDER BY order_id ASC LIMIT 1");
				$itemBefore->execute();
				if($itemBefore->rowCount() == 0)
					return;
                $itemBefore = $itemBefore->fetch();
                Painel::update(array('nome_tabela'=>$tabela,'id'=>$itemBefore['id'],'order_id'=>$infoItemAtual['order_id']));
                Painel::update(array('nome_tabela'=>$tabela,'id'=>$infoItemAtual['id'],'order_id'=>$itemBefore['order_id']));
				
            }
        }
    }


?>