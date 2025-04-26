
<main class="contenedor seccion">
    <h1>Actualizar</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php 
        foreach($alertas as $alerta){

         
            ?> 
            <div class="alerta error"><?php echo $alerta ?></div>
            <?php 
        }
    ?>
    <form class="formulario" method="POST" enctype="multipart/form-data">
      
    <?php include __DIR__ .'/vendedorForm.php' ?>

        <input type="submit" value="Actualizar vendedor" class="boton boton-verde">
    </form>
</main>

