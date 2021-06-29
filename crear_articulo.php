<?php 

// Llamamos al archivo funcions.php
require 'functions/functions.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = validate($_POST["Descripcion"]);
    $precio = validate($_POST['Precio']);
    $rubro = validate($_POST['codigorubro']);
    
    // Si la conexión a la base de datos da error, entonces...
    $conexion = crear_conexion();
    if(!$conexion){
        die('Ha habido un error, intente más tarde');
    } else {
        // echo 'ha entrado aqui'
        $conexion->query("INSERT INTO articulos (Descripcion, Precio, CodigoRubros) VALUES ('$nombre', '$precio', '$rubro')");
        if($conexion->error)    die($conexion->error);
        echo 'Se ha añadido un artículo con éxito';
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
    <title>Ejercicio para crear un nuevo artículo</title>
</head>
<body>
    <div class="text-center">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="mt-4">
            <!-- Descripción del artículo -->
            <label for="Descripcion">Ingrese la descripción del artículo: </label>
            <input type="text"  class="mt-3" for="Descripcion" name="Descripcion" required>
            <br>
            <!-- Precio -->
            <label for="Precio">Ingrese el precio del artículo: </label>
            <input type="text"  class="my-3" for="Precio" name="Precio" required>
            <br>
            <!-- Seleccionar rubro -->
            <label for="codigorubro">Seleccione el rubro del artículo: </label>
            <select name="codigorubro" >
            <?php
                $conexion = crear_conexion();
                if(!$conexion){
                    die('Ha habido un error, intente más tarde');
                } else {
                    $registros = $conexion->query("SELECT Codigo, Descripcion FROM rubros");
                    if($conexion->error)    die();
                    
                    while ($reg = $registros->fetch_array()) {
                        echo "<option value=\"" . $reg['Codigo'] . "\">" . $reg['Descripcion'] . "</option>";
                    }
                    $conexion->close();
                }
            ?>
            </select>
            <br>
            <button type="submit" class="mt-3">Confirmar</button>
            <div class="row mt-3">
                <div class="col-12">
                    <a href="insertar.php" style="width: 12%;" class="btn btn-primary">Insertar rubro</a>
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