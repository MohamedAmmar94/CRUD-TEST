
<nav id="mainnav" class="mainnav">
    <ul class="menu">
        @foreach ($parent_category as $key => $cat)

                <li class="dropdown">
                  <a href="{{route('products.index',['category'=>$cat->id])}}">{{$cat->name}}</a>
                  @if(count($cat->childs)>0)
                  <ul class="submenu">
                       @include('partials.child_menu',['childs' => $cat->childs])
                  </ul>
                  @endif
                 <li>


        @endforeach
        {{-- <li class="dropdown">
        <a href="">Service</a>
        <ul class="submenu">
          <li>
            <a href="">satu</a>
          </li>
          <li class="dropdown">
            <a href="">dua</a>
            <ul class="submenu">
              <li class="dropdown">
                <a href="">jeruh dua</a>
                <ul class="submenu">
                  <li>
                    <a href="">mentok satu</a>
                  </li>
                  <li class="dropdown">
                    <a href="">mentok dua</a>
                    <ul class="submenu">
                      <li>
                        <a href="">njedok prend satu</a>
                      </li>
                      <li>
                        <a href="">njedok prend dua</a>
                      </li>
                      <li>
                        <a href="">njedok prend tiga</a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="">mentok satu</a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="">jeruh satu</a>
              </li>
            </ul>
          </li>
      </ul>
      </li>
      <li><a href="">Other</a></li>
           --}}

    </ul>

</nav>
