<div class="post content-post" id="{{$id}}">
    <div class="post-img">
        <img src="{{$image}}" alt="profile photo">
    </div>
    <div class="post-body">
        {{-- user / date / options --}}
        <div class="d-flex">
            <span class="user">{{$user}}</span>
            
            {{-- <span>·{{$hour}}</span>  --}}
        
            <div class="ml-auto">               
                @if (session('user')->id == $userId)
                <button class="btn btn-sm btn-primary" value=false onclick="confirmEdit(this,{{$id}})" style="width:30px"><i class="fa fa-edit mr-2"></i></button>
                <button class="btn btn-sm p-1 btn-danger" value=false onclick="confirmRemove(this,{{$id}})" style="width:30px"><i class="fa fa-trash"></i></button>
                @endif
            </div>
 

        </div>

        <div class="post-content">
            <p class="outline:none" id="postText{{$id}}" contentEditable="false">{{$text}}<p>
        </div>
        <div class="post-react">
            <div class="react mr-5 d-flex justify-content-center align-items-center rounded" onclick="like({{$id}},{{$userId}})">
                <i class="fa fa-2x fa-thumbs-up"> </i> <span> {{$likes== null ? 0:$likes}} </span>
            </div>
            <div class="react d-flex justify-content-center align-items-center rounded" onclick="comment({{$id}},{{$userId}})">
                <i class="fa fa-2x fa-comment"> </i> <span> {{$comments == null ? 0:$comments}} </span>
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
        async function like(postId,userId){
            
            let request = await axios.get(`http://twitter2x.test/posts/${postId}`);
            console.log(request.data.likes)
            let validation = null;
            request.data.likes.forEach(like => {
                if(like.user_id == userId ){
                    return validation = "yes";
                }
            });
            console.log(validation);
           //let like = await axios.post('http://twitter2x.test/likes', { post_id: postId,user_id: userId});

        }
        function confirmEdit(obj,id){
            if(obj.value=="true"){
                edit(id);
                obj.value=false
                obj.className="btn btn-sm btn-primary";
                obj.innerHTML="<i class='fa fa-edit'></i>"
                return true
            }
            obj.value=true
            console.log(document.getElementById(id));
            obj.className="btn btn-sm btn-success";
            obj.innerHTML="<i class='fa fa-check'></i>";
            postText = document.getElementById(`postText${id}`);
            postText.setAttribute("contentEditable","true");
            postText.focus();

        }
        async function edit(id){
            postText = document.getElementById(`postText${id}`);
            postText.setAttribute("contentEditable","false");
            console.log("chamou")
            let request = await axios.put(`http://twitter2x.test/posts/${id}/edit`,{post:postText.innerText})
                .then(()=>{
                    console.log("sucesso")
                })

            
        }
        function confirmRemove(obj,id){
            obj.value == "true" ? remove(id):false
            obj.value=true

            obj.className="btn btn-sm btn-success";
            obj.innerHTML="<i class='fa fa-check'></i>";
        }
        async function remove(id){
            let request = await axios.delete(`http://twitter2x.test/posts/${id}/delete`)
                .then(()=>{
                    document.getElementById(id).remove();
                })
    


        }
    </script>
@endpush