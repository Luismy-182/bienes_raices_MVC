
<main class="contenedor seccion">

    <h1>Administrador de bienes raices</h1>
  <?php 
    if($estatus){
        $mensaje=mostrarNotificacion(intval($estatus));
        if($mensaje): ?>
            <p class="alerta exito"><?php echo s($mensaje) ?></p>
        <?php endif;
    }
  ?>
    <a href="/admin/propiedades/crear" class="boton boton-verde">Nueva propiedad</a>
    <a href="/admin/vendedores/crear" class="boton boton-amarillo">Nuevo vendedor</a>
    
    <h2>Propiedades</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>Id</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        
        <tbody>
            <?php foreach($propiedades as $propiedad ): ?>
            <tr>
                <td><?php echo $propiedad->id ?></td>
                <td><?php echo $propiedad->titulo?></td>
                <td>
                    <img src="/imagenes/<?php echo $propiedad->imagen?>" alt="imagen <?php echo $propiedad->titulo; ?>">    
                </td>
                <td><?php echo $propiedad->precio?></td>
                <td>
                    
                    <form method="POST" action="/admin/propiedades/eliminar">
                    <input type="hidden" name="id" value="<?php echo $propiedad->id;?>">
                    <input type="hidden" name="tipo" value="propiedad"> <!--El tipo de persona-->
                    <input type="submit" class="boton-rojo" value="Eliminar">
                    </form>
                    <a href="/admin/propiedades/actualizar?id=<?php echo $propiedad->id?>" class="boton-azul">Actualizar</a>
                </td>
               
        </tr>
        </tbody>
        <?php  endforeach ;?>
    </table>



    <h2>Vendedores</h2>


    <table class="propiedades">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>imagen</th>
                <th>email</th>
            
                <th>Acciones</th>
            </tr>
        </thead>

        
        <tbody>
            <?php foreach($vendedores as $vendedor ): ?>
            <tr>
                <td><?php echo $vendedor->id ?></td>
                <td><?php echo $vendedor->nombre?></td>
                <td><?php echo $vendedor->telefono?></td>
                <td><img src="/imagenes/<?php echo $vendedor->imagen?>" alt="imagen <?php echo $vendedor->nombre?>"></td>
                <td><?php echo $vendedor->email?></td>
                <td>
                    
                    <form method="POST" action="admin/vendedores/eliminar">
                    <input type="hidden" name="id" value="<?php echo $vendedor->id;?>">
                    <input type="hidden" name="tipo" value="vendedor">
                    <input type="submit" class="boton-rojo" value="Eliminar">
                    </form>
                    <a href="/admin/vendedores/actualizar?id=<?php echo $vendedor->id?>" class="boton-azul">Actualizar</a>
                </td>
            </tr>
        </tbody>
        <?php  endforeach ;?>
    </table>

</main>