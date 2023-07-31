@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Panel de Control') }}</div>

                    <div class="card-body">
                        @if (auth()->user()->rol === 'administrador')
                            <h2>Listado de Usuarios</h2>
                            <!-- Formulario de búsqueda por SAP -->
                            <form action="{{ route('home') }}" method="GET" class="mb-3">
                                <div class="input-group">
                                    <input style="width: 100%" type="text" name="sap" class="form-control" placeholder="Buscar por SAP">
                                </div>
                                <div class="input-group mt-3">
                                    <button style="background-color: #4aaff7; color: #fff;" class="btn btn-secondary btn-block" type="submit">Buscar</button>
                                </div>
                            </form>
                            <form action="{{ route('home') }}" method="GET">
                                <div class="input-group mb-3">
                                    <button style="background-color: #f86969; color: #fff;" class="btn btn-secondary btn-block" type="submit">Eliminar filtros</button>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>SAP</th>
                                            <th>Rol</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->SAP }}</td>
                                                <td>{{ $user->rol }}</td>
                                                <td>{{ $user->status }}</td>
                                                <td>
                                                    <form method="POST" action="{{ route('update.status', $user->id) }}">
                                                        @csrf
                                                        @method('POST')

                                                        <input type="hidden" name="current_status" value="{{ $user->status }}">
                                                        <input type="hidden" name="current_rol" value="{{ $user->rol }}">
                                                        <select name="status">
                                                            <option value="habilitado"{{ $user->status === 'habilitado' ? ' selected' : '' }}>
                                                                Habilitado</option>
                                                            <option value="deshabilitado"{{ $user->status === 'deshabilitado' ? ' selected' : '' }}>
                                                                Deshabilitado</option>
                                                        </select>
                                                        <p></p>
                                                        <select name="rol">
                                                            <option value="cliente"{{ $user->rol === 'cliente' ? ' selected' : '' }}>
                                                                Cliente</option>
                                                            <option value="administrador"{{ $user->rol === 'administrador' ? ' selected' : '' }}>
                                                                Administrador</option>
                                                        </select>
                                                        <p></p>
                                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @elseif(auth()->user()->rol === 'cliente')
                            <p>No tienes permisos para ver esta página.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    /* Estilos para la tabla */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    /* Mover el botón al final de la fila */
    td:last-child {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
    }

    /* Estilos adaptativos para pantallas móviles */
    @media (max-width: 767px) {
        /* Modificar el ancho del input y botón de búsqueda para móviles */
        input[name="sap"] {
            width: 100%;
        }

        .input-group-append {
            width: 100%;
        }

        /* Alinear los botones en el formulario en una columna */
        form {
            display: flex;
            flex-direction: column;
        }
    }
</style>
