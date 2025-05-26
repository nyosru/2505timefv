<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Управление видами спорта</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-6">
        @if ($updateMode)
            <h3 class="text-xl mb-2">Редактировать вид спорта</h3>
        @else
            <h3 class="text-xl mb-2">Добавить новый вид спорта</h3>
        @endif

        <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
            <input type="text" wire:model.defer="name" placeholder="Название вида спорта" class="border p-2 rounded w-full mb-2" />
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

            <div>
                @if ($updateMode)
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Обновить</button>
                    <button type="button" wire:click="cancel" class="ml-2 px-4 py-2 border rounded hover:bg-gray-100">Отмена</button>
                @else
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Создать</button>
                @endif
            </div>
        </form>
    </div>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
        <tr>
            <th class="border border-gray-300 p-2 text-left">ID</th>
            <th class="border border-gray-300 p-2 text-left">Название</th>
            <th class="border border-gray-300 p-2 text-center">Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($sportTypes as $sportType)
            <tr>
                <td class="border border-gray-300 p-2">{{ $sportType->id }}</td>
                <td class="border border-gray-300 p-2">{{ $sportType->name }}</td>
                <td class="border border-gray-300 p-2 text-center space-x-2">
                    <button wire:click="edit({{ $sportType->id }})" class="text-blue-600 hover:underline">Редактировать</button>
                    <button wire:click="delete({{ $sportType->id }})"
                            onclick="confirm('Удалить вид спорта?') || event.stopImmediatePropagation()"
                            class="text-red-600 hover:underline">Удалить</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="p-2 text-center text-gray-500">Виды спорта не найдены.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $sportTypes->links('vendor.pagination.my1tailwind') }}
    </div>
</div>
