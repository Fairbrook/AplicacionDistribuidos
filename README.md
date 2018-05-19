# AplicacionDistribuidos
Aplicacion punto de venta para la materia de sistemas distribuidos

## [Ejemplo nusoap](www.qualityinfosolutions.com/servicio-web-basico-con-nusoap-php/)



## Métodos WebService / Controladores
* Métodos de WebService invocados desde Controladores
* Métodos de Controladores

### Usuario

Método WS | _return_
----------- | ------------
Ingresar (usuario) | ???
RegistrarCuenta (usuario) | ???
CheckHash (hash) | ???
SetHash (usuario) | ???

Método de Controlador | _return_
----------- | ------------
Ingresar ($POST["username"], $POST["password"]) | ???
Registrar ($POST["username"], $POST["password"]) | ???
Check ( ) | ???

### Producto

Método WS | _return_
----------- | ------------
??? | ???
AgregarProducto (producto) | ???
EliminarProducto (producto) | ???
??? | ???
SelectProductoById (id) | ???


Método de Controlador | _return_
----------- | ------------
Lista ( ) | ???
Agregar ($POST["mod_nombre"], $POST["mod_existencia"], $POST["mod_precio"]) | ???
Eliminar ($GET["id"]) | ???
Modificar ($POST["mod_nombre"], $POST["mod_existencia"], $POST["mod_precio"]) | ???
