@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Importar Excel') }}</div>

                    <div class="card-body">
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
    </div>

@endsection
