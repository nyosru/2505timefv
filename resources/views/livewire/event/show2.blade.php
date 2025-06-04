<div id="event-details-container" class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Левая часть: изображение и основная информация -->
        <div class="md:w-1/3">
            <div
                    class="w-full h-64 rounded-lg bg-cover bg-center shadow-md"
                    style="background-image: url('https://media.istockphoto.com/id/502301173/ru/%D1%84%D0%BE%D1%82%D0%BE/%D1%81%D0%BF%D0%BE%D1%80%D1%82%D0%B8%D0%B2%D0%BD%D1%8B%D1%85-%D0%B3%D0%B5%D1%80%D0%BE%D0%B8.jpg?s=612x612&amp;w=0&amp;k=20&amp;c=hvF4ffHr63Qy3uATLQovIvCfV0uxVmbmjLxVjc4V-zs=')"
                    aria-label="Фото мероприятия"
            ></div>

            <h1 class="text-3xl font-bold mt-6 mb-4">Кубок губернатора Тюменской области</h1>

            <div class="space-y-3 text-gray-700">
                <div>
                    <span class="font-semibold">Вид спорта:</span>
                    <a href="#" class="text-blue-600 hover:underline ml-1">Футбол</a>
                </div>
                <div>
                    <span class="font-semibold">Место проведения:</span>
                    <a href="#" class="text-blue-600 hover:underline ml-1">Тюмень</a>
                </div>
                <div>
                    <span class="font-semibold">Период проведения:</span>
                    <span class="ml-1">20.12.2025 - 24.12.2026</span>
                </div>
            </div>

            <section class="mt-8">
                <h2 class="text-xl font-semibold mb-3">Спортсмены</h2>
                <ul class="space-y-2">
                    @foreach(['Исматов М', 'Точиев С', 'Казаков А', 'Киселев В', 'Петров С', 'Галеев Д', 'Концевенко М'] as $index => $athlete)
                        <li class="flex items-center gap-3">
                            <div class="w-6 font-semibold text-gray-600">{{ $index + 1 }}.</div>
                            <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                            <span>{{ $athlete }}</span>
                        </li>
                    @endforeach
                </ul>
            </section>
        </div>

        <!-- Правая часть: медиа и дополнительные секции -->
        <div class="md:w-2/3 flex flex-col gap-8">

            <!-- Фото с мероприятия -->
            <section>
                <h2 class="text-xl font-semibold mb-4">Фото с мероприятия</h2>
                <div class="grid grid-cols-3 gap-4">
                    @foreach(range(1,3) as $photo)
                        <div class="bg-gray-100 rounded-lg h-40 flex items-center justify-center text-gray-500 font-semibold">
                            Фото {{ $photo }}
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Видео с мероприятия -->
            <section>
                <h2 class="text-xl font-semibold mb-4">Видео с мероприятия</h2>
                <div class="grid grid-cols-3 gap-4">
                    @foreach(range(1,3) as $video)
                        <div class="bg-gray-100 rounded-lg h-40 flex items-center justify-center text-gray-500 font-semibold">
                            Видео {{ $video }}
                        </div>
                    @endforeach
                </div>
            </section>

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
                                    <img src="assets/{{ $person['medal'] }}" alt="Медаль" class="w-5 h-5 ml-auto" />
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

        </div>
    </div>
</div>
