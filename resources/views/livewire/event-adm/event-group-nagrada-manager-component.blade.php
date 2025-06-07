<div class="p-6" x-data="{ open: false }">

    <h2 class="text-xl font-semibold mb-4">
        <button
                @click="open = !open"
                type="button"
                class="float-right text-2xl font-bold px-3 py-0 leading-none select-none rounded hover:bg-gray-200"
                aria-label="Показать/скрыть форму добавления"
        >
            +
        </button>
        Категории
    </h2>

    @if(session()->has('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div x-show="open" x-transition>

        <!-- Выбор мероприятия -->
        @if( $hideSetEvent && !empty($eventId) )
        @else
            <div class="mb-4">
                <label class="block font-semibold mb-1">Мероприятие *</label>
                <select wire:model="eventId" class="w-full border rounded p-2" required>
                    <option value="">-- Выберите мероприятие --</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                    @endforeach
                </select>
                @error('eventId') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        @endif

        @if($eventId)
            <!-- Добавление группы -->
            <div class="mb-4 flex gap-2">
                <input type="text" wire:model.defer="groupName" placeholder="Название группы"
                       class="flex-grow border rounded p-2"/>
                <button wire:click="addGroup" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Добавить
                </button>
            </div>
            @error('groupName') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

    </div>

    <!-- Список групп -->
    @if($groups->isEmpty())
        <p class="text-gray-600">Группы для выбранного мероприятия отсутствуют.</p>
    @else
        <ul
{{--                class="space-y-2"--}}
        >
            @foreach($groups as $group)
                <li class="flex justify-between items-center hover:bg-yellow-200 p-1">
                    @if($editingGroupId === $group->id)
                        <input type="text" wire:model.defer="editingGroupName" class="border rounded p-1 flex-grow mr-2" />
                        <button wire:click="saveGroup" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 mr-2">Сохранить</button>
                        <button wire:click="cancelEdit" class="px-3 py-1 bg-gray-400 text-white rounded hover:bg-gray-500">Отмена</button>
                        @error('editingGroupName') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    @else
                        <span>{{ $group->name }}</span>
                        <div>
                            <button wire:click="startEditGroup({{ $group->id }})" class="text-blue-600 hover:underline text-sm mr-3">Изменить</button>
                            <button wire:click="deleteGroup({{ $group->id }})" wire:confirm="Удалить группу?" class="text-red-600 hover:underline text-sm">Удалить</button>
                        </div>
                    @endif
                </li>
            @endforeach

        </ul>
    @endif
    @endif

</div>
