@extends('app')

@section('content')
<div class="wrapper d-flex justify-content-center align-items-center p-0 m-0" style="height:100vh">
    <div class="row" >
        <div class="col col-md-auto">
            <div class="d-flex justify-content-center"> <i class="fa fa-4x fa-twitter"></i> </div>
            <div class="d-flex justify-content-center mb-4"> <h1>Criar contar</h1> </div>
            
         <form style="width:30rem" method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                @csrf
                {{-- image default --}}
                <input type="hidden" name="image" value="https://upload.wikimedia.org/wikipedia/en/e/ee/Unknown-person.gif">

                <div class="col-auto p-0">
                    
                    <div class="form-group mb-4">
                        <label for="name" >Nome</label>

                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror 
                                          
                    </div>

                    <div class="form-group mb-4">
                        <label for="email">E-mail</label>

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                                          
                    </div>
                </div>

                <div class="col-auto p-0">

                    <div class="form-group mb-4">
                        <label for="password">Senha</label>

                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="password-confirm">Confirmar a senha</label>

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

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
                <a href=" {{route('login.index')}} "> <p>voltar</p> </a> 
             </div>
              
              </form>
        </div>
    </div>
</div>
@endsection

