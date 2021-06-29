<?php 

// ------------------------ Functions ----------------------------
function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

function crear_conexion(){
    $host = $_ENV['DB_HOST'];
    $user = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];
    $mysql = new mysqli($host, $user, $password, 'Articulos_rubros');

    if($mysql->connect_error)     return false;
    else                          return $mysql;
}

?>
