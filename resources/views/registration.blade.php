@extends('layout')
  
  @section('content')
  <main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
    
                        <form action="{{ route('register.post') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>
                                <div class="col-md-6">
                                    <input type="text" id="name" class="form-control" name="name"
                                    value="{{old('name')}}"
                                    required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lastname" class="col-md-4 col-form-label text-md-right">Apellido</label>
                                <div class="col-md-6">
                                    <input type="text" id="lastname" class="form-control" name="lastname"
                                    value="{{old('lastname')}}"
                                    required autofocus>
                                    @if ($errors->has('lastname'))
                                        <span class="text-danger">{{ $errors->first('lastname') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="DNI" class="col-md-4 col-form-label text-md-right">DNI</label>
                                <div class="col-md-6">
                                    <input type="text" id="DNI" class="form-control" name="DNI"
                                    value="{{old('DNI')}}"
                                    required autofocus>
                                    @if ($errors->has('DNI'))
                                        <span class="text-danger">{{ $errors->first('DNI') }}</span>
                                    @endif
                                    @if ($errors->has('DNI_'))
                                        <span class="text-danger">{{ $errors->first('DNI_') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4
                                col-form-label text-md-right">Correo electrónico</label>
                                <div class="col-md-6">
                                    <input type="text" id="email" class="form-control" name="email"
                                    value="{{old('email')}}"
                                    required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password"
                                class="col-md-4 col-form-label text-md-right">Contraseña</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password"
                                    required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirm"
                                class="col-md-4 col-form-label text-md-right">Confirmar Contraseña</label>
                                <div class="col-md-6">
                                    <input type="password" id="password_confirm"
                                    class="form-control" name="password_confirm"
                                    required>
                                    @if ($errors->has('password_confirm'))
                                        <span class="text-danger">{{ $errors->first('password_confirm') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-md-4
                                col-form-label text-md-right">Teléfono</label>
                                <div class="col-md-6">
                                    <input type="text" id="phone" class="form-control" name="phone"
                                    value="{{old('phone')}}"
                                    autofocus>
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="country" class="col-md-4
                                col-form-label text-md-right">País</label>
                                <div class="col-md-6">
                                    <input type="text" id="country" class="form-control" name="country"
                                    value="{{old('country')}}"
                                    autofocus>
                                    @if ($errors->has('country'))
                                        <span class="text-danger">{{ $errors->first('country') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="IBAN" class="col-md-4
                                col-form-label text-md-right">IBAN</label>
                                <div class="col-md-6">
                                    <input type="text" id="IBAN" class="form-control" name="IBAN"
                                    value="{{old('IBAN')}}"
                                    required autofocus>
                                    @if ($errors->has('IBAN'))
                                        <span class="text-danger">{{ $errors->first('IBAN') }}</span>
                                    @endif
                                    @if ($errors->has('IBAN_'))
                                        <span class="text-danger">{{ $errors->first('IBAN_') }}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="about" class="col-md-4
                                col-form-label text-md-right">Acerca de</label>
                                <div class="col-md-6">
                                    <input type="text" id="about" class="form-control" name="about"
                                    value="{{old('about')}}"
                                    autofocus>
                                    @if ($errors->has('about'))
                                        <span class="text-danger">{{ $errors->first('about') }}</span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </form>
                          
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>
  @endsection