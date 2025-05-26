<div>
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Управление спортсменами</h2>
        <button wire:click="create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Добавить спортсмена
        </button>
    </div>

    @if(session()->has('success'))
        <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full border border-gray-300 rounded">
        <thead class="bg-gray-100">
        <tr>
            <th class="p-2 border-b">Фамилия</th>
            <th class="p-2 border-b">Имя</th>
            <th class="p-2 border-b">Отчество</th>
            <th class="p-2 border-b">Дата рождения</th>
            <th class="p-2 border-b">Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse($athletes as $athlete)
            <tr class="hover:bg-gray-50">
                <td class="p-2 border-b">{{ $athlete->last_name }}</td>
                <td class="p-2 border-b">{{ $athlete->first_name }}</td>
                <td class="p-2 border-b">{{ $athlete->middle_name }}</td>
                <td class="p-2 border-b">
                    {{ $athlete->birth_date ? $athlete->birth_date->format('d.m.Y') : '-' }}
                </td>
                <td class="p-2 border-b text-right space-x-2">
                    <button wire:click="edit({{ $athlete->id }})" class="text-blue-600 hover:underline">Редактировать</button>
                    <button wire:click="delete({{ $athlete->id }})"
                            onclick="confirm('Удалить спортсмена?') || event.stopImmediatePropagation()"
                            class="text-red-600 hover:underline">
                        Удалить
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="p-2 text-center text-gray-500">Спортсмены не найдены</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $athletes->links() }}
    </div>

    @if($showForm)
        <livewire:athlete.admin-form :athleteId="$selectedAthleteId" wire:key="athlete-form-{{ $selectedAthleteId ?? 'new' }}" />
    @endif
</div>
