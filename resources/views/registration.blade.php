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
                                <label for="usr_name" class="col-md-4 col-form-label text-md-right">Nombre</label>
                                <div class="col-md-6">
                                    <input type="text" id="usr_name" class="form-control" name="usr_name"
                                    value="{{old('usr_name')}}"
                                    required autofocus>
                                    @if ($errors->has('usr_name'))
                                        <span class="text-danger">{{ $errors->first('usr_name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="usr_lastname" class="col-md-4 col-form-label text-md-right">Apellido</label>
                                <div class="col-md-6">
                                    <input type="text" id="usr_lastname" class="form-control" name="usr_lastname"
                                    value="{{old('usr_lastname')}}"
                                    required autofocus>
                                    @if ($errors->has('usr_lastname'))
                                        <span class="text-danger">{{ $errors->first('usr_lastname') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="usr_DNI" class="col-md-4 col-form-label text-md-right">DNI</label>
                                <div class="col-md-6">
                                    <input type="text" id="usr_DNI" class="form-control" name="usr_DNI"
                                    value="{{old('usr_DNI')}}"
                                    required autofocus>
                                    @if ($errors->has('usr_DNI'))
                                        <span class="text-danger">{{ $errors->first('usr_DNI') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="usr_email" class="col-md-4
                                col-form-label text-md-right">Correo electrónico</label>
                                <div class="col-md-6">
                                    <input type="text" id="usr_email" class="form-control" name="usr_email"
                                    value="{{old('usr_email')}}"
                                    required autofocus>
                                    @if ($errors->has('usr_email'))
                                        <span class="text-danger">{{ $errors->first('usr_email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="usr_password"
                                class="col-md-4 col-form-label text-md-right">Contraseña</label>
                                <div class="col-md-6">
                                    <input type="password" id="usr_password" class="form-control" name="usr_password"
                                    required>
                                    @if ($errors->has('usr_password'))
                                        <span class="text-danger">{{ $errors->first('usr_password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="usr_password_confirm"
                                class="col-md-4 col-form-label text-md-right">Confirmar Contraseña</label>
                                <div class="col-md-6">
                                    <input type="password" id="usr_password_confirm"
                                    class="form-control" name="usr_password_confirm"
                                    required>
                                    @if ($errors->has('usr_password_confirm'))
                                        <span class="text-danger">{{ $errors->first('usr_password_confirm') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="usr_phone" class="col-md-4
                                col-form-label text-md-right">Teléfono</label>
                                <div class="col-md-6">
                                    <input type="text" id="usr_phone" class="form-control" name="usr_phone"
                                    value="{{old('usr_phone')}}"
                                    autofocus>
                                    @if ($errors->has('usr_phone'))
                                        <span class="text-danger">{{ $errors->first('usr_phone') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="usr_country" class="col-md-4
                                col-form-label text-md-right">País</label>
                                <div class="col-md-6">
                                    <input type="text" id="usr_country" class="form-control" name="usr_country"
                                    value="{{old('usr_country')}}"
                                    autofocus>
                                    @if ($errors->has('usr_country'))
                                        <span class="text-danger">{{ $errors->first('usr_country') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="usr_IBAN" class="col-md-4
                                col-form-label text-md-right">IBAN</label>
                                <div class="col-md-6">
                                    <input type="text" id="usr_IBAN" class="form-control" name="usr_IBAN"
                                    value="{{old('usr_IBAN')}}"
                                    required autofocus>
                                    @if ($errors->has('usr_IBAN'))
                                        <span class="text-danger">{{ $errors->first('usr_IBAN') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="user_about" class="col-md-4
                                col-form-label text-md-right">Acerca de</label>
                                <div class="col-md-6">
                                    <input type="text" id="user_about" class="form-control" name="user_about"
                                    value="{{old('user_about')}}"
                                    autofocus>
                                    @if ($errors->has('user_about'))
                                        <span class="text-danger">{{ $errors->first('user_about') }}</span>
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