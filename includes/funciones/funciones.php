<?php 

function dd($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}


define('TEMPLATES_URL',__DIR__.'/../includes/templates');

function incluirTemplate(string $nombre, bool $inicio=false, bool $baner=false){
    include TEMPLATES_URL . "/{$nombre}.php";
}


function is_auth(){
    if(empty($_SESSION['login'])){
        session_start();
        
        
        if(!$_SESSION['login']){
            header('Location: /login');
        }

       
    }
}


// function auth(){
//     if(empty($_SESSION['login'])){
//         session_start();
//         return $auth=true;
//     }
        
// }

//sanitizando el html que se muestra cuando autocompleta y no piede el contenido
function s($html): string{
    $s=htmlspecialchars($html);
    return $s;
}


//validando el tipo de vendedor o propiedad

function validarTipoContenido($tipo){
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}

function mostrarNotificacion($codigo){
    $mensaje='';

    switch($codigo){
        case 1: 
            $mensaje ='Creado exitosamente';
            break;
        case 2: 
            $mensaje ='actualizado exitosamente';
            break;
        case 3: 
            $mensaje ='eliminado exitosamente';
            break;
    }
    return $mensaje;
}


function redireccionar($link){
    $id=$_GET['id'];
    $id=filter_var($id, FILTER_VALIDATE_INT);
    
    if(!$id){
        header("Location: {$link}");
    }
    return $id;
}