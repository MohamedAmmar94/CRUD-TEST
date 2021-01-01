@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('categories.create') }}">
                Add Category
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        Category List
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Client">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            id
                        </th>
                        <th>
                            name
                        </th>
                        <th>
                            parent
                        </th>
                        <th>
                            logo
                        </th>
                        <th>
                            updated_at
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="Search">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="Search">
                        </td>
                        <td>
                            <select class="search">
                                <option  value> All Category</option>
                                @foreach($categories as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="Search">
                        </td>

                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $key => $category)
                        <tr data-entry-id="{{ $category->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $category->id ?? '' }}
                            </td>
                            <td>
                                {{ $category->name ?? '' }}
                            </td>
                            <td>
                                {{ $category->parent_category? $category->parent_category->name : '' }}
                            </td>
                            <td>
                                @if($category->logo_url)
                                    <img class='index-gallary gallary' src='{{$category->logo_url}}'>
                                @endif

                            </td>
                            <td>
                                {{ $category->updated_at ?? '' }}
                            </td>
                            <td>

                                    <a class="btn btn-xs btn-primary" href="{{ route('categories.show', $category->id) }}">
                                        View
                                    </a>



                                    <a class="btn btn-xs btn-info" href="{{ route('categories.edit', $category->id) }}">
                                        Edit
                                    </a>



                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are You Sure');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form>


                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>

    $(function () {

  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)




  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 5, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Client:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  $('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value
      table
        .column($(this).parent().index())
        .search(value, strict)
        .draw()
  });
})

</script>
@endsection
