<?php
    class BaseControlador {
        protected $wsdl = "http://192.168.60.6/WebService/WebService.php?wsdl";
        protected $soapClient;

        protected $availableWSActions;

        public function __construct() {
            $this->soapClient = new SoapClient($this->wsdl);
            $this->soapClient->__getFunctions();
        }
    }
    
?>