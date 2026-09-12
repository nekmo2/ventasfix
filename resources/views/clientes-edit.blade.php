@extends('layouts.vertical', ['title' => 'Editar Cliente'])

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">Editar Cliente</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/clientes">Clientes</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </div>
        </div>
    </div>
</div>

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
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="/clientes/{{ $cliente->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Rut Empresa</label>
                            <input type="text" name="rut_empresa" class="form-control" value="{{ $cliente->rut_empresa }}" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Rubro</label>
                            <input type="text" name="rubro" class="form-control" value="{{ $cliente->rubro }}" required>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label>Razón Social</label>
                        <input type="text" name="razon_social" class="form-control" value="{{ $cliente->razon_social }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Teléfono</label>
                            <input type="text" name="telefono" class="form-control" value="{{ $cliente->telefono }}" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Dirección</label>
                            <input type="text" name="direccion" class="form-control" value="{{ $cliente->direccion }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Nombre de Contacto</label>
                            <input type="text" name="nombre_contacto" class="form-control" value="{{ $cliente->nombre_contacto }}" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Email de Contacto</label>
                            <input type="email" name="email_contacto" class="form-control" value="{{ $cliente->email_contacto }}" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Actualizar Cliente</button>
                    <a href="/clientes" class="btn btn-secondary mt-2">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection