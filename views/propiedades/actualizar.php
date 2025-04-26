<main class="contenedor seccion">
    <h1>Actualizar</h1>
<?php 
    foreach($alertas as $alerta){

        
        ?> 
        <div class="alerta error"><?php echo $alerta ?></div>
        <?php 
    }
?>
    <form method="POST" class="formulario" enctype="multipart/form-data">
    <?php include __DIR__ .'/formulario.php' ?>
    <input type="submit" value="Actualizar propiedad" class="boton boton-verde">
    </form>
</main>