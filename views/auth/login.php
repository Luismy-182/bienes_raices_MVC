
<main class="contenedor section contenido-centrado">
    <h1>Iniciar sesion</h1>
    <?php 
    if(isset($alertas)){
        foreach($alertas as $alerta):?>
            <p class="alerta error"><?php echo $alerta ?></p>
        <?php endforeach;
    }
    ?>

    <form method="POST" class="formulario">
        <fieldset>
            <legend>Email y Password</legend>
            
            <label for="nombre">Email</label>
            <input type="email" placeholder="Tu email" id="email" name="email">
            
            <label for="password">Password</label>
            <input type="password" placeholder="Tu password" id="password" name="password">
        
        </fieldset>
    <input type="submit" value="Iniciar sesión" class="boton boton-verde">
    </form>
</main>
