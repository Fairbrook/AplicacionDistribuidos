<?php
    class BaseControlador {
        protected $wsdl = "'http://ip_equipo:8080/ws_test/server.php?wsdl';";
        protected $soapClient;

        protected $availableWSActions;

        public function __construct() {
            $this->soapClient = new SoapClient($wsdl);
            $this->availableWSActions = $this->soapClient->_getFunctions();
        }
    }
    
?>