<div class="p-4 border rounded shadow-sm max-w-md">

    <h3 class="text-lg font-semibold mb-4">Компания(и) авторы</h3>

    @if(session()->has('success'))
        <div class="mb-3 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4 flex space-x-2">
        <form wire:submit="addOrganizer" class="flex w-full">
            <div >
        <select wire:model="selectedOrganizerId" class="flex-grow border rounded p-2 w-full">
            <option value="">Выберите организацию для добавления</option>
            @foreach($availableOrganizers as $organizer)
                <option value="{{ $organizer->id }}">{{ $organizer->name }}</option>
            @endforeach
        </select>
            </div>
    <div>
        <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
{{--                @if(!$selectedOrganizerId) disabled @endif--}}
        >Добавить</button>
    </div>
        </form>
    </div>

    @error('selectedOrganizerId')
    <div class="mb-4 text-red-600">{{ $message }}</div>
    @enderror

    @if($news->companyAutors->isEmpty())
        <p class="text-gray-500">Нет добавленных организаторов.</p>
    @else
        <ul class="space-y-2">
            @foreach($news->companyAutors as $organizer)
                <li class="flex justify-between items-center border px-3 py-2 rounded">
                    <span>{{ $organizer->name }}</span>
                    <button wire:click="removeOrganizer({{ $organizer->id }})"
                            class="text-red-600 hover:text-red-800"
                            onclick="return confirm('Удалить этого организатора?')"
                            title="Удалить">
                        &times;
                    </button>
                </li>
            @endforeach
        </ul>
    @endif
</div>
