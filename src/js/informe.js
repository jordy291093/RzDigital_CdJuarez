(function(){
    obtenerInformes();
    let informes = [];
    const PROJECT_URL = 'location.origin';

    const nuevoInformeBtn = document.querySelector('#agregar-informe');
    nuevoInformeBtn.addEventListener('click', function() {
        mostrarFormulario(false);
    });

    async function obtenerInformes() {
        try {
            const id = obtenerCliente();
            const url = `/api/informes?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            informes = resultado.informe;
            mostrarInformes();
            
        } catch (error) {
            console.log(error);
        }
    }

    function mostrarInformes() {
        limpiarInformesHTML();
        if(informes.length === 0) {
            const contenedorInformes = document.querySelector('#noInfomre');

            const textoNoInformes = document.createElement('P');
            textoNoInformes.textContent = 'No hay Informes';
            textoNoInformes.classList.add('no-informes');


            contenedorInformes.appendChild(textoNoInformes);
            return;
        }

        const estados = {
            0: 'Pendiente',
            1: 'Entregado'
        }

        informes.forEach(informe => {
            const tabla = document.querySelector('#tabla');
            tabla.classList.add('mostrar');

            const contenedorInforme = document.createElement('TR');
            contenedorInforme.dataset.informeId = informe.id;
            
            const folio = document.createElement('TD');
            folio.textContent = informe.folio;
            folio.classList.add('pointer');
            folio.ondblclick = function() {
                mostrarFormulario(true, {...informe});
            }
            
            const fechaGen = document.createElement('TD');
            fechaGen.textContent = informe.fechaGen;

            const modelo = document.createElement('TD');
            modelo.textContent = informe.modelo;

            const serie = document.createElement('TD');
            serie.textContent = informe.serie;

            const noParte = document.createElement('TD');
            noParte.textContent = informe.noParte;

            const refacciones = document.createElement('TD');
            refacciones.textContent = informe.refacciones;

            const falla = document.createElement('TD');
            falla.textContent = informe.falla;

            const comentarios = document.createElement('TD');
            comentarios.textContent = informe.comentarios;

            const contador = document.createElement('TD');
            contador.textContent = informe.contador;

            const fechaEnt = document.createElement('TD');
            fechaEnt.textContent = informe.fechaEnt;

            // botones
            const btnEstadoInfomre = document.createElement('BUTTON');
            btnEstadoInfomre.classList.add('estado-informe');
            btnEstadoInfomre.classList.add(`${estados[informe.status].toLowerCase()}`);
            btnEstadoInfomre.textContent = estados[informe.status];
            btnEstadoInfomre.dataset.estadoInforme = informe.status;
            
            btnEstadoInfomre.ondblclick = function() {
                cambiarStatus({...informe});
            }

            contenedorInforme.appendChild(folio);
            contenedorInforme.appendChild(fechaGen);
            contenedorInforme.appendChild(modelo);
            contenedorInforme.appendChild(serie);
            contenedorInforme.appendChild(noParte);
            contenedorInforme.appendChild(refacciones);
            contenedorInforme.appendChild(falla);
            contenedorInforme.appendChild(comentarios);
            contenedorInforme.appendChild(contador);
            contenedorInforme.appendChild(fechaEnt);
            contenedorInforme.appendChild(btnEstadoInfomre);

            // console.log(contenedorInforme);

            const listadoInformes = document.querySelector('#listado-informes');
            listadoInformes.appendChild(contenedorInforme);
        });
    }

    function mostrarFormulario(editar = false, informe = {}) {
        const modal = document.createElement('DIV');
        modal.classList.add('modal');
        modal.innerHTML = `
            <form action="" class="formulario nuevo-informe">
                <legend>${editar ? 'Editar Informe' : 'Añadir Informe'}</legend>

                <div class="grid">
                    <div class="campo">
                        <label for="folio">Folio: </label>
                        <input 
                            value="${informe.folio ? informe.folio : ''}"
                            placeholder="${informe.folio ? 'Editar Folio' : 'Añadir Folio'}" 
                            name="folio" 
                            id="folio" 
                            type="text"
                        >
                    </div>

                    <div class="campo">
                        <label for="fechaGen">Fecha Generada: </label>
                        <input 
                            value="${informe.fechaGen ? informe.fechaGen : ''}"
                            placeholder="${informe.fechaGen ? 'Editar aaaa-mm-dd' : 'aaaa-mm-dd'}" 
                            name="fechaGen" 
                            id="fechaGen" 
                            type="text"
                        >
                    </div>

                    <div class="campo">
                        <label for="modelo">Modelo: </label>
                        <input 
                            value="${informe.modelo ? informe.modelo : ''}"
                            placeholder="${informe.modelo ? 'Editar Modelo' : 'Añadir Modelo'}" 
                            name="modelo" 
                            id="modelo" 
                            type="text"
                        >
                    </div>

                    <div class="campo">
                        <label for="serie">Serie: </label>
                        <input 
                            value="${informe.serie ? informe.serie : ''}"
                            placeholder="${informe.serie ? 'Editar Serie' : 'Añadir Serie'}" 
                            name="serie" 
                            id="serie" 
                            type="text"
                        >
                    </div>

                    <div class="campo">
                        <label for="noParte">Numero de Parte: </label>
                        <input 
                            value="${informe.noParte ? informe.noParte : ''}"
                            placeholder="${informe.noParte ? 'Editar Numero de Parte' : 'Añadir Numero de Parte'}" 
                            name="noParte" 
                            id="noParte" 
                            type="text"
                        >
                    </div>

                    <div class="campo">
                        <label for="refacciones">Refacción: </label>
                        <input 
                            value="${informe.refacciones ? informe.refacciones : ''}"
                            placeholder="${informe.refacciones ? 'Editar Refacción' : 'Añadir Refacción'}" 
                            name="refacciones" 
                            id="refacciones" 
                            type="text"
                        >
                    </div>

                    <div class="campo">
                        <label for="falla">Fallas: </label>
                        <textarea name="falla" id="falla">${informe.falla ? informe.falla : ''}</textarea>
                    </div>

                    <div class="campo">
                        <label for="comentarios">Comentarios: </label>
                        <textarea name="comentarios" id="comentarios">${informe.comentarios ? informe.comentarios : ''}</textarea>
                    </div>

                    <div class="campo">
                        <label for="contador">Contador: </label>
                        <input 
                            value="${informe.contador ? informe.contador : ''}"
                            placeholder="${informe.contador ? 'Editar Contador' : 'Añadir Contador'}" 
                            name="contador" 
                            id="contador" 
                            type="number"
                        >
                    </div>

                    <div class="campo">
                        <label for="fechaEnt">Fecha Visita: </label>
                        <input 
                            value="${informe.fechaEnt ? informe.fechaEnt : ''}"
                            placeholder="${informe.fechaEnt ? 'Editar aaaa-mm-dd' : 'aaaa-mm-dd'}" 
                            name="fechaEnt" 
                            id="fechaEnt" 
                            type="text"
                        >
                    </div>
                </div>

                <div class="opciones">
                    <input 
                        class="submit-nuevo-informe" 
                        type="submit" 
                        value="${informe.folio ? 'Actualizar Informe' : 'Añadir Informe'}"
                    >
                    <button 
                        type="button" 
                        id="cerrar-informe" 
                        class="cerrar-informe">
                        Cancelar
                    </button>
                </div>
            </form>

        `;

        setTimeout(() => {
            const formulario = document.querySelector('.formulario');
            formulario.classList.add('animar');
        }, 300);

        // Cerrar modal
        modal.addEventListener('click', function(e){
            e.preventDefault();

            if(e.target.classList.contains('cerrar-informe')) {
                const formulario = document.querySelector('.formulario');
                formulario.classList.add('cerrar');
                setTimeout(() => {
                    modal.remove();
                }, 300);
            }

            if(e.target.classList.contains('submit-nuevo-informe')) {
                const informeFolio = document.querySelector('#folio').value.trim();
                const informeFechaGen = document.querySelector('#fechaGen').value.trim();
                const informeModelo = document.querySelector('#modelo').value.trim();
                const informeSerie = document.querySelector('#serie').value.trim();
                const informeNoParte = document.querySelector('#noParte').value.trim();
                const informeRefacciones = document.querySelector('#refacciones').value.trim();
                const informeFalla = document.querySelector('#falla').value.trim();
                const informeComentarios = document.querySelector('#comentarios').value.trim();
                const informeContador = document.querySelector('#contador').value.trim();
                const informeFechaEnt = document.querySelector('#fechaEnt').value.trim();

                const formatoFecha = /^\d{4}-\d{2}-\d{2}$/;

                if( informeFolio === '' && informeFechaGen === '' &&
                    informeModelo === '' && informeSerie === '' &&
                    informeNoParte === '' && informeRefacciones === '' &&
                    informeFalla === '' && informeComentarios === '' &&
                    informeContador === '' && informeFechaEnt === '') {
                    // Mostrar una alerta de error
                    sweetAlertaError('Todos los campos son obligatorios');
                    return;

                } else if(informeFolio === '') {
                    sweetAlertaError('Es obligatorio el campo: Folio');
                    return;

                } else if(informeFechaGen === '') {
                    sweetAlertaError('Es obligatorio el campo: Fecha Generada');
                    return;

                } else if (!formatoFecha.test(informeFechaGen)) {
                    sweetAlertaError('Formato de fecha inválido en el campo: Fecha Generada. Por favor, use AAAA-MM-DD. Ejemplo: 2024-01-31');
                    return;

                } else if(informeModelo === '') {
                    sweetAlertaError('Es obligatorio el campo: Modelo');
                    return;

                } else if(informeSerie === '') {
                    sweetAlertaError('Es obligatorio el campo: Serie');
                    return;
                    
                } else if(informeNoParte === '') {
                    sweetAlertaError('Es obligatorio el campo: Numero de Parte');
                    return;
                    
                } else if(informeRefacciones === '') {
                    sweetAlertaError('Es obligatorio el campo: Refacciones');
                    return;
                    
                } else if(informeFalla === '') {
                    sweetAlertaError('Es obligatorio el campo: Falla');
                    return;
                    
                } else if(informeComentarios === '') {
                    sweetAlertaError('Es obligatorio el campo: Comentarios');
                    return;
                    
                } else if(informeContador === '') {
                    sweetAlertaError('Es obligatorio el campo: Contador');
                    return;
                    
                } else if(informeFechaEnt === '') {
                    sweetAlertaError('Es obligatorio el campo: Fecha Visita');
                    return;

                } else if (!formatoFecha.test(informeFechaEnt)) {
                    sweetAlertaError('Formato de fecha inválido en el campo: Fecha Entrega. Por favor, use AAAA-MM-DD. Ejemplo: 2024-01-31');
                    return;
                }
                
                if(editar){
                    informe.comentarios = informeComentarios;
                    informe.contador = informeContador;
                    informe.falla = informeFalla;
                    informe.fechaEnt = informeFechaEnt;
                    informe.fechaGen = informeFechaGen;
                    informe.folio = informeFolio;
                    informe.modelo = informeModelo;
                    informe.noParte = informeNoParte;
                    informe.refacciones = informeRefacciones;
                    informe.serie = informeSerie;
                    actualizarInforme(informe);
                } else {
                    agregarInforme(informeFolio, informeFechaGen, informeModelo, informeSerie, informeNoParte, informeRefacciones, informeFalla, informeComentarios, informeContador, informeFechaEnt);
                }
            }
        });

        document.querySelector('.dashboard').appendChild(modal);
    }

    function sweetAlertaError(mensaje) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: mensaje,
        });
    }

    function sweetAlertaExito(mensaje) {
        Swal.fire({
            position: "center",
            icon: "success",
            title: mensaje,
            showConfirmButton: false,
            timer: 1500
        });
    }

    function mostrarAlerta(mensaje, tipo, referencia) {
        // prevenir multiples alertas
        const alertaPrevia = document.querySelector('.alerta');
        if(alertaPrevia) {
            alertaPrevia.remove();
        }

        const alerta = document.createElement('DIV');
        alerta.classList.add('alerta', tipo);
        alerta.textContent = mensaje;

        referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling);

        setTimeout(() => {
            alerta.remove();
        }, 5000);
    }

    async function agregarInforme(folio, fechaGen, modelo, serie,noParte, refacciones, falla, comentarios, contador, fechaEnt) {
        // Construir la peticion
        const datos = new FormData();
        datos.append('folio', folio);
        datos.append('fechaGen', fechaGen);
        datos.append('modelo', modelo);
        datos.append('serie', serie);
        datos.append('noParte', noParte);
        datos.append('refacciones', refacciones);
        datos.append('falla', falla);
        datos.append('comentarios', comentarios);
        datos.append('contador', contador);
        datos.append('fechaEnt', fechaEnt);
        datos.append('clientes_id', obtenerCliente());

        try {
            const url = `${PROJECT_URL}/api/informe`;
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });

            const resultado = await respuesta.json();
            // ver en consola el resultado
            // console.log(resultado);

            // Mostrar mensaje en el modal
            mostrarAlerta(resultado.mensaje, resultado.tipo, document.querySelector('.formulario legend'));

            if(resultado.tipo === 'exito') {
                const modal = document.querySelector('.modal');

                setTimeout(() => {
                    modal.remove();
                }, 1500);

                // Agregando el objeto de informe al global de informes
                const informeObj = {
                    id: String(resultado.id),
                    folio: folio,
                    fechaGen: fechaGen,
                    modelo: modelo,
                    serie: serie,
                    noParte: noParte,
                    refacciones: refacciones,
                    falla: falla,
                    comentarios: comentarios,
                    contador: contador,
                    fechaEnt: fechaEnt,
                    status: "0",
                    clientes_id: resultado.clientes_id
                }

                informes = [...informes, informeObj];  // Global

                mostrarInformes();
            }

        } catch (error) {
            console.log(error);
        }
    }

    function cambiarStatus(informe) {
        const nuevoStatus = informe.status === "1" ? "0" : "1";
        informe.status = nuevoStatus;
        actualizarInforme(informe);
    }

    async function actualizarInforme(informe) {
        const {clientes_id, comentarios, contador, falla, fechaEnt, fechaGen, folio, id, modelo, noParte, refacciones, serie, status} = informe;

        const datos = new FormData();
        datos.append('comentarios' , comentarios);
        datos.append('contador' , contador);
        datos.append('falla' , falla);
        datos.append('fechaEnt' , fechaEnt);
        datos.append('fechaGen' , fechaGen);
        datos.append('folio' , folio);
        datos.append('id' , id);
        datos.append('modelo' , modelo);
        datos.append('noParte' , noParte);
        datos.append('refacciones' , refacciones);
        datos.append('serie' , serie);
        datos.append('status' , status);
        datos.append('clientes_id' , obtenerCliente());

        // for( let valor of datos.values()) {
        //     console.log(valor);
        // }

        try {
            const url = `${PROJECT_URL}/api/informe/actualizar`;
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();

            if(resultado.respuesta.tipo === 'error') {
                sweetAlertaError(resultado.mensaje);
            } else if(resultado.respuesta.tipo === 'exito') {
                sweetAlertaExito(resultado.respuesta.mensaje);

                const modal = document.querySelector('.modal');
                if(modal) {
                    modal.remove();
                }

                informes = informes.map(informeMemoria => {
                    if(informeMemoria.id === id) {
                        informeMemoria.status = status
                        informeMemoria.comentarios = comentarios
                        informeMemoria.contador = contador
                        informeMemoria.falla = falla
                        informeMemoria.fechaEnt = fechaEnt
                        informeMemoria.fechaGen = fechaGen
                        informeMemoria.folio = folio
                        informeMemoria.modelo = modelo
                        informeMemoria.noParte = noParte
                        informeMemoria.refacciones = refacciones
                        informeMemoria.serie = serie
                    }

                    return informeMemoria;
                });

                mostrarInformes();
            }

        } catch (error) {
            console.log(error);
        }


    }

    function obtenerCliente() {
        // Identificar la url del cliente
        const clienteParams = new URLSearchParams(window.location.search);
        const cliente = Object.fromEntries(clienteParams.entries());
        return cliente.id;
    }

    function limpiarInformesHTML() {
        const listadoInformes = document.querySelector('#listado-informes');
        
        while(listadoInformes.firstChild) {
            listadoInformes.removeChild(listadoInformes.firstChild);
        }
    }
})();