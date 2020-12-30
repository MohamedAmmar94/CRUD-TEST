@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Show Title
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('products.index') }}">
                    Go Back
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            id
                        </th>
                        <td>
                            {{ $product->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Title
                        </th>
                        <td>
                            {{ $product->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            description
                        </th>
                        <td>
                            {{ $product->description }}

                        </td>
                    </tr>
                    <tr>
                        <th>
                            category
                        </th>
                        <td>
                            {{ $product->category_name ?  $product->category_name->name :''}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            price
                        </th>
                        <td>
                            {{ $product->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            category
                        </th>
                        <td>
                            <div class="row">
                            @if($product->images_url && count($product->images_url) >0)
                                @foreach($product->images_url as $img)
                                    <div class="img-container" id="img-{{$img['id']}}">
                                        <img class="index-gallary" src="{{$img['image_url']}}">
                                    </div>
                                @endforeach
                            @endif
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('products.index') }}">
                    Go Back
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
