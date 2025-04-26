<?php 

namespace Controller;

use MVC\Router;
use Model\Admin;

class LoginController{
    public static function login(Router $router){
    
    $alertas=[];

    if($_SERVER['REQUEST_METHOD']==='POST'){
        $auth=new Admin($_POST);
        $alertas=$auth->validar();
        
        

        if(empty($alertas)){
            //verificar si el usuario existe
            $resultado= $auth->verificarUsuario();

            if(!$resultado){
                $alertas=Admin::getAlertas();
            }else{
            //verificar el password
            $autentificado=$auth->comprobarPassword($resultado);

            if($autentificado){
            //autentificar el usuario
                $auth->autentificar();
            }else{
                //password incorrecto
                $alertas=Admin::getAlertas();
            }
            }
        }
    }



    $router->render('auth/login',[
        'alertas'=>$alertas
    ]);
    }

    public static function logout(Router $router){
        session_start();
        $_SESSION=[];
        header('Location: /');
    }
}