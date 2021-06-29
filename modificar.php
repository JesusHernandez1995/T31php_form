<?php 
session_start();

if(empty($_SESSION['modifying'])){
    $_SESSION["modifying"] = false;
}

// Llamamos al archivo funcions.php
require 'functions/functions.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION["modifying"] == false){
    $codigo = validate($_POST["Codigo"]);
    
    // Si la conexión a la base de datos da error, entonces...
    $conexion = crear_conexion();
    if(!$conexion){
        die('Ha habido un error, intente más tarde');
    } else {
        $registro = $conexion->query("SELECT Descripcion FROM rubros WHERE Codigo='$codigo'");
        if($conexion->error)    die();
        
        if($reg = $registro->fetch_array()){
            $_SESSION["modifying"] = true;
        } else {
            echo 'No existe un rubro con ese código';
        }
        
        $conexion->close();
    }
} else if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION["modifying"] == true){
        $codigo = validate($_POST["Codigo"]);
        $descripcion = validate($_POST["Descripcion"]);
        
        // Si la conexión a la base de datos da error, entonces...
        $conexion = crear_conexion();
        if(!$conexion){
            die('Ha habido un error, intente más tarde');
        } else {
            $registro = $conexion->query("UPDATE rubros SET Descripcion='$descripcion' WHERE Codigo='$codigo'");
            if($conexion->error)    die();
            echo 'Se modificó la descripcion del rubro';
            session_destroy();
        }
        $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Ejercicio para crear tablas y rubros - Modificar Item</title>
</head>
<body>
    <div class="text-center">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="mt-4">
            
            <?php if(!isset($reg)): ?>
                <label for="Codigo">Ingrese el código del rubro a modificar: </label>
                <input type="text" for="Codigo" name="Codigo" required>
            <?php else:?>
                <label for="Codigo">Código del rubro que quiere modificar </label>
                <input type="text" for="Codigo" name="Codigo" readonly value="<?php echo $_REQUEST['Codigo']; ?>">

                <label for="Descripcion">Descripción del rubro que quiere modificar: </label>
                <input type="text" for="Descripcion" name="Descripcion" value="<?php echo $reg['Descripcion']; ?>" required>
            <?php endif;?>


            <button type="submit">Confirmar</button>
            <div class="row mt-3">
                <div class="col-12">
                    <a href="crear_articulo.php" style="width: 12%;" class="btn btn-primary">Crear artículo</a>
                    <a href="insertar.php" style="width: 12%;" class="btn btn-primary">Insertar rubro</a>
                    <a href="borrar.php" style="width: 12%;" class="btn btn-primary">Borrar rubro</a>
                    <a href="mostrar.php" style="width: 15%;" class="btn btn-primary">Mostrar todos los rubros</a>
                    <a href="mostrar_articulos.php" style="width: 18%;" class="btn btn-primary">Mostrar todos los artículos</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>


