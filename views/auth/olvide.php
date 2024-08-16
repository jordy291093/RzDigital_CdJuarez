<div class="contenedor olvide">
    
    <?php include_once __DIR__ . '/../templates/header.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recuperar Password</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <form action="/olvide" method="POST" class="formulario" novalidate>
            <div class="campo">
                <label for="email">Email:</label>
                <input type="email" id="email" placeholder="Tu Email" name="email">
            </div>

            <input type="submit" class="boton" value="Enviar">
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes cuenta? <span>Iniciar Sesión</span></a>
            <a href="/crear">¿Aún no tienes cuenta? <span>Crear una cuenta</span></a>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../templates/derechos.php'; ?>