<?php 
namespace Controller;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;


class VendedorController{

    public static function crear(Router $router){


        $alertas=Vendedor::getAlertas();
        $vendedor=new Vendedor;


        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $vendedor=new Vendedor($_POST['vendedor']);
           
            $alertas=$vendedor->validar();
            if(empty($alertas)){
        
                //preparamos la imagen
                $nombre_imagen=md5(uniqid(rand(),true)).'.jpg';
                if($_FILES['vendedor']['tmp_name']['imagen']){
                    $imagen=Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800,600);
                    $vendedor->setImagen($nombre_imagen);
                }
                $resultado=$vendedor->save();
                
                if($resultado){
        
                           /***************insertando imagen************/
                
                //crear carpeta relativa
                $carpetaImagenes='imagenes/';
                
                if(!is_dir($carpetaImagenes)){
                    mkdir($carpetaImagenes, 0777);
                }
        
                //usando intervention image guardar imagen en servidor
                $imagen->save($carpetaImagenes.$nombre_imagen);
                //ahora guardamos tambien el nombre en la bd
                    header('Location: /admin?resultado=1');
                }
            }
        }
                
        $router->render('vendedores/crear',[
        'vendedor'=>$vendedor,
        'alertas'=>$alertas,
        ]);
    }

    public static function actualizar(Router $router){
    
    
    $id=$_GET['id'];

    //buscar una propiedad por su id;+
    $alertas=[];


    //llena el select de vendedores
    $vendedor=Vendedor::find($id);
    $vendedores=Vendedor::all();
    $alertas=Vendedor::getAlertas();

    if(!$id){
        header('Location: /admin');
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //asignar los atributos
        $args=$_POST['vendedor'];
        $vendedor->sincronizar($args);
        $alertas=$vendedor->validar();
        //generando un nombre unico para almacenar imagen
        $nombre_imagen=md5(uniqid(rand(),true)).'.jpg';
    
        if($_FILES['vendedor']['tmp_name']['imagen']){
    
            $imagen=Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800,600);
            
            $vendedor->setImagen($nombre_imagen);
        }
        
        if(empty($alertas)){
            if($_FILES['vendedor']['tmp_name']['imagen']){
            $imagen->save(CARPETA_IMAGENES . $nombre_imagen);
            }
            $resultado=$vendedor->save();
            
        }
        $resultado=$vendedor->save();
    
        
    }

    $router->render('vendedores/actualizar',[
        'alertas'=>$alertas,
        'vendedor'=>$vendedor,
        
    ]);
    }


    public static function eliminar(){
   


    if($_SERVER['REQUEST_METHOD']==='POST'){
        //TOMAMMOS EL ID A ELIMINAR y lo filtramos
        $id=$_POST['id'];
   
        $id=filter_var($id,FILTER_VALIDATE_INT);


        if($id){
        $tipo = $_POST['tipo'];
    
        if(validarTipoContenido($tipo)){
            if($tipo==='vendedor'){
                $vendedor=Vendedor::find($id);
                $vendedor->delete();  
            }else if($tipo==='propiedad'){
                $propiedad=Propiedad::find($id);
                $propiedad->delete();    
            }
        }

        } 
    }
}



   
}