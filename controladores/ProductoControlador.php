
<?php

    Class ProductoControlador extends BaseControlador {

        public $result;
        private $tabla = "productos";
        private $fields = array(
            "id" => "id",
            "nombre"  => "nombre",
            "exist" => "existencia",
            "precio" => "precio"
        );

        public function __construct(){}

        public function Lista(){

            $lista = $this->soapClient->__soapCall('ListaProducto');  
            
            $this->result = $lista;
        }

        public function Agregar () {

             if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["mod_nombre"]) && isset($_POST["mod_existencia"]) && isset($_POST["mod_precio"])):
                
                $producto = new ProductoModelo ();
                $producto->nombre = $_POST["mod_nombre"];
                $producto->existencia = intval($_POST["mod_existencia"]);
                $producto->precio = floatval($_POST["mod_precio"]);

                if(empty($producto->existencia) && empty($producto->precio) && empty($producto->nombre)):
                    return false;
                endif;

                if(!filter_var($producto->precio, FILTER_VALIDATE_INT) && !filter_var($producto->existencia, FILTER_VALIDATE_INT)):
                    return false;
                endif;

                if((int)$producto->precio < 0 || (int)$producto->existencia < 0):
                    return false;
                endif;

                $newProducto = $this->soapClient->__soapCall('AgregarProducto', array('producto' => $producto));    

                //Call to logger
                if ($newProducto == null) {        //Ya existe el producto
                    $this->result = 3;
                    return;
                }

                $producto->id = $newProducto;

                $usuario = new UsuarioModelo();
                $usuario->username = $_SESSION["usuario"];

                $log = new LoggerControlador();
                $log->Agregar($usuario, $producto);

                header("Location: producto.php?c=Producto&a=Lista");

             endif;

        }

        public function Eliminar() {
            $idProd = $_GET["id"];

            $checkProducto = $this->soapClient->__soapCall('SelectProductoById', array('id' => $idProd));

            if ($checkProducto == 0) {
                $usuario = new UsuarioModelo();
                $usuario->username = $_SESSION["usuario"];

                $producto = new ProductoModelo();
                $producto->id = $_GET["id"];
                $producto->nombre = "NE";
                $producto->existencia = -1;
                $producto->precio = -1;

                $log = new LoggerControlador();
                $log->IEliminar($usuario, $producto);
                
                header("Location: producto.php?c=Producto&a=Lista&e=2");
                return;
            }

            $this->result = $checkProducto;
            $producto = new ProductoModelo();
            $producto->id = $this->result->id;
            $producto->nombre = $this->result->nombre;
            $producto->existencia = $this->result->existencia;
            $producto->precio = $this->result->precio;

            $deleteProducto = $this->soapClient->__soapCall('EliminarProducto', array('producto' => $producto));

            $usuario = new UsuarioModelo();
            $usuario->username = $_SESSION["usuario"];

            $log = new LoggerControlador();
            $log->Eliminar($usuario, $producto);
            
            header("Location: producto.php?c=Producto&a=Lista");

        }

        public function Modificar(){

            if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["mod_nombre"]) && isset($_POST["mod_existencia"]) && isset($_POST["mod_precio"])):

            

                $producto = new ProductoModelo();
                $producto->nombre = $_POST["mod_nombre"];
                $producto->existencia = intval($_POST["mod_existencia"]);
                $producto->precio = floatval($_POST["mod_precio"]);
                $producto->id = $_GET["id"];

                if(empty($producto->existencia) && empty($producto->precio) && empty($producto->nombre)):
                    return false;
                endif;

                if(!filter_var($producto->precio, FILTER_VALIDATE_INT) && !filter_var($producto->existencia, FILTER_VALIDATE_INT)):
                    return false;
                endif;

                if((int)$producto->precio < 0 || (int)$producto->existencia < 0):
                    return false;
                endif;

                $checkProducto = $this->soapClient->__soapCall('SelectProductoById', array('id' => $idProd));

                if($checkProducto == 1):

                    $res = $checkProducto
                    $actual = new ProductoModelo();
                    $actual->id = $res->id;
                    $actual->nombre = $res->nombre;
                    $actual->existencia = $res->existencia;
                    $actual->precio = $res->precio;

                    if($actual->id == $_SESSION["producto_id"] && $actual->nombre == $_SESSION["producto_nombre"] && $actual->existencia == $_SESSION["producto_existencia"] && $actual->precio == $_SESSION["producto_precio"]):
                       

                       	$updateProducto = $this->soapClient->__soapCall('ModificarProducto', array('producto' => $producto));

                        $usuario = new UsuarioModelo();
                        $usuario->username = $_SESSION["usuario"];

                        $log = new LoggerControlador();
                        $log->Modificar($usuario, $producto);

                        $this->stop();
                        header("Location: producto.php?c=Producto&a=Lista");
                    else:
                        $usuario = new UsuarioModelo();
                        $usuario->username = $_SESSION["usuario"];

                        $log = new LoggerControlador();
                        $log->IModificar($usuario, $producto);
                        header("Location: producto.php?c=Producto&a=Lista&e=3");
                    endif;
                else:
                    $usuario = new UsuarioModelo();
                    $usuario->username = $_SESSION["usuario"];

                    $log = new LoggerControlador();
                    $log->IModificar($usuario, $producto);
                    header("Location: producto.php?c=Producto&a=Lista&e=1");
                endif;

            else:
                if(isset($_GET["id"])):

                    if(!$this->start()) {
                        $this->stop();
                        return false;
                    }

                    $id = $_GET["id"];

                    $checkProducto = $this->soapClient->__soapCall('SelectProductoById', array('id' => $idProd));

                    if($checkProducto == 1):
                        $this->result = $checkProducto;
                        $_SESSION["producto_id"] = $this->result->id;
                        $_SESSION["producto_nombre"] = $this->result->nombre;
                        $_SESSION["producto_existencia"] = $this->result->existencia;
                        $_SESSION["producto_precio"] = $this->result->precio;
                    else:
                        header("Location: producto.php?c=Producto&a=Lista&e=2");    
                    endif;
                else:
                    header("Location: producto.php?c=Producto&a=Lista");
                endif;
            endif;

        }

    }

?>