@push('scripts')
<script>
    var html= `
    <div class="d-flex border p-2 mt-4" style="min-height:5rem">
        <div class="col col-sm-auto p-0 m-0 pr-2 d-flex justify-content-center align-items-top"> 
            <img src="imagem" class="rounded-circle" style="max-width:4rem;min-width:4rem;max-height:4rem;min-height:4rem"  alt="profile photo">
        </div>
        <div class="col">
            <div class="row">
                <strong>Usuario</strong>
            </div>
            <div class="row">
                <p class="text-justify" style="width:90%">Texto do post</p> 
            </div>
            <div class="row d-flex">
    
                <div class="mr-5">
                    <i class="fa fa-2x fa-thumbs-up"> </i> 
                    <span> quantidade de likes</span>
                </div>
    
                <div class="react d-flex justify-content-center align-items-center rounded" data-toggle="collapse" data-target="#collapseComment COM ID">
                    <i class="fa fa-2x fa-comment text-white mr-2"></i> 
                    <span> quantidade de comments </span>
                </div>
    
            </div>
            <div class="row collapse mt-0">
                <div class="card card-body">
                    {{-- Aqui vai os comentários --}}
                </div>
            </div>
        </div>
    

    
        <div class="col col-sm-auto">
            <div class="row d-flex">
                <ul class="list-group collapse position-absolute" style="right:2rem;top:0" id="menuCollapse{{$id}}">
    
                    <button class="list-group-item list-group-item-action list-group-item-primary d-flex p-2 font-size">
                        <i class="fa fa-edit mr-2"></i> 
                        <span>Editar</span> 
                    </button>
    
                    <button class="list-group-item list-group-item-action list-group-item-danger d-flex p-2">
                        <i class="fa fa-trash mr-2"></i> 
                        <span>Excluir</span>
                    </button>
    
                </ul>
                <div>
                    <button class="btn btn-sm rounded-circle border"  data-toggle="collapse" data-target="#menuCollapse{{$id}}">
                        <i class="fa fa-ellipsis-h"></i>
                    </button>            
                </div>
            </div>
        </div>
    </div>`;
</script>
@endpush

@push('styles')
<style>
  .fa-comment,.fa-thumbs-up{
    -webkit-text-stroke:1px black;
    color:white;
  }
</style>
@endpush
