<div>

    @php
        $photos = [];
        foreach( $event->photos as $k => $v ) {
            if(!empty($v->url)){
                $photos[] = asset('storage/'.$v->url);
            }
        }
    @endphp

    @if( count($photos) > 0 )
        <section x-data="photoViewer()" x-init="init()" class="relative">

            <h2 class="text-xl font-semibold
            text-center md:text-left
            mb-4 sticky top-[76px] bg-white/80 z-10 py-4">Фото</h2>

            <div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4">
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
                        @touchstart="touchStart($event)"
                        @touchmove.prevent="touchMove($event)"
                        @touchend="touchEnd()"
                >
                    <div class="relative
{{--                    bg-white rounded-lg shadow-lg--}}
{{--                    p-4--}}
                    max-w-[100%]
                    max-h-[100%]
                    w-full
                    flex flex-col items-center">
                        <!-- Картинка -->
                        <img
                                :src="photos[current]"
                                alt="Фото"
                                class="max-h-[70vh] w-auto rounded select-none"
                                draggable="false"
                        />

                        <!-- Стрелки -->
                        <button
                                class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 rounded-full p-2 shadow hover:bg-white"
                                @click.stop="prev()"
                        >
                            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <button
                                class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 rounded-full p-2 shadow hover:bg-white"
                                @click.stop="next()"
                        >
                            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>

                        @if(1==2)
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
                        @endif

                    </div>
                </div>
            </div>
        </section>

        <script>
            function photoViewer() {
                return {
                    open: false,
                    current: 0,
                    photos: @json($photos),

                    touchStartX: 0,
                    touchEndX: 0,
                    threshold: 50, // минимальное расстояние для свайпа

                    init() {
                        // Можно добавить инициализацию, если нужно
                    },

                    prev() {
                        this.current = (this.current - 1 + this.photos.length) % this.photos.length;
                    },

                    next() {
                        this.current = (this.current + 1) % this.photos.length;
                    },

                    touchStart(event) {
                        this.touchStartX = event.touches[0].clientX;
                    },

                    touchMove(event) {
                        this.touchEndX = event.touches[0].clientX;
                    },

                    touchEnd() {
                        let diffX = this.touchEndX - this.touchStartX;

                        if (Math.abs(diffX) > this.threshold) {
                            if (diffX > 0) {
                                // свайп вправо - предыдущая фотка
                                this.prev();
                            } else {
                                // свайп влево - следующая фотка
                                this.next();
                            }
                        }

                        // сброс координат
                        this.touchStartX = 0;
                        this.touchEndX = 0;
                    },
                }
            }
        </script>
    @endif
</div>
