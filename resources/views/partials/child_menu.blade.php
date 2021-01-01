@foreach($childs as $child)
    <li class=" @if(count($child->childs)) dropdown @endif">
      <a href="{{route('products.index',['category'=>$child->id])}}">{{$child->name}}</a>

      @if(count($child->childs))
          <ul class="submenu">
            @include('partials.child_menu',['childs' => $child->childs])
          </ul>
       @endif
  </li>
@endforeach
