<?php include_once __DIR__ . '/../header.php'; ?>

    <a href="/crear-vehiculo" class="boton">Asignar Vehículo</a>
    
    <?php if(count($vehiculos) === 0) { ?>
        <p class="no-vehiculos">Sin Vehículo Asignado</p>
    <?php } else { ?>
        <ul class="listado-vehiculos">
            <div class="listado-info">
                <?php foreach($vehiculos as $vehiculo) { ?>
                    <li><span>Conductor:</span> <?php echo $vehiculo->nombre; ?></li>
                    <li><span>Marca:</span> <?php echo $vehiculo->marca; ?></li>
                    <li><span>Modelo:</span> <?php echo $vehiculo->modelo; ?></li>
                    <li><span>Año:</span> <?php echo $vehiculo->año; ?></li>
                    <li><span>Placa:</span> <?php echo $vehiculo->placa; ?></li>
                    <li class="center"><a href="/vehiculo?id=<?php echo $vehiculo->url; ?>"  class="agregar">Agregar Servicio</a></li>
                <?php } ?>
            </div>
        </ul>
    <?php } ?>

<?php include_once __DIR__ . '/../footer.php'; ?>