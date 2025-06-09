{{--                <li>--}}
{{--                    <pre class="max-h-[200px] text-xs  overflow-y-auto">{{ print_r($participant->toArray(),1) }}</pre>--}}
{{--                </li>--}}

<li class="flex justify-between items-center hover:bg-yellow-200
{{--border rounded --}}
py-1">
    @if($show)
        <span>
                    @if(!empty($participant->pivot->place))
                ({{ $participant->pivot->place ?? '-' }})
            @endif
            {{ $participant->last_name ?? '' }}
            {{ $participant->first_name ?? ''}}
                </span>
        <button
                wire:click="removeParticipant({{ $participant->id }})"
                onclick="return confirm('Удалить спортсмена из мероприятия?')"
                class="text-red-600 hover:underline text-sm"
        >
            Удалить
        </button>
    @endif
</li>