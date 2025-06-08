<div
        class="w-full @if( $items->count() > 3 ) @else md:w-1/2 lg:w-1/3 @endif"
>
    <h2 class="text-xl font-semibold
{{--    mb-4--}}
        sticky top-[76px] bg-white/80 z-10 py-4
        ">Публикации
    </h2>

    <a href="https://МояПобеда.рус" target="_blank">
        <img src="/img/logo.my.victory.jpg" class="w-full max-w-[150px]"/>
    </a>



    <div class="
        @if( $items->count() > 3 )
        w-full
        grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5
        ml-5 sm:ml-0
{{--        gap-4--}}
        @else
        @endif
        ">
        @foreach($items as $attachment)
            <div class="
{{--            mb-1--}}
            ">
                @php
                    $filename = '/file-icon/48px/' . substr($attachment->filename, -3) . '.png';
                @endphp


                {{--                                <div class="flex-1">--}}
                <a href="{{ Storage::url($attachment->url) }}"
                   class="block hover:bg-gray-100 p-2"
                   target="_blank">
                    <div class="flex flex-row items-center justify-left space-x-2 w-full">
                        <div>
                            @if(file_exists(public_path($filename)))
                                <img src="{{ $filename }}" class="inline" alt=""/>
                            @else
                                <strong class="text-lg font-bold
                            border-gray-800
                            border border-1
                            px-2 py-1 mr-1 mb-1
                            rounded">{{ substr($attachment->filename, -4) }}</strong>
                            @endif
                        </div>
                        <div>
                            {{--                                <div class="flex-auto">--}}
                            {{--                <a href="{{ Storage::url($attachment->url) }}" target="_blank">--}}
                            <strong>{{ $attachment->name ?? $attachment->filename }}</strong>
                        </div>
                    </div>
                </a>
            </div>
            {{--                            </div>--}}
        @endforeach
    </div>
</div>
