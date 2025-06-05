<div class="w-full p-6">

    <div>
        <a href="{{ route('admin.guest.manager') }}"
           class="float-right px-2 blue-500 underline">Добавить гостя</a>
        <h3 class="mt-8 mb-4 text-xl font-semibold">Гости мероприятия</h3>
    </div>

    @if(session()->has('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- Выбор мероприятия -->
    @if( empty($eventId) )
        <div class="mb-4">
            <label class="block font-semibold mb-1">Мероприятие *</label>
            @if($eventId)
                <div class="p-2 bg-gray-100 rounded">{{ $events->firstWhere('id', $eventId)?->title }}</div>
            @else
                <select wire:model="eventId" class="w-full border rounded p-2">
                    <option value="">-- Выберите мероприятие --</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                    @endforeach
                </select>
                @error('eventId') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            @endif
        </div>
    @endif

    {{--        $eventId: {{ $eventId ?? 'x' }}--}}
    @if($eventId)
        <!-- Выбор гостя -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Гость *</label>
            <select wire:model="guestId" class="w-full border rounded p-2">
                <option value="">-- Выберите гостя --</option>
                @foreach($guests as $guest)
                    <option value="{{ $guest->id }}">{{ $guest->last_name }} {{ $guest->first_name }}</option>
                @endforeach
            </select>
            @error('guestId') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button wire:click="addGuest" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Добавить гостя
        </button>

        <!-- Список привязанных гостей -->
        <h3 class="mt-8 mb-4 font-semibold">Гости мероприятия</h3>

        @if($eventGuests->isEmpty())
            <p class="text-gray-600">Пока нет привязанных гостей.</p>
        @else
            <ul class="space-y-2">
                @foreach($eventGuests as $eventGuest)
                    <li class="flex justify-between items-center border rounded p-3">
                        <span>{{ $eventGuest->guest->last_name }} {{ $eventGuest->guest->first_name }}</span>
                        <button
                                wire:click="removeGuest({{ $eventGuest->id }})"
                                onclick="return confirm('Удалить гостя из мероприятия?')"
                                class="text-red-600 hover:underline text-sm"
                        >
                            Удалить
                        </button>
                    </li>
                @endforeach
            </ul>
        @endif
    @endif

</div>
