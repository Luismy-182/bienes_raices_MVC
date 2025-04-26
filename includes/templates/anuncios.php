<?php 

use App\Propiedad;
    require_once __DIR__.'../../config/database.php';
    
    $db=conectarDB();
    $propiedad=new Propiedad;
    if($_SERVER['SCRIPT_NAME']==='/anuncios.php'){
        $propiedades=Propiedad::all();
    }else{
        $propiedades=Propiedad::get(3);
    }
?>


<div class="contenedor-anuncios">

    <?php foreach ($propiedades as $propiedad) : ?>

        <div class="anuncio">
           
            <img class="anuncio-imagen" loading="lazy" src="/imagenes/<?php echo $propiedad->imagen ?>" alt="imagen anuncio">
           

            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo?></h3>
                <p><?php echo $propiedad->descripcion ?></p>
                <p class="precio"><?php echo $propiedad->precio; ?></p>


                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" src="build/img/icono_wc.svg" alt="icono1">
                        <p><?php echo $propiedad->wc;?></p>
                    </li>
                    <li>
                        <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono1">
                        <p><?php echo $propiedad->estacionamiento;?></p>
                    </li>
                    <li>
                        <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono1">
                        <p><?php echo $propiedad->habitaciones;?></p>
                    </li>

                </ul>

                <a href="anuncio.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Ver propiedad</a>
            </div><!--fin Contenidoanuncio-->
        </div>

        <?php endforeach; ?>

        
    </div>