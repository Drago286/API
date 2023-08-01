@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Importar Caidas') }}</div>

                    <div class="card-body">
                        @if (session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="documento" class="form-label">Seleccionar archivo Excel:</label>
                                <input type="file" name="documento"
                                    class="form-control @error('documento') is-invalid @enderror" id="documento">
                                @error('documento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success">Importar Caidas</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Importar Stock') }}</div>

                    <div class="card-body">
                        @if (session()->has('error2'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error2') }}
                            </div>
                        @endif
                        @if (session()->has('success2'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success2') }}
                            </div>
                        @endif

                        <form action="{{ route('import-stock') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="documento2" class="form-label">Seleccionar archivo Excel:</label>
                                <input type="file" name="documento2"
                                    class="form-control @error('documento2') is-invalid @enderror" id="documento2">
                                @error('documento2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success">Importar Stock</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
