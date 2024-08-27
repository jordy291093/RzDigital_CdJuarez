<?php include_once __DIR__ . '/../header.php'; ?>

<div>
    <div class="contenedor-nuevo-servicio">
        <button
            type="button"
            class="agregar-servicio"
            id="agregar-servicio">

            <i class="fa-solid fa-plus"></i>
            Nuevo servicio
        </button> 
    </div>

    <div id="noServicio" class="noServicio"></div>

    <main id="tabla" class="tabla">
        <table>
            <thead>
                <tr>
                    <th>Servicio</th>
                    <th>Comentarios</th>
                    <th>Fecha del Servicio</th>
                </tr>
            </thead>
            <tbody  id="listado-servicios"></tbody>
        </table>
    </main>

</div>

<?php include_once __DIR__ . '/../footer.php'; ?>

<?php
    $script = '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="build/js/servicio.js"></script>
    ';
?>