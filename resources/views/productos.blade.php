@extends('layouts.vertical', ['title' => 'Productos'])

@section('css')
@vite(['node_modules/simple-datatables/dist/style.css'])
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">Productos</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Approx</a></li>
                    <li class="breadcrumb-item active">Productos</li>
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
                        <h4 class="card-title">Listado de Productos</h4>
                    </div>
                    <div class="col-auto">
                        <button class="btn bg-primary text-white" data-bs-toggle="modal" data-bs-target="#addProducto"><i class="fas fa-plus me-1"></i> Add Producto</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table mb-0" id="datatable_1">
                        <thead class="table-light">
                            <tr>
                                <th>Imagen</th>
                                <th>SKU</th>
                                <th>Nombre</th>
                                <th>Precio Neto</th>
                                <th>Precio Venta</th>
                                <th>Stock Actual</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                            <tr>
                                <td><img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}" style="width:50px; height:50px; object-fit:cover;" class="rounded"></td>
                                <td>{{ $producto->sku }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td>${{ number_format($producto->precio_neto, 0, ',', '.') }}</td>
                                <td>${{ number_format($producto->precio_venta, 0, ',', '.') }}</td>
                                <td>{{ $producto->stock_actual }}</td>
                                <td class="text-end">
                                    <a href="/productos/{{ $producto->id }}/edit"><i class="las la-pen text-secondary fs-18"></i></a>
                                    <form action="/productos/{{ $producto->id }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border:none; background:none; padding:0;" onclick="return confirm('¿Seguro que quieres eliminar este producto?')">
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

<div class="modal fade" id="addProducto" tabindex="-1" aria-labelledby="addProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="/productos" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductoLabel">Add Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>SKU</label>
                            <input type="text" name="sku" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label>Descripción Corta</label>
                        <input type="text" name="descripcion_corta" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Descripción Larga</label>
                        <textarea name="descripcion_larga" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-2">
                        <label>URL Imagen</label>
                        <input type="text" name="imagen" class="form-control" placeholder="https://..." required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Precio Neto</label>
                            <input type="number" step="0.01" name="precio_neto" class="form-control" required>
                            <small class="text-muted">El precio de venta con IVA (19%) se calcula automáticamente.</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label>Stock Actual</label>
                            <input type="number" name="stock_actual" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>Stock Mínimo</label>
                            <input type="number" name="stock_minimo" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>Stock Bajo</label>
                            <input type="number" name="stock_bajo" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>Stock Alto</label>
                            <input type="number" name="stock_alto" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-100">Add Producto</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script-bottom')
@vite(['resources/js/pages/datatable.init.js'])
@endsection