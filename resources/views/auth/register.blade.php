@extends('layouts.auth', ['title' => 'Register'])

@section('content')

<div class="card">
    <div class="card-body p-0 bg-black auth-header-box rounded-top">
        <div class="text-center p-3">
            <a href="{{ route('any', 'index')}}" class="logo logo-admin">
                <img src="/images/logo-sm.png" height="50" alt="logo" class="auth-logo">
            </a>
            <h4 class="mt-3 mb-1 fw-semibold text-white fs-18">Create an account</h4>
            <p class="text-muted fw-medium mb-0">Enter your detail to Create your account today.</p>
        </div>
    </div>
    <div class="card-body pt-0">

        {{-- mostramos los errores de validacion si es que hay --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="my-4" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group mb-2">
                <label class="form-label" for="rut">Rut</label>
                <input type="text" class="form-control" id="rut" name="rut" value="{{ old('rut') }}" placeholder="Enter rut">
            </div><!--end form-group-->

            <div class="form-group mb-2">
                <label class="form-label" for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder="Enter nombre">
            </div><!--end form-group-->

            <div class="form-group mb-2">
                <label class="form-label" for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido') }}" placeholder="Enter apellido">
            </div><!--end form-group-->

            <div class="form-group mb-2">
                <label class="form-label" for="useremail">Email</label>
                <input type="email" class="form-control" id="useremail" name="email" value="{{ old('email') }}" placeholder="usuario@ventasfix.cl">
            </div><!--end form-group-->

            <div class="form-group mb-2">
                <label class="form-label" for="userpassword">Password</label>
                <input type="password" class="form-control" name="password" id="userpassword" placeholder="Enter password">
            </div><!--end form-group-->

            <div class="form-group mb-2">
                <label class="form-label" for="Confirmpassword">ConfirmPassword</label>
                <input type="password" class="form-control" name="password_confirmation" id="Confirmpassword" placeholder="Enter Confirm password">
            </div><!--end form-group-->

            <div class="form-group mb-0 row">
                <div class="col-12">
                    <div class="d-grid mt-3">
                        <button class="btn btn-primary" type="submit">Registrarse <i class="fas fa-sign-in-alt ms-1"></i></button>
                    </div>
                </div><!--end col-->
            </div> <!--end form-group-->
        </form><!--end form-->
        <div class="text-center">
            <p class="text-muted">Already have an account ? <a href="{{ route('second', ['auth', 'login'])}}" class="text-primary ms-2">Log in</a></p>
        </div>
    </div><!--end card-body-->
</div><!--end card-->

@endsection