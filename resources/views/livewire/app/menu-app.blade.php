<div class="flex justify-center items-center">

    @if( $type == 'tech')
        <div class="flex flex-row flex-wrap space-x-1 my-2">
            @foreach( $menus as $menu )
                {{--                <pre>{{ print_r($menu->label) }}</pre>--}}
                @if(
                    !empty($menu['label']) && !empty($menu['route'])
                )
                    <livewire:app.menuItem label="{{ $menu['label'] ?? 'x' }}" routeName="{{ $menu['route'] }}"
                                           active="{{ $menu['active'] ?? false }}"
                    />
                @endif
            @endforeach
        </div>

    @else
        <div class="flex justify-center
my-2
text-lg
{{--items-center--}}
">

            <div class="flex flex-row space-x-3">
                <div>
                    <livewire:app.menuItem label="Новости" routeName="news"
                                           :active="( Request::routeIs('news') || Request::is('news*')   || Request::is('/')  )"/>
                </div>
                <div>
                    <livewire:app.menuItem label="Мероприятия" routeName="events.index"
                                           :active="( Request::routeIs('events*') )"/>
                </div>
                <div>
                    <livewire:app.menuItem label="Спортсмены" routeName="athletes.index"
                                           :active="( Request::routeIs('athletes*')  )"/>
                </div>
            </div>
        </div>
    @endif
</div>