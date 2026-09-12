@extends('layouts.vertical', ['title' => 'Editar Usuario'])

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">Editar Usuario</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/users">Usuarios</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </div>
        </div>
    </div>
</div>

{{-- mostramos errores de validacion si es que hay --}}
@if ($errors->any())
<div class="row">
    <div class="col-12">
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                {{-- este formulario manda los datos a la ruta update, laravel simula el metodo put con @method --}}
                <form action="/users/{{ $usuario->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-2">
                        <label for="rut">Rut</label>
                        <input type="text" name="rut" class="form-control" value="{{ $usuario->rut }}" required>
                    </div>

                    <div class="mb-2">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ $usuario->nombre }}" required>
                    </div>

                    <div class="mb-2">
                        <label for="apellido">Apellido</label>
                        <input type="text" name="apellido" class="form-control" value="{{ $usuario->apellido }}" required>
                    </div>

                    <div class="mb-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $usuario->email }}" required>
                    </div>

                    <div class="mb-2">
                        <label for="password">Password (dejar vacío para no cambiarla)</label>
                        <input type="password" name="password" class="form-control" placeholder="Nueva contraseña (opcional)">
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Actualizar Usuario</button>
                    <a href="/users" class="btn btn-secondary mt-2">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection