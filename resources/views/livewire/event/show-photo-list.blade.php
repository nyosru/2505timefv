<div>

    {{--                    <pre class="max-h-[200px] overflow-auto p-2 text-xs">{{ print_r($event->toArray(),1) }}</pre>--}}

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

            <div
                    {{--                            class="max-h-[450px] overflow-y-auto p-2 border border-2 border-gray-500 rounded-lg"--}}
            >

                <div class="grid grid-cols-3 gap-4">
                    @foreach($photos as $i => $photo)
                        <img
                                src="{{ $photo }}"
                                alt="Фото {{ $i+1 }}"
                                class="bg-gray-100 rounded-lg h-40 w-full object-cover cursor-pointer transition hover:scale-105"
                                @click="open = true; current = {{ $i }}"
                                loading="lazy"
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
                    <div class="relative bg-white rounded-lg shadow-lg p-4
{{--                                    max-w-2xl--}}
            max-w-[75%]
            w-full flex flex-col items-center">
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
            </div>
        </section>
    @endif
</div>
