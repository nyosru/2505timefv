<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">

    <h2 class="text-2xl font-bold mb-6">Управление гостями</h2>

    @if(session()->has('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Форма добавления / редактирования -->
    <form wire:submit.prevent="save" class="mb-6 space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Фамилия *</label>
                <input type="text" wire:model.defer="last_name" class="w-full border rounded p-2" />
                @error('last_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-semibold mb-1">Имя *</label>
                <input type="text" wire:model.defer="first_name" class="w-full border rounded p-2" />
                @error('first_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-semibold mb-1">Отчество</label>
                <input type="text" wire:model.defer="middle_name" class="w-full border rounded p-2" />
                @error('middle_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-semibold mb-1">Дата рождения</label>
                <input type="date" wire:model.defer="birth_date" class="w-full border rounded p-2" />
                @error('birth_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block font-semibold mb-1">Комментарий</label>
            <textarea wire:model.defer="comment" rows="3" class="w-full border rounded p-2"></textarea>
            @error('comment') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                {{ $editMode ? 'Обновить' : 'Добавить' }}
            </button>
            <button type="button" wire:click="resetForm" class="px-4 py-2 border rounded hover:bg-gray-100">
                Отмена
            </button>
        </div>
    </form>

    <!-- Поиск -->
    <input
            type="text"
            wire:model.debounce.300ms="search"
            placeholder="Поиск гостей..."
            class="mb-4 w-full border rounded p-2"
    />

    <!-- Список гостей -->
    <table class="w-full border-collapse border">
        <thead>
        <tr class="bg-gray-100">
            <th class="border p-2 text-left">Фамилия</th>
            <th class="border p-2 text-left">Имя</th>
            <th class="border p-2 text-left">Отчество</th>
            <th class="border p-2 text-left">Дата рождения</th>
            <th class="border p-2 text-left">Комментарий</th>
            <th class="border p-2 text-center">Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse($guests as $guest)
            <tr class="hover:bg-gray-50">
                <td class="border p-2">{{ $guest->last_name }}</td>
                <td class="border p-2">{{ $guest->first_name }}</td>
                <td class="border p-2">{{ $guest->middle_name }}</td>
                <td class="border p-2">{{ $guest->birth_date?->format('d.m.Y') }}</td>
                <td class="border p-2">{{ $guest->comment }}</td>
                <td class="border p-2 text-center space-x-2">
                    <button wire:click="edit({{ $guest->id }})" class="text-blue-600 hover:underline">
                        Редактировать
                    </button>
                    <button
                            wire:click="delete({{ $guest->id }})"
                            onclick="return confirm('Удалить гостя?')"
                            class="text-red-600 hover:underline"
                    >
                        Удалить
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center p-4 text-gray-500">Гостей не найдено.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $guests->links() }}
    </div>

</div>
