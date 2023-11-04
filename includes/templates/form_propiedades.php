
<fieldset>
            <legend>Informacion General</legend>
            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo de la propiedad" value="<?php echo s($propiedad->titulo);?>">

            <label for="precio">Precio:</label>
            <input type="number"  id="precio" name="propiedad[precio]" placeholder="Precio de la propiedad" value="<?php echo s($propiedad->precio);?>">

            <label for="imagen">Imagen:</label>
            <input type="file" name="propiedad[imagen]" id="imagen" accept="imagen/jpeg, image/png">
            <?php if($propiedad->imagen): ?>
                <img src="../../imagenes/<?php echo $propiedad->imagen;?>" class="imagen-small" alt="">
                <?php endif;?>
            <label for="descripcion">Descripcion:</label>
            <textarea  id="descipcion" name="propiedad[descripcion]" value="<?php echo s($propiedad->descripcion);?>" ></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion de la propiedad</legend>
            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="propiedad[habitaciones]" value="<?php echo s($propiedad->habitaciones);?>" placeholder="Ej: 3" min="1" max="9">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="propiedad[wc]" value="<?php echo s($propiedad->wc);?>" placeholder="Ej: 3" min="1" max="9">

            <label for="estacionamiento">Estacionamientos:</label>
            <input type="number" id="estacionamiento" name="propiedad[estacionamiento]"  value="<?php echo s($propiedad->estacionamiento);?>" placeholder="Ej: 3" min="1" max="9">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
                <label for="vendedor">
                    <select name="propiedad[vendedores_id]" id="vendedor">
                        <option value="" selected disabled>--- Seleccionar un vendedor ---</option>
                        <?php foreach($vendedores as $vendedor):?>
                            <option
                                <?php echo $propiedad->vendedores_id === $vendedor->id ? 'selected' : '';?>
                            value="<?php echo s($vendedor->id)?>"><?php echo s($vendedor->nombre) . " " . s($vendedor->apellido)?></option>
                        <?php endforeach;?>
                    </select>
                </label>
            
        </fieldset> 
        <br>