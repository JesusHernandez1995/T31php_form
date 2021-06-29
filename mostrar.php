<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .tablalistado{
            border-collapse: collapse;
            box-shadow: 0px 0px 10px #000;
            margin: 15px;
        }
        .tablalistado th{
            background-color: #22d710;
            padding: 10px;
            border: 2px solid #000;
        }
        .tablalistado td{
            background-color: #7bde71;
            padding: 10px;
            border: 2px solid #000;
        }
    </style>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Listado de Rubros</title>
</head>
<body>

    <?php 

    // Llamamos al archivo funcions.php
    require 'functions/functions.php';

    // Si la conexión a la base de datos da error, entonces...
    $conexion = crear_conexion();
    if(!$conexion){
        die('Ha habido un error, intente más tarde');
    } else {
        $registros = $conexion->query("SELECT Codigo, Descripcion FROM rubros");
        if($conexion->error)    die();
        
        echo "<div class='text-center d-flex justify-content-center mt-3'>";
        echo '<table class="tablalistado">';
        echo '<tr><th>Código</th><th>Descripción</th></tr>';
        while ($reg = $registros->fetch_array()) {
            echo '<tr>';
            echo '<td>';
            echo $reg['Codigo'];
            echo '</td>';
            echo '<td>';
            echo $reg['Descripcion'];
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
        $conexion->close();
    }
    ?>
    <div class="text-center">
        <div class="row mt-3">
            <div class="col-12">
                <a href="crear_articulo.php" style="width: 12%;" class="btn btn-primary">Crear artículo</a>
                <a href="insertar.php" style="width: 12%;" class="btn btn-primary">Insertar rubro</a>
                <a href="borrar.php" style="width: 12%;" class="btn btn-primary">Borrar rubro</a>
                <a href="modificar.php" style="width: 12%;" class="btn btn-primary">Modificar rubro</a>
                <a href="mostrar_articulos.php" style="width: 18%;" class="btn btn-primary">Mostrar todos los artículos</a>
            </div>
        </div>
    </div>
</body>
</html>

