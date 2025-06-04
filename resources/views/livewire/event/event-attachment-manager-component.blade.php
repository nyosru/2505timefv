<div class="p-6 bg-white rounded shadow max-w-3xl mx-auto">

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
        <h2 class="text-xl font-bold mb-4">Вложения мероприятия</h2>

        @if(session()->has('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="save" enctype="multipart/form-data" class="mb-6">
            <div class="mb-4">
                <label class="block font-semibold mb-1">Название *</label>
                <input type="text" wire:model.defer="name" class="w-full border rounded p-2"/>
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

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

            <div class="mb-4">
                <label class="block font-semibold mb-1">Файл *</label>
                <input type="file" wire:model="files" multiple class="w-full"/>
                @error('file') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

                @if ($file)
                    <div class="mt-2 text-sm text-gray-600">
                        Выбран файл: {{ $file->getClientOriginalName() }}
                    </div>
                @endif
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Добавить вложение
            </button>
        </form>

        <div>
            @if($attachments->isEmpty())
                <p class="text-gray-500">Вложений пока нет.</p>
            @else
                <div class="mb-4 max-h-[400px] overflow-auto">
                <ul class="space-y-2">
                    @foreach($attachments as $attachment)
                        <li class="flex justify-between items-center border rounded p-3">
                            <div>
                                {{--                                <strong>{{ $attachment->name }}</strong>--}}
                                {{--                                <span class="ml-2 text-sm text-gray-600">[{{ ucfirst($attachment->type) }}]</span>--}}
                                @if($attachment->type === 'image')
                                    <img src="{{ Storage::url($attachment->url) }}" alt="{{ $attachment->name }}"
                                         class="max-w-[100px] max-h-[100px]"/>
                                @elseif($attachment->type === 'video')
                                    <strong>{{ $attachment->name }}</strong>
                                    <span class="ml-2 text-sm text-gray-600">[{{ ucfirst($attachment->type) }}]</span>
                                @elseif($attachment->type === 'document')
                                    <strong>{{ $attachment->name }}</strong>
                                    <span class="ml-2 text-sm text-gray-600">[{{ ucfirst($attachment->type) }}]</span>
                                @endif
{{--                                <a href="{{ Storage::url($attachment->url) }}" target="_blank"--}}
{{--                                   class="text-blue-600 hover:underline text-sm">--}}
{{--                                    Открыть--}}
{{--                                </a>--}}
                                <button wire:click="deleteAttachment({{ $attachment->id }})"
                                        onclick="return confirm('Удалить вложение?')"
                                        class="text-red-600 hover:underline text-sm">
                                    Удалить
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ul>
                    </div>
            @endif
        </div>
    @endif

</div>
