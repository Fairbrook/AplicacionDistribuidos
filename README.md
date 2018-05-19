# AplicacionDistribuidos
Aplicacion punto de venta para la materia de sistemas distribuidos

## [Ejemplo nusoap](www.qualityinfosolutions.com/servicio-web-basico-con-nusoap-php/)



## Métodos WebService / Controladores
* Métodos de WebService invocados desde Controladores
* Métodos de Controladores

### Usuario
* Métodos WS
  * Ingresar (username, password).
  * SetHash (key).
  * SelectUserByUsername (username).
  * RegistrarCuenta (username, password, key).
  * CheckHash (key).
  
* Controlador
  * Ingresar ($POST["username"], $POST["password"]).
  * Registrar ($POST["username"], $POST["password"]).
  * Check ()
