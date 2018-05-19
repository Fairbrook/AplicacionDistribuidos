<?php

    Class UsuarioControlador extends BaseControlador {

        public $result = 1;

        public function __construct(){}

        public function Ingresar () {
            if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["usuario"]) && isset($_POST["password"])):
                
                if(empty($_POST["usuario"]) && empty($_POST["password"])):
                    $this->result = 2;
                    return;
                endif;

                $username = trim($_POST["usuario"]);
                $password = hash("sha256", $_POST["password"]);

                $loginRes = $this->soapClient->__soapCall('Ingresar', array('username' => $username, 'password' => $password));

                if ($loginRes > 0): 
                    $key = hash("sha256",(string)mt_rand(10, 1000));
                    $this->soapClient->__soapCall('SetHash', array('key' => $key));

                    $_SESSION["usuario"] = $username;
                    $_SESSION["hash"] = $key;
                    header("Location: producto.php?c=Producto&a=Lista");
                else:
                    $this->result = 3;
                    return false;
                endif;

                
            endif;
        }

        public function Registrar () {
            if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["usuario"]) && isset($_POST["password"])):

                if(empty($_POST["usuario"]) && empty($_POST["password"])):
                    $this->result = 2;
                    return;
                endif;

                $username = trim($_POST["usuario"]);
                $password = hash("sha256", $_POST["password"]);
                $key = hash("sha256",(string)mt_rand(10, 1000));

                $UserVerify = $this->soapClient->__soapCall('SelectUserByUsername', array('username' => $username));

                if ($UserVerify == 3) {        //Ya existe ese nombre de usuario
                    $this->result = 3;
                    return;
                } else if ($registerUserRes == 1) {

                    $UserVerify = $this->soapClient->__soapCall('RegistrarCuenta', array('username' => $username, 'password' => $password, 'key'=> $key));

                    $_SESSION["usuario"] = $username;
                    $_SESSION["hash"] = $key;                        
                    header("Location: producto.php");

                }                        

            endif;
        }

        public function Logout(){
            session_destroy();
            header("Location: usuario.php?c=Usuario&a=Ingresar");
        }

        public function Check () {
            if(isset($_SESSION["hash"])):
                $key = $_SESSION["hash"];
                $resCheckHash = $this->soapClient->__soapCall('CheckHash', array('key' => $key));

                if ($resCheckHash == 1) {
                    return false;
                } else {
                    session_destroy();
                    return true;
                }
            else:
                return true;
            endif;            
        }

    }

?>