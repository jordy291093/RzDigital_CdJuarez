(function(){
    obtenerServicios();
    let servicios = [];
    const PROJECT_URL = 'location.origin';

    const nuevoServicioBtn = document.querySelector('#agregar-servicio');
    nuevoServicioBtn.addEventListener('click', function() {
        mostrarFormulario(false);
    });

    async function obtenerServicios() {
        try {
            const id = obtenerVehiculo();
            const url = `/api/servicios?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            servicios = resultado.servicio;
            mostrarServicio();

        } catch (error) {
            console.log(error);
        }
    }

    function mostrarServicio() {
        limpiarServiciosHTML();
        if(servicios.length === 0) {
            const contenedorServicios = document.querySelector('#noServicio');

            const textoNoServicio = document.createElement('P');
            textoNoServicio.textContent = 'No hay Servicios';
            textoNoServicio.classList.add('no-servicios');

            contenedorServicios.appendChild(textoNoServicio);
            return;
        }

        servicios.forEach(service => {
            const tabla = document.querySelector('#tabla');
            tabla.classList.add('mostrar');

            const contenedorServicio = document.createElement('TR');
            contenedorServicio.dataset.servicioId = service.id;

            const servicio = document.createElement('TD');
            servicio.textContent = service.servicio;
            servicio.classList.add('pointer');
            servicio.ondblclick = function() {
                mostrarFormulario(true, {...service});
            }

            const comentarios = document.createElement('TD');
            comentarios.textContent = service.comentarios;

            const fecha = document.createElement('TD');
            fecha.textContent = service.fecha;

            contenedorServicio.appendChild(servicio);
            contenedorServicio.appendChild(comentarios);
            contenedorServicio.appendChild(fecha);

            // console.log(contenedorServicio);

            const listadoServicios = document.querySelector('#listado-servicios');
            listadoServicios.appendChild(contenedorServicio);
        });
    }

    function mostrarFormulario(editar = false, service = {}) {
        const modal =document.createElement('DIV');
        modal.classList.add('modal');
        modal.innerHTML = `
        
            <form action="" class="formulario nuevo-servicio">
                <legend>${editar ? 'Editar Servicio' : 'Añadir Servicio'}</legend>

                <div class="grid">
                    <div class="campo">
                        <label for="servicio">Servicio: </label>
                        <input 
                            value="${service.servicio ? service.servicio : ''}"
                            placeholder="${service.servicio ? 'Editar servicio' : 'Añadir servicio'}" 
                            name="servicio" 
                            id="servicio" 
                            type="text"
                        >
                    </div>

                    <div class="campo">
                        <label for="comentarios">Comentarios: </label>
                        <textarea name="comentarios" id="comentarios">${service.comentarios ? service.comentarios : ''}</textarea>
                    </div>

                    <div class="campo">
                        <label for="fecha">Fecha: </label>
                        <input 
                            value="${service.fecha ? service.fecha : ''}"
                            placeholder="${service.fecha ? 'Editar aaaa-mm-dd' : 'aaaa-mm-dd'}" 
                            name="fecha" 
                            id="fecha" 
                            type="text"
                        >
                    </div>
                </div>

                <div class="opciones">
                    <input 
                        class="submit-nuevo-servicio" 
                        type="submit" 
                        value="${service.servicio ? 'Actualizar Servicio' : 'Añadir Servicio'}"
                    >
                    <button 
                        type="button" 
                        id="cerrar-servicio" 
                        class="cerrar-servicio">
                        Cancelar
                    </button>
                </div>
            </form>        
        `;

        setTimeout(() => {
            const formulario = document.querySelector('.formulario');
            formulario.classList.add('animar');
        }, 300);

        // cerrar el modal
        modal.addEventListener('click', function(e) {
            e.preventDefault();

            if(e.target.classList.contains('cerrar-servicio')) {
                const formulario = document.querySelector('.formulario');
                formulario.classList.add('cerrar');
                setTimeout(() => {
                    modal.remove();
                }, 300);
            }

            if(e.target.classList.contains('submit-nuevo-servicio')) {
                const servicioNombre = document.querySelector('#servicio').value.trim();
                const servicioComentarios = document.querySelector('#comentarios').value.trim();
                const servicioFecha = document.querySelector('#fecha').value.trim();

                const formatoFecha = /^\d{4}-\d{2}-\d{2}$/;

                if( servicioNombre === '' && 
                    servicioComentarios === '' &&
                    servicioFecha === '') {
                    // Mostrar una alerta de error
                    sweetAlertaError('Todos los campos son obligatorios');
                    return;

                } else if(servicioNombre === '') {
                    sweetAlertaError('Es obligatorio el campo: Servicio');
                    return;

                }else if(servicioComentarios === '') {
                    sweetAlertaError('Es obligatorio el campo: Comentarios');
                    return;

                } else if(servicioFecha === '') {
                    sweetAlertaError('Es obligatorio el campo: Fecha');
                    return;
                    
                } else if (!formatoFecha.test(servicioFecha)) {
                    sweetAlertaError('Formato de fecha inválido en el campo: Fecha. Por favor, use AAAA-MM-DD. Ejemplo: 2024-01-31');
                    return;
                }
                
                if(editar){
                    service.servicio = servicioNombre;
                    service.comentarios = servicioComentarios;
                    service.fecha = servicioFecha;
                    actualizarServicio(service);
                } else {
                    agregarServicio(servicioNombre, servicioComentarios, servicioFecha);
                }
            }
        });

        document.querySelector('.dashboard').appendChild(modal);
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

    function sweetAlertaError(mensaje) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: mensaje,
        });
    }

    async function agregarServicio(servicio, comentarios, fecha) {
        const datos = new FormData();
        datos.append('servicio', servicio);
        datos.append('comentarios', comentarios);
        datos.append('fecha', fecha);
        datos.append('vehiculo_id', obtenerVehiculo());

        try {
            const url = `${PROJECT_URL}/api/servicio`;
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });

            const resultado = await respuesta.json();

            // console.log(resultado);

            if(resultado.tipo === 'error') {
                sweetAlertaError(resultado.mensaje);
            } else if(resultado.tipo === 'exito') {
                sweetAlertaExito(resultado.mensaje);
                const modal = document.querySelector('.modal');

                setTimeout(() => {
                    modal.remove();
                }, 1500);

                // Agregar el objeto 
                const servicioObj = {
                    id: String(resultado.id),
                    servicio: servicio,
                    comentarios: comentarios,
                    fecha: fecha,
                    vehiculo_id: resultado.vehiculo_id
                }

                servicios = [...servicios, servicioObj];
                mostrarServicio();
            }

        } catch (error) {
            console.log(error);
        }
    }

    async function actualizarServicio(service) {
        const {vehiculo_id, id, servicio, comentarios, fecha} = service;

        const datos = new FormData();
        datos.append('id', id);
        datos.append('servicio', servicio);
        datos.append('comentarios', comentarios);
        datos.append('fecha', fecha);
        datos.append('vehiculo_id', obtenerVehiculo());

        // for( let valor of datos.values()) {
        //     console.log(valor);
        // }

        try {
            const url = `${PROJECT_URL}/api/servicio/actualizar`;
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();

            // console.log(resultado);

            if(resultado.respuesta.tipo === 'error') {
                sweetAlertaError(resultado.respuesta.mensaje);
            } else if(resultado.respuesta.tipo === 'exito') {
                sweetAlertaExito(resultado.respuesta.mensaje);

                const modal = document.querySelector('.modal');
                if(modal) {
                    modal.remove();
                }

                servicios = servicios.map(servicioMemoria => {
                    if(servicioMemoria.id === id) {
                        servicioMemoria.servicio = servicio
                        servicioMemoria.comentarios = comentarios
                        servicioMemoria.fecha = fecha
                    }

                    return servicioMemoria;
                });

                mostrarServicio();
            }

        } catch (error) {
            console.log(error);
        }
    }

    function obtenerVehiculo() {
        // Identificar la url del Vehiculo
        const vehiculoParams = new URLSearchParams(window.location.search);
        const vehiculo = Object.fromEntries(vehiculoParams.entries());
        return vehiculo.id;
    }

    function limpiarServiciosHTML() {
        const listadoServicios = document.querySelector('#listado-servicios');
        
        while(listadoServicios.firstChild) {
            listadoServicios.removeChild(listadoServicios.firstChild);
        }
    }
})();