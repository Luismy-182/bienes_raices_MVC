<?php 
function conectarDB() :mysqli{
    $db=New Mysqli('localhost','root','maiki','bienes_raices');

    if(!$db){
        echo "Error al conectar papi";
        exit;
    }
    return $db;
}
?>