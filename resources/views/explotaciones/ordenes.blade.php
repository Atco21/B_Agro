@extends('explotacion')

@section('content2')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        addEventListener('DOMContentLoaded', inicio);

        function inicio() {

            const select = document.querySelector(".exploSelect");
            document.getElementById('ordenes').setAttribute('hidden', '');
            document.getElementById('previo').removeAttribute('hidden');
            document.getElementById('exploOpciones').removeAttribute('hidden');

            if (select) {
                select.selectedIndex = 0;

                select.addEventListener("change", function() {
                    const id = select.value;
                    document.getElementById('cuadroDetalles').setAttribute('hidden', '');
                    if (id) {
                        document.getElementById('ordenes').removeAttribute('hidden');
                        document.getElementById('previo').setAttribute('hidden', '');

                        cargarDatos(id);
                        actualizarURL(id);
                    }
                });
            }
            history.replaceState({}, "", "/explotaciones/ordenes/");

            document.querySelectorAll(".explotacion-tarjeta").forEach(tarjeta => {
                tarjeta.addEventListener("click", function() {
                    const select = document.querySelector(".exploSelect");
                    const id = this.dataset.id;

                    if (!select || !id) return;

                    select.value = id;

                    select.dispatchEvent(new Event("change"));
                });
            });

        }

        function actualizarURL(id_explo) {
            const newURL = `/explotaciones/ordenes/${id_explo}`;
            history.pushState({
                id: id_explo
            }, "", newURL);
        }
        window.onpopstate = function(event) {
            if (event.state && event.state.id) {
                cargarDatos(event.state.id);

                const select = document.querySelector(".exploSelect");
                if (select) {
                    select.value = event.state.id;
                }
            } else {
                const select = document.querySelector(".exploSelect");
                if (select) {
                    select.selectedIndex = 0;
                }

                document.getElementById('ordenes').setAttribute('hidden', '');
                document.getElementById('previo').removeAttribute('hidden');
            }
        };
        async function cargarDatos(id) {
            fetch(`/api/ordenes/explotacion/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert("No hay datos");
                    } else {
                        document.getElementById('ordenes').removeAttribute('hidden');
                        document.getElementById('previo').setAttribute('hidden', '');

                        actualizarContenido(data);
                    }
                })
                .catch(error => console.error("ErrormostrarOrdenesPorExplotacion en la petición:", error));
        }



        async function actualizarContenido(data) {
            console.log(data);
            const tbody = document.querySelector("#bodyTabla");
            tbody.innerHTML = "";

            data.forEach(orden => {

                const fila =
                    `<tr class="linea_orden" id=${orden.id}>
            <td>${orden.tarea}</td>
            <td>${orden.fecha_inicio}</td>
            <td>${orden.estado}</td>
            <td>${orden.parcela.nombre}</td>
            </tr>
        `;

                tbody.innerHTML += fila;
            });
            let lineas = document.querySelectorAll('.linea_orden');
            lineas.forEach(linea => {
                linea.addEventListener('click', () => seleccionar(linea.id));
            });
        }

        function seleccionar(id) {
            const lineas = document.querySelectorAll('.linea_orden');
            console.log(id)
            lineas.forEach(linea => {
                if (linea.id == id) {
                    linea.classList.add('seleccionada');
                    mostrarOrden(id);
                } else {
                    linea.classList.remove('seleccionada');
                }
            });
        }


        async function mostrarOrden(id) {
            fetch(`/api/orden/${id}`)
                .then(response => response.json())
                .then(orden => {
                    if (orden.error) {
                        alert("No hay datos");
                    } else {

                        const cuadro = document.getElementById('cuadroDetalles');
                        console.log(orden);
                        cuadro.innerHTML = `

                        <h2 class="fw-bold text-center mb-3 mt-5">Órden ${orden.estado}</h2>

                        <div class="d-flex align-items-center mb-2">
                            <img src="{{url('images/Tarea-Icon.svg')}}" class="me-3"><span>Tarea: <strong>${orden   .tarea}</strong></span>
                        </div>

                        <div class="d-flex align-items-center mb-2">
                            <img src="{{url('images/Fecha-Icon.svg')}}" class="me-3"><span>Fecha: <strong>${orden   .fecha_inicio}</strong></span>
                        </div>

                        <div class="d-flex align-items-center mb-2">
                            <img src="{{url('images/Maquina-Icon.svg')}}" class="me-3"><span>Máquina: <strong>${orden   .maquina?.nombre || 'Sin asignar'}</strong></span>
                        </div>

                        <div class="d-flex align-items-center mb-2">
                            <img src="{{url('images/Tratamiento-Icon.svg')}}" class="me-3"><span>Tratamiento: <strong>${orden   .tratamiento?.nombre || 'Ninguno'}</strong></span>
                        </div>

                        <div class="border rounded px-2 py-1 mb-3">
                            <div class="d-flex align-items-center mb-1">
                                <img src="{{url('images/Persona-Icon.svg')}}" class="me-3"><span class="fw-semibold">Aplicadores</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <img src="{{url('images/FotoAbatar.png')}}" class="me-3"><span>${orden  .aplicadores?.nombre || 'Sin asignar'}</span>
                                <i class="bi bi-caret-down ms-auto"></i>
                            </div>
                        </div>
                `;
                    }
                })
                .catch(error => console.error("Error al mostrar la orden:", error));
        }
    </script>

    <div id="previo">

        <div class="d-flex h-25 mb-3">

            <div class="ms-5 h-50">

                <h2 class="mb-3">Resumen de órdenes por explotación</h2>
                @foreach ($explotacion as $exp)
                    @php
                        $resumen = $ordenes[$exp->id] ?? [
                            'Pendientes' => 0,
                            'En curso' => 0,
                            'Pausadas' => 0,
                            'Completadas' => 0,
                        ];
                    @endphp
                    <div class="explotacion-tarjeta" data-id={{ $exp->id }} ">
                        <h3 class="mt-4 mb-2">{{ $exp->nombre }}</h3>
                        <div class="resumen d-flex flex-wrap gap-3">
                            <div class="resumen-tarjeta">
                                <h6>En curso</h6>
                                <div class="cantidad">{{ $resumen['En curso'] }}</div>
                            </div>
                            <div class="resumen-tarjeta">
                                <h6>Pendientes</h6>
                                <div class="cantidad">{{ $resumen['Pendientes'] }}</div>
                            </div>
                            <div class="resumen-tarjeta">
                                <h6>Pausadas</h6>
                                <div class="cantidad">{{ $resumen['Pausadas'] }}</div>
                            </div>
                        </div>
                    </div>
     @endforeach
                    </div>

            </div>

        </div>

        <div id="ordenes" class="ms-5" hidden>
            <div class="row">
                <div class="col-md-7">

                    <div class="d-flex justify-content-between gap-3 mb-3">
                        <!-- Cuadro de búsqueda -->
                        <div class="input-group w-25" id="cuadroBusqueda">
                            <span class="input-group-text">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path id="Vector"
                                        d="M19.3013 18.4803L14.6073 13.7872C15.9678 12.1538 16.6462 10.0588 16.5014 7.9379C16.3566 5.81703 15.3998 3.83363 13.8299 2.4003C12.26 0.966976 10.1979 0.194069 8.07263 0.242369C5.94738 0.290669 3.92256 1.15646 2.41939 2.65963C0.916222 4.1628 0.0504346 6.18762 0.0021347 8.31287C-0.0461652 10.4381 0.726742 12.5002 2.16007 14.0701C3.5934 15.64 5.5768 16.5969 7.69766 16.7417C9.81853 16.8865 11.9136 16.208 13.547 14.8475L18.2401 19.5416C18.3098 19.6113 18.3925 19.6665 18.4836 19.7043C18.5746 19.742 18.6722 19.7614 18.7707 19.7614C18.8693 19.7614 18.9669 19.742 19.0579 19.7043C19.1489 19.6665 19.2317 19.6113 19.3013 19.5416C19.371 19.4719 19.4263 19.3892 19.464 19.2981C19.5017 19.2071 19.5211 19.1095 19.5211 19.011C19.5211 18.9124 19.5017 18.8148 19.464 18.7238C19.4263 18.6327 19.371 18.55 19.3013 18.4803ZM1.52072 8.51096C1.52072 7.17593 1.9166 5.87089 2.6583 4.76086C3.4 3.65083 4.45421 2.78566 5.68761 2.27477C6.92101 1.76388 8.27821 1.63021 9.58758 1.89066C10.897 2.15111 12.0997 2.79398 13.0437 3.73799C13.9877 4.68199 14.6306 5.88473 14.891 7.1941C15.1515 8.50347 15.0178 9.86067 14.5069 11.0941C13.996 12.3275 13.1309 13.3817 12.0208 14.1234C10.9108 14.8651 9.60575 15.261 8.27072 15.261C6.48112 15.259 4.76538 14.5472 3.49994 13.2817C2.2345 12.0163 1.52271 10.3006 1.52072 8.51096Z"
                                        fill="#01533E" />
                                </svg>
                            </span>
                            <input type="search" class="form-control" placeholder="Buscar" id="textoBusqueda">
                        </div>


                        <select class="form-select w-25" id="filtroEstado">
                            <option value="Todas" selected>Todas</option>
                            <option value="Pendientes">Pendientes</option>
                            <option value="Pausadas">Pausadas</option>
                            <option value="En_curso">En curso</option>
                            <option value="Completadas">Completadas</option>
                        </select>
                    </div>

                    <div class="table-wrapped" id="tablaOrdenes">
                        <table id="tabla_ordenes" border="1" class="table">
                            <thead>
                                <tr>
                                    <th class="th_verde_primero">Tarea</th>
                                    <th class="th_verde">Fecha</th>
                                    <th class="th_verde">Estado</th>
                                    <th class="th_verde">Parcela</th>
                                </tr>
                            </thead>
                            <tbody id="bodyTabla">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4 ms-4 d-flex flex-column justify-content-between" id="cuadroDetalles" hidden>
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <h3>
                            Selecciona una orden para ver los detalles
                        </h3>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
