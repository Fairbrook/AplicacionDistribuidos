<?php
    include("controllers/ProductoController.php");
    $controller = new ProductoController();
    if(@isset($_POST["mod_nombre"])){
        $producto = new Producto();
        $producto->nombre = $_POST["mod_nombre"];
        $producto->existencia = intval($_POST["mod_existencia"]);
        $producto->precio = floatval($_POST["mod_precio"]);
        $res = $controller->add($producto);
        if($res){
            header("Location: productos.php");
        }
    }
?>
<?php if(isset($res)):?>
    <?php if(!$res):?>  
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        No borres los patrones y los required!!
    </div>
    <?php endif;?>
<?php endif;?>
<div class="form-group">
    <label for="mod_nombre" class="col-sm-3 control-label">Nombre</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="mod_nombre" name="mod_nombre" placeholder="Nombre del producto" required>
    </div>
</div>

<div class="form-group">
    <label for="mod_existencia" class="col-sm-3 control-label">Existencia</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="mod_existencia" name="mod_existencia" placeholder="Existencia del producto" required pattern="[0-9]+">
    </div>
</div>

<div class="form-group">
    <label for="mod_precio" class="col-sm-3 control-label">Precio</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="mod_precio" name="mod_precio" placeholder="Precio del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$">
    </div>
</div>