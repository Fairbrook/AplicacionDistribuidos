<?php 

    Class LoggerControlador extends BaseControlador {

        public function Eliminar ($usuario, $producto) {
            $this->soapClient->__soapCall('LogEliminar', array('usuario' => $usuario, 'producto' => $producto));
        }

        public function IEliminar ($usuario, $producto) {
            $this->soapClient->__soapCall('LogIEliminar', array('usuario' => $usuario, 'producto' => $producto));
        }

        public function Agregar ($usuario, $producto) {
            $this->soapClient->__soapCall('LogAgregar', array('usuario' => $usuario, 'producto' => $producto));
        }

        public function IModificar ($usuario, $producto) {
            $this->soapClient->__soapCall('LogIModificar', array('usuario' => $usuario, 'producto' => $producto));
        }

        public function Modificar ($usuario, $producto) {
            $this->soapClient->__soapCall('LogModificar', array('usuario' => $usuario, 'producto' => $producto));
        }

    }
    
?>