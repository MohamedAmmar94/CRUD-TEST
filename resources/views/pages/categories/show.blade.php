@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Show Category
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('categories.index') }}">
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
                            {{ $category->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Name
                        </th>
                        <td>
                            {{ $category->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Logo
                        </th>
                        <td>
                            @if($category->logo_url)
                            <img class="index-gallary" src="{{$category->logo_url}}">
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            website
                        </th>
                        <td>
                            {{ $category->website }}
                        </td>
                    </tr>

                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('categories.index') }}">
                    Go Back
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
