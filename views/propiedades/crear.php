<main class="contenedor seccion">
<?php 
    foreach($alertas as $alerta){

        
        ?> 
        <div class="alerta error"><?php echo $alerta ?></div>
        <?php 
    }
?>
    <form method="POST" class="formulario" enctype="multipart/form-data">
    <?php include __DIR__ .'/formulario.php' ?>
    <input type="submit" value="Crear propiedad" class="boton boton-verde">
    </form>
</main>