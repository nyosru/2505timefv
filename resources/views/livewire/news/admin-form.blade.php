<div class="p-6">

    <h3 class="text-xl font-bold mb-4">
        {{ ( $editMode ? 'Редактирование' : 'Создание' ) }} новости
    </h3>

    @if (session()->has('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif


    <form wire:submit.prevent="saveData">

        <!-- Title -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Заголовок *</label>
            <input
                    type="text"
                    wire:model="title"
                    class="w-full p-2 border rounded"
                    required
            >
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            {{--                    <x-input-error for="title" />--}}
            {{--                    <x-input-error  :messages="$errors->get('title')" for="title" />--}}
        </div>


        <!-- Фото -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Фото</label>
            <input type="file" wire:model="photo" accept="image/*" class="w-full p-2 border rounded" />
            @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            @if ($photo)
                <div class="mt-2">
                    <span class="block mb-1">Предпросмотр:</span>
                    <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="max-w-xs rounded" />
                </div>
            @elseif($editMode && $currentNews && $currentNews->photo)
                <div class="mt-2">
                    <span class="block mb-1">Текущее фото:</span>
                    <img src="{{ asset('storage/' . $currentNews->photo) }}" alt="Current Photo" class="max-w-xs rounded" />
                </div>
            @endif
        </div>


        <!-- Date -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Дата *</label>
            <input
                    type="date"
                    wire:model="date"
                    class="w-full p-2 border rounded"
                    required
            >
            @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            {{--                    <x-input-error for="date" />--}}
        </div>

        <!-- Short Text -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Краткий текст</label>
            <textarea
                    wire:model="short_text"
                    class="w-full p-2 border rounded h-24"
            ></textarea>
            @error('short_text') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            {{--                    <x-input-error for="short_text" />--}}
        </div>

        <!-- Full Text -->
        <div class="mb-4">
            <!-- Подключение TinyMCE -->
            {{--                    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>--}}

            <label class="block text-sm font-medium mb-1">Полный текст *</label>


            {{--                    <livewire:editor />--}}
{{--            <input id="x" type="hidden" name="content" wire:model.defer="full_text">--}}
{{--            <trix-editor input="x"></trix-editor>--}}

            <textarea wire:model="full_text" name="full_text"
                style="height: 300px; width: 100%;"
                ></textarea>
{{--            <input id="x" type="hidden" wire:model="full_text" name="full_text" >--}}
{{--            <trix-editor--}}
{{--                    input="x"--}}
{{--                    wire:key="trix-editor"--}}
{{--                    x-data--}}
{{--                    x-init="$nextTick(() => {--}}
{{--        let trix = $el;--}}
{{--        trix.editor.loadHTML(@entangle('full_text').live);--}}
{{--        trix.addEventListener('trix-change', function(event) {--}}
{{--            @this.set('full_text', trix.value);--}}
{{--        });--}}
{{--    })"--}}
{{--            ></trix-editor>--}}

            @error('full_text') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror


{{--            @if(1==1)--}}
{{--                <script>--}}
{{--                    document.addEventListener("trix-attachment-add", function (event) {--}}
{{--                        if (event.attachment.file) {--}}
{{--                            uploadFileAttachment(event.attachment);--}}
{{--                        }--}}
{{--                    });--}}

{{--                    function uploadFileAttachment(attachment) {--}}
{{--                        let file = attachment.file;--}}
{{--                        let form = new FormData();--}}
{{--                        form.append("file", file);--}}

{{--                        fetch("/trix-upload", {--}}
{{--                            method: "POST",--}}
{{--                            headers: {--}}
{{--                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")--}}
{{--                            },--}}
{{--                            body: form--}}
{{--                        })--}}
{{--                            .then(response => response.json())--}}
{{--                            .then(data => {--}}
{{--                                attachment.setAttributes({--}}
{{--                                    url: data.url,--}}
{{--                                    href: data.url--}}
{{--                                });--}}
{{--                            })--}}
{{--                            .catch(error => {--}}
{{--                                console.error("Upload failed:", error);--}}
{{--                            });--}}
{{--                    }--}}
{{--                </script>--}}
{{--            @endif--}}
{{--            @push('scripts')--}}
{{--                <script>--}}
{{--                    document.addEventListener('livewire:load', function () {--}}
{{--                        let trix = document.querySelector('trix-editor');--}}

{{--                        trix.addEventListener('trix-change', function(event) {--}}
{{--                        @this.set('full_text', event.target.innerHTML);--}}
{{--                        });--}}

{{--                        Livewire.hook('message.processed', () => {--}}
{{--                            trix.editor.loadHTML(@this.full_text || '');--}}
{{--                        });--}}
{{--                    });--}}
{{--                </script>--}}
{{--            @endpush--}}

        </div>

{{--        вид спорта--}}
{{--        <div class="mb-4">--}}
{{--            <label class="block text-sm font-medium mb-1">Виды спорта</label>--}}
{{--            <div class="flex flex-wrap gap-2 max-h-48 overflow-auto border rounded p-2">--}}
{{--                @foreach($sport_types as $id => $name)--}}
{{--                    <label class="inline-flex items-center space-x-2 bg-blue-100 p-1 rounded mr-1 mb-1">--}}
{{--                        <input type="checkbox" wire:model="sport_type_ids" value="{{ $id }}" class="form-checkbox" />--}}
{{--                        <span>{{ $name }}</span>--}}
{{--                    </label>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--            @error('sport_type_ids') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror--}}
{{--        </div>--}}


        <div class="mb-4 w-full">
            <label class="block text-sm font-medium mb-1">Виды спорта</label>
            <div class="flex flex-wrap xgap-1 max-h-48 overflow-auto border rounded ">
                @foreach($sport_types as $id => $name)
                    <label class="inline-flex items-center space-x-2 bg-blue-100 px-2 py-1 rounded mr-1 mb-1">
                        <input type="checkbox" wire:model="sport_type_ids" value="{{ $id }}" class="form-checkbox" />
                        <span>{{ $name }}</span>
                    </label>
                @endforeach
            </div>
            @error('sport_type_ids') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>



        <!-- IDs -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium mb-1">ID мероприятия</label>
{{--                <input--}}
{{--                        type="number"--}}
{{--                        wire:model="event_id"--}}
{{--                        class="w-full p-2 border rounded"--}}
{{--                >--}}
                <select wire:model="event_id" class="w-full p-2 border rounded">
                    <option value="">Выберите мероприятие</option>
                    @foreach($events as $id => $title)
                        <option value="{{ $id }}">{{ $title }}</option>
                    @endforeach
                </select>
                @error('event_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">ID спортсмена</label>
{{--                <input--}}
{{--                        type="number"--}}
{{--                        wire:model="athlete_id"--}}
{{--                        class="w-full p-2 border rounded"--}}
{{--                >--}}
                <select wire:model="athlete_id" class="w-full p-2 border rounded">
                    <option value="">Выберите спортсмена</option>
                    @foreach($athletes as $id => $last_name)
                        <option value="{{ $id }}">{{ $last_name }}</option>
                    @endforeach
                </select>
                @error('athlete_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>


        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-2 mt-6">
            <button
                    type="button"
                    wire:click.prevent="resetForm"
                    class="px-4 py-2 border rounded hover:bg-gray-50"
            >
                Отмена
            </button>
            <button
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
            >
                Сохранить
            </button>
        </div>

    </form>
</div>