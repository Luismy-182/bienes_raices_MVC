<?php
namespace Model;

use Model\ActiveRecord;

class vendedor extends ActiveRecord{


    protected static $db; //conexión BD
    protected static $columnasDB=['id', 'nombre', 'apellido', 'telefono', 'email', 'imagen'];
    protected static $alertas=[];
    protected static $tabla='vendedores';
    
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $imagen;

    
    public function __construct($args=[]){
        $this->id=$args['id'] ?? '';
        $this->nombre=$args['nombre'] ?? '';
        $this->apellido=$args['apellido'] ?? '';
        $this->telefono=$args['telefono'] ?? '';
        $this->email=$args['email'] ?? '';
        $this->imagen=$args['imagen'] ?? '';
    }
    
    public function validar(){
        if(!$this->nombre){
            self::$alertas[]="El nombre no puede estar vacío";
        }
        if(!$this->apellido){
            self::$alertas[]="El apellido no puede estar vacío";
        }
        if(!$this->telefono){
            self::$alertas[]="El teléfono no puede estar vacío";
        }
        if(!$this->email){
            self::$alertas[]="El email no puede estar vacío";
        }
        
        return self::$alertas;
    }


    
}