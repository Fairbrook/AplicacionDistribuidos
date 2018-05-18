<?php
    class BaseControlador {
        protected $wsdl = "'http://ip_equipo:8080/ws_test/server.php?wsdl';";
        protected $soapClient;


        public function __construct() {
            $this->soapClient = new SoapClient($wsdl);
            
        }
    }
    
?>