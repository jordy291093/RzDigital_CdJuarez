<div class="contenedor reestablecer">

    <?php include_once __DIR__ . '/../templates/header.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Actualizar contraseña</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <?php if ($mostrar) { ?>

            <form method="POST" class="formulario">
                <div class="campo">
                    <label for="password">Password:</label>
                    <input type="password" id="password" placeholder="Tu Password" name="password">
                    <i class="fa-regular fa-eye"></i>
                </div>

                <input type="submit" class="boton" value="Guardar Password">
            </form>
        
        <?php } ?>
        
        <div class="acciones">
            <a href="/">¿Ya tienes cuenta? Iniciar Sesión</a>
            <a href="/olvide">Recuperar Password</a>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../templates/derechos.php'; ?>