@extends('layouts.vertical', ['title' => 'Clientes'])

@section('css')
@vite(['node_modules/simple-datatables/dist/style.css'])
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">Clientes</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Approx</a></li>
                    <li class="breadcrumb-item active">Clientes</li>
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
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title">Listado de Clientes</h4>
                    </div>
                    <div class="col-auto">
                        <button class="btn bg-primary text-white" data-bs-toggle="modal" data-bs-target="#addCliente"><i class="fas fa-plus me-1"></i> Add Cliente</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table mb-0" id="datatable_1">
                        <thead class="table-light">
                            <tr>
                                <th>Rut Empresa</th>
                                <th>Razón Social</th>
                                <th>Rubro</th>
                                <th>Teléfono</th>
                                <th>Contacto</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->rut_empresa }}</td>
                                <td>{{ $cliente->razon_social }}</td>
                                <td>{{ $cliente->rubro }}</td>
                                <td>{{ $cliente->telefono }}</td>
                                <td>{{ $cliente->nombre_contacto }}</td>
                                <td class="text-end">
                                    <a href="/clientes/{{ $cliente->id }}/edit"><i class="las la-pen text-secondary fs-18"></i></a>
                                    <form action="/clientes/{{ $cliente->id }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border:none; background:none; padding:0;" onclick="return confirm('¿Seguro que quieres eliminar este cliente?')">
                                            <i class="las la-trash-alt text-secondary fs-18"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addCliente" tabindex="-1" aria-labelledby="addClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="/clientes" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addClienteLabel">Add Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Rut Empresa</label>
                            <input type="text" name="rut_empresa" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Rubro</label>
                            <input type="text" name="rubro" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label>Razón Social</label>
                        <input type="text" name="razon_social" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Teléfono</label>
                            <input type="text" name="telefono" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Dirección</label>
                            <input type="text" name="direccion" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Nombre de Contacto</label>
                            <input type="text" name="nombre_contacto" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Email de Contacto</label>
                            <input type="email" name="email_contacto" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-100">Add Cliente</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script-bottom')
@vite(['resources/js/pages/datatable.init.js'])
@endsection