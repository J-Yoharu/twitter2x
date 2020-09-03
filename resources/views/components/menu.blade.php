<div class="col-md-3 pl-5">
    <ul class="nav flex-column position-fixed" style="height:100vh">
        
        <li class="nav-item">
            <i class="{{$icon ?? 'fa fa-2x fa-twitter'}}"></i>
        </li>

        <li class="nav-item d-flex align-items-center mt-2">
            <i class="fa fa-2x fa-home"></i>
            <a href="{{route('index')}}"><h4 class="nav-link active">Home</h4></a>
        </li>

        <li class="nav-item d-flex align-items-center mt-2">
            <i class="fa fa-2x fa-window-close"></i>
            <a href="{{ route('login.index') }}">
            
            <h4 class="nav-link"> Sair </h4>  
            </a>
        </li>
        </ul>
      
      <form id="logout-form" method="POST" class="d-none">
        @csrf
    </form>         
</div>