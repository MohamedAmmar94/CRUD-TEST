@extends('layouts.admin')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('products.create') }}">
                Add Product
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        products List
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-product">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            id
                        </th>
                        <th>
                            title
                        </th>
                        <th>
                            description
                        </th>
                        <th>
                            price
                        </th>
                        <th>
                            category
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
                            <input class="search" type="text" placeholder="Search">
                        </td>

                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>

                    @foreach($products as $key => $product)
                        <tr data-entry-id="{{ $product->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $product->id ?? '' }}
                            </td>
                            <td>
                                {{ $product->title ?? '' }}
                            </td>
                            <td>
                                {{ $product->description ?? '' }}
                            </td>
                            <td>
                                {{ $product->price ?? '' }}

                            </td>
                            <td>

                                {{ $product->category_name ? $product->category_name->name : '' }}
                            </td>
                            <td>
                                {{ $product->updated_at ?? '' }}
                            </td>
                            <td>

                                    <a class="btn btn-xs btn-primary" href="{{ route('products.show', $product->id) }}">
                                        View
                                    </a>



                                    <a class="btn btn-xs btn-info" href="{{ route('products.edit', $product->id) }}">
                                        Edit
                                    </a>



                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are You Sure');" style="display: inline-block;">
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
        $('.table-striped').DataTable( {
           "order": [[ 6, "desc" ]],
         });
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)




  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
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
