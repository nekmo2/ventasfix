@extends('layouts.vertical', ['title' => 'Editar Producto'])

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
            <h4 class="page-title">Editar Producto</h4>
            <div class="">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/productos">Productos</a></li>
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
                <form action="/productos/{{ $producto->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>SKU</label>
                            <input type="text" name="sku" class="form-control" value="{{ $producto->sku }}" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ $producto->nombre }}" required>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label>Descripción Corta</label>
                        <input type="text" name="descripcion_corta" class="form-control" value="{{ $producto->descripcion_corta }}" required>
                    </div>

                    <div class="mb-2">
                        <label>Descripción Larga</label>
                        <textarea name="descripcion_larga" class="form-control" rows="3" required>{{ $producto->descripcion_larga }}</textarea>
                    </div>

                    <div class="mb-2">
                        <label>URL Imagen</label>
                        <input type="text" name="imagen" class="form-control" value="{{ $producto->imagen }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Precio Neto</label>
                            <input type="number" step="0.01" name="precio_neto" class="form-control" value="{{ $producto->precio_neto }}" required>
                            <small class="text-muted">Precio de venta actual con IVA: ${{ number_format($producto->precio_venta, 0, ',', '.') }}</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label>Stock Actual</label>
                            <input type="number" name="stock_actual" class="form-control" value="{{ $producto->stock_actual }}" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>Stock Mínimo</label>
                            <input type="number" name="stock_minimo" class="form-control" value="{{ $producto->stock_minimo }}" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>Stock Bajo</label>
                            <input type="number" name="stock_bajo" class="form-control" value="{{ $producto->stock_bajo }}" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>Stock Alto</label>
                            <input type="number" name="stock_alto" class="form-control" value="{{ $producto->stock_alto }}" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Actualizar Producto</button>
                    <a href="/productos" class="btn btn-secondary mt-2">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection