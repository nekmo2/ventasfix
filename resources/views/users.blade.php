@extends('layouts.vertical', ['title' => 'Users'])

@section('css')
@vite(['node_modules/simple-datatables/dist/style.css'])
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">Usuarios</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Approx</a>
                    </li><!--end nav-item-->
                    <li class="breadcrumb-item active">Usuarios</li>
                </ol>
            </div>
        </div><!--end page-title-box-->
    </div><!--end col-->
</div><!--end row-->

{{-- mostramos errores de validacion si es que hay, por ejemplo al agregar un usuario --}}
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
                        <h4 class="card-title">Usuarios del Sistema</h4>
                    </div><!--end col-->
                    <div class="col-auto">
                        <button class="btn bg-primary text-white" data-bs-toggle="modal" data-bs-target="#addUser"><i class="fas fa-plus me-1"></i> Add User</button>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end card-header-->
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table mb-0" id="datatable_1">
                        <thead class="table-light">
                            <tr>
                                <th>Rut</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- recorremos los usuarios reales que nos manda el controlador --}}
                            @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->rut }}</td>
                                <td>{{ $usuario->nombre }}</td>
                                <td>{{ $usuario->apellido }}</td>
                                <td><a href="#" class="text-body text-decoration-underline">{{ $usuario->email }}</a></td>
                                <td class="text-end">
                                    <a href="/users/{{ $usuario->id }}/edit"><i class="las la-pen text-secondary fs-18"></i></a>

                                    {{-- el formulario de eliminar necesita method DELETE, laravel lo simula con @method --}}
                                    <form action="/users/{{ $usuario->id }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border:none; background:none; padding:0;" onclick="return confirm('¿Seguro que quieres eliminar este usuario?')">
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
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {{-- este formulario manda los datos a la ruta store con metodo post --}}
            <form action="/users" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserLabel">Add User Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="rut">Rut</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="far fa-id-card"></i></span>
                            <input type="text" name="rut" class="form-control" placeholder="Rut" required>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="nombre">Nombre</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="far fa-user"></i></span>
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="apellido">Apellido</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="far fa-user"></i></span>
                            <input type="text" name="apellido" class="form-control" placeholder="Apellido" required>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="usuario@ventasfix.cl" required>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-100">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script-bottom')
@vite(['resources/js/pages/datatable.init.js'])
@endsection