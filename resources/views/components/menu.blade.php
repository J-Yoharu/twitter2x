<div class="col-4">
    <div class="position-fixed d-flex justify-content-end h-100" style="width:22vw">
        <ul class="nav flex-column h-100 " >
        
            <li class="nav-item">
                <i class="{{$icon ?? 'fa fa-2x fa-twitter'}}"></i>
            </li>
    
            <li class="nav-item d-flex align-items-center mt-2">
                <i class="fa fa-2x fa-home"></i>
                <a href="{{route('index')}}"><h4 class="nav-link active">Home</h4></a>
            </li>
    
            <li class="nav-item d-flex mt-2">

            </li>
            <li class="mt-auto">
                <div class="row mb-3 d-flex justify-content-center">
                    <ul class="list-group collapse w-75" id="profileCollapse">
    
                        {{-- <button class="list-group-item list-group-item-action d-flex  font-size">
                            <i class="fa fa-edit mr-2"></i> 
                            <span>Editar</span> 
                        </button> --}}
                        <a href="{{ route('login.index') }}" class="list-group-item list-group-item-action d-flex"> 
                                <i class="fa fa-window-close mr-2"></i>
                                <span> Sair </span>  
                        </a>
        
                    </ul>
                </div>
                <div class="row d-flex justify-content-center text-white rounded-pill border p-1 mt-auto">

                    <div class="col-md-auto p-0 m-0 d-flex justify-content-center align-items-top">
                        <img src={{session('user')->image}} class="rounded-circle" style="max-width:3rem;min-width:3rem;max-height:3rem;min-height:3rem" alt="profile photo">
                    </div>
                    <div class="col d-flex justify-content-center align-items-center text-dark">
                      <div class="p-2 bd-highlight">
                        <span>{{session('user')->name}} </span>
                      </div>
                      <div class="p-2 bd-highlight" data-toggle="collapse" data-target="#profileCollapse">
                        <i class="fa fa-caret-down"></i>
                      </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>



      
      <form id="logout-form" method="POST" class="d-none">
        @csrf
    </form>   
 
</div>