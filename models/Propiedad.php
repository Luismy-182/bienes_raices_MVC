<?php
namespace Model;

use Model\ActiveRecord;
class Propiedad extends ActiveRecord{

protected static $db; //conexión BD
protected static $columnasDB=['id', 'titulo', 'precio', 'imagen','descripcion', 'habitaciones','wc', 'estacionamiento', 'vendedorId'];
protected static $alertas=[];
protected static $tabla='propiedades';

public $id;
public $titulo;
public $precio;
public $imagen;
public $descripcion;
public $habitaciones;
public $wc;
public $estacionamiento;
public $creado;
public $vendedorId;


public function __construct($args=[]){
    $this->id=$args['id'] ?? '';
    $this->titulo=$args['titulo'] ?? '';
    $this->precio=$args['precio'] ?? '';
    $this->imagen=$args['imagen'] ?? '';
    $this->descripcion=$args['descripcion'] ?? '';
    $this->habitaciones=$args['habitaciones'] ?? '';
    $this->wc=$args['wc'] ?? '';
    $this->estacionamiento=$args['estacionamiento'] ?? '';
    $this->creado=date('Y/m/d');
    $this->vendedorId=$args['vendedorId'] ?? 1;
}


public function validar(){
    //validar
    if(!$this->titulo){
       self::$alertas[]="Título no puede estar vacío";
       
   }
   if(!$this->precio){
       self::$alertas[]="Precio no puede estar vacío";
   }
    if(!$this->imagen){
       self::$alertas[]="La imagen es obligatoria";
   }
   if(strlen($this->descripcion)<50){
       self::$alertas[]="Descripción debe tener mas de 50 caracteres";
   }
   if(!$this->habitaciones){
       self::$alertas[]="Habitaciones no puede estar vacío";
   }
   if(!$this->wc){
       self::$alertas[]="WC no puede estar vacío";
   }
   if(!$this->estacionamiento){
       self::$alertas[]="Estacionamiento no puede estar vacío";
   }
   if(!$this->vendedorId){
       self::$alertas[]="El vendedor no puede estar vacío";
   }

   return self::$alertas;

}


}