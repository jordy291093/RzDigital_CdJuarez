<div class="contenedor crear">
    
    <?php include_once __DIR__ . '/../templates/header.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tu cuenta en RZ Digital Cd. Juárez, Chih.</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <form action="/crear" method="POST" class="formulario">
            <div class="campo">
                <label for="nombre">Nombre:</label>
                <input 
                    type="text" 
                    id="nombre" 
                    placeholder="Tu Nombre" 
                    name="nombre" 
                    value="<?php echo $usuario->nombre; ?>"
                >
            </div>

            <div class="campo">
                <label for="email">Email:</label>
                <input 
                    type="email" 
                    id="email" 
                    placeholder="Tu Email" 
                    name="email" 
                    value="<?php echo $usuario->email; ?>"
                >
            </div>

            <div class="campo">
                <label for="password">Contraseña:</label>
                <input 
                    type="password" 
                    id="password" 
                    placeholder="Tu Contraseña" 
                    name="password"
                >
                <i class="fa-regular fa-eye"></i>
            </div>

            <div class="instruccion">
                <p>La contraseña debe tener más de 8 caracteres</p>
            </div>

            <div class="campo">
                <label for="password2">Confirmar Contraseña:</label>
                <input 
                    type="password" 
                    id="password2" 
                    placeholder="Confirmar Contraseña" 
                    name="password2"
                >
            </div>

            <input type="submit" class="boton" value="Crear Cuenta">
        </form>
        
        <div class="acciones">
            <a href="/">¿Ya tienes cuenta? <span>Iniciar Sesión</span></a>
            <a href="/olvide">Recuperar contraseña</a>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../templates/derechos.php'; ?>

<?php
    $script = '
        <script src="build/js/app.js"></script>
    ';
?>