<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">

    <h2 class="text-2xl font-bold mb-6">Управление спонсорами</h2>

    @if(session()->has('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="mb-6 space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <label class="block font-semibold mb-1">Название компании</label>
                <input type="text" wire:model.defer="company_name" class="w-full border rounded p-2" />
                @error('company_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Фамилия</label>
                <input type="text" wire:model.defer="last_name" class="w-full border rounded p-2" />
                @error('last_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Имя</label>
                <input type="text" wire:model.defer="first_name" class="w-full border rounded p-2" />
                @error('first_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Отчество</label>
                <input type="text" wire:model.defer="middle_name" class="w-full border rounded p-2" />
                @error('middle_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block font-semibold mb-1">Комментарий</label>
                <textarea wire:model.defer="comment" rows="3" class="w-full border rounded p-2"></textarea>
                @error('comment') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Ссылка</label>
                <input type="url" wire:model.defer="link" class="w-full border rounded p-2" />
                @error('link') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Фото (путь или URL)</label>
                <input type="text" wire:model.defer="photo" class="w-full border rounded p-2" />
                @error('photo') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Дата рождения</label>
                <input type="date" wire:model.defer="birth_date" class="w-full border rounded p-2" />
                @error('birth_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="flex gap-4">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                {{ $sponsorId ? 'Обновить' : 'Добавить' }}
            </button>
            <button type="button" wire:click="resetForm" class="px-4 py-2 border rounded hover:bg-gray-100">
                Отмена
            </button>
        </div>
    </form>

    <hr class="my-6" />

    <h3 class="text-xl font-semibold mb-4">Список спонсоров</h3>

    @if($sponsors->isEmpty())
        <p class="text-gray-600">Спонсоры отсутствуют.</p>
    @else
        <table class="w-full border-collapse border">
            <thead>
            <tr class="bg-gray-100">
                <th class="border p-2 text-left">Компания</th>
                <th class="border p-2 text-left">ФИО</th>
                <th class="border p-2 text-left">Комментарий</th>
                <th class="border p-2 text-left">Ссылка</th>
                <th class="border p-2 text-left">Дата рождения</th>
                <th class="border p-2 text-center">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sponsors as $sponsor)
                <tr class="hover:bg-gray-50">
                    <td class="border p-2">{{ $sponsor->company_name }}</td>
                    <td class="border p-2">
                        {{ $sponsor->last_name }} {{ $sponsor->first_name }} {{ $sponsor->middle_name }}
                    </td>
                    <td class="border p-2">{{ $sponsor->comment }}</td>
                    <td class="border p-2">
                        @if($sponsor->link)
                            <a href="{{ $sponsor->link }}" target="_blank" class="text-blue-600 hover:underline">
                                Ссылка
                            </a>
                        @endif
                    </td>
                    <td class="border p-2">{{ $sponsor->birth_date?->format('d.m.Y') }}</td>
                    <td class="border p-2 text-center space-x-2">
                        <button wire:click="edit({{ $sponsor->id }})" class="text-blue-600 hover:underline">
                            Редактировать
                        </button>
                        <button
                                wire:click="delete({{ $sponsor->id }})"
                                onclick="return confirm('Удалить спонсора?')"
                                class="text-red-600 hover:underline"
                        >
                            Удалить
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $sponsors->links() }}
        </div>
    @endif

</div>
