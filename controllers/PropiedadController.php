<?php 
namespace Controller;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{

    public static function index(Router $router){
    is_auth();
    
    $propiedades=Propiedad::all();
    $estatus=$_GET['resultado'] ?? null;
    $vendedores=Vendedor::all();


    $router->render('admin',[
        'nombre'=>'Miguel',
        'propiedades'=>$propiedades,
        'vendedores'=>$vendedores,
        'estatus'=>$estatus
        ]);    
    }




    public static function crear(Router $router){
        is_auth();
        $propiedad=new Propiedad;
        $vendedores=Vendedor::all();
        $alertas=Propiedad::getAlertas();

    if($_SERVER['REQUEST_METHOD']==='POST'){
             
    //forma POO.
    $propiedad=new Propiedad($_POST['propiedad']);
    //generando un nombre unico para almacenar imagen
    $nombre_imagen=md5(uniqid(rand(),true)).'.jpg';

    if($_FILES['propiedad']['tmp_name']['imagen']){

        $imagen=Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
     
        $propiedad->setImagen($nombre_imagen);
    }

    //validar
    $alertas=$propiedad->validar();


    
    if(empty($alertas)){
        
        /***************insertando imagen************/
        
        //crear carpeta relativa
        $carpetaImagenes=CARPETA_IMAGENES;
        
        if(!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes, 0777);
        }

        
        //subir o mover la imagen del directorio temporal
        //  move_uploaded_file($imagen['tmp_name'], $carpetaImagenes.$nombre_imagen);
        
        //usando intervention image guardar imagen en servidor
        $imagen->save($carpetaImagenes. $nombre_imagen);
        //ahora guardamos tambien el nombre en la bd
        
        //si no hay alertas insertamos
        $resultado=$propiedad->save();

        if($resultado){
            header('Location: /admin?resultado=1');
        }
   


    }
        }

        $router->render('propiedades/crear',[
            'propiedad'=>$propiedad,
            'vendedores'=>$vendedores,
            'alertas'=>$alertas
        ]);
    }





    public static function actualizar(Router $router){
        is_auth();
        $id=redireccionar('/admin');
        
        $propiedad=Propiedad::find($id);
        $vendedores=Vendedor::all();
        $alertas=Propiedad::getAlertas();

        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //asignar los atributos
            $args=$_POST['propiedad'];
            $propiedad->sincronizar($args);
            $alertas=$propiedad->validar();

            //generando un nombre unico para almacenar imagen
            $nombre_imagen=md5(uniqid(rand(),true)).'.jpg';

            if($_FILES['propiedad']['tmp_name']['imagen']){

                $imagen=Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            
                $propiedad->setImagen($nombre_imagen);
            }
            
            if(empty($alertas)){
                if($_FILES['propiedad']['tmp_name']['imagen']){
                $imagen->save(CARPETA_IMAGENES . $nombre_imagen);
                }
                $resultado=$propiedad->save();
                
            }
        }
        $router->render('/propiedades/actualizar',[
            'propiedad'=>$propiedad,
            'alertas'=>$alertas,
            'vendedores'=>$vendedores

        ]);


    }


    public static function eliminar(Router $router){
        is_auth();
        if($_SERVER['REQUEST_METHOD']==='POST'){
        //TOMAMMOS EL ID A ELIMINAR y lo filtramos
        
        $id=$_POST['id'];
        $id=filter_var($id,FILTER_VALIDATE_INT);

        if($id){
            $tipo = $_POST['tipo'];
        
            if(validarTipoContenido($tipo)){
              
                $propiedad= Propiedad::find($id);
                $propiedad->delete();
            
            }
    
        }


    }// fin metodo

}




}