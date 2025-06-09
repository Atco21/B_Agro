@extends('explotacion')

@section('content2')
    <script>
        let quimicosAlmacen = [];

        addEventListener('DOMContentLoaded', inicio);


        async function inicio() {
            quimicosAlmacen = [];

                document.querySelectorAll(".resumen-tarjeta-peligro").forEach( tarjeta => {
                const id = tarjeta.dataset.id;

                const url = `/api/almacen/explotacion/quimicosPeligro/${id}`;
                console.log("Pidiendo a:", url);

                 fetch(`/api/almacen/explotacion/quimicosPeligro/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            tarjeta.innerHTML = "<p>Error al cargar químicos en peligro</p>";
                        } else {
                            const total = data.length;
                            let html = `<h4>Químicos en peligro -> <b><i>${total}</i></b></h4>`;

                            html +=
                                `<div class="quimicos-peligro mt-3" style="overflow-y: auto; font-size: 1.2em"><ul>`;
                            data.forEach(q => {
                                html +=
                                    `<li>Nombre: <b class="me-3">${q.quimico.nombre}</b> Cantidad: <b class="ms-1">${q.stock}</b></li>`;
                            });
                            html += `</ul></div>`;

                             tarjeta.innerHTML = html;
                        }
                    })
                    .catch(err => {
                        tarjeta.innerHTML = "<p>Error al conectar con el servidor</p>";
                        console.error(err);
                    });
            });
            document.getElementById('exploOpciones').removeAttribute('hidden');

            const select = document.querySelector(".exploSelect");
            if (select) {
                select.selectedIndex = 0;

                select.addEventListener(
                    "change",
                    function() {
                        const id = select.value;
                        if (id) {
                            quimicosAlmacen = [];
                            cargarDatos(id);
                            actualizarURL(id);
                        } else {
                            document.getElementById('almacenOpciones').setAttribute('hidden', '');
                            document.getElementById('previo').removeAttribute('hidden');
                        }
                    }
                );
            }


            document.querySelectorAll(".almacen-tarjeta").forEach(tarjeta => {
                tarjeta.addEventListener("click", function() {
                    const select = document.querySelector(".exploSelect");
                    const id = this.dataset.id;

                    if (!select || !id) return;

                    select.value = id;

                    select.dispatchEvent(new Event("change"));
                });
            });


            document.getElementById('abrirReflejarStock').addEventListener('click', function() {
                console.log(quimicosAlmacen);
                let select = document.getElementById('quimicoEnAlmacen');
                select.innerHTML = '';
                console.log("Cargando químicos en el modal");
                let options = '<option selected disabled>Selecciona un químico</option>';
                quimicosAlmacen.forEach(quimico => {
                    console.log(quimico);
                    options += `<option value="${quimico.id}">${quimico.nombre} (${quimico.tipo})</option>`;
                });
                select.innerHTML += options;
            })
        }


        function actualizarURL(id_explo) {
            const newURL = `/explotaciones/almacen/${id_explo}`;
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

                document.getElementById('almacenOpciones').setAttribute('hidden', '');
                document.getElementById('previo').removeAttribute('hidden');
            }
        };



        async function cargarDatos(id) {




            fetch(`/api/almacen/explotacion/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert("No hay datos");
                    } else {
                        var almacen = data[0].id;
                        fetch(`/api/almacen/quimicos/${almacen}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.error) {
                                    alert("No hay datos");
                                } else {
                                    const tabla = document.getElementById('tablaQuimicos');
                                    tabla.innerHTML = '';
                                    console.log(data);
                                    data.forEach(almacen => {
                                        quimicosAlmacen.push(almacen.quimico);
                                        const fila =
                                            `<tr class="linea_almacen" id=${almacen.id}>
                                        <td>${almacen.quimico.nombre}</td>
                                        <td>${almacen.quimico.tipo}</td>
                                        <td>${almacen.stock}</td>
                                        <td>${almacen.unidad}</td>
                                        <td>${almacen.stock_minimo}${almacen.unidad}</td>
                                    </tr>`;
                                        tabla.innerHTML += fila;
                                    });
                                }
                            });



                        fetch(`/api/almacen/cosecha/${almacen}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.error) {
                                    alert("No hay datos");
                                } else {
                                    const tabla = document.getElementById('tablaCosecha');
                                    tabla.innerHTML = '';
                                    console.log(data);
                                    data.forEach(almacen => {
                                        const fila2 = `
                                            <tr>
                                                <td>${almacen.cultivo.nombre}</td>
                                                <td>${almacen.stock}</td>
                                                <td>${almacen.unidad}</td>
                                            </tr>
                                        `

                                        tabla.innerHTML += fila2
                                    })
                                    document.getElementById('previo').setAttribute('hidden', '');
                                    document.getElementById('almacenOpciones').removeAttribute(
                                        'hidden');
                                }
                            })

                    }
                })
        }
    </script>


    <div class="ms-5" id="previo">
        <div class="d-flex flex-row">
            <div class="ms-auto pe-3">
                <button class="btn btn-primary mb-2 me-4 " data-bs-toggle="modal" data-bs-target="#modalGestionarAlmacenes">
                    <h4>Gestionar almacenes</h4>
                </button>
            </div>

        </div>

        <div class="d-flex align-items-center oveflow-auto flex-wrap">



            @foreach ($almacenes as $almacen)
                <div class="almacen-tarjeta m-2 flex-column w-25 overflow-auto" data-id="{{ $almacen->explotacion->id }}"
                    style="height: 300px !important">
                    <div class="flex-column align-items-center">
                        <div class="resumen-tarjeta mt-2 w-100" data-id="{{ $almacen->explotacion->id }}">
                            <H4 class="mt-4 mb-2 text-center text-truncate">
                                {{ $almacen->nombre . ' - ' . $almacen->explotacion->nombre }}
                            </H4>
                        </div>
                        <div class="resumen-tarjeta-peligro mt-5 w-100 " data-id="{{ $almacen->id }}">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="modal fade" id="modalGestionarAlmacenes" tabindex="-1" aria-labelledby="modalGestionarAlmacenesLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="modalGestionarAlmacenesLabel">Gestionar Almacenes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>

                    <div class="modal-body p-4">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Explotación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($almacenes as $almacen)
                                    <tr>
                                        <td>{{ $almacen->nombre }}</td>
                                        <td>{{ $almacen->explotacion->nombre }}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                                data-bs-target="#modalVerAlmacen" data-id="{{ $almacen->id }}">Ver</button>
                                            <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                                data-bs-target="#modalEditarAlmacen"
                                                data-id="{{ $almacen->id }}">Editar</button>
                                            <form action="" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('¿Eliminar almacén?')">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <button class="btn btn-success mt-3" data-bs-toggle="modal"
                            data-bs-target="#modalAgregarAlmacen">Agregar almacén</button>
                    </div>
                </div>
            </div>
        </div>







        <div class="modal fade" id="modalAgregarAlmacen" tabindex="-1" aria-labelledby="modalAgregarAlmacenLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAgregarAlmacenLabel">Agregar nuevo almacén</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>

                    <form action="" method="POST">
                        @csrf
                        <div class="modal-body">
                            @if ($almacenes->count() == $explotacion->count())
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading">¡Atención!</h4>
                                    <p>Ya has alcanzado el número máximo de almacenes para esta explotación.</p>
                                    <hr>
                                    <p class="mb-0">Por favor, elimina un almacén existente antes de agregar uno nuevo.
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"
                                        class="btn btn-secondary"data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            @else
                                <div class="mb-3">
                                    <label for="nombreAlmacen" class="form-label">Nombre del almacén</label>
                                    <input type="text" class="form-control" id="nombreAlmacen" name="nombre" required>
                                </div>

                                <div class="mb-3">
                                    <label for="explotacion" class="form-label">Explotación</label>
                                    <select class="form-select" id="explotacion" name="explotacion_id" required>
                                        <option value="">Selecciona una explotación </option>
                                        @foreach ($explotacion as $explo)
                                            <option value="{{ $explo->id }}">{{ $explo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>






    </div>

    </div>



    <div class="ms-5" id="almacenOpciones" hidden style="font-size: 20px;">

        <div class="d-flex flex-row mb-3 w-50 align-items-center">
            <div class="me-auto pe-3">
                <button type="button" class="btn botonAlmacen" data-bs-toggle="modal"
                    data-bs-target="#reflejarStockModal" id="abrirReflejarStock">
                    <h4>Reflejar stock</h4>
                </button>
            </div>

        </div>


        <div class="modal fade" id="reflejarStockModal" tabindex="-1" aria-labelledby="reflejarStockModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content d-flex justify-content-center">

                    <div class="modal-header">
                        <h3 class="modal-title" id="crearParcelaLabel">Reflejar stock</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form action="{{route('almacen.quimico.update') }}" method="POST" id="formReflejarStock">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3 mx-2">
                                <label for="cultivoParcela" class="form-label">Químico:</label>
                                <select class="form-select form-control" id="quimicoEnAlmacen" required name="quimico_id">

                                </select>
                            </div>
                            <div class="row mb-3 mx-2">
                                <label for="tamanyoParcela" class="form-label">Cantidad:</label>
                                <input type="number" class="form-control" id="tamanyoParcela" placeholder="1" min="1" required name="cantidad">
                            </div>
                    </div>

                    <div class="modal-footer modal-dialog-centered d-flex justify-content-center">
                        <button type="submit" class="btn button-secondary1">Reflejar</button>
                    </div>
                </form>

                </div>
            </div>
        </div>

        <div class="d-flex flex-row">

            <div class="col-md-5">
                <h4>Químicos</h4>
                <table class="table text-center" border="1">
                    <thead>
                        <tr>
                            <th class="th_verde_primero">Nombre</th>
                            <th class="th_verde">Tipo</th>
                            <th class="th_verde">Cantidad</th>
                            <th class="th_verde">Unidad</th>
                            <th class="th_verde">Stock mínimo</th>
                        </tr>
                    </thead>
                    <tbody id="tablaQuimicos">
                    </tbody>
                </table>
            </div>
            <div class="col-md-1">

            </div>


            <div class="col-md-5">
                <h4>Cultivos</h4>
                <table class="table text-center" border="1">
                    <thead>
                        <tr>
                            <th class="th_verde_primero">Nombre</th>
                            <th class="th_verde">Cantidad</th>
                            <th class="th_verde">Unidad</th>
                        </tr>
                    </thead>
                    <tbody id="tablaCosecha">
                    </tbody>
                </table>

            </div>

        </div>

    </div>
@endsection
