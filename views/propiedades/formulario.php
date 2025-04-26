<fieldset>
            <legend>Información general</legend>
            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" placeholder="Titulo propiedad" name="propiedad[titulo]" value="<?php echo s($propiedad->titulo); ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" placeholder="Precio propiedad" name="propiedad[precio]" value="<?php echo s($propiedad->precio); ?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpg image/jpeg image/png">

            <?php 
            
            if($propiedad->imagen):?>
            <p>Imagen actual:</p>
            <img src="/imagenes/<?php echo $propiedad->imagen ?>" alt="imagen-small" class="imagen-small">
            
            <?php endif;?>

            <label for="descripcion">Descripcion:</label>
            <textarea name="propiedad[descripcion]" id="descripcion"><?php echo s($propiedad->descripcion); ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion propiedad</legend>
            <label for="habitaciones">Habitaciones:</label>
            <input type="number" name="propiedad[habitaciones]" id="habitaciones" value="<?php echo s($propiedad->habitaciones); ?>">

            <label for="baños">Número de baños</label>
            <input type="number" name="propiedad[wc]" id="wc" placeholder="ejemplo 3" min="1" max="9" value="<?php echo s($propiedad->wc); ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->estacionamiento); ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

          <label for="vendedor">Vendedor</label>
          <select name="propiedad[vendedorId]" id="vendedor">
            <option value="">-- Seleccione --</option>
            <?php foreach($vendedores as $vendedor) :?>
                <option 
                <?php echo ($propiedad->vendedorId) === $vendedor->id ? 'selected' : ''; ?>
                value="<?php echo s($vendedor->id);?>"
                ><?php echo s($vendedor->nombre) . " ".s($vendedor->apellido); ?> </option>
                <?php endforeach; ?>
          </select>
          
        </fieldset>