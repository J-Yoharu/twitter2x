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
                {{session()->get('user')->name}}
              <div style="width:100%" class="content-post">
                <div class="post-img">
                  <img src={{session()->get('user')->image}} alt="profile photo">
                </div>
                <div class="tweet-body">
                  <form action="{{ route('index') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="id_user">
                      <input type="hidden" name="likes" value="0">

                      <textarea rows="2" id="tweetText" placeholder="Whats happening?" name="data"></textarea> 
                      <hr>
                      <div class="tweet-button">
                        <button class="btn btn-primary" type="submit">Tweet</button>
                      </div>
                  </form>
                </div>
              </div>

              {{-- posts --}}

              {{-- @foreach ($posts as $post) --}}

                {{--@component('components.post','teste')
                    @slot('userImg',"{$post->image}")
                    @slot('hour',"{$post->created_at}")
                    @slot('user',"{$post->name}")
                    @slot('text',"{$post->data}")
                    @slot('likes',"{$post->likes}") 
                    @slot('comments','10')
                @endcomponent --}}

                {{-- @include('components.post',[
                  'image' => $post->image,
                  'user' => $post->name,
                  'hour' => $post->created_at,
                  'text' => $post->data,
                  'likes' => $post->likes,
                  'comments' => $post->comments,
                  'id' => $post->id_post,
                ])
                
              @endforeach --}}
              
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

