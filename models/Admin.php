<?php 
namespace Model;
class Admin extends ActiveRecord{
    //bd
    protected static $tabla='usuarios';
    protected static $columnasDB=['id','email','password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args=[])
    {
        $this->id=$args['id'] ?? '';
        $this->email=$args['email'] ?? '';
        $this->password=$args['password'] ?? '';
    }


    public function validar(){
        if(!$this->email){
            self::$alertas[]='El email es obligatorio';
        }
        if(!$this->password){
           self::$alertas[]='El email es obligatorio';
        } 

        return self::$alertas;
    }

    public function verificarUsuario(){
        $query="SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email ."' LIMIT 1";

        $resultado= self::$db->query($query);

        if(!$resultado->num_rows){
            self::$alertas[]='El usuario no existe';
            return;
        }
        return $resultado;
    }

    public function comprobarPassword($resultado){
        $usuario=$resultado->fetch_object();
        $autentificado=password_verify($this->password, $usuario->password);

        if(!$autentificado){
            self::$alertas[]='El password es incorrecto';
        }
        return $autentificado;
    }



    public function autentificar(){
        session_start();


        //llenamos el arreglo de sesion
        $_SESSION['usuario']=$this->email;
        $_SESSION['login']=true;
        header('Location: /admin');
    }

}