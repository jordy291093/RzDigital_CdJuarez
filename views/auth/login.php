<div class="contenedor login">

    <?php include_once __DIR__ . '/../templates/header.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesión</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <form action="/" method="POST" class="formulario" novalidate>
            <div class="campo">
                <label for="email">Email:</label>
                <input type="email" id="email" placeholder="Tu Email" name="email">
            </div>
            
            <div class="acciones">
                <a href="/crear">¿Aún no tienes cuenta? <span> Crear una cuenta</span></a>
            </div>

            <div class="campo">
                <label for="password">Password:</label>
                <input type="password" id="password" placeholder="Tu Password" name="password">
                <i class="fa-regular fa-eye"></i>
            </div>

            <div class="acciones">
                <a href="/olvide">Recuperar Password</a>
            </div>

            <input type="submit" class="boton" value="Iniciar Sesión">
        </form>
    </div>
</div>

<?php include_once __DIR__ . '/../templates/derechos.php'; ?>

<?php
    $script = '
        <script src="build/js/app.js"></script>
    ';
?>