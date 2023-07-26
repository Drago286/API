@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Panel de Control') }}</div>

                    <div class="card-body">
                        @if (auth()->user()->rol === 'administrador')
                            <h2>Listado de Usuarios</h2>
                            <!-- Formulario de búsqueda por SAP -->
                            <form action="{{ route('home') }}" method="GET">
                                <div class="input-group mb-3">
                                    <input style="width: 1%" type="text" name="sap" class="form-control" placeholder="Buscar por SAP">
                                    <div class="input-group-append">
                                        <button style="background-color: #4aaff7; font_color: #fff" class="btn btn-secondary" type="submit">Buscar</button>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('home') }}" method="GET">
                                <div class="input-group mb-3">
                                        <button style="background-color: #f86969; font_color: #fff"class="btn btn-secondary" type="submit">Eliminar filtros</button>
                                </div>
                            </form>
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
                                                        <option
                                                            value="habilitado"{{ $user->status === 'habilitado' ? ' selected' : '' }}>
                                                            Habilitado</option>
                                                        <option
                                                            value="deshabilitado"{{ $user->status === 'deshabilitado' ? ' selected' : '' }}>
                                                            Deshabilitado</option>
                                                    </select>
                                                    <p></p>
                                                    <select name="rol">
                                                        <option
                                                            value="cliente"{{ $user->rol === 'cliente' ? ' selected' : '' }}>
                                                            Cliente</option>
                                                        <option
                                                            value="administrador"{{ $user->rol === 'administrador' ? ' selected' : '' }}>
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
    </style>
