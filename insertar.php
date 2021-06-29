<?php 

// Llamamos al archivo funcions.php
require 'functions/functions.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = validate($_POST["Descripcion"]);
    
    // Si la conexión a la base de datos da error, entonces...
    $conexion = crear_conexion();
    if(!$conexion){
        die('Ha habido un error, intente más tarde');
    } else {
        $conexion->query("INSERT INTO rubros (Descripcion) VALUES ('$nombre')");
        if($conexion->error)    die();
        echo 'Se ha añadido un rubro con éxito';
        $conexion->close();
    }
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
    <title>Ejercicio para crear tablas y rubros - Insertar Item</title>
</head>
<body>
    <div class="text-center">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="mt-4">
            <label for="Descripcion">Ingrese la descripción del rubro a insertar: </label>
            <input type="text" for="Descripcion" name="Descripcion">

            <button type="submit">Confirmar</button>
            <div class="row mt-3">
                <div class="col-12">
                    <a href="crear_articulo.php" style="width: 12%;" class="btn btn-primary">Crear artículo</a>
                    <a href="borrar.php" style="width: 12%;" class="btn btn-primary">Borrar rubro</a>
                    <a href="modificar.php" style="width: 12%;" class="btn btn-primary">Modificar rubro</a>
                    <a href="mostrar.php" style="width: 15%;" class="btn btn-primary">Mostrar todos los rubros</a>
                    <a href="mostrar_articulos.php" style="width: 18%;" class="btn btn-primary">Mostrar todos los artículos</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>