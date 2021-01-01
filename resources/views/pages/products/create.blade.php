@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Product
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("products.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">title</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>

                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="required" for="description">description</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"  name="description" id="description"  required>{{ old('description', '') }}</textarea>

                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label for="category">category</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category" id="category" >
                    <option selected value="">Main Category</option>
                    @foreach($categories as $id => $item)
                        <option value="{{ $item->id }}" {{ old('category') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">

                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="required" for="price">price</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" required>

                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="" for="images">images</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="file" name="images[]" id="images"  accept="image/png, image/jpeg, image/jpg" multiple>

                <span class="help-block"></span>
            </div>


            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    save
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
               if ($("#images")[0].files.length > 2) {
                    Notiflix.Notify.Failure('Max number of images is 2');
                   $("#images").val("");
               }

         });
     });
    </script>
@endsection
