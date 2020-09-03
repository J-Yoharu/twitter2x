@extends('app')

@section('content')
<div class="wrapper d-flex justify-content-center align-items-center p-0 m-0" style="height:100vh">
    <div class="row" >
        <div class="col col-md-auto">
            <div class="d-flex justify-content-center"> <i class="fa fa-4x fa-twitter"></i> </div>
            <div class="d-flex justify-content-center mb-4"> <h1>Entrar no Twitter</h1> </div>
            
            <form style="width:30rem" method="POST" action="{{ route('login.auth') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-auto p-0">

                  @if($error ?? false)
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                      </button>
                        <strong>{{$error}}</strong> <br>                          
                    </div>
                  @endif

                    <div class="input-group mb-4">
                      <div class="input-group-prepend">
                        <div class="input-group-text"> <i class="fa fa-2x fa-at"></i> </div>
                      </div>
                      <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror                    </div>
                </div>

                <div class="col-auto p-0">
                    <div class="input-group mb-4">
                      <div class="input-group-prepend">
                        <div class="input-group-text"> <i class="fa fa-2x fa-key"></i> </div>
                      </div>
                      <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-block btn-primary">
                  {{ __('Login') }}
              </button>
              
                <div class="mt-5 d-flex justify-content-center">
                   <a href=" {{route('login.register')}} "> <p>inscrever-se</p> </a> 
                </div>
              </form>
        </div>
    </div>
</div>
@endsection