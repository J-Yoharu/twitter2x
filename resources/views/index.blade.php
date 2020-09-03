@extends('app')

@section('content')
<div class="container-fluid" style="font-size:15px">
    <div class="row">
        {{-- menu --}}
        @include('components.menu')

        {{-- conteudo / propaganda--}}
        <div class="col" style="overflow-y:scroll">
         
          {{-- conteudo --}}
          <div class="row" style="min-height:100vh">
            
            {{--twitte / posts --}}
            <div class="col-md-8 p-0 border-left border-right">

              {{-- tweet --}}
              <div style="width:100%" class="content-post">
                <div class="post-img">
                  <img src={{session('user')->image}} alt="profile photo">
                </div>
                <div class="tweet-body">
                  <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="user_id" value={{session('user')->id}}>

                      <textarea rows="2" id="tweetText" placeholder="Whats happening?" name="post"></textarea> 
                      <hr>
                      <div class="tweet-button">
                        <button class="btn btn-primary" type="submit">Tweet</button>
                      </div>
                  </form>
                </div>
              </div>

              {{-- posts --}}

              @foreach ($posts as $post)

                @include('components.post',[
                  'image' => $post->user->image,
                  'user' => $post->user->name,
                  'hour' => $post->created_at,
                  'text' => $post->post,
                  'likes' => $post->likes,
                  'comments' => $post->comments,
                  'id' => $post->id,
                  'userId' => $post->user->id,
                ])
                
              @endforeach
              
            </div>

            {{-- propaganda --}}
            <div class="col">
              propaganda
            </div>
          </div>
        </div>
    </div>
</div> 
  @push('styles')
  <style>
    hr{
      /* background-color:white; */
    }
    .content-post{
      display:inline-flex;
      width:100%;
      padding:1rem;
    }
    .tweet-body{
      width:100%;
    }
    .tweet-body textarea{
      width:100%;
      background-color:transparent;
      border:none;
      font-size:20px;
      outline: none;
      overflow-y:hidden;
      resize:none;
    }
    .tweet-button{
      width:100%;
      display:flex;
      justify-content: flex-end;    
    }

  </style>
  @endpush
 
  @push('scripts')
      <script>

        // textarea listener function
        $("#tweetText").on('keypress',function(e) {
          if(e.which == 13) {
              let currentRow = parseInt(this.getAttribute("rows"));
              this.setAttribute("rows",currentRow+1);
          }
        });

        function enviar(){
          let twitter = $("#tweetText");
          console.log(twitter.val());

          // limpando
          twitter.val("");
          twitter.attr("rows","2");
        }
      </script>
  @endpush
@endsection

