<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">

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
    <div class="mb-4">
        <label class="block font-semibold mb-1">Мероприятие *</label>
        <select wire:model="eventId" class="w-full border rounded p-2">
            <option value="">-- Выберите мероприятие --</option>
            @foreach($events as $event)
                <option value="{{ $event->id }}">{{ $event->title }}</option>
            @endforeach
        </select>
        @error('eventId') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    @if($eventId)
        <!-- Выбор спортсмена -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Спортсмен *</label>
            <select wire:model="athleteId" class="w-full border rounded p-2">
                <option value="">-- Выберите спортсмена --</option>
                @foreach($athletes as $athlete)
                    <option value="{{ $athlete->id }}">
                        {{ $athlete->last_name }}
                        {{ $athlete->first_name }}
                        @if( !empty($athlete->birth_date) )
                        {{ date('d.m.Y', strtotime($athlete->birth_date)) }}
                        @endif
                    </option>
                @endforeach
            </select>
            @error('athleteId') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button wire:click="addParticipant" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Добавить спортсмена
        </button>

        <!-- Список уже привязанных -->
        <h3 class="mt-8 mb-4 text-xl font-semibold">Уже привязанные спортсмены</h3>

        @if($participants->isEmpty())
            <p class="text-gray-600">Пока нет привязанных спортсменов.</p>
        @else
            <ul class="space-y-2">
                @foreach($participants as $participant)
                    <li class="flex justify-between items-center border rounded p-3">
                        <span>
                            {{ $participant->athlete->last_name }}
                            {{ $participant->athlete->first_name }}
                        </span>
                        <button
                                wire:click="removeParticipant({{ $participant->id }})"
                                onclick="return confirm('Удалить спортсмена из мероприятия?')"
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
