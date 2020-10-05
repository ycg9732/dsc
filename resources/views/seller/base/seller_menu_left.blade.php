<div class="ecsc-layout-left">
    <div class="sidebar" id="sidebar">
        <div class="column-menu">

            <ul id="seller_center_left_menu">

                @foreach($seller_menu as $menu)

                    @if(isset($menu['action']) && isset($menu_select['action']) && $menu['action'] == $menu_select['action'])

                        @foreach($menu['children'] as $key=>$child)

                            <li id="quicklink_{{ $child['action'] }}"
                                @if($menu_select['current'] == $child['action'] || $menu_select['current_2'] == $child['action'] )
                                class="current"
                                    @endif
                            ><a href="{{ $child['url'] }}" title="{{ $child['label'] }}"> {{ $child['label'] }} </a>
                                <div class="arrow"></div>
                            </li>

                        @endforeach

                    @endif

                @endforeach

            </ul>
        </div>
    </div>
</div>