<?php 
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
    require 'includes/app.php';
    incluirTemplate('header', $inicio = true);


?>

    <main class="contenedor seccion">
        <h1>Mas sobre nosotros</h1>
        <!--iconos-->
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo reprehenderit eveniet saepe incidunt sunt inventore aspernatur dolores nam?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="icono seguridad" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo reprehenderit eveniet saepe incidunt sunt inventore aspernatur dolores nam?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="icono seguridad" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo reprehenderit eveniet saepe incidunt sunt inventore aspernatur dolores nam?</p>
            </div>
        </div>
        <!--iconos-->
    </main>

    <section class="seccion contenedor">
        <h2>casas y depas en venta</h2>
            <?php
                $limit = 3;
             include('includes/templates/anuncio.php');
             ?>



            <div class="alinear-derecha">
                <a href="anuncios.php" class="boton boton-verde">Ver todas</a>
            </div>

    </section>
    
    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un ascesor se pondra en contacto contigo en la brevedad</p>
        <a href="contacto.php" class="boton boton-amarillo">Contactanos</a>
    </section>

    <div class="contenedor seccion  seccion-inferior">

        <section class="blog">
            <h3>Nuestro blog</h3>
            
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" loading="lazy" type="image/jpeg" alt="texto entrada blog">
                        <img src="build/img/blog1.jpg" alt="texto entrada blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p>Escrito el <span>20/10/2023</span> por <span>Admin</span> </p>
                        <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
                    </a>
                </div>

            </article>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img src="build/img/blog2.jpg" alt="texto entrada blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Guia para la decoracion de tu hogar</h4>
                        <p>Escrito el <span>20/10/2023</span> por <span>Admin</span> </p>
                        <p>Maximisa el espacio de tu hogar con esta guia, aprende a combinar colores y muebles para darle vida a tu espacio</p>
                    </a>
                </div>

            </article>

        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    el personal se comporto de una excelente forma, muy buena atencion y la casa que me ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>- Gusanin de la gusanera</p>
            </div>
        </section>
    </div>

<?php include('includes/templates/footer.php'); ?>