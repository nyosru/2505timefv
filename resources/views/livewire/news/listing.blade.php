<div>

    <div class="mt-4">
        {{ $news->links('vendor.pagination.my1tailwind') }}
    </div>

    <div id="cards-container" class="grid grid-cols-3 gap-[20px] w-full">

        {{--    <h2 class="text-2xl font-bold mb-4">Новости</h2>--}}

        @forelse($news as $item)

            <livewire:news.listing-card :item="$item"/>

            {{--            <li class="mb-4 border-b pb-2">--}}
            {{--                <a href="{{ route('news.show', $item->id) }}" class="text-blue-600 hover:underline">--}}
            {{--                    <strong>{{ $item->title }}</strong>--}}
            {{--                </a>--}}
            {{--                <div class="text-gray-500 text-sm">{{ $item->date->format('d.m.Y') }}</div>--}}
            {{--                @if($item->short_text)--}}
            {{--                    <div>{{ $item->short_text }}</div>--}}
            {{--                @endif--}}
            {{--            </li>--}}

        @empty
            <div>Новостей пока нет.</div>
        @endforelse
    </div>
    <div class="mt-4">
        {{ $news->links('vendor.pagination.my1tailwind') }}
    </div>


    @if(1==2)
        <div id="cards-container" class="grid grid-cols-3 gap-[20px] w-full">
            <div class="card w-full p-4 bg-white rounded-[10px] mb-6 border-1 border-[#E9E9E9]"
                 style="opacity: 1; transform: translateY(0px); transition: opacity 1s, transform 0.4s;">

                <div class="min-h-[165px] justify-between items-baseline rounded-t-[10px] w-full relative flex gap-[10px]"
                     style="
            background-image: url('https://static.1tv.ru/uploads/video/material/splash/2022/10/22/750806/big/750806_big_2079786d17.jpg');
            background-size: cover;
            background-position: center;
          ">
                    <img class="p-[10px] w-[60px] h-[60px] rounded-full" src="assets/avatar.png" alt="Аватар">
                    <div class="buttons2 absolute top-[10px] right-[20px] flex gap-[7px] items-center">

                        <button class="bg-[#00A521] px-[12px] py-[1px] rounded-full tracking-[-2%] leading-[24px] text-white text-[12px]">
                            Добавить
                        </button>

                        <button class="bg-[#3579F4] px-[12px] py-[1px] rounded-full tracking-[-2%] leading-[24px] text-white text-[12px]">
                            Изменить
                        </button>

                    </div>
                </div>

                <div class="relative flex justify-between items-start mt-3">
                    <h3 class="font-[Oswald] text-[18px] w-[90%] font-medium uppercase pb-1 text-[#252525]">
                        Заголовок новости 1
                    </h3>
                    <img class="w-fit pt-[5px]" src="assets/copy.svg" alt="copy">
                </div>


                <div class="flex flex-col mt-[5px]">
                    <h4 class="leading-[30px] font-bold">Описание</h4>
                    <p class="text-[14px] leading-[25px] pb-[10px] text-[#003493]">
                        Краткое описание новости 1
                    </p>
                </div>


                <div class="flex justify-between items-center mt-3">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-thumbs-up grey"></i>
                        <span>124</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-eye grey"></i>
                        <span>856</span>
                    </div>
                </div>

            </div>
        </div>
    @endif
</div>