<fieldset>
<legend>Información general</legend>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" placeholder="Nombre vendedor" name="vendedor[nombre]" value="<?php echo $vendedor->nombre ?>">
    
    <label for="apellido">apellido:</label>
    <input type="text" id="apellido" placeholder="Apellido vendedor" name="vendedor[apellido]" value="<?php echo $vendedor->apellido ?>">
    <label for="telefono">telefono:</label>
    <input type="text" id="telefono" placeholder="Telefono vendedor" name="vendedor[telefono]" value="<?php echo $vendedor->telefono ?>">
    
    <label for="email">Email</label>
    <input type="email" name="vendedor[email]" value="<?php echo $vendedor->email?>">

    <label for="imagen">foto de perfil</label>
    <input type="file" name="vendedor[imagen]" id="imagen" accept="image/*">  

    <?php 
        if($vendedor->imagen){ ?>
        <p>Imagen actual:</p>
            <img class="imagen-sm" src="/imagenes/<?php echo $vendedor->imagen?>" alt="imagen de <?php echo $vendedor->nombre?>">
            <?php } ?>
        
</fieldset>