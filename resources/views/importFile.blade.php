@extends('layouts.app')

@section('content')
    <div class="container">

        <!-- Importar Caidas y Importar Stock en un solo row -->
        <div class="row justify-content-center">
            <!-- Importar Caidas -->
            <div class="col-md-5">
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

            <!-- Importar Stock -->
            <div class="col-md-5">
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
        <br>
        <br>

        <br><br>
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ __('Importar Codigos') }}</div>
                        <div class="card-body">
                            <form action="{{ route('import-codigos-all') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="documento3" class="form-label">Seleccionar archivo Excel (Codigos
                                            830):</label>
                                        <input type="file" name="documento3"
                                            class="form-control @error('documento3') is-invalid @enderror" id="documento3">
                                        @error('documento3')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if (session()->has('error3'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ session('error3') }}
                                            </div>
                                        @endif
                                        @if (session()->has('success3'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('success3') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="documento4" class="form-label">Seleccionar archivo Excel (Codigos
                                            930E2):</label>
                                        <input type="file" name="documento4"
                                            class="form-control @error('documento4') is-invalid @enderror" id="documento4">
                                        @error('documento4')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if (session()->has('error4'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ session('error4') }}
                                            </div>
                                        @endif
                                        @if (session()->has('success4'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('success4') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="documento5" class="form-label">Seleccionar archivo Excel (Codigos
                                            930E4):</label>
                                        <input type="file" name="documento5"
                                            class="form-control @error('documento5') is-invalid @enderror" id="documento5">
                                        @error('documento5')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if (session()->has('error5'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ session('error5') }}
                                            </div>
                                        @endif
                                        @if (session()->has('success5'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('success5') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <button id="submitBtn" type="submit" class="btn btn-success custom-btn" disabled>Importar
                                    Códigos</button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>{{--
            <div class="container">
                <div class="row justify-content-center">

                    <!-- Importar Codigos 830 -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">{{ __('Importar Codigos 830') }}</div>
                            <div class="card-body">
                                @if (session()->has('error3'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error3') }}
                                    </div>
                                @endif
                                @if (session()->has('success3'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success3') }}
                                    </div>
                                @endif

                                <form action="{{ route('import-codigos') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="documento3" class="form-label">Seleccionar archivo Excel:</label>
                                        <input type="file" name="documento3"
                                            class="form-control @error('documento3') is-invalid @enderror" id="documento3">
                                        @error('documento3')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="equipo" value="830">
                                    <button type="submit" class="btn btn-success">Importar Codigos 830</button>
                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- Importar Codigos 930E2 -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">{{ __('Importar Codigos 930E2') }}</div>
                            <div class="card-body">
                                @if (session()->has('error4'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error4') }}
                                    </div>
                                @endif
                                @if (session()->has('success4'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success4') }}
                                    </div>
                                @endif

                                <form action="{{ route('import-codigos-E2') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="documento4" class="form-label">Seleccionar archivo Excel:</label>
                                        <input type="file" name="documento4"
                                            class="form-control @error('documento4') is-invalid @enderror" id="documento4">
                                        @error('documento4')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="equipo" value="930E2">
                                    <button type="submit" class="btn btn-success">Importar Codigos 930E2</button>
                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- Importar Codigos 930E4 -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">{{ __('Importar Codigos 930E4') }}</div>
                            <div class="card-body">
                                @if (session()->has('error5'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error5') }}
                                    </div>
                                @endif
                                @if (session()->has('success5'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success5') }}
                                    </div>
                                @endif

                                <form action="{{ route('import-codigos-E4') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="documento5" class="form-label">Seleccionar archivo Excel:</label>
                                        <input type="file" name="documento5"
                                            class="form-control @error('documento5') is-invalid @enderror" id="documento5">
                                        @error('documento5')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="equipo" value="930E4">
                                    <button type="submit" class="btn btn-success">Importar Codigos 930E4</button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
     --}}
    </div>
    <script>
        // Habilitar el botón de envío cuando los tres archivos hayan sido seleccionados
        const document3Input = document.getElementById('documento3');
        const document4Input = document.getElementById('documento4');
        const document5Input = document.getElementById('documento5');
        const submitBtn = document.getElementById('submitBtn');

        document3Input.addEventListener('change', checkInputs);
        document4Input.addEventListener('change', checkInputs);
        document5Input.addEventListener('change', checkInputs);

        function checkInputs() {
            if (document3Input.files.length > 0 && document4Input.files.length > 0 && document5Input.files.length > 0) {
                submitBtn.removeAttribute('disabled');
            } else {
                submitBtn.setAttribute('disabled', 'disabled');
            }
        }
    </script>
    <style>
        /* Estilos para el botón deshabilitado */
        .custom-btn[disabled] {
            background-color: red;
        }

        /* Estilos para el botón habilitado */
        .custom-btn:not([disabled]) {
            background-color: green;
            cursor: pointer;
            /* Cambiar el cursor cuando el botón está habilitado */
        }
    </style>
@endsection
