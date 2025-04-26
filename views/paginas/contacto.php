<main class="contenedor section">
    <h1>Contacto</h1>

    <?php if($mensaje) {
        echo "<p class='alerta exito'>" .$mensaje  ."</p>";
        
    }?>
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">            
        <source srcset="build/img/destacada3.jpg" type="image/jpg">            
        <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen destacada">
    </picture>

    <h2>Llene el formulario de contacto</h2>

    <form action="" class="formulario" method="POST">
        <fieldset>
            <legend>Información personal</legend>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" name="contacto[name]" required>
            <label for="mensaje">Mensaje</label>
            <textarea name="mensaje" id="mensaje" name="contacto[mensaje]" required></textarea>



         
        </fieldset>

        <fieldset>
            <legend>Información sobre propiedad</legend>
            <label for="venta">Vende o compra</label>

            <select name="venta" id="venta" name="contacto[tipo]" required>
                <option value="" disabled selected >-- Seleccione --</option>
                <option value="vende">Vende</option>
                <option value="compra">Compra</option>
            </select>

            <label for="cantidad" required>Precio o presupuesto</label>
            <input type="number" name="contacto[precio]" placeholder="Cantidad" placeholder="Tu presupuesto">



        </fieldset>



        <fieldset>
            <legend>Contacto</legend>

            <legend>Como deseas ser contactado</legend>
            <div class="forma-contacto">
                <input type="radio" id="r_telefono" value="telefono"  name="contacto[contacto]" required>
                <label for="r_telefono">Teléfono</label>
                <input type="radio" id="r_email" value="email" name="contacto[contacto]" required>
                <label for="r_email">Email</label>
            </div>
      

            <div id="contacto"></div>
        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>