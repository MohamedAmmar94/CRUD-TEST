@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Category
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("categories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label for="user_id">parent</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="parent" id="user_id">
                    <option selected value="">Main Category</option>
                    @foreach($categories as $id => $item)
                        <option value="{{ $item->id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">

                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="" for="logo">logo</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="file" name="logo" id="logo" value="{{ old('logo', '') }}" accept="image/png, image/jpeg, image/jpg" >
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label for="website">website</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', '') }}">
                @if($errors->has('website'))
                    <div class="invalid-feedback">
                        required
                    </div>
                @endif
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
         $("#logo").on("change", function(e) {
               let img = new Image()
                  img.src = window.URL.createObjectURL(event.target.files[0])
                  img.onload = () => {
                      console.log(img.width+" - "+img.height);
                      if(img.width <100 || img.height<100 ){
                           Notiflix.Notify.Failure('min width and height is 100 px');
                            $("#logo").val("");
                      }
                  }

         });
     });
    </script>
@endsection
