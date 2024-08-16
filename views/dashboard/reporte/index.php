<?php include_once __DIR__ . '/../header.php'; ?>

    <?php if (count($clientes) === 0) { ?>
        <p class="no-clientes">Sin clientes</p>
        <a class="boton" href="/crear-cliente">Crear Cliente</a>
    <?php } else { ?>
        <ul class="listado-clientes">
            <?php foreach ($clientes as $cliente) { ?>
                <li class="cliente">
                    <a href="/cliente?id=<?php echo $cliente->url; ?>"><?php echo $cliente->nombre; ?></a>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>

<?php include_once __DIR__ . '/../footer.php'; ?>