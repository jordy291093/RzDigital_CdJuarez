<?php include_once __DIR__ . '/../header.php'; ?>

    <div class="contenedor-sm">
        <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

        <form action="/crear-vehiculo" method="POST" class="formulario">
            <div class="grid">
                <div class="campo">
                    <label for="nombre">Nombre del conductor</label>
                    <input 
                        type="text"
                        name="nombre"
                        id="nombre"
                        placeholder="Nombre del conductor"
                    >
                </div>
                <div class="campo">
                    <label for="marca">Marca del Automóvil</label>
                    <input 
                        type="text"
                        name="marca"
                        id="marca"
                        placeholder="Marca del Automóvil"
                    >
                </div>
                <div class="campo">
                    <label for="modelo">Modelo del Automóvil</label>
                    <input 
                        type="text"
                        name="modelo"
                        id="modelo"
                        placeholder="Modelo del Automóvil"
                    >
                </div>
                <div class="campo">
                    <label for="año">Año del Automóvil</label>
                    <input 
                        type="text"
                        name="año"
                        id="año"
                        placeholder="Año del Automóvil"
                    >
                </div>
                <div class="campo">
                    <label for="placa">Placa del Automóvil</label>
                    <input 
                        type="text"
                        name="placa"
                        id="placa"
                        placeholder="Placa del Automóvil"
                    >
                </div>
            </div>

            <div class="botones">
                <a class="cancelar" href="/dashboard/vehiculo">Cancelar</a>

                <input type="submit" value="Guardar">
            </div>
        </form>

    </div>

<?php include_once __DIR__ . '/../footer.php'; ?>