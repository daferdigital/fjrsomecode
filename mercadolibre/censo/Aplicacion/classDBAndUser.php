<?php   

    ini_set('display_errors', 1);
	ini_set('log_errors', 1);
	ini_set('error_log', dirname(__FILE__) . '/error_log.txt');

	error_reporting(E_ERROR | E_WARNING | E_PARSE);
    if(isset($_POST['PHPSESSID'])) session_id($_POST['PHPSESSID']);
    if(isset($_GET['PHPSESSID'])) session_id($_GET['PHPSESSID']);
    session_start();
    include_once ("define.inc");
    class DBEasyCommands
    {
        private $link;
        private $list_error;
        private $dbUser = "root";
        private $dbPassword = "root1006";
        
        function __construct()
        {
			$this->list_error=array();
			//$this->link=@mysql_connect("mysql16.000webhost.com", "a1062527_admin", "admin123");
			$this->link=@mysql_connect("localhost", $this->dbUser, $this->dbPassword);
			//$this->link=@mysql_connect("localhost", "kijam_ray", "abc123"/*"root1234"*/);
			if (mysql_error($this->link))
				$this->list_error[]=mysql_error($this->link);
			else
            {
				//@mysql_selectdb("a1062527_censo", $this->link);
				@mysql_selectdb("Censo", $this->link);
				//@mysql_selectdb("kijam_ray", $this->link);
				if (mysql_error($this->link))
					$this->list_error[]=mysql_error($this->link);
				else
					mysql_set_charset('utf8',$this->link);
            }
        }
        function __destruct()
        {
            if(count($this->list_error)>0) print_r($this->list_error);
            @mysql_close ($this->link);
        }
		function errors(){
			return $this->list_error;
		}
        function q($query)
        {
            $r=@mysql_query($query, $this->link);
            if (mysql_error($this->link))
            {
                $this->list_error[]=mysql_error($this->link)."<br>\nQuery: $query<br>\n<br>\n";
                //print_r(mysql_error($this->link));
                return false;
            }
            else
                return $r;
        }
        function pid($tabla){  
            $a=$this->q("SHOW TABLE STATUS LIKE '".secInjection($tabla)."';");
            $assoc=mysql_fetch_assoc($a);
            return $assoc['Auto_increment'];
        }
        function id()
        {
            return @mysql_insert_id($this->link);
        }
        function qs($query, $params)
        {
            $res=@call_user_func_array("sprintf",@array_merge(array($query), $params));
			//echo $res;
            if ($res)
                if ($r=$this->q($res))
                    return $r;
                return false;
        }
        function l($query, $unique = true)
        {
            if ($unique)
                return @mysql_fetch_assoc($this->q($query));
            else
            {
                $ret=array();
                $q=$this->q($query);
                while ($r=@mysql_fetch_assoc($q))
                    $ret[]=$r;
                return $ret;
            }
        }
        function ls($query, $params, $unique = true)
        {
            if ($unique)
                return @mysql_fetch_assoc($this->qs($query, $params));
            else
            {
                $ret=array();
                $q=$this->qs($query, $params);
                while ($r=@mysql_fetch_assoc($q))
                {
                    $ret[]=$r;
                }
                return $ret;
            }
        }
        function n($query) { 
			return @mysql_num_rows($this->q($query)); 
		}
    }

    $db=new DBEasyCommands();
	global $db;
	
    class CUser
    {
        public $id;
        public $rol;
        public $user;
        public $pass;
        public $name;
        public $mail;
    }

    class User
    {
        static private $keySecurity = "s3cK3yD3c0lor32";

        static function getUserByID($id)
        {
            global $db;

            if ($r=$db->ls("SELECT * FROM user WHERE id=%d", array(intval($id))))
            {
                $us      =new CUser();
                $us->id  =$r["id"];
                $us->rol =$r["rol"];
                $us->user=$r["user"];
                $us->pass=$r["pass"];
                $us->name=$r["name"];
                $us->mail=$r["mail"];
                return $us;
            }

            return false;
        }

        static function getUserByUsername($us)
        {
            global $db;

            if ($r=$db->ls("SELECT * FROM user WHERE user='%s'", array(strtolower(secInjection($us)))))
            {
                $us      =new CUser();
                $us->id  =$r["id"];
                $us->rol =$r["rol"];
                $us->user=$r["user"];
                $us->pass=$r["pass"];
                $us->name=$r["name"];
                $us->mail=$r["mail"];
                return $us;
            }

            return false;
        }

        static function getUserByMail($us)
        {
            global $db;

            if ($r=$db->ls("SELECT * FROM user WHERE mail='%s'", array(strtolower(secInjection($us)))))
            {
                $us      =new CUser();
                $us->id  =$r["id"];
                $us->rol =$r["rol"];
                $us->user=$r["user"];
                $us->pass=$r["pass"];
                $us->name=$r["name"];
                $us->mail=$r["mail"];
                return $us;
            }

            return false;
        }

        static function validpass($user, $pass)
        {

            if ($us=User::getUserByUsername($user))
            {
                if (md5($pass . strtolower($user) . User::$keySecurity) == $us->pass)
                    return true;
            }

            return false;
        }

        static function authSession()
        {
            static $primera = true;
            static $isAuth = false;

            if ($_SESSION['user'] instanceof CUser)
            {
                if (!$primera)
                    return $isAuth;

                $t1=User::getUserByID($_SESSION['user']->id);
                $t2=User::getUserByUsername($_SESSION['user']->user);
                $t3=User::getUserByMail($_SESSION['user']->mail);

                if ($t1 instanceof CUser && $t2 instanceof CUser && $t3 instanceof CUser)
                {
                    $isAuth= 	$t1->id==$t2->id &&
								$t1->id == $t3->id && 
								$t1->id == $_SESSION['user']->id && 
								$t1->pass == $t2->pass && 
								$t1->pass == $t3->pass && 
								$t1->pass == $_SESSION['user']->pass;
                }
            }
            else
                $isAuth=false;

            $primera=false;
            return $isAuth;
        }

        static function login($user, $pass)
        {
            if (User::validpass($user, $pass))
            {
                unset ($_SESSION['user']);
                $_SESSION['user']=User::getUserByUsername($user);
                return $_SESSION['user'] instanceof CUser;
            }

            return false;
        }

        static function isAdmin() { return User::authSession() && $_SESSION['user']->rol == 1; }

        static function logOut() { unset ($_SESSION['user']); }

        static function addUser($us)
        {
            global $db;

            if (is_array($us))
            {
                $t      =new CUser();
                $t->user=$us['user'];
                $t->mail=$us['mail'];
                $t->pass=$us['pass'];
                $t->name=$us['name'];
                $t->rol =$us['rol'];
                $us     =$t;
            }

            if ($us instanceof CUser)
            {
                if (User::getUserByUsername(($us->user)))
                    return E_USER_EXIST;

                if (User::getUserByMail(strtolower($us->mail)))
                    return E_MAIL_EXIST;

                if ($db->qs("INSERT INTO user (user,pass,mail,name,rol) VALUES ('%s','%s','%s','%s','%d')", array
                (
                strtolower(secInjection($us->user)),
                md5($us->pass . strtolower($us->user) . User::$keySecurity),
                strtolower(secInjection($us->mail)),
                secInjection($us->name),
                intval($us->rol)
                )))
                    return OK;
                else
                    return E_SQL_ERROR;
            }

            return E_FORMAT_INVALID;
        }

        static function updateUser($id, $name, $rol, $mail, $pass = null)
        {
            global $db;                             
            if ($r=User::getUserByID(intval($id)))
            {             
				if ($r2=$db->ls("SELECT * FROM user WHERE mail='%s' and id<>%d", array(strtolower(secInjection($mail)),intval($id))))
				{
                    return E_MAIL_EXIST;				
				}else 			
                if ($pass == null)
                    return $db->qs("UPDATE user SET name = '%s', rol = '%d', mail = '%s' WHERE id=%d;", array
                    (
                    secInjection($name),
                    intval($rol), 
					strtolower(secInjection($mail)),
                    intval($id)
                    ));
                else
                    return $db->qs("UPDATE user SET name = '%s', rol = '%d', mail = '%s', pass = '%s' WHERE id=%d;", array
                    (
                    secInjection($name),
                    intval($rol),
					strtolower(secInjection($mail)),
                    md5($pass . $r->user . User::$keySecurity),
                    intval($id)
                    ));
            }                               
            return E_USER_NOT_EXIST;
        }

        static function deleteUser($id)
        {
            global $db;

            if ($r=User::getUserByID(intval($id)))
            {
                if ($r->user != 'admin')
                    return $db->qs("DELETE FROM user WHERE id=%d;", array(intval($id)));
                else
                    return E_USER_ADMIN_NOT_DELETE;
            }

            return E_USER_NOT_EXIST;
        }
    }
    function emailValido($str)
    {
        $dm =split("@", $str);
        $dom=$dm[1];
        return eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$", $str) && gethostbyname($dom) != $dom;
    }
    function email($para, $asunto, $mensaje = "", $de = "")
    {
        $sCabeceras="From: ". ($de==""?($_SERVER['SERVER_NAME']." <info@".$_SERVER['SERVER_NAME']):$de)."\r\nReply-To: ".($de==""?($_SERVER['SERVER_NAME']." <info@".$_SERVER['SERVER_NAME']):$de)."\r\nX-Mailer: PHP/" . phpversion() . "\r\nMIME-version: 1.0\r\n";
        $sCabeceras.="X-Priority: 1 (Higuest)\r\n";
        $sCabeceras.="X-MSMail-Priority: High\r\n";
        $sCabeceras.="Importance: High\r\n";
        $bHayFicheros=0;

        foreach ($_POST as $nombre => $valor)
        {
            if ($nombre == "captcha" || $nombre == "challenge" || $valor=="")
                continue;

            $mensaje.="<b>" . ereg_replace("_", " ", $nombre) . ":</b> ";
			if(is_array($valor)){
				$mensaje.= implode(", ",$valor). "<br>\n";
			}else $mensaje.= $valor . "<br>\n";
        }
		$mensaje.="\n<br />\n<br />--\n<br />".$_SERVER['SERVER_NAME'];
        foreach ($_FILES as $vAdjunto)
        {
            if ($vAdjunto["size"] > 0)
            {
                if ($bHayFicheros == 0)
                {
                    $bHayFicheros=1;
                    $sCabeceras.="Content-type: multipart/mixed;";
                    $sCabeceras.="boundary=\"--_Separador-de-mensajes_--\"\n";
                    $sCabeceraTexto="----_Separador-de-mensajes_--\n";
                    $sCabeceraTexto.="Content-type: text/html;charset=utf-8\n";
                    $sCabeceraTexto.="Content-transfer-encoding: 7BIT\n";
                    $mensaje=$sCabeceraTexto . $mensaje;
                }

                $sAdjuntos.="\n\n----_Separador-de-mensajes_--\n";
                $sAdjuntos.="Content-type: " . $vAdjunto["type"] . ";name=\"" . $vAdjunto["name"] . "\"\n";
                $sAdjuntos.="Content-Transfer-Encoding: BASE64\n";
                $sAdjuntos.="Content-disposition: attachment;filename=\"" . $vAdjunto["name"] . "\"\n\n";
                $oFichero  =fopen($vAdjunto["tmp_name"], 'r');
                $sContenido=fread($oFichero, filesize($vAdjunto["tmp_name"]));
                $sAdjuntos.=chunk_split(base64_encode($sContenido));
                fclose ($oFichero);
            }
        }

        if ($bHayFicheros)
            $mensaje.=$sAdjuntos . "\n\n----_Separador-de-mensajes_----\n";
        else
            $sCabeceras.="Content-type: text/html;charset=utf-8\n";

        return mail($para, $asunto, $mensaje, $sCabeceras);
    }
    function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }
    function selfURL() { 
        $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; 
        $protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; 
        $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); 
        return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI']; 
    } 

    function smartCopy($source, $dest, $options=array('folderPermission'=>0755,'filePermission'=>0755))
    {
        $result=false;
       
        if (is_file($source)) {
            if ($dest[strlen($dest)-1]=='/') {
                if (!file_exists($dest)) {
                    cmfcDirectory::makeAll($dest,$options['folderPermission'],true);
                }
                $__dest=$dest."/".basename($source);
            } else {
                $__dest=$dest;
            }
            $result=copy($source, $__dest);
            chmod($__dest,$options['filePermission']);
           
        } elseif(is_dir($source)) {
            if ($dest[strlen($dest)-1]=='/') {
                if ($source[strlen($source)-1]=='/') {
                    //Copy only contents
                } else {
                    //Change parent itself and its contents
                    $dest=$dest.basename($source);
                    @mkdir($dest);
                    chmod($dest,$options['filePermission']);
                }
            } else {
                if ($source[strlen($source)-1]=='/') {
                    //Copy parent directory with new name and all its content
                    @mkdir($dest,$options['folderPermission']);
                    chmod($dest,$options['filePermission']);
                } else {
                    //Copy parent directory with new name and all its content
                    @mkdir($dest,$options['folderPermission']);
                    chmod($dest,$options['filePermission']);
                }
            }

            $dirHandle=opendir($source);
            while($file=readdir($dirHandle))
            {
                if($file!="." && $file!="..")
                {
                     if(!is_dir($source."/".$file)) {
                        $__dest=$dest."/".$file;
                    } else {
                        $__dest=$dest."/".$file;
                    }
                    //echo "$source/$file ||| $__dest<br />";
                    $result=smartCopy($source."/".$file, $__dest, $options);
                }
            }
            closedir($dirHandle);
           
        } else {
            $result=false;
        }
        return $result;
    } 
	 
	function embedYouTube($url) {
		$parts = explode('?v=',$url);
		if (count($parts) == 2) {
			$tmp = explode('&',$parts[1]);
			if (count($tmp)>1) {
				return $tmp[0];
			} else {
				return $parts[1];
			}
		} else {
			$parts = explode('/',$url);
			if ((eregi("youtu",$url) && (count($parts) > 4 || eregi("youtu.be",$url))) || eregi("animoto",$url)) {
				return $parts[count($parts)-1];
			}
			return false;
		}
	}

	function secInjection($str){
		return str_replace("'","\'",stripslashes($str));
	}
	function generateUrl($nombre){
		$nombre=preg_replace("/ /","-",$nombre);
		return $nombre;
	}
	function detectErrorUpload(){
		foreach($_FILES as $n => $v){
			if($v['error']!=0 && $v['name']!=""){
				switch($v['error'])
				{
					case '1':
						$error .= $v['name'].': The uploaded file exceeds the upload_max_filesize directive in php.ini.'."\n";;
						break;
					case '2':
						$error .= $v['name'].': The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.'."\n";;
						break;
					case '3':
						$error .= $v['name'].': The uploaded file was only partially uploaded.'."\n";
						break;
					case '4':
						$error .= $v['name'].': No file was uploaded.'."\n";
						break;

					case '6':
						$error .= $v['name'].': Missing a temporary folder.'."\n";
						break;
					case '7':
						$error .= $v['name'].': Failed to write file to disk.'."\n";;
						break;
					case '8':
						$error .= $v['name'].': File upload stopped by extension.'."\n";;
						break;
					case '999':
					default:
						$error .= $v['name'].': No error code avaiable ('.$v['error'].').'."\n";;
				}
			}
		}
		return $error;
	}
	
	function getRealIP()
	{

		if( !empty($_SERVER['HTTP_X_FORWARDED_FOR']) )
		{
			$client_ip =
			( !empty($_SERVER['REMOTE_ADDR']) ) ?
			$_SERVER['REMOTE_ADDR']
			:
			( ( !empty($_ENV['REMOTE_ADDR']) ) ?
			$_ENV['REMOTE_ADDR']
			:
			"unknown" );

			// los proxys van añadiendo al final de esta cabecera
			// las direcciones ip que van "ocultando". Para localizar la ip real
			// del usuario se comienza a mirar por el principio hasta encontrar
			// una dirección ip que no sea del rango privado. En caso de no
			// encontrarse ninguna se toma como valor el REMOTE_ADDR

			$entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);

			reset($entries);
			while (list(, $entry) = each($entries))
			{
				$entry = trim($entry);
				if ( preg_match("/^([0-9]+.[0-9]+.[0-9]+.[0-9]+)/", $entry, $ip_list) )
				{
					// http://www.faqs.org/rfcs/rfc1918.html
					$private_ip = array(
					'/^0./',
					'/^127.0.0.1/',
					'/^192.168..*/',
					'/^172.((1[6-9])|(2[0-9])|(3[0-1]))..*/',
					'/^10..*/');

					$found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);

					if ($client_ip != $found_ip)
					{
						$client_ip = $found_ip;
						break;
					}
				}
			}
		}
		else
		{
			$client_ip =
			( !empty($_SERVER['REMOTE_ADDR']) ) ?
			$_SERVER['REMOTE_ADDR']
			:
			( ( !empty($_ENV['REMOTE_ADDR']) ) ?
			$_ENV['REMOTE_ADDR']
			:
			"unknown" );
		}

		return $client_ip;

	}
	function createThumbsWidth( $urlImage, $urlThumb, $thumbWidth )
	{
		// load image and get image size
		$imagen=getimagesize($urlImage);
		switch ($imagen[2]){
			case IMAGETYPE_JPEG: 
				$img = imagecreatefromjpeg($urlImage);
				break;
			case IMAGETYPE_PNG: 
				$img = imagecreatefrompng($urlImage);
				break;
			default:
				return false;
		} 
		
		$width = imagesx( $img );
		$height = imagesy( $img );

		// calculate thumbnail size
		$new_width = $thumbWidth;
		$new_height = ceil( $height * ( $thumbWidth / $width ) );

		// create a new temporary image
		$tmp_img = imagecreatetruecolor( $new_width, $new_height );
		
		imagealphablending($tmp_img, false);
		imagesavealpha($tmp_img,true);

		// copy and resize old image into new image
		imagecopyresampled( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

		// save thumbnail into a file
		imagepng( $tmp_img, $urlThumb, 7);
		imagedestroy($img);
		imagedestroy($tmp_img);
		return true;
	}
	function createThumbsHeight( $urlImage, $urlThumb, $thumbHeight )
	{
		// load image and get image size
		$imagen=getimagesize($urlImage);
		switch ($imagen[2]){
			case IMAGETYPE_JPEG: 
				$img = imagecreatefromjpeg($urlImage);
				break;
			case IMAGETYPE_PNG: 
				$img = imagecreatefrompng($urlImage);
				break;
			default:
				return false;
		} 
		
		$width = imagesx( $img );
		$height = imagesy( $img );

		// calculate thumbnail size
		$new_width = ceil( $width * ( $thumbHeight / $height ) );
		$new_height = $thumbHeight; //floor( $height * ( $thumbWidth / $width ) );

		// create a new temporary image
		$tmp_img = imagecreatetruecolor( $new_width, $new_height );

		imagealphablending($tmp_img, false);
		imagesavealpha($tmp_img,true);
		// copy and resize old image into new image
		imagecopyresampled ( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

		// save thumbnail into a file
		imagepng( $tmp_img, $urlThumb, 7);
		imagedestroy($img);
		imagedestroy($tmp_img);
		return true;
	}
	function createThumbsWH( $urlImage, $urlThumb, $thumbWidth, $thumbHeight )
	{
		// load image and get image size
		$imagen=getimagesize($urlImage);
		switch ($imagen[2]){
			case IMAGETYPE_JPEG: 
				$img = imagecreatefromjpeg($urlImage);
				break;
			case IMAGETYPE_PNG: 
				$img = imagecreatefrompng($urlImage);
				break;
			default:
				return false;
		} 
		
		list($w_src, $h_src, $type) = getimagesize($urlImage);
		if($w_src>$h_src){
			$ratio=$w_src/$h_src;
			$h2=$thumbHeight;
			$w2=$thumbHeight*$ratio;
		}else{
			$ratio=$h_src/$w_src;
			$h2=$thumbWidth*$ratio;
			$w2=$thumbWidth;
		}
		//echo "$w_src x $h_src -> $w2 x $h2";
		$imgScaled = imagecreatetruecolor($w2, $h2);
		imagealphablending($imgScaled, false);
		imagesavealpha($imgScaled,true);
		
		imagecopyresampled($imgScaled, $img, 0, 0, 0, 0, $w2, $h2, $w_src, $h_src);

		$img1 = imagecreatetruecolor($thumbWidth, $thumbHeight);
		imageantialias($img1, true);

		imagealphablending($img1, false);
		imagesavealpha($img1,true);
		
		$diffW=$w2-$thumbWidth;
		$diffH=$h2-$thumbHeight;
		imagecopyresampled($img1, $imgScaled, 0, 0, $diffW/2, $diffH/2, $thumbWidth, $thumbHeight, $thumbWidth, $thumbHeight);

		imagepng( $img1, $urlThumb, 7);
		imagedestroy($img);
		imagedestroy($img1);
		imagedestroy($imgScaled);
		return true;
	}
	function rrmdir($dir) {
		if (is_dir($dir)) {
			$objects = scandir($dir);
			foreach ($objects as $object) {
				if ($object != "." && $object != "..") {
					if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
				}
			}
			reset($objects);
			rmdir($dir);
		}
	} 
	//User::updateUser(1,"Super Administrador",1,"info@domain.com","123");
?>