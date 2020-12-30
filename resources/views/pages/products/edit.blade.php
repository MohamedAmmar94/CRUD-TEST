@extends('layouts.admin')
@section('styles')
    <style>

.del-btn{
    position: absolute;
    top:5px;
    right: 5px;
    z-index:99;
    background-color: #d5d5d59e;
    border: none;
    border-radius: 50%;
}
.img-container{
    width: fit-content;
    position: relative;
    margin:10px;
}
    </style>
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        Edit Category
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("products.update", [$product->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label class="required" for="title">title</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('name', $product->title) }}" required>

                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="required" for="description">description</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"  name="description" id="description"  required>{{ old('name', $product->description) }}</textarea>

                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label for="category">category</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category" id="category">
                    <option selected >Select Category</option>
                    @foreach($categories as $id => $item)
                        <option value="{{ $item->id }}" {{ old('category') == $item->id ? 'selected' :(($product->category == $item->id) ? 'selected':'')  }}>{{ $item->name }}</option>
                    @endforeach
                </select>

                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="required" for="price">price</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required>

                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="" for="logo">images</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="file" name="images[]" id="images"  accept="image/png, image/jpeg, image/jpg" multiple>
                <div class="row">
                    @if($product->images_url && count($product->images_url) >0)
                        @foreach($product->images_url as $img)
                            <div class="img-container" id="img-{{$img['id']}}">
                                <img class="index-gallary" src="{{$img['image_url']}}">
                                <button type="button" class="del-btn " onclick="delete_image('{{$img['id']}}')" >x</button>
                            </div>
                        @endforeach
                    @endif
                </div>
                
                <input type="hidden" name="count" id="count" value="{{$product->images_url ? count($product->images_url):0}}">
                <span class="help-block"></span>
            </div>


            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
    <script>
    $(document).ready(function(){
        $("#images").on("change", function(e) {
            var count=$("#count").val();
              if ($("#images")[0].files.length > 2-count) {
                   Notiflix.Notify.Failure('Max number of images is 2');
                  $("#images").val("");
              }

        });
    });
        function delete_image(id){
            swal({
            title: "Are you Sure ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var url = '{{ route("product.delete_image", ":id") }}';
                    url = url.replace(':id', id);
                      $.ajax({
                           url:url,
                           type:'post',
                           data: {_token : '{{ csrf_token() }}'},

                     }).done( function(data){
            			console.log(data);
            			if(data==true){
                            $('#img-'+id).hide();
                            var count=$("#count").val();
                            $("#count").val(count+1);
                            Notiflix.Notify.Success('image deleted successful ');
                        }else{
                             Notiflix.Notify.Failure('somethig went wronge ');
                        }
                    });
                }
            });
        }
    </script>
@endsection
