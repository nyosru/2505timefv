<div>

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
                <h3 class="font-bold">Участники</h3>
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
            <a href="{{ route('events.index') }}" class="text-blue-600 hover:underline">&larr; К списку мероприятий</a>
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

</div>


