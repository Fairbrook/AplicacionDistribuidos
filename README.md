# AplicacionDistribuidos
Aplicacion punto de venta para la materia de sistemas distribuidos

## [Ejemplo nusoap](www.qualityinfosolutions.com/servicio-web-basico-con-nusoap-php/)



## Métodos WebService / Controladores
* Métodos de WebService invocados desde Controladores
* Métodos de Controladores

### Usuario

Método WS | _return_
----------- | ------------
Ingresar (usuario) | 1 --> Login Exitoso; 0 --> Login no exitoso
RegistrarCuenta (usuario) | 3 --> Ya existe ese nombre de usuario; 1 --> Cuenta creada exitosamente
SetHash (usuario) | null
CheckHash (hash) | 1 --> No han iniciado sesión con otra cuenta; default --> El hash ha cambiado

Método de Controlador | _return_
----------- | ------------
Ingresar ($POST["username"], $POST["password"]) | false --> Inicio de sesión ha fallado
Registrar ($POST["username"], $POST["password"]) | result = 2 --> Hay campos vacíos; result = 3 --> Ya existe cuenta con ese username
Check ( ) | false --> Login de cuenta seguro; true --> Login de cuenta inseguro

### Producto

Método WS | _return_
----------- | ------------
??? | ???
AgregarProducto (producto) | null --> Ya existe el producto; idProducto insertado --> Correcta la inserción
SelectProductoById (id) | 0 --> El producto con determinado "id" no existe; ModeloProducto --> Producto encontrado
EliminarProducto (producto) | null
??? | ???



Método de Controlador | _return_
----------- | ------------
Lista ( ) | ???
Agregar ($POST["mod_nombre"], $POST["mod_existencia"], $POST["mod_precio"]) | false --> Error al ingresar información; result = 3 --> Ya existe ese producto
Modificar ($POST["mod_nombre"], $POST["mod_existencia"], $POST["mod_precio"]) | ???
Eliminar ($GET["id"]) | null
