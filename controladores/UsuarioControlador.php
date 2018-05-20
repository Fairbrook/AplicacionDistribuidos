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

                $usuario = new UsuarioModelo();
                $usuario->username = trim($_POST["usuario"]);
                $usuario->password = hash("sha256", $_POST["password"]);

                $loginRes = $this->soapClient->__soapCall('Ingresar', array('usuario' => $usuario));

                if ($loginRes > 0): 
                    $usuario->hash = hash("sha256",(string)mt_rand(10, 1000));
                    $this->soapClient->__soapCall('SetHash', array('usuario' => $usuario));

                    $_SESSION["usuario"] = $usuario->username;
                    $_SESSION["hash"] = $usuario->hash;
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

                $usuario = new UsuarioModelo();
                $usuario->username = trim($_POST["usuario"]);
                $usuario->password = hash("sha256", $_POST["password"]);
                $usuario->hash = hash("sha256",(string)mt_rand(10, 1000));

                $registUser = $this->soapClient->__soapCall('RegistrarCuenta', array('usuario' => $usuario));

                if ($registUser == 3) {        //Ya existe ese nombre de usuario
                    $this->result = 3;
                    return;
                } else if ($registUser == 1) { 

                    $_SESSION["usuario"] = $usuario->username;
                    $_SESSION["hash"] = $usuario->hash;                        
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
                $hashKey = $_SESSION["hash"];
                $resCheckHash = $this->soapClient->__soapCall('CheckHash', array('hash' => $hashKey));

                if ($resCheckHash == 1) {
                    return false;
                } else {
                    session_destroy();
                    return true;
                }
            else:
                session_destroy();
                return true;
            endif;            
        }

    }

?>