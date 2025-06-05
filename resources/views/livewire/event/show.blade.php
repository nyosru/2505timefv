<div>

    <div id="event-details-container" class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">

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


                <div class="space-y-3 text-gray-700">
                    {{--                <div>--}}
                    {{--                    <span class="font-semibold">Вид спорта:</span>--}}
                    {{--                    <a href="#" class="text-blue-600 hover:underline ml-1">Футбол</a>--}}
                    {{--                </div>--}}
                    <div>
                        <span class="font-semibold">Место проведения:</span>
                        {{--                    <a href="#" class="text-blue-600 hover:underline ml-1">Тюмень</a>--}}
                        {{ $event->sportPlace->city->country->name  ?? '--' }}<br>
                        {{ $event->sportPlace->city->name  ?? '--' }}<br>
                        {{ $event->sportPlace->name ?? '--' }}<br>
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

            <!-- Правая часть: медиа и дополнительные секции -->
            <div class="md:w-2/3 flex flex-col gap-8">

                <h1 class="text-3xl font-bold mt-6 mb-4">{{ $event->title ?? '-' }}</h1>

                <!-- Фото с мероприятия -->
                <section>

                                        <pre class="max-h-[200px] overflow-auto p-2 text-xs">{{ print_r($event->toArray(),1) }}</pre>

                    @php
                        // Пример: массив ссылок на фото
                        $photos = [
    //                        asset('storage/events/photo1.jpg'),
    //                        asset('storage/events/photo2.jpg'),
    //                        asset('storage/events/photo3.jpg'),
                        ];
                        foreach( $event->photos as $k => $v )
                            {
    //                            $photos[] = asset($v->url);
                                if(!empty($v->url)){
                                $photos[] = asset('storage/'.$v->url);
                            }
                            }
                    @endphp

                    @if( count($photos) > 0 )
                        <section x-data="{ open: false, current: 0, photos: {{ Js::from($photos) }} }">
                            <h2 class="text-xl font-semibold mb-4">Фото</h2>
                            <div class="grid grid-cols-3 gap-4">
                                @foreach($photos as $i => $photo)
                                    <img
                                            src="{{ $photo }}"
                                            alt="Фото {{ $i+1 }}"
                                            class="bg-gray-100 rounded-lg h-40 w-full object-cover cursor-pointer transition hover:scale-105"
                                            @click="open = true; current = {{ $i }}"
                                    />
                                @endforeach
                            </div>

                            <!-- Модальное окно -->
                            <div
                                    x-show="open"
                                    x-transition
                                    class="fixed inset-0 bg-black/70 flex items-center justify-center z-50"
                                    @keydown.window.escape="open = false"
                                    @click.self="open = false"
                            >
                                <div class="relative bg-white rounded-lg shadow-lg p-4 max-w-2xl w-full flex flex-col items-center">
                                    <!-- Картинка -->
                                    <img
                                            :src="photos[current]"
                                            alt="Фото"
                                            class="max-h-[70vh] w-auto rounded"
                                    />

                                    <!-- Стрелки -->
                                    <button
                                            class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 rounded-full p-2 shadow hover:bg-white"
                                            @click.stop="current = (current - 1 + photos.length) % photos.length"
                                    >
                                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 19l-7-7 7-7"/>
                                        </svg>
                                    </button>
                                    <button
                                            class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 rounded-full p-2 shadow hover:bg-white"
                                            @click.stop="current = (current + 1) % photos.length"
                                    >
                                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>

                                    <!-- Закрыть -->
                                    <button
                                            class="absolute top-2 right-2 text-gray-700 hover:text-red-600"
                                            @click="open = false"
                                    >
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </section>
                    @endif
                    {{--foto old--}}
                    @if(1==2)
                        <h2 class="text-xl font-semibold mb-4">Фото
                            {{--                        с мероприятия--}}
                        </h2>
                        <div class="grid grid-cols-3 gap-4">
                            @foreach(range(1,3) as $photo)
                                <div class="bg-gray-100 rounded-lg h-40 flex items-center justify-center text-gray-500 font-semibold">
                                    Фото {{ $photo }}
                                </div>
                            @endforeach
                        </div>
                    @endif

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
                        <div class="mb-1" >
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

        </div>

    </div>

    <div class="flex flex-col md:flex-row xgap-8 flex-wrap">

        <livewire:event.informer.event-participiant-list :list="$event->athletes"/>

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


@if(1==2)

    <livewire:event.show-item :event="$event"/>

    <Br/>
    <Br/>
    <Br/>
    <Br/>
    <Br/>
    <Br/>
    <Br/>


    <div class="w-full flex flex-col gap-2 mb-2">

        <div class="w-full">
            <button class="back-button" onclick="history.back()">
                <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path d="M15 18l-6-6 6-6"></path>
                </svg>
                Назад
            </button>
        </div>

        <div class="w-full flex flex-col md:flex-row gap-2 mb-2">
            <div class="w-full sm:w-1/2">
                @if($event->photo)
                    <img src="{{ asset('storage/' . $event->photo) }}" alt="{{ $event->title }}"
                         class="w-full h-auto mb-6 rounded max-w-[350px] float-left mr-2">
                @endif
            </div>
            <div class="w-full md:w-1/2">


                Вид спорта:<br/>
                Футбол
                <br/>
                Место проведения:<br/>
                {{ $event->sportPlace->city->country->name  ?? '--' }}<br>
                {{ $event->sportPlace->city->name  ?? '--' }}<br>
                {{ $event->sportPlace->name ?? '--' }}<br>
                <br/>
                <br/>
                Период проведения:
                <br/>

                20/12/2025 - 24/12/2026
                <br/>
                <br/>

                @foreach( $event->getAttributes() as $k => $v )
                    {{ $k }} - {{ $v }} <br/>
                @endforeach
            </div>
        </div>

    </div>

    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>

    <livewire:event.show2 :event="$event"/>

    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>


    <button class="back-button" onclick="history.back()">
        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path d="M15 18l-6-6 6-6"></path>
        </svg>
        Назад
    </button>

    <div>
        <h2 class="text-3xl font-bold mb-2">{{ $event->title }}</h2>

        <div id="card-container"
             class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-[20px] w-full">

            @if(1==2)
                <div class="bg-yellow-200 m-2 rounded p-2">
                    <pre class="text-xs">{{ print_r($event->toArray(), true) }}</pre>
                </div>
            @endif

            <div class="bg-yellow-200 m-2 rounded p-2">
                <h3 class="font-bold mb-3">Участники</h3>
                <div class="flex flex-col space-y-2">
                    @foreach( $event->athletes as $athlete)
                        {{--                    <pre>{{ print_r($athlete->toArray(), true) }}</pre>--}}
                        <livewire:event.show-athlete :athlete="$athlete"/>
                    @endforeach
                    @foreach( $event->athletesNoPlace as $athlete)
                        {{--                    <pre>{{ print_r($athlete->toArray(), true) }}</pre>--}}
                        <livewire:event.show-athlete :athlete="$athlete"/>
                    @endforeach

                </div>
            </div>

            <div class="bg-yellow-200 m-2 rounded p-2">
                <h3 class="font-bold">Время проведения</h3>
                @if( !empty($event->event_date) )
                    @if( !empty($event->events_date_finished) )
                        с
                    @endif
                    {{$event->event_date->format('d.m.Y') }}
                    @if( !empty($event->events_date_finished) )
                        по {{$event->events_date_finished->format('d.m.Y') }}
                    @endif
                @else
                    --
                @endif
            </div>
            <div class="bg-yellow-200 m-2 rounded p-2">
                <h3 class="font-bold">Место проведения</h3>
                {{ $event->sportPlace->city->country->name  ?? '--' }}<br>
                {{ $event->sportPlace->city->name  ?? '--' }}<br>
                {{ $event->sportPlace->name ?? '--' }}<br>
            </div>
            <div class="bg-yellow-200 m-2 rounded p-2">
                <h3 class="font-bold">Описание</h3>
                {{$event->description ?? '--'}}
            </div>
            <div class="bg-yellow-200 m-2 rounded p-2">
                <h3 class="font-bold">Вид спорта</h3>
                {{$event->sportType->name ?? '--'}}
            </div>

        </div>
        <br/>
        <br/>
        <br/>
        <br/>
        <div class="text-gray-600 mb-4">
            <strong>Дата проведения:</strong> {{ $event->event_date->format('d.m.Y') }}<br>
            {{--            <strong>Место проведения:</strong> {{ $event->venue }}, {{ $event->city }}, {{ $event->country }}--}}
        </div>

        @if($event->photo)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $event->photo) }}" alt="Фото мероприятия"
                     class="max-w-full h-auto rounded">
            </div>
        @endif

        <div class="whitespace-pre-line">
            {{ $event->description }}
        </div>

        <div class="mt-6">
            <a href="{{ route('events.index') }}" class="text-blue-600 hover:underline">&larr; К списку
                мероприятий</a>
        </div>
    </div>
    <br/>
    <br/>
    <br/>
    <br/>
    <h3 class="text-xl font-bold mb-2">
        сверстали не используя css tailwind
    </h3>
    <div id="event-details-container" class="event-container">
        <div class="event-header">
            <div class="event-image"
                 style="background-image: url('https://media.istockphoto.com/id/502301173/ru/%D1%84%D0%BE%D1%82%D0%BE/%D1%81%D0%BF%D0%BE%D1%80%D1%82%D0%B8%D0%B2%D0%BD%D1%8B%D1%85-%D0%B3%D0%B5%D1%80%D0%BE%D0%B8.jpg?s=612x612&amp;w=0&amp;k=20&amp;c=hvF4ffHr63Qy3uATLQovIvCfV0uxVmbmjLxVjc4V-zs=')"></div>

            <div class="event-info">
                <h1 class="event-title">Кубок губернатора Тюменской области</h1>

                <div class="event-details">
                    <div>
                        <div class="detail-label">Вид спорта:</div>
                        <a href="#" class="detail-value">Футбол</a>
                    </div>
                    <div>
                        <div class="detail-label">Место проведения:</div>
                        <a href="#" class="detail-value">Тюмень</a>
                    </div>
                    <div>
                        <div class="detail-label">Период проведения:</div>
                        <a href="#" class="detail-value">20/12/2025 - 24/12/2026</a>
                    </div>
                </div>

                <div class="section">
                    <div class="section-title">Спортсмены</div>
                    <ul class="section-list">
                        <li class="section-item">
                            <div class="section-index">1.</div>
                            <div class="section-avatar-placeholder"></div>
                            Исматов М
                        </li>
                        <li class="section-item">
                            <div class="section-index">2.</div>
                            <div class="section-avatar-placeholder"></div>
                            Точиев С
                        </li>
                        <li class="section-item">
                            <div class="section-index">3.</div>
                            <div class="section-avatar-placeholder"></div>
                            Казаков А
                        </li>
                        <li class="section-item">
                            <div class="section-index">4.</div>
                            <div class="section-avatar-placeholder"></div>
                            Киселев В
                        </li>
                        <li class="section-item">
                            <div class="section-index">5.</div>
                            <div class="section-avatar-placeholder"></div>
                            Петров С
                        </li>
                        <li class="section-item">
                            <div class="section-index">6.</div>
                            <div class="section-avatar-placeholder"></div>
                            Галеев Д
                        </li>
                        <li class="section-item">
                            <div class="section-index">7.</div>
                            <div class="section-avatar-placeholder"></div>
                            Концевенко М
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Блок с фото -->
        <div class="media-section">
            <div class="section-title">Фото с мероприятия</div>
            <div class="media-grid">
                <div class="media-item">
                    <div class="media-caption">Фото 1</div>
                </div>
                <div class="media-item">
                    <div class="media-caption">Фото 2</div>
                </div>
                <div class="media-item">
                    <div class="media-caption">Фото 3</div>
                </div>
            </div>
        </div>

        <!-- Блок с видео -->
        <div class="media-section">
            <div class="section-title">Видео с мероприятия</div>
            <div class="media-grid">
                <div class="media-item video">
                    <div class="media-caption">Видео 1</div>
                </div>
                <div class="media-item video">
                    <div class="media-caption">Видео 2</div>
                </div>
                <div class="media-item video">
                    <div class="media-caption">Видео 3</div>
                </div>
            </div>
        </div>

        <div class="sections-grid">
            <!-- Первая колонка -->
            <div class="section-column">
                <div class="section">
                    <div class="section-title">Пьедестал</div>
                    <ul class="section-list">
                        <li class="section-item">
                            <div class="section-index">1.</div>
                            <div class="section-avatar-placeholder"></div>
                            Исматов М
                            <img class="medal-img" src="assets/gold.svg" alt="Золото">
                        </li>
                        <li class="section-item">
                            <div class="section-index">2.</div>
                            <div class="section-avatar-placeholder"></div>
                            Точиев С
                            <img class="medal-img" src="assets/gold.svg" alt="Золото">
                        </li>
                        <li class="section-item">
                            <div class="section-index">2.</div>
                            <div class="section-avatar-placeholder"></div>
                            Казаков А
                            <img class="medal-img" src="assets/gold.svg" alt="Золото">
                        </li>
                        <li class="section-item">
                            <div class="section-index">3.</div>
                            <div class="section-avatar-placeholder"></div>
                            Киселев В
                            <img class="medal-img" src="assets/silver.svg" alt="Серебро">
                        </li>
                        <li class="section-item">
                            <div class="section-index">3.</div>
                            <div class="section-avatar-placeholder"></div>
                            Петров С
                            <img class="medal-img" src="assets/silver.svg" alt="Серебро">
                        </li>
                        <li class="section-item">
                            <div class="section-index">3.</div>
                            <div class="section-avatar-placeholder"></div>
                            Галеев Д
                            <img class="medal-img" src="assets/bronze.svg" alt="Бронза">
                        </li>
                        <li class="section-item">
                            <div class="section-index">3.</div>
                            <div class="section-avatar-placeholder"></div>
                            Концевенко М
                            <img class="medal-img" src="assets/bronze.svg" alt="Бронза">
                        </li>
                    </ul>
                </div>

                <div class="section">
                    <div class="section-title">Организаторы</div>
                    <ul class="section-list">
                        <li class="section-item">
                            <div class="section-index">1.</div>
                            <div class="section-avatar-placeholder"></div>
                            Спортивная федерация
                        </li>
                        <li class="section-item">
                            <div class="section-index">2.</div>
                            <div class="section-avatar-placeholder"></div>
                            Городская администрация
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Вторая колонка -->
            <div class="section-column">
                <div class="section">
                    <div class="section-title">СМИ</div>
                    <ul class="section-list">
                        <li class="section-item">
                            <div class="section-index">1.</div>
                            <div class="section-avatar-placeholder"></div>
                            Спортивный канал
                        </li>
                        <li class="section-item">
                            <div class="section-index">2.</div>
                            <div class="section-avatar-placeholder"></div>
                            Городская газета
                        </li>
                        <li class="section-item">
                            <div class="section-index">3.</div>
                            <div class="section-avatar-placeholder"></div>
                            Онлайн-портал
                        </li>
                        <li class="section-item">
                            <div class="section-index">1.</div>
                            <div class="section-avatar-placeholder"></div>
                            Спортивный канал
                        </li>
                        <li class="section-item">
                            <div class="section-index">2.</div>
                            <div class="section-avatar-placeholder"></div>
                            Городская газета
                        </li>
                        <li class="section-item">
                            <div class="section-index">3.</div>
                            <div class="section-avatar-placeholder"></div>
                            Онлайн-портал
                        </li>
                        <li class="section-item">
                            <div class="section-index">3.</div>
                            <div class="section-avatar-placeholder"></div>
                            Онлайн-портал
                        </li>
                    </ul>
                </div>

                <div class="section">
                    <div class="section-title">Спонсоры</div>
                    <ul class="section-list">
                        <li class="section-item">
                            <div class="section-index">1.</div>
                            <div class="section-avatar-placeholder"></div>
                            Главный спонсор
                        </li>
                        <li class="section-item">
                            <div class="section-index">2.</div>
                            <div class="section-avatar-placeholder"></div>
                            Технический партнер
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Почетные гости -->
            <div class="section-column">
                <div class="section">
                    <div class="section-title">Почетные гости</div>
                    <ul class="section-list">
                        <li class="section-item">
                            <div class="section-index">1.</div>
                            <div class="section-avatar-placeholder"></div>
                            Мэр города
                        </li>
                        <li class="section-item">
                            <div class="section-index">2.</div>
                            <div class="section-avatar-placeholder"></div>
                            Олимпийский чемпион
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Судьи -->
            <div class="section-column">
                <div class="section">
                    <div class="section-title">Судьи</div>
                    <ul class="section-list">
                        <li class="section-item">
                            <div class="section-index">1.</div>
                            <div class="section-avatar-placeholder"></div>
                            Главный судья
                        </li>
                        <li class="section-item">
                            <div class="section-index">2.</div>
                            <div class="section-avatar-placeholder"></div>
                            Судья на линии
                        </li>
                        <li class="section-item">
                            <div class="section-index">3.</div>
                            <div class="section-avatar-placeholder"></div>
                            Хронометрист
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Посетители (на всю ширину) -->
            <div class="full-width-section">
                <div class="section">
                    <div class="section-title">Посетители</div>
                    <ul class="section-list">
                        <li class="section-item">
                            <div class="section-index">1.</div>
                            <div class="section-avatar-placeholder"></div>
                            VIP-гости (50 человек)
                        </li>
                        <li class="section-item">
                            <div class="section-index">2.</div>
                            <div class="section-avatar-placeholder"></div>
                            Корпоративные клиенты (120 человек)
                        </li>
                        <li class="section-item">
                            <div class="section-index">3.</div>
                            <div class="section-avatar-placeholder"></div>
                            Общие зрители (500 человек)
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
    </div>


