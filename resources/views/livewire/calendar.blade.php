<div class="bg-white rounded-lg shadow">
    <div class="flex items-center justify-between p-4 border-b">
        <button wire:click="previousMonth" class="p-2 hover:bg-gray-100 rounded-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <h2 class="text-lg font-semibold text-gray-900">
            {{ Carbon\Carbon::createFromDate($currentYear, $currentMonth, 1)->format('F Y') }}
        </h2>
        <button wire:click="nextMonth" class="p-2 hover:bg-gray-100 rounded-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>

    <div class="grid grid-cols-7 gap-px bg-gray-200">
        @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
            <div class="bg-gray-50 p-2 text-center text-sm font-medium text-gray-500">{{ $day }}</div>
        @endforeach

        @foreach($this->getDays() as $day)
            <div @class([
                'bg-white p-2 min-h-[80px]',
                'text-gray-400' => !$day,
            ])>
                @if($day)
                    <button
                        wire:click="selectDate('{{ $day->format('Y-m-d') }}')"
                        @class([
                            'w-8 h-8 rounded-full text-sm font-medium transition-colors',
                            'bg-blue-500 text-white' => $selectedDate === $day->format('Y-m-d'),
                            'hover:bg-gray-100' => $selectedDate !== $day->format('Y-m-d'),
                            'text-blue-600 font-bold' => $day->isToday(),
                        ])
                    >
                        {{ $day->day }}
                    </button>
                    @php $dayEvents = $this->getEventsForDate($day->format('Y-m-d')); @endphp
                    @if(count($dayEvents) > 0)
                        <div class="mt-1 space-y-1">
                            @foreach(array_slice($dayEvents, 0, 2) as $event)
                                <div class="text-xs truncate px-1 py-0.5 rounded {{ $event['color'] ?? 'bg-blue-100 text-blue-700' }}">
                                    {{ $event['title'] }}
                                </div>
                            @endforeach
                            @if(count($dayEvents) > 2)
                                <div class="text-xs text-gray-500">+{{ count($dayEvents) - 2 }} more</div>
                            @endif
                        </div>
                    @endif
                @endif
            </div>
        @endforeach
    </div>
</div>
