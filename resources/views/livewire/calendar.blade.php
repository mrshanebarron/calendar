<div class="bg-white rounded-lg shadow border border-gray-200">
    <div class="flex items-center justify-between px-4 py-3 border-b">
        <button wire:click="previousMonth" class="p-2 hover:bg-gray-100 rounded-lg"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg></button>
        <span class="text-lg font-semibold text-gray-900">{{ Carbon\Carbon::create($year, $month, 1)->format('F Y') }}</span>
        <button wire:click="nextMonth" class="p-2 hover:bg-gray-100 rounded-lg"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></button>
    </div>
    <div class="grid grid-cols-7 gap-px bg-gray-200">
        @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
            <div class="bg-gray-50 py-2 text-center text-xs font-medium text-gray-500">{{ $day }}</div>
        @endforeach
        @foreach($days as $date)
            <div class="bg-white min-h-[40px] flex items-center justify-center">
                @if($date)
                    <button wire:click="selectDate('{{ $date }}')" class="w-8 h-8 rounded-full flex items-center justify-center text-sm {{ $selectedDate === $date ? 'bg-blue-600 text-white' : 'hover:bg-gray-100 text-gray-900' }} {{ Carbon\Carbon::parse($date)->isToday() ? 'font-bold' : '' }}">
                        {{ Carbon\Carbon::parse($date)->day }}
                    </button>
                @endif
            </div>
        @endforeach
    </div>
</div>
