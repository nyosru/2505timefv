<div class="w-full p-6 ">

    <!-- Список привязанных спонсоров -->
    <h3 class="mt-8 mb-4 text-xl font-semibold">Спонсоры мероприятия</h3>

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

    @if( empty($events) )
        <!-- Выбор мероприятия -->
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

    @if($eventId)
        <!-- Выбор спонсора -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Спонсор *</label>
            <select wire:model="sponsorId" class="w-full border rounded p-2">
                <option value="">-- Выберите спонсора --</option>
                @foreach($sponsors as $sponsor)
                    <option value="{{ $sponsor->id }}">{{ $sponsor->company_name ?: ($sponsor->last_name . ' ' . $sponsor->first_name) }}</option>
                @endforeach
            </select>
            @error('sponsorId') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button wire:click="addSponsor" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Добавить спонсора
        </button>


        @if($eventSponsors->isEmpty())
            <p class="text-gray-600">Пока нет привязанных спонсоров.</p>
        @else
            <ul class="space-y-2">
                @foreach($eventSponsors as $sponsor)
                    <li class="flex justify-between items-center border rounded p-3">
                        <span>{{ $sponsor->company_name ?: ($sponsor->last_name . ' ' . $sponsor->first_name) }}</span>
                        <button
                                wire:click="removeSponsor({{ $sponsor->id }})"
                                onclick="return confirm('Удалить спонсора из мероприятия?')"
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
