<div class="w-full p-6" x-data="{ open: false }">

    <h2 class="text-xl font-semibold mb-4">
        <!-- Кнопка "+" справа сверху -->
        <button
                @click="open = !open"
                type="button"
                class="float-right text-2xl font-bold px-3 py-0 leading-none select-none rounded hover:bg-gray-200"
                aria-label="Показать/скрыть форму добавления"
        >
            +
        </button>
        Участники
    </h2>

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

    <div x-show="open" x-transition>

        <!-- Выбор мероприятия -->
        @if( empty( $eventId ))
            <div class="mb-4">
                <label class="block font-semibold mb-1">Мероприятие *</label>
                <select wire:model.live="eventId" class="w-full border rounded p-2">
                    <option value="">-- Выберите мероприятие --</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                    @endforeach
                </select>
                @error('eventId') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        @endif

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


            @if( $this->events->find($eventId)->groupsNagrada->count() > 0 )
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Группа соревнования</label>

                    {{--            <pre class="max-h-[200px] text-xs  overflow-y-auto">{{ print_r(--}}
                    {{--                $this->events->find($eventId)->groupsNagrada->toArray()--}}
                    {{--                ,1) }}</pre>--}}

                    <select wire:model="event_group_nagrada_id" class="w-full border rounded p-2">
                        <option value="">-- Выберите группу --</option>
                        @foreach($this->events->find($eventId)->groupsNagrada as $i)
                            <option value="{{ $i->id }}">
                                {{ $i->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('athleteId') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            @endif

            <!-- Выбор места -->
            <div class="mb-4">
                <label class="block font-semibold mb-1">Место (1-3 или пусто)</label>
                <select wire:model="place" class="w-full border rounded p-2">
                    <option value="">-- Не указано --</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                @error('place') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>


            <button wire:click="addParticipant" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Добавить спортсмена
            </button>

    </div>
    <!-- Список уже привязанных -->
    {{--        <h3 class="mt-8 mb-4 text-xl font-semibold">Уже привязанные спортсмены</h3>--}}

    {{--    <pre class="max-h-[200px] text-xs  overflow-y-auto">{{ print_r($events->toArray(),1) }}</pre>--}}

    @if($participants->isEmpty())
        <p class="text-gray-600">Пока нет привязанных спортсменов.</p>
    @else

        @php
            $previousGroupNagrada = null;
        @endphp

        <ul class="space-y-2">
            @foreach($participants as $participant)

{{--                <li>--}}
{{--                    <pre>{{ print_r($participant->toArray(),1) }}</pre>--}}
{{--                </li>--}}

                @if( empty($participant->eventGroupNagrada->name) )
                    @continue
                @endif

{{--            <pre>{{$participant->event_group_nagrada_id}}</pre>--}}

                @if( !empty($participant->event_group_nagrada_id) && $participant->event_group_nagrada_id != $previousGroupNagrada)

                    <li class="bg-gray-300">
                        {{$participant->eventGroupNagrada->name}}
                    </li>
                    @php
                        $previousGroupNagrada = $participant->event_group_nagrada_id;
                    @endphp
{{--                @elseif( !empty($participant->event_group_nagrada_id) && $participant->event_group_nagrada_id == $previousGroupNagrada)--}}
                @endif

                <livewire:event.event-participiant-item :participant="$participant" :key="'parcipant-'.$participant->id" />

            @endforeach

                <li class="bg-gray-300">
                    без групп
                </li>

                @foreach($participants as $participant)

                    @if( empty($participant->eventGroupNagrada->name) )
                <livewire:event.event-participiant-item :participant="$participant" :key="'parcipant-'.$participant->id" />
                    @endif

            @endforeach
        </ul>
    @endif
    @endif

</div>
