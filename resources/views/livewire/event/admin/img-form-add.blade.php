<div>
    <form wire:submit.prevent="save" enctype="multipart/form-data" novalidate>
        <label class="block font-semibold mb-2">Загрузить фото мероприятия</label>
        <div>
            <input type="file" multiple wire:model="photos" accept="image/*" class="inline-block mb-4"/>

        </div>
        @error('photos.*')
        <div class="text-red-600 mb-2">{{ $message }}</div>
        @enderror

        @if ($photos)
            <div class="mb-4 p-2 bg-white rounded
            border-2 border-blue-400
{{--            flex flex-wrap gap-4--}}
            ">
                <button type="submit"
                        class="float-right px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                >Загрузить
                </button>
                @foreach ($photos as $photo)
{{--                    <div class="w-24 h-24 border rounded overflow-hidden">--}}
                        <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="
{{--                        object-cover--}}
                        w-[120px] inline mr-1 mb-1
                        border border-black rounded
{{--                        w-full h-full--}}
                        "/>
{{--                    </div>--}}
                @endforeach
            </div>
        @endif


    </form>
</div>
