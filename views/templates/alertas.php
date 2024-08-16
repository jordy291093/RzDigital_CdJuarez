<?php
    foreach ($alertas as $key => $alerta):
        foreach ($alerta as $mensaje):
?>
        <?php if ($key === 'error'){ ?>
            <div class="alerta <?php echo $key; ?>">
            <i class="fa-solid fa-xmark"></i> <?php echo $mensaje; ?>
            </div>
        <?php } else if ($key === 'exito') { ?>
            <div class="alerta <?php echo $key; ?>">
                <i class="fa-solid fa-check"></i> <?php echo $mensaje; ?>
            </div>
        <?php } ?>
            

<?php
        endforeach;
    endforeach;
?>