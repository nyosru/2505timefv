<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-1">
    @forelse($photos as $photo)
{{--        <div class="border rounded overflow-hidden shadow-sm">--}}
{{--            <img src="{{ $photo->url }}" alt="{{ $photo->name }}" class="object-cover w-full h-24" />--}}
{{--        </div>--}}
        <div class="border rounded overflow-hidden shadow-sm relative group bg-white">
            <img src="{{ asset('storage/' . $photo->url) }}" alt="{{ $photo->name }}" class="object-cover w-full h-24" />
            <button type="button"
                    wire:click="deletePhoto({{ $photo->id }})"
                    class="
{{--                    absolute top-1 right-1 --}}
                    bg-red-600 text-white rounded px-2 py-0.5 shadow opacity-80 group-hover:opacity-100 text-xs hover:bg-red-800"
                    title="Удалить"
                    onclick="return confirm('Удалить это фото?')"
            >✕</button>
        </div>
    @empty
        <div class="col-span-full text-center text-gray-500">
            Нет загруженных фото.
        </div>
    @endforelse
</div>
