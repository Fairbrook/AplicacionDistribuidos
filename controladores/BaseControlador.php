<?php
    class BaseControlador {
        protected $wsdl = "http://localhost/WebService/WebService.php?wsdl";
        protected $soapClient;

        protected $availableWSActions;

        public function __construct() {
            $this->soapClient = new SoapClient($this->wsdl);
            $this->soapClient->__getFunctions();
        }
    }
    
?>