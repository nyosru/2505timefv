<div class="card w-full p-4 bg-white rounded-[10px] mb-6 border-1 border-[#E9E9E9]"
     style="opacity: 1; transform: translateY(0px); transition: opacity 1s, transform 0.4s;">

    {{--    <pre>{{ print_r($event->toArray()) }}</pre>--}}


    <a href="{{ route('events.show', ['id' => $event->id]) }}" wire:navigate>
        <div class="min-h-[165px] justify-between items-baseline rounded-t-[10px] w-full relative flex gap-[10px]"
             style="

        @if($event->photo)
            background-image: url('{{ asset('storage/' . $event->photo) }}');
        @else
            background-image: url('https://media.istockphoto.com/id/502301173/ru/%D1%84%D0%BE%D1%82%D0%BE/%D1%81%D0%BF%D0%BE%D1%80%D1%82%D0%B8%D0%B2%D0%BD%D1%8B%D1%85-%D0%B3%D0%B5%D1%80%D0%BE%D0%B8.jpg?s=612x612&amp;w=0&amp;k=20&amp;c=hvF4ffHr63Qy3uATLQovIvCfV0uxVmbmjLxVjc4V-zs=');
        @endif

            background-size: cover;
            background-position: center;
          ">
            {{--        <img class="p-[10px] w-[60px] h-[60px]" src="assets/avatar.png" alt="avatar">--}}
            {{--        <div class="buttons2 absolute top-[10px] right-[20px] flex gap-[7px] items-center">--}}
            {{--            <button class="bg-[#00A521] px-[12px] py-[1px] rounded-full tracking-[-2%] leading-[24px] text-white text-[12px]">--}}
            {{--                Добавить--}}
            {{--            </button>--}}
            {{--            <button class="bg-[#3579F4] px-[12px] py-[1px] rounded-full tracking-[-2%] leading-[24px] text-white text-[12px]">--}}
            {{--                Изменить--}}
            {{--            </button>--}}
            {{--        </div>--}}
        </div>
    </a>

    {{--    <pre>{{ print_r($event->toArray()) }}</pre>--}}

    <a href="{{ route('events.show', ['id' => $event->id]) }}" wire:navigate>
        <div class="relative flex justify-between items-start mt-3">
            <h3 class="font-[Oswald] text-[18px] w-[90%] font-medium uppercase pb-1 text-[#252525]">
                {{--            Кубок губернатора Тюменской области--}}
                {{$event->title}}
            </h3>
            {{--        <img class="w-fit pt-[5px]" src="assets/copy.svg" alt="copy">--}}
        </div>
    </a>
    {{--    {{$event->sportType->name ?? '--' }}--}}
    @if(!empty($event->sportType->name))
        <div class="flex flex-col mt-[5px]">
            <h4 class="leading-[30px] font-bold">Вид спорта</h4>
            <a class="text-[14px] leading-[25px] pb-[10px] text-[#003493] underline" href="#">
                {{--            Футбол--}}
                {{ $event->sportType->name }}
            </a>
        </div>
    @endif

    @if( !empty($event->sportPlace->name) )
        <div class="flex flex-col mt-[5px]">
            <h4 class="leading-[30px] font-bold">Место проведения</h4>

            <div class="text-[14px]">
                {{$event->sportPlace->city->country->name ?? '-' }}
                >
                {{$event->sportPlace->city->name ?? '-' }}
            </div>

            <a class="text-[14px] leading-[25px] pb-[10px] text-[#003493] underline" href="#">
                {{--            {{ $event->country }}<br/>--}}
                {{--            {{ $event->city }}<br/>--}}
                {{--            {{ $event->venue }}--}}
                {{ $event->sportPlace->name }}
            </a>
        </div>
    @endif

    @if( !empty($event->event_date) )
        <div class="flex flex-col mt-[5px]">
            <h4 class="leading-[30px] font-bold">@if(!empty($event->events_date_finished))
                    Период проведения
                @else
                    Дата проведения
                @endif            @if($event->event_date->isFuture())
                    <span class="bg-red-300 p-1 rounded-md">скоро</span>
                @endif
            </h4>
            <a class="text-[14px] leading-[25px] pb-[10px] text-[#003493] underline" href="#">
                {{--            20/12/2025 - 24/12/2026--}}
                {{ $event->event_date->format('d.m.Y') }}
                @if(!empty($event->events_date_finished) )
                    - {{ $event->events_date_finished->format('d.m.Y')  }}
                @endif
            </a>
        </div>
    @endif

</div>
