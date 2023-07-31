@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Subir Archivo Excel</h2>
    <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data" id="uploadForm">
        @csrf
        <div class="mb-3">
            <input type="file" name="excelFile" class="form-control" id="fileInput">
        </div>
        <button type="submit" class="btn btn-primary" id="uploadBtn">Subir y Analizar Excel</button>
    </form>

    <!-- Barra de progreso y mensajes de estado -->
    <div class="progress mt-4" style="display: none;" id="progressBarContainer">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="progressBar"></div>
    </div>
    <div class="mt-2" id="statusMessage"></div>
</div>
<!-- Resto del código HTML -->
<!-- Importar Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    document.getElementById('uploadForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(event.target);

        // Mostrar la barra de progreso y ocultar el botón
        document.getElementById('uploadBtn').style.display = 'none';
        document.getElementById('progressBarContainer').style.display = 'block';

        // Realizar la solicitud POST utilizando Axios
        axios.post('{{ route('upload') }}', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            onUploadProgress: function(progressEvent) {
                const progress = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                document.getElementById('progressBar').style.width = progress + '%';
            }
        }).then(function(response) {
            // Mostrar el mensaje de estado y reiniciar el formulario
            document.getElementById('statusMessage').innerText = response.data.message;
            document.getElementById('uploadForm').reset();

            // Ocultar la barra de progreso y mostrar nuevamente el botón
            document.getElementById('progressBarContainer').style.display = 'none';
            document.getElementById('uploadBtn').style.display = 'block';
        }).catch(function(error) {
            // Mostrar el mensaje de error si ocurre algún problema
            document.getElementById('statusMessage').innerText = 'Ocurrió un error al importar el archivo.';
            console.error(error);
        });
    });
</script>
@endsection
