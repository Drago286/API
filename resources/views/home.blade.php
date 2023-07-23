@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Panel de Control') }}</div>

                <div class="card-body">
                    @if(auth()->user()->rol === 'administrador')
                        <h2>Listado de Usuarios</h2>
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
                                        <td>{{$user->SAP}}</td>
                                        <td>{{$user->rol}}</td>
                                        <td>{{ $user->status }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('update.status', $user->id) }}">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="current_status" value="{{ $user->status }}">
                                                <select name="status">
                                                    <option value="habilitado"{{ $user->status === 'habilitado' ? ' selected' : '' }}>Habilitado</option>
                                                    <option value="deshabilitado"{{ $user->status === 'deshabilitado' ? ' selected' : '' }}>Deshabilitado</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary">Cambiar Estado</button>
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
