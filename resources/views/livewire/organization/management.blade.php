<div class="p-4">
    <h2 class="text-2xl font-bold mb-4">Управление организациями</h2>

    @if(session()->has('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between mb-3">
        <input type="text" wire:model.debounce.500ms="search" placeholder="Поиск по названию" class="border p-2 rounded w-1/3" />
        <button wire:click="create" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Добавить организацию</button>
    </div>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
        <tr class="bg-gray-100">
            <th class="border border-gray-300 p-2 text-left">#</th>
            <th class="border border-gray-300 p-2 text-left">Название</th>
            <th class="border border-gray-300 p-2 text-left">Город</th>
            <th class="border border-gray-300 p-2 text-left">Адрес</th>
            <th class="border border-gray-300 p-2 text-left">Логотип</th>
            <th class="border border-gray-300 p-2 text-left">Сайт</th>
            <th class="border border-gray-300 p-2 text-left">Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse($organizers as $org)
            <tr>
                <td class="border border-gray-300 p-2">{{ $org->id }}</td>
                <td class="border border-gray-300 p-2">{{ $org->name }}</td>
                <td class="border border-gray-300 p-2">{{ $org->city?->name ?? '-' }}</td>
                <td class="border border-gray-300 p-2">{{ $org->address ?? '-' }}</td>
                <td class="border border-gray-300 p-2">
                    @if($org->logo)
                        <img src="{{ asset('storage/' . $org->logo) }}" alt="Логотип" class="h-10 w-auto rounded" />
                    @else
                        -
                    @endif
                </td>
                <td class="border border-gray-300 p-2">
                    @if($org->website)
                        <a href="{{ $org->website }}" target="_blank" class="text-blue-600 underline">{{ $org->website }}</a>
                    @else
                        -
                    @endif
                </td>
                <td class="border border-gray-300 p-2 whitespace-nowrap">
                    <button wire:click="edit({{ $org->id }})" class="px-2 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 mr-2">Редактировать</button>
                    <button wire:click="delete({{ $org->id }})" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700" onclick="confirm('Удалить организацию?') || event.stopImmediatePropagation()">Удалить</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="p-4 text-center text-gray-500">Нет организаций</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $organizers->links() }}
    </div>

    <!-- Модальное окно для формы -->
    @if($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white rounded shadow-lg p-6 w-full max-w-xl relative">

                <h3 class="text-xl font-semibold mb-4">{{ $organizerId ? 'Редактировать организацию' : 'Добавить организацию' }}</h3>

                <form wire:submit.prevent="save" enctype="multipart/form-data" novalidate>

                    <div class="mb-4">
                        <label for="name" class="block mb-1 font-semibold">Название *</label>
                        <input id="name" type="text" wire:model.defer="name" class="w-full border rounded px-3 py-2 @error('name') border-red-600 @enderror" />
                        @error('name') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="city_id" class="block mb-1 font-semibold">Город</label>
                        <select id="city_id" wire:model.defer="city_id" class="w-full border rounded px-3 py-2 @error('city_id') border-red-600 @enderror">
                            <option value="">-- не выбран --</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }} ({{ $city->country->name ?? 'x' }})</option>
                            @endforeach
                        </select>
                        @error('city_id') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block mb-1 font-semibold">Адрес</label>
                        <input id="address" type="text" wire:model.defer="address" class="w-full border rounded px-3 py-2 @error('address') border-red-600 @enderror" />
                        @error('address') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="website" class="block mb-1 font-semibold">Адрес сайта</label>
                        <input id="website" type="url" wire:model.defer="website" class="w-full border rounded px-3 py-2 @error('website') border-red-600 @enderror" />
                        @error('website') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-semibold">Логотип</label>
                        <input type="file" wire:model="logo" accept="image/*" />
                        @error('logo') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror

                        @if($logoPreview)
                            <img src="{{ $logoPreview }}" alt="Превью логотипа" class="h-20 mt-2 rounded" />
                        @endif
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Отмена</button>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">{{ $organizerId ? 'Сохранить' : 'Добавить' }}</button>
                    </div>
                </form>

                <!-- Кнопка закрытия модального окна -->
                <button type="button" wire:click="closeModal" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 text-xl font-bold">&times;</button>
            </div>
        </div>
    @endif
</div>
