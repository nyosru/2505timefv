<div class="p-6 shadow max-w-3xl mx-auto">

    @if(!$eventId)
        <div class="mb-4">
            <label class="block font-semibold mb-1">Выберите мероприятие</label>
            <select wire:model.live="eventId" class="w-full border rounded p-2">
                <option value="">-- Выберите --</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->title }}</option>
                @endforeach
            </select>
        </div>
    @endif

    @if($eventId)
        @if($type === 'image')
            <h2 class="text-xl font-bold mb-4">Добавить фото</h2>
        @elseif($type === 'video')
            <h2 class="text-xl font-bold mb-4">Добавить видео (ссылки на vkvideo.ru)</h2>
        @elseif($type === 'document')
            <h2 class="text-xl font-bold mb-4">Добавить документы (pdf)</h2>
        @else
            <h2 class="text-xl font-bold mb-4">Вложения мероприятия</h2>
        @endif

        @if(session()->has('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="save" enctype="multipart/form-data" class="mb-6">

            @if($type === 'image')
            @elseif($type === 'video')
            @else
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Название *</label>
                    <input type="text" wire:model.defer="name" class="w-full border rounded p-2"/>
                    @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            @endif

            @if(empty($type))
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Тип *</label>
                    <select wire:model.defer="type" class="w-full border rounded p-2">
                        <option value="">-- Выберите тип --</option>
                        <option value="image">Картинка</option>
                        <option value="video">Видео</option>
                        <option value="document">Документ</option>
                    </select>
                    @error('type') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            @endif

            @if($type === 'image' || $type === 'document')
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Файл(ы) *</label>
                    <input type="file" wire:model.lazy="files" multiple class="w-full"/>
                    @error('files') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

                    {{--                @if ($file)--}}
                    {{--                    <div class="mt-2 text-sm text-gray-600">--}}
                    {{--                        Выбран файл: {{ $file->getClientOriginalName() }}--}}
                    {{--                    </div>--}}
                    {{--                @endif--}}
                </div>
            @endif

            @if($type === 'video')
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Ссылки на vkvideo (1 строка 1 ссылка)</label>
                    <small>Например: https://vkvideo.ru/video123456789</small>
                    <textarea wire:model.lazy="urls" rows="4" class="w-full border rounded p-2"></textarea>
                    @error('urls') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

                    {{--                @if ($file)--}}
                    {{--                    <div class="mt-2 text-sm text-gray-600">--}}
                    {{--                        Выбран файл: {{ $file->getClientOriginalName() }}--}}
                    {{--                    </div>--}}
                    {{--                @endif--}}
                </div>
            @endif

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Добавить
            </button>
        </form>

        <div>
            @if($attachments->isEmpty())
                <p class="text-gray-500">Вложений пока нет.</p>
            @else
                <div class="mb-4 max-h-[400px] overflow-auto">

                    @foreach($attachments as $attachment)

                        @if($attachment->type != $type )
                            @continue
                        @endif

                        <div class="float-left p-1 m-1 rounded-md">
                            @if($attachment->type === 'image')
                                <img src="{{ Storage::url($attachment->url) }}" alt="{{ $attachment->name }}"
                                     class="max-w-[100px] max-h-[100px]"/>
                                <br/>
                                <button wire:click="deleteAttachment({{ $attachment->id }})"
                                        wire:confirm="Удалить вложение?"
                                        class="text-red-600 hover:underline text-sm">
                                    Удалить
                                </button>

                            @elseif($attachment->type === 'video')

                                <a href="{{ $attachment->url_video }}" target="_blank">
                                    <strong>{{ $attachment->name }}</strong>
                                    <span class="ml-2 text-sm text-gray-600">[{{ ucfirst($attachment->type) }}]</span>
                                </a>
                                <Br/>
                                <button wire:click="deleteAttachment({{ $attachment->id }})"
                                        wire:confirm="Удалить вложение?"
                                        class="text-red-600 hover:underline text-sm">
                                    Удалить
                                </button>

                            @elseif($attachment->type === 'document')

                                @php
                                    $filename = '/file-icon/32px/' . substr($attachment->filename, -3) . '.png';
//                                        $filename = '/file-icon/48px/' . substr($attachment->filename, -3) . '.png';
                                @endphp

                                <div class="flex flex-row items-center justify-center space-x-2 w-full">

                                    <div class="w-[40px]">
                                        <a href="{{ Storage::url($attachment->url) }}" target="_blank">
                                            @if(file_exists(public_path($filename)))
                                                <img src="{{ $filename }}" alt=""/>
                                            @else
                                                {{--                                        Файл изображения не найден--}}
                                                <strong class="text-lg font-bold
                                                    border-gray-800
                                                    border border-1
                                                    px-2 py-1 mr-1 mb-1
                                                    rounded">{{ substr($attachment->filename, -4) }}</strong>
                                            @endif
                                        </a>
                                    </div>

                                    <div class="flex-auto">
                                        <a href="{{ Storage::url($attachment->url) }}" target="_blank">
                                            <strong>{{ $attachment->name ?? $attachment->filename }}</strong>
                                        </a>
                                    </div>

                                    <div class="flex-auto">
                                        <button wire:click="deleteAttachment({{ $attachment->id }})"
                                                wire:confirm="Удалить вложение?"
                                                class="text-red-600 hover:underline text-sm">
                                            Удалить
                                        </button>
                                    </div>

                                </div>
                            @endif
                        </div>
                    @endforeach
                    <br clear="all"/>
                </div>
            @endif
        </div>
    @endif

</div>
