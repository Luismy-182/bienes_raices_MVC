<?php 
namespace Model;
abstract class ActiveRecord{
  
protected static $db; //conexión BD
protected static $columnasDB=[];
protected static $alertas=[];
protected static $tabla='';


public static function setDB($database){
    self::$db=$database;
}

public function atributos(){
    $atributos=[];
    
    foreach(static::$columnasDB as $columna){
        if($columna==='id')continue;
        $atributos[$columna]=$this->$columna;
    }

   
   return $atributos;
    
}


public function sanitizarAtributos(){

   $atributos=$this->atributos();

   $sanitizado=[];
   foreach($atributos as $key => $value){
    $sanitizado[$key]= self::$db->escape_string($value);

    }
    return $sanitizado; //a la espera de que alguien tome el arreglo sanitizado
}


//validar errores

public static function getAlertas(){
    return static::$alertas;
}

public function validar(){
    //usamos static para que al heredar se haga referencia a la clase hija y no la padre
    static::$alertas=[];
    //siempre que se valida se limpia el arreglo
    return static::$alertas;

}

public function save(){
    if(!empty($this->id)){
        //actualizar
        
        return $this->update();
        
    }else{
        //creando un nuevo registro
        
        return $this->insert();
        
    }
}

public function update(){
    //acutalizando bd, sanitizando datos
    $atributos=$this->sanitizarAtributos();
    $valores=[];
    foreach($atributos as $key => $value){
        $valores[]="{$key}='{$value}'";
    }
    $query="UPDATE ".static::$tabla. " SET ";
    $query.=join (', ', $valores);
    $query.=" WHERE id = '" .self::$db->escape_string($this->id). "' ";
    $query.=" LIMIT 1";
 
    $resultado = self::$db->query($query);
    

    if($resultado){
        header('Location: /admin?resultado=2');
    }

  
}

public function insert(){
    //insertando datos a la db
    $atributos=$this->sanitizarAtributos();
    $query=" INSERT INTO ".static::$tabla. "(";
    $query.=join(', ', array_keys($atributos));
    $query.=") Values ('";
    $query.=join("','", array_values($atributos));
    $query.="') ";
    
    $resultado=self::$db->query($query);
    return $resultado;
}


public function setImagen($imagen){
    //busca si antes ya existe una imagen en la bd, si es que si la elimina con unlink
    if(isset($this->id) ){
        //elimina imagen
        $this->borrarImagen();
    }
    //asigna la imagen nueva al objeto de active record
    if($imagen){
        $this->imagen=$imagen;
    }
 }
 
 public function borrarImagen(){
    //comprueba si existe el archivo
    $existeArchivo= file_exists(CARPETA_IMAGENES.$this->imagen);
    if($existeArchivo){
        unlink(CARPETA_IMAGENES.$this->imagen);
    }
 }
 
public function delete(){
    //eliminamos el registro
    $query="DELETE FROM ".static::$tabla." WHERE id= " .self::$db->escape_string($this->id);
    
    $resultado=self::$db->query($query);
    if($resultado){
        $this->borrarImagen();
        header('Location: /admin?estatus=3');
    }
}

public static function all(){
    $query="SELECT * FROM ".static::$tabla." ";
    $resultado=self::consultarSql($query);
    return $resultado;
}

public static function get($limite){
    $query="SELECT * FROM ".static::$tabla." LIMIT ".$limite;
    $resultado=self::consultarSql($query);
    return $resultado;
}

//arreglo de objetos de active record
protected static function consultarSql($query){
    //consultar la base de datos
    $resultado=self::$db->query($query);

    //iterar los resultados
    $array=[];
    while($registro = $resultado->fetch_assoc() ){
        //se vuelve static porque trae un registro que depende mucho de la clase hija y no padre
        $array[]=static::crearObjeto($registro);
    }


    //liberar la memoria
    $resultado->free();

    //retornar los resultados 
    return $array;

}

protected static function crearObjeto($registro){
    //con self mandas a llamar la clase padre, es equivalente a super de java
    $objeto=new static; //crea nuevos objetos de la clase padre

    foreach ($registro as $key =>$value){
        
        if(property_exists($objeto, $key)){
            $objeto->$key=$value;
        }
    }

    return $objeto;
}


//buscar una sola propiedad por su id
public static function find($id){
    $query="SELECT * FROM ".static::$tabla. " WHERE id={$id} ";
    $resultado=static::consultarSql($query);
    return array_shift($resultado);
}

//crea un nuevo objeto con la informacion nueva de cada input para actualizar
public function sincronizar($args=[]){
    foreach($args as $key =>$value){
        if(property_exists($this, $key)&&!is_null($value)){
            $this->$key=$value;
        }
    }
}



}//fin clase



?>