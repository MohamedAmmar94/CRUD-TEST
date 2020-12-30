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
        <form method="POST" action="{{ route("categories.update", [$category->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required>

                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label for="user_id">parent</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="parent" id="user_id">
                    <option selected value="">Main Category</option>
                    @foreach($categories as $id => $item)
                        <option value="{{ $item->id }}" {{ old('parent') == $item->id ? 'selected' :(($category->parent == $item->id) ? 'selected':'')  }}>{{ $item->name }}</option>
                    @endforeach
                </select>

                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="" for="logo">logo</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="file" name="logo" id="logo"  accept="image/png, image/jpeg, image/jpg" >

                @if($category->logo_url)
                    <div class="img-container">
                        <img class="index-gallary" src="{{$category->logo_url}}">
                        <button type="button" class="del-btn " onclick="delete_logo('{{$category->logo->id}}')" >x</button>
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label for="website">website</label>
                <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', $category->website) }}">

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
        function delete_logo(id){
            swal({
            title: "Are you Sure ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                //console.log("ddd");
            //    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var url = '{{ route("category.delete_logo", ":id") }}';
                    url = url.replace(':id', id);
                      $.ajax({
                           url:url,
                           type:'post',
                           data: {_token : '{{ csrf_token() }}'},

                     }).done( function(data){
            			console.log(data);
            			if(data==true){
                            $('.img-container').hide();
                            Notiflix.Notify.Success('logo deleted successful ');
                        }else{
                             Notiflix.Notify.Failure('somethig went wronge ');
                        }
                    });
                }
            });
        }
    </script>
@endsection
