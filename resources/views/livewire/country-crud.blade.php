<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Управление странами</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-6">
        <div class="float-right mb-6 w-full sm:w-[350px] bg-gradient-to-tr from-blue-200 to-blue-300 p-2 rounded">
        @if ($updateMode)
            <h3 class="text-xl mb-2">Редактировать страну</h3>
        @else
            <h3 class="text-xl mb-2">Добавить новую страну</h3>
        @endif

        <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
            <input type="text" wire:model.defer="name" placeholder="Наименование страны" class="border p-2 rounded w-full mb-2" />
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

            <div class="text-right">
                @if ($updateMode)
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Обновить</button>
                    <button type="button" wire:click="cancel" class="ml-2 px-4 py-2 border rounded hover:bg-gray-100">Отмена</button>
                @else
                    <button type="submit" class="
                    bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700
                    ">Создать</button>
                @endif
            </div>
        </form>
    </div>
    </div>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
        <tr>
            <th class="border border-gray-300 p-2 text-left">ID</th>
            <th class="border border-gray-300 p-2 text-left">Наименование</th>
            <th class="border border-gray-300 p-2 text-center">Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($countries as $country)
            <tr>
                <td class="border border-gray-300 p-2">{{ $country->id }}</td>
                <td class="border border-gray-300 p-2">{{ $country->name }}</td>
                <td class="border border-gray-300 p-2 text-center space-x-2">
                    <button wire:click="edit({{ $country->id }})" class="text-blue-600 hover:underline">Редактировать</button>
                    <button wire:click="delete({{ $country->id }})"
                            onclick="confirm('Удалить страну?') || event.stopImmediatePropagation()"
                            class="text-red-600 hover:underline">Удалить</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="p-2 text-center text-gray-500">Страны не найдены.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $countries->links('vendor.pagination.my1tailwind') }}
    </div>
</div>
