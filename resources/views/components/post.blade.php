<div class="post content-post" id="{{$id}}">
    <div class="post-img">
        <img src="{{$image}}" alt="profile photo">
    </div>
    <div class="post-body">
        {{-- user / date / options --}}
        <div class="d-flex">
            <span class="user">{{$user}}</span>
            
            <span>·{{$hour}}</span> 
        
            <div class="ml-auto">
                <a href="{{ route('posts.edit', $id) }}">Excluir</a>
            </div>
 

        </div>

        <div class="post-content">
            <p>
                {{$text}}
            </p>
        </div>
        <div class="post-react">
            <div class="react" onclick="like({{$id}})">
                <i class="fa fa-2x fa-thumbs-up"> </i> <span> {{$likes== '0' ? '':$likes}} </span>
            </div>
            <div class="react" onclick="comment()">
                <i class="fa fa-2x fa-comment"> </i> <span> {{$comments}} </span>
            </div>
        </div>
    </div>
</div>

{{-- estilo do component --}}
@push('styles')
<style>     
    .post{
        margin-top:1rem;
        border:1px solid gray;
    }
    .post-img{
        margin-right:1rem;
    }
    .post-img img{
        border-radius:50rem;
        max-width:60px;
        min-width:60px;
        min-height:60px;
        max-height:60px
        margin:1rem;
    }
    .post-body{
        width:100%;
    }
    .post-body .user{
         font-weight: bold;
    }
    .post-react{
        display:inline-flex;
    }
    .post-react .react{
        margin-right:1rem;
        width:10rem;
        display:flex;
        justify-content: center;
        align-items: center;
    }
    .post-react .react i{
        color:transparent;
        -webkit-text-stroke: 1px black; 
    }
    .post-react .react span{
        margin-left:1rem;
    }
    /* após clicar no post */
    /* .post-react .react i:hover{
        color:white;
        -webkit-text-stroke: 1px black; 
    } */
    .react:hover{
        background-color:gray;
    }
</style>
@endpush

@push('scripts')
    <script>
        function like(id){
          console.log(id);
        }
        function comment(){
            console.log("comentou");
        }
    </script>
@endpush