<?php 


namespace Controller;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{

    public static function index(Router $router){
        $propiedades=Propiedad::get(3);
        $inicio=true;
        $baner=true;
        $router->render('paginas/index',[
        'inicio'=>$inicio,
        'propiedades'=>$propiedades,
        'baner'=>$baner
        ]);
    }

    public static function nosotros(Router $router){

        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router){
        $propiedades=Propiedad::all();

        $router->render('paginas/propiedades',[
            'propiedades'=>$propiedades,
        ]);
    }


    public static function propiedad(Router $router){
        $id=redireccionar('/propiedades');
        $propiedad=Propiedad::find($id);
        $router->render('paginas/propiedad',[
            'propiedad'=>$propiedad,
        ]);
    }

    public static function blog(Router $router){
        $router->render('paginas/blog');
    }

    public static function entrada(Router $router){
        $router->render('paginas/entrada');
    }

    public static function contacto(Router $router){
        $mensaje=null;
        if($_SERVER['REQUEST_METHOD']==='POST'){

            $respuestas=$_POST['contacto'];
            $email=new PHPMailer();
            //configurar
            $email->isSMTP();
            $email->Host = 'smtp.mailtrap.oi';
            $email->SMTPAuth=true;
            $email->Host = 'smtp.example.com';                     //Set the SMTP server to send through
            //Enable SMTP authentication
            $email->Username = 'user@example.com';                     //SMTP username
            $email->Password = 'secret';                               //SMTP password
            $email->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            //Recipients
            $email->setFrom('from@example.com', 'Mailer');
            $email->addAddress('joe@example.net', 'Joe User');     //Add a recipient
            $email->Subject='Tienes un nuevo email';
            //Habilitar HTML

            $email->isHTML(true);
            $email->CharSet = 'UTF-8';

            //definir el contenido
            $contenido= '<html>'; 
            $contenido.='<p>Tienes un nuevo email </p>';
            $contenido.='<p>Nombre: ' . $respuestas['nombre'] .'</p>';

            //enviar de forma condicional 
            if($respuestas['contacto']==='telefono'){
                //si elijio ser contactado por telefono
                $contenido.='<p>Teléfono: ' . $respuestas['telefono'] .'</p>';
                $contenido.='<p>Fecha Contacto: ' . $respuestas['fecha'] .'</p>';
                $contenido.='<p>Hora: ' . $respuestas['hora'] .'</p>';

            }else{
                //por emial
                $contenido.='<p>Email: ' . $respuestas['email'] .'</p>';

            }

            $contenido.='<p>Mensaje: ' . $respuestas['mensaje'] .'</p>';
            $contenido.='<p>Vende o compra: ' . $respuestas['tipo'] .'</p>';
            $contenido.='<p>Precio o presupuesto: ' . $respuestas['precio'] .'</p>';
            $contenido.='<p>Prefiere ser contactdo por: ' . $respuestas['contacto'] .'</p>';
            $contenido.='</html>';


            $email->Body=$contenido;
            $email->AltBody='Esto es el texto alternativo sin html';

            //enviar el email
            if($email->send()){
                $mensaje= "Mensaje enviado";
            }else{
                $mensaje="Error en el mensaje";
            }
        }
        
        $router->render('paginas/contacto',[
            'mensaje'=>$mensaje
        ]);
    }



}