@extends('ventas')

@section('content3')
    <div class="w-100 m-2 p-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Clientes</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearCliente">
                Crear cliente
            </button>
        </div>

        <div>
            <table class="table table-striped" id="tablaClientes">
                <thead>
                    <tr>
                        <th class="th_verde_primero">Nombre completo</th>
                        <th class="th_verde">DNI/NIF</th>
                        <th class="th_verde">Dirección</th>
                        <th class="th_verde">Teléfono</th>
                        <th class="th_verde">Email</th>
                        <th class="th_verde">Empresa</th>
                        <th class="th_verde">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nombre_completo }}</td>
                            <td>{{ $cliente->dni_nif }}</td>
                            <td>{{ $cliente->direccion ?? '-' }}</td>
                            <td>{{ $cliente->telefono ?? '-' }}</td>
                            <td>{{ $cliente->email ?? '-' }}</td>
                            <td>{{ $cliente->es_empresa ? 'Sí' : 'No' }}</td>
                            <td>
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#modalVerCliente{{ $cliente->id }}">
                                    Ver
                                </button>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#modalEditarCliente{{ $cliente->id }}">
                                    Editar
                                </button>
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar cliente?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalVerCliente{{ $cliente->id }}" tabindex="-1"
                            aria-labelledby="modalVerClienteLabel{{ $cliente->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalVerClienteLabel{{ $cliente->id }}">Cliente:
                                            {{ $cliente->nombre_completo }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>DNI/NIF:</strong> {{ $cliente->dni_nif }}</p>
                                        <p><strong>Dirección:</strong> {{ $cliente->direccion ?? '—' }}</p>
                                        <p><strong>Teléfono:</strong> {{ $cliente->telefono ?? '—' }}</p>
                                        <p><strong>Email:</strong> {{ $cliente->email ?? '—' }}</p>
                                        <p><strong>Es empresa:</strong> {{ $cliente->es_empresa ? 'Sí' : 'No' }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalEditarCliente{{ $cliente->id }}" tabindex="-1"
                            aria-labelledby="modalEditarClienteLabel{{ $cliente->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditarClienteLabel{{ $cliente->id }}">Editar
                                            cliente</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-3">
                                                <label class="form-label" for="nombreCompleto{{ $cliente->id }}">Nombre
                                                    completo</label>
                                                <input type="text" id="nombreCompleto{{ $cliente->id }}"
                                                    name="nombre_completo" class="form-control"
                                                    value="{{ $cliente->nombre_completo }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="dniNif{{ $cliente->id }}">DNI/NIF</label>
                                                <input type="text" id="dniNif{{ $cliente->id }}" name="dni_nif"
                                                    class="form-control" value="{{ $cliente->dni_nif }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"
                                                    for="direccion{{ $cliente->id }}">Dirección</label>
                                                <input type="text" id="direccion{{ $cliente->id }}" name="direccion"
                                                    class="form-control" value="{{ $cliente->direccion }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"
                                                    for="telefono{{ $cliente->id }}">Teléfono</label>
                                                <input type="text" id="telefono{{ $cliente->id }}" name="telefono"
                                                    class="form-control" value="{{ $cliente->telefono }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="email{{ $cliente->id }}">Email</label>
                                                <input type="email" id="email{{ $cliente->id }}" name="email"
                                                    class="form-control" value="{{ $cliente->email }}">
                                            </div>
                                            <div class="form-check mb-3">
                                                <input type="checkbox" id="esEmpresa{{ $cliente->id }}"
                                                    name="es_empresa" class="form-check-input"
                                                    {{ $cliente->es_empresa ? 'checked' : '' }}>
                                                <label class="form-check-label" for="esEmpresa{{ $cliente->id }}">Es
                                                    empresa</label>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div <div class="modal fade" id="modalCrearCliente" tabindex="-1" aria-labelledby="modalCrearClienteLabel"
            aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCrearClienteLabel"> cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">

                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="nombreCompleto">Nombre completo</label>
                            <input type="text" id="nombreCompleto" name="nombre_completo" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="dniNif">DNI/NIF</label>
                            <input type="text" id="dniNif" name="dni_nif" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="direccion">Dirección</label>
                            <input type="text" id="direccion" name="direccion" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="telefono">Teléfono</label>
                            <input type="text" id="telefono" name="telefono" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" id="esEmpresa" name="es_empresa" class="form-check-input">
                            <label class="form-check-label" for="esEmpresa">Es empresa</label>
                        </div>
                        <button type="submit" class="btn btn-success">Crear cliente</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
