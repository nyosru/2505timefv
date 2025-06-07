<div class="mt-1">

    <livewire:cms2.app.breadcrumb
            {{--            :board_id="$leed->column->board_id"--}}
            {{--            :board_id=""--}}
            :menu="[
                    ['route'=>'events.index','name'=>'Мероприятия', 'route-var' => [] ]
                    ,
                    ['route'=>'events.show','name'=>( strlen($event->title) > 50 ? substr($event->title, 0, 50) . '...' : ( $event->title  ?? '-') ), 'route-var' => [ 'id' => $event->id ] ]
{{--                    [--}}
{{--                        'route'=>'leed',--}}
{{--                        'name'=>( $leed->column->board->name ?? 'x' )--}}
{{--                    ],--}}
{{--                     [ 'link' => 'no', 'name'=> ( ($leed->name ?? '-') ) ]--}}
                 ]"
    />

    <div id="event-details-container" class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-lg ">

        <div class="flex flex-col md:flex-row gap-8">
            <!-- Левая часть: изображение и основная информация -->
            <div class="md:w-1/3">
                <div
                        class="w-full h-64 rounded-lg bg-cover bg-center shadow-md"
                        {{--                    style="background-image: url('https://media.istockphoto.com/id/502301173/ru/%D1%84%D0%BE%D1%82%D0%BE/%D1%81%D0%BF%D0%BE%D1%80%D1%82%D0%B8%D0%B2%D0%BD%D1%8B%D1%85-%D0%B3%D0%B5%D1%80%D0%BE%D0%B8.jpg?s=612x612&amp;w=0&amp;k=20&amp;c=hvF4ffHr63Qy3uATLQovIvCfV0uxVmbmjLxVjc4V-zs=')"--}}
                        style="background-image: url('{{ asset('storage/'.$event->photo) }}')"
                        aria-label="Фото мероприятия"
                ></div>

                {{--            <h1 class="text-3xl font-bold mt-6 mb-4">Кубок губернатора Тюменской области</h1>--}}



            </div>

            <!-- Правая часть: медиа и дополнительные секции -->
            <div class="md:w-2/3 flex flex-col gap-8">

                <h1 class="text-3xl font-bold mt-6 mb-4">{{ $event->title ?? '-' }}</h1>


                <div class="space-y-3 text-gray-700">
                    {{--                <div>--}}
                    {{--                    <span class="font-semibold">Вид спорта:</span>--}}
                    {{--                    <a href="#" class="text-blue-600 hover:underline ml-1">Футбол</a>--}}
                    {{--                </div>--}}
                    <div>
                        <span class="font-semibold">Место проведения:</span>
                        {{--                    <a href="#" class="text-blue-600 hover:underline ml-1">Тюмень</a>--}}
                        {{ $event->sportPlace->city->country->name  ?? '--' }}<br>
                        @if( !empty($event->sportPlace->city->name) )
                            {{ $event->sportPlace->city->name }}<br>
                        @endif
                        {{--{{ $event->sportPlace->city->name  ?? '--' }}<br>--}}
                        {{ $event->sportPlace->name ?? '--' }}<br>
                        {{--                        adress:{{ $event->sportPlace->adress ?? '--' }}<br>--}}

                    </div>


                    {{--                    <span class="ml-1">20.12.2025 - 24.12.2026</span>--}}
                    @if( !empty($event->event_date) )
                        <div>
                            <span class="font-semibold">Период проведения:</span>
                            @if( !empty($event->events_date_finished) )
                                с
                            @endif
                            {{$event->event_date->format('d.m.Y') }}
                            @if( !empty($event->events_date_finished) )
                                по {{$event->events_date_finished->format('d.m.Y') }}
                            @endif
                        </div>
                    @else

                    @endif

                </div>



            </div>

        </div>

{{--        <pre class="text-xs">{{ print_r($event->toArray(), true) }}</pre>--}}

        <!-- Фото с мероприятия -->
        <section class="my-5">
            <livewire:event.show-photo-list :event="$event"/>
        </section>

        <!-- Видео с мероприятия -->
        @if( count($event->videos) > 0  )
            <section>
                <h2 class="text-xl font-semibold mb-4">Видео</h2>
                @foreach( $event->videos as $video)
                    @if( strpos($video->url_video, 'vkvideo.ru') !== false )
                        <a
                                href="{{ $video->url_video }}"
                                target="_blank">Видео video - #{{ $video->id }}</a>
                        <br clear="all"/>
                    @endif
                @endforeach
            </section>
        @endif

        <section>
            <h2 class="text-xl font-semibold mb-4">Документы</h2>

            {{--                    <div class="grid grid-cols-3 gap-4">--}}
            @foreach($event->docs as $attachment)
                <div class="mb-1">
                    @php
                        $filename = '/file-icon/48px/' . substr($attachment->filename, -3) . '.png';
                    @endphp

                    {{--                            <div class="flex flex-col items-center justify-center space-x-2 w-full">--}}

                    {{--                                <div class="flex-1">--}}
                    <a href="{{ Storage::url($attachment->url) }}" target="_blank">
                        @if(file_exists(public_path($filename)))
                            <img src="{{ $filename }}" class="inline" alt=""/>
                        @else
                            <strong class="text-lg font-bold
                            border-gray-800
                            border border-1
                            px-2 py-1 mr-1 mb-1
                            rounded">{{ substr($attachment->filename, -4) }}</strong>
                        @endif
                    </a>
                    {{--                                </div>--}}

                    {{--                                <div class="flex-auto">--}}
                    <a href="{{ Storage::url($attachment->url) }}" target="_blank">
                        <strong>{{ $attachment->name ?? $attachment->filename }}</strong>
                    </a>
                </div>
                {{--                            </div>--}}
            @endforeach
            {{--            </div>--}}
        </section>

        @if(1==2)
            <!-- Сетки с колонками -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Колонка 1 -->
                <div class="space-y-8">
                    <!-- Пьедестал -->
                    <section>
                        <h3 class="text-lg font-semibold mb-3">Пьедестал</h3>
                        <ul class="space-y-2">
                            @foreach([
                              ['name' => 'Исматов М', 'medal' => 'gold.svg'],
                              ['name' => 'Точиев С', 'medal' => 'gold.svg'],
                              ['name' => 'Казаков А', 'medal' => 'gold.svg'],
                              ['name' => 'Киселев В', 'medal' => 'silver.svg'],
                              ['name' => 'Петров С', 'medal' => 'silver.svg'],
                              ['name' => 'Галеев Д', 'medal' => 'bronze.svg'],
                              ['name' => 'Концевенко М', 'medal' => 'bronze.svg'],
                            ] as $index => $person)
                                <li class="flex items-center gap-3">
                                    <div class="w-6 font-semibold text-gray-600">{{ $index + 1 }}.</div>
                                    <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                                    <span>{{ $person['name'] }}</span>
                                    <img src="assets/{{ $person['medal'] }}" alt="Медаль"
                                         class="w-5 h-5 ml-auto"/>
                                </li>
                            @endforeach
                        </ul>
                    </section>

                    <!-- Организаторы -->
                    <section>
                        <h3 class="text-lg font-semibold mb-3">Организаторы</h3>
                        <ul class="space-y-2">
                            @foreach(['Спортивная федерация', 'Городская администрация'] as $index => $org)
                                <li class="flex items-center gap-3">
                                    <div class="w-6 font-semibold text-gray-600">{{ $index + 1 }}.</div>
                                    <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                                    <span>{{ $org }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                </div>

                <!-- Колонка 2 -->
                <div class="space-y-8">
                    <!-- СМИ -->
                    <section>
                        <h3 class="text-lg font-semibold mb-3">СМИ</h3>
                        <ul class="space-y-2">
                            @foreach(['Спортивный канал', 'Городская газета', 'Онлайн-портал'] as $index => $media)
                                <li class="flex items-center gap-3">
                                    <div class="w-6 font-semibold text-gray-600">{{ $index + 1 }}.</div>
                                    <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                                    <span>{{ $media }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </section>

                    <!-- Спонсоры -->
                    <section>
                        <h3 class="text-lg font-semibold mb-3">Спонсоры</h3>
                        <ul class="space-y-2">
                            @foreach(['Главный спонсор', 'Технический партнер'] as $index => $sponsor)
                                <li class="flex items-center gap-3">
                                    <div class="w-6 font-semibold text-gray-600">{{ $index + 1 }}.</div>
                                    <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                                    <span>{{ $sponsor }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                </div>

            </div>

            <!-- Почётные гости и судьи -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                <!-- Почётные гости -->
                <section>
                    <h3 class="text-lg font-semibold mb-3">Почётные гости</h3>
                    <ul class="space-y-2">
                        @foreach(['Мэр города', 'Олимпийский чемпион'] as $index => $guest)
                            <li class="flex items-center gap-3">
                                <div class="w-6 font-semibold text-gray-600">{{ $index + 1 }}.</div>
                                <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                                <span>{{ $guest }}</span>
                            </li>
                        @endforeach
                    </ul>
                </section>

                <!-- Судьи -->
                <section>
                    <h3 class="text-lg font-semibold mb-3">Судьи</h3>
                    <ul class="space-y-2">
                        @foreach(['Главный судья', 'Судья на линии', 'Хронометрист'] as $index => $judge)
                            <li class="flex items-center gap-3">
                                <div class="w-6 font-semibold text-gray-600">{{ $index + 1 }}.</div>
                                <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                                <span>{{ $judge }}</span>
                            </li>
                        @endforeach
                    </ul>
                </section>
            </div>

            <!-- Посетители (на всю ширину) -->
            <section class="mt-8">
                <h3 class="text-lg font-semibold mb-3">Посетители</h3>
                <ul class="space-y-2">
                    @foreach([
                      'VIP-гости (50 человек)',
                      'Корпоративные клиенты (120 человек)',
                      'Общие зрители (500 человек)'
                    ] as $index => $visitor)
                        <li class="flex items-center gap-3">
                            <div class="w-6 font-semibold text-gray-600">{{ $index + 1 }}.</div>
                            <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                            <span>{{ $visitor }}</span>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif

        @if( $event->athletes->count() > 0 )
            <livewire:event.informer.event-participiant-list :list="$event->groupsNagrada"/>
        @endif


        <div class="flex flex-col md:flex-row xgap-8 flex-wrap">

            @if( $event->guests->count() > 0 )
                <livewire:event.informer.event-guests-list :list="$event->guests"/>
            @endif
            @if( $event->sponsors->count() > 0 )
                <livewire:event.informer.event-sponsor-list :list="$event->sponsors"/>
            @endif
{{--            <div>--}}
{{--                <pre class="text-xs">{{ print_r($event->toArray(),1) }}</pre>--}}
{{--            </div>--}}

{{--        @foreach(range(1, 5) as $index )--}}
{{--            <section class="w-full md:w-1/2 lg:w-1/3 mt-8">--}}
{{--                <h2 class="text-xl font-semibold mb-3">Спортсмены</h2>--}}
{{--                <ul class="space-y-2">--}}
{{--                    @foreach(['Исматов М', 'Точиев С', 'Казаков А', 'Киселев В', 'Петров С', 'Галеев Д', 'Концевенко М'] as $index => $athlete)--}}
{{--                        <li class="flex items-center gap-3">--}}
{{--                            <div class="w-6 font-semibold text-gray-600">{{ $index + 1 }}.</div>--}}
{{--                            <div class="w-10 h-10 rounded-full bg-gray-300"></div>--}}
{{--                            <span>{{ $athlete }}</span>--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </section>--}}
{{--        @endforeach--}}
</div>
</div>

</div>


