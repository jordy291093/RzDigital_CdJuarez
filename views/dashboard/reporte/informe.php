<?php include_once __DIR__ . '/../header.php'; ?>

<div>
    <div class="contenedor-nuevo-informe">
        <button
            type="button"
            class="agregar-informe"
            id="agregar-informe">

            <i class="fa-solid fa-plus"></i>
            Nuevo informe
        </button> 
    </div>

    <div id="noInfomre" class="noInfomre"></div>

    <main id="tabla" class="tabla">
        <table>
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Fecha Generada</th>
                    <th>Modelo</th>
                    <th>Serie</th>
                    <th>Numero de parte</th>
                    <th>Refacciones</th>
                    <th>Falla</th>
                    <th>Comentarios</th>
                    <th>Contador</th>
                    <th>Fecha Visita</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody  id="listado-informes"></tbody>
        </table>
    </main>

</div>

<?php include_once __DIR__ . '/../footer.php'; ?>

<?php
    $script = '
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="build/js/informe.js"></script>
    ';
?>