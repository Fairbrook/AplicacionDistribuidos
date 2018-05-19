# AplicacionDistribuidos
Aplicacion punto de venta para la materia de sistemas distribuidos

## [Ejemplo nusoap](www.qualityinfosolutions.com/servicio-web-basico-con-nusoap-php/)



## Métodos WebService / Controladores
* Métodos de WebService invocados desde Controladores
* Métodos de Controladores

### Usuario
* Métodos WS
  * Ingresar (UsuarioModelo).
  * SetHash (UsuarioModelo).
  * RegistrarCuenta (UsuarioModelo).
  * CheckHash (hash).
  
* Controlador
  * Ingresar ($POST["username"], $POST["password"]).
  * Registrar ($POST["username"], $POST["password"]).
  * Check ()

### Producto
* Métodos WS
  * AgregarProducto (ProductoModelo)
  * SelectProductoById (id)
  * EliminarProducto (ProductoModelo)

* Controlador
  * Lista ().
  * Eliminar ($GET["id"]).
  * Agregar ($POST["mod_nombre"], $POST["mod_existencia"], $POST["mod_precio"]).
  * Modificar ($POST["mod_nombre"], $POST["mod_existencia"], $POST["mod_precio"]).
