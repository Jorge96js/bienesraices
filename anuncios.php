

<?php
    include('includes/app.php');
    incluirTemplate('header');
?>


    <main class="contenedor seccion">
        <h2>Casas y depas en venta</h2>
            <?php
                $limit = 10;
                include('includes/templates/anuncio.php');
            ?>
    </main>
    <?php include('includes/templates/footer.php'); ?>