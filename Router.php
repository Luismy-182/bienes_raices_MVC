<?php 

namespace MVC;
class Router{
    public $rutasGET=[];
    public $rutasPOST=[];

    public function get($url, $fn){
        $this->rutasGET[$url]=$fn;
    }

    public function post($url, $fn){
        $this->rutasPOST[$url]=$fn;
    }


    public function comprobarRutas(){
 
        //arreglo de rutas protegidas

      

        
        
        $urlActual=$_SERVER['PATH_INFO'] ?? '/';
        $metodo=$_SERVER['REQUEST_METHOD'];
        
        if($metodo==='GET'){
            $fn=$this->rutasGET[$urlActual] ?? null;
        }else{
            $fn=$this->rutasPOST[$urlActual] ?? null;
        }
    
    
      



        if($fn){
            //lA URL EXISTE Y Hay una funcion asociada
            call_user_func($fn, $this);
        }else{
            echo "Página no encontrada";
        }
    }

    //Renderiza las vistas
    public function render($view, $datos=[]){

        foreach($datos as $key => $value){
            $$key=$value;
        }
        ob_start(); //Almacenamiento en memoria durante un momento
        include __DIR__."/views/$view.php";

        $contenido= ob_get_clean();//limpia el buffer
        include __DIR__. '/views/layout.php';

    }

}