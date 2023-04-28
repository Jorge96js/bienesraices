

    <?php include('includes/templates/header.php')?>


    <main class="contenedor seccion">
        <h1>contacto</h1>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img src="build/img/destacada3.jpg" alt="Imagen contacto">
        </picture>
        <h2>Llene el formulario de contacto</h2>
        <form action="" class="formulario">
            <fieldset>
                <legend>Informacion personal</legend>
    
                <label for="nombre">Nombre: </label>
                <input id="nombre" type="text" placeholder="Escriba su nombre">
    
                <label for="email">E-mail: </label>
                <input id="email" type="text" placeholder="Escriba su correo">
    
                <label for="telefono">Telefono: </label>
                <input id="telefono" type="tel" placeholder="Escriba su numero">
    
                <label for="mensaje">Mensaje: </label>
                <textarea name="mensaje" id="mensaje"></textarea>
            </fieldset>
            <fieldset>
                <legend>Informacion Sobre la Propiedad</legend>
                <label for="opciones">Vende o Compra</label>
                <select name="" id="opciones">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="compra">Compra</option>
                    <option value="vende">Vende</option>
                </select>
    
                <label for="Presupuesto">Precio o Presupuesto </label>
                <input id="Presupuesto" type="number" placeholder="Escriba su Presupuesto">
            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propiedad</legend>
                <p>Como desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input name="contactado" type="radio" value="telefono" id="contactar-telefono"> 

                    <label for="contactar-email">E-mail</label>
                    <input name="contactado" type="radio" value="email" id="contactar-email"> 
                </div>
                <p>Si eligio telefono elija la fecha y la hora para ser contactado</p>

                <label for="fecha">Fecha</label>
                <input type="date" id="fecha"> 
                
                <label for="hora">Hora</label>
                <input type="time" id="hora" min="9:00" max="18:00"> 
            </fieldset>
            <input type="submit" value="enviar" class="boton boton-verde mt-2">
        </form>
    </main>


    <?php include('includes/templates/footer.php'); ?>