<?php include_once __DIR__ . '/../header.php'; ?>

    <div class="contenedor-sm">
        <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

        <form class="formulario" method="POST" action="/crear-cliente">

            <?php include_once __DIR__ . '/formulario-cliente.php'; ?>

            <input type="submit" value="Crear Reporte">
        </form>

    </div>

<?php include_once __DIR__ . '/../footer.php'; ?>

