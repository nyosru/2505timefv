<div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Управление новостями</h2>
{{--        <button wire:click="create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">--}}
{{--            + Добавить новость--}}
{{--        </button>--}}
        <button wire:click="create" class="btn btn-primary">+ Добавить новость</button>
    </div>

    <!-- Search -->
    <div class="mb-4">
        <input
                type="text"
                wire:model.live="search"
                placeholder="Поиск по заголовкам..."
                class="w-full p-2 border rounded"
        >
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-lg border">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Заголовок</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Дата</th>
                <th class="px-6 py-3 text-right text-sm font-medium text-gray-500">Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($news as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $item->title }}</td>
                    <td class="px-6 py-4">{{ $item->date->format('d.m.Y') }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <button
                                wire:click="edit({{ $item->id }})"
                                class="text-blue-600 hover:text-blue-800"
                        >
                            ✏️
                        </button>
                        <button
                                wire:confirm("Удалить новость?")
                        wire:click="delete({{ $item->id }})"
                        class="text-red-600 hover:text-red-800"
                        >
                        🗑️
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">Новостей не найдено</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $news->links() }}
    </div>

    <!-- Edit Modal -->
{{--    <x-modal wire:model.defer="editMode" name="edit-modal">--}}
    @if($showForm)
        <div class="p-6">
            <h3 class="text-xl font-bold mb-4">
                {{ $editMode ? 'Редактирование' : 'Создание' }} новости
            </h3>

            <form wire:submit.prevent="save">
                <!-- Title -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Заголовок *</label>
                    <input
                            type="text"
                            wire:model="title"
                            class="w-full p-2 border rounded"
                            required
                    >
{{--                    <x-input-error for="title" />--}}
{{--                    <x-input-error  :messages="$errors->get('title')" for="title" />--}}
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
{{--                    <x-input-error for="date" />--}}
                </div>

                <!-- Short Text -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Краткий текст</label>
                    <textarea
                            wire:model="short_text"
                            class="w-full p-2 border rounded h-24"
                    ></textarea>
{{--                    <x-input-error for="short_text" />--}}
                </div>

                <!-- Full Text -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Полный текст *</label>
                    <textarea
                            wire:model="full_text"
                            class="w-full p-2 border rounded h-32"
                            required
                    ></textarea>
{{--                    <x-input-error for="full_text" />--}}
                </div>

                <!-- IDs -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">ID мероприятия</label>
                        <input
                                type="number"
                                wire:model="event_id"
                                class="w-full p-2 border rounded"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">ID спортсмена</label>
                        <input
                                type="number"
                                wire:model="athlete_id"
                                class="w-full p-2 border rounded"
                        >
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
    @endif
{{--    </x-modal>--}}
</div>
