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
        @permission('р.Техничка')
        <div>
            <livewire:app.menuItem label="Техничка" routeName="tech.index"
                                   :active="( Request::routeIs('tec*') || Request::routeIs('admi*')  )"/>
        </div>
        @endpermission
    </div>
</div>
