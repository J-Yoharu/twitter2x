<div class="d-flex border p-2 mt-4" id="postContainer{{$id}}" style="min-height:5rem">
    {{-- image --}}
    <div class="col col-sm-auto p-0 m-0 pr-2 d-flex justify-content-center align-items-top" id="image{{$image}} "> 
        <img src="{{$image}}" class="rounded-circle" style="max-width:4rem;min-width:4rem;max-height:4rem;min-height:4rem"  alt="profile photo">
    </div>
    {{-- body --}}
    <div class="col">
        <div class="row">
            <strong id="userName{{$user}}">{{$user}}</strong>
        </div>
        <div class="row">
            <p class="text-justify" id="post{{$id}}"  style="width:90%">{{$post->post}}</p> 
        </div>
        <div class="row d-flex">

            <div class="mr-5" onclick="like({{$id}},{{session('user')->id}})">
                <i class="fa fa-2x fa-thumbs-up 
                    {{$postsLiked->contains('post_id',$id) ? "text-primary":"text-white"}}
               " id="likeIcon{{$id}}"> </i> <span id="likesCount{{$id}}"> {{$likes== null ? 0:$likes}} </span>
            </div>

            <div class="react d-flex justify-content-center align-items-center rounded" data-toggle="collapse" data-target="#collapseComment{{$id}}" onclick="comment({{$id}},{{$userId}})">
                <i class="fa fa-2x fa-comment text-white mr-2"> </i> <span id="commentsCount{{$id}}"> {{$comments == null ? 0:$comments}} </span>
            </div>

        </div>
        <div class="row collapse mt-0" id="collapseComment{{$id}}">
            <div class="card card-body" id="comments{{$id}}">
                
            </div>
        </div>
    </div>
    {{-- menu --}}
    @if (session('user')->id==$userId)
    <div class="col col-sm-auto">
        <div class="row d-flex">
            <ul class="list-group collapse position-absolute" style="right:2rem;top:0" id="menuCollapse{{$id}}">
                <button class="list-group-item list-group-item-action list-group-item-primary d-flex p-2 font-size" onclick="edit(this,{{$id}})"><i class="fa fa-edit mr-2"></i> <span>Editar</span> </button>
                <button class="list-group-item list-group-item-action list-group-item-danger d-flex p-2" onclick="remove(this,{{$id}})"><i class="fa fa-trash mr-2"></i> <span>Excluir</span></button>
            </ul>
            <div>
                <button class="btn btn-sm rounded-circle border"  data-toggle="collapse" data-target="#menuCollapse{{$id}}"><i class="fa fa-ellipsis-h"></i></button>            
            </div>
        </div>
    </div>
    @endif
</div>