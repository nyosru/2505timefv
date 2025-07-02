<div>


    <livewire:cms2.app.breadcrumb
            {{--            :board_id="$leed->column->board_id"--}}
            {{--            :board_id=""--}}
            :menu="[
                    ['route'=>'news','name'=>'Новости', 'route-var' => [] ]
                    ,
{{--                    ['route'=>'events.show','name'=>( strlen($event->title) > 50 ? substr($event->title, 0, 50) . '...' : ( $event->title  ?? '-') ), 'route-var' => [ 'id' => $event->id ] ]--}}
{{--                    [--}}
{{--                        'route'=>'leed',--}}
{{--                        'name'=>( $leed->column->board->name ?? 'x' )--}}

{{--                    ],--}}
                     [ 'link' => 'no', 'name'=> ( ($news->title ?? '-') ) ]
                 ]"
    />


{{--    <button class="back-button" onclick="history.back()">--}}
{{--        <i class="fa-solid fa-arrow-left"></i>--}}
{{--        Назад--}}
{{--    </button>--}}

    <div>


        <div class="text-gray-500 mt-4">{{ $news->date->format('d.m.Y') }}</div>
        <h2 class="text-2xl font-bold mb-2">{{ $news->title }}</h2>

        @if($news->photo)
            <img src="{{ asset('storage/' . $news->photo) }}" alt="{{ $news->title }}" class="w-full h-auto mb-6 rounded max-w-[350px] float-left mr-2">
        @endif


{{--        @if($news->short_text)--}}
{{--            <div class="mb-2 font-semibold">{{ $news->short_text }}</div>--}}
{{--        @endif--}}

{{--        <pre class="text-xs">{{ print_r($news->toArray()) }}</pre>--}}

        <div>{!! nl2br(e($news->full_text)) !!}</div>

        <div class="mt-4">
            <a href="{{ route('news') }}" class="text-blue-600 hover:underline">&larr; К списку новостей</a>
        </div>
    </div>








@if(1==2)
    <div class="container" id="newsDetailContainer">

        <div class="news-header">

            <div class="news-image"
                 style="background-image: url('https://static.1tv.ru/uploads/video/material/splash/2022/10/22/750806/big/750806_big_2079786d17.jpg')"></div>

            <div class="news-info">
                <h1 class="news-title">Заголовок новости 1</h1>

                <div class="news-meta">
                    <div class="meta-item">
                        <span class="meta-icon"><i class="fa-solid fa-calendar"></i></span>
                        <span>28 мая 2025 г.</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-icon"><i class="fa-solid fa-tag"></i></span>
                        <span>Спорт</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-icon"><i class="fa-solid fa-eye"></i></span>
                        <span>856 просмотров</span>
                    </div>
                </div>

                <div class="like-section">
                    <button class="like-button" id="likeButton">
                        <span><i class="fa-solid fa-thumbs-up"></i></span> Лайкнуть
                    </button>
                    <div class="stats">
                        <div class="stat-item">
                            <span><i class="fa-solid fa-thumbs-up"></i></span>
                            <span id="likeCount">124</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <h2 class="section-title">Содержание</h2>
            <div class="news-content">
                <p>В центре города торжественно открылась новая современная библиотека. В церемонии приняли участие
                    представители местной администрации, деятели культуры и жители города.</p>
                <p>Новая библиотека предлагает посетителям более 50 тысяч книг, включая редкие издания и современные
                    бестселлеры. Особое внимание уделено созданию комфортных условий для чтения и работы.</p>
                <p>Помимо традиционных книжных фондов, в библиотеке оборудованы:</p>
                <ul>
                    <li>Современные компьютерные классы</li>
                    <li>Конференц-залы для мероприятий</li>
                    <li>Детская игровая зона</li>
                    <li>Кафе с читальным залом</li>
                </ul>
                <p>Директор библиотеки Анна Сидорова отметила: "Наша цель - создать пространство, где каждый житель
                    города
                    сможет найти что-то интересное для себя, будь то классическая литература или новейшие цифровые
                    ресурсы".</p>
            </div>
        </div>

        <div class="author-section">
            <img class="author-avatar"
                 src="https://img.championat.com/s/732x488/news/big/n/p/kto-takoj-nezauryadnyj-chelovek_1691747995897594832.jpg"
                 alt="Иван Петров">
            <div class="author-info">
                <div class="author-name">Иван Петров</div>
                <div class="author-bio">Спортивный журналист с 10-летним опытом. Специализируется на футболе и хоккее.
                </div>
            </div>
        </div>
    </div>
    @endif
</div>