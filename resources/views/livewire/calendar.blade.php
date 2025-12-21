<div style="background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e5e7eb;">
    <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px 16px; border-bottom: 1px solid #e5e7eb;">
        <button wire:click="previousMonth" style="padding: 8px; background: transparent; border: none; cursor: pointer; border-radius: 8px;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='transparent'"><svg style="width: 20px; height: 20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg></button>
        <span style="font-size: 18px; font-weight: 600; color: #111827;">{{ Carbon\Carbon::create($this->year, $this->month, 1)->format('F Y') }}</span>
        <button wire:click="nextMonth" style="padding: 8px; background: transparent; border: none; cursor: pointer; border-radius: 8px;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='transparent'"><svg style="width: 20px; height: 20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></button>
    </div>
    <div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 1px; background: #e5e7eb;">
        @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
            <div style="background: #f9fafb; padding: 8px 0; text-align: center; font-size: 12px; font-weight: 500; color: #6b7280;">{{ $day }}</div>
        @endforeach
        @foreach($this->days as $date)
            <div style="background: white; min-height: 40px; display: flex; align-items: center; justify-content: center;">
                @if($date)
                    <button wire:click="selectDate('{{ $date }}')" style="width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; border: none; cursor: pointer; {{ $this->selectedDate === $date ? 'background: #2563eb; color: white;' : 'background: transparent; color: #111827;' }} {{ Carbon\Carbon::parse($date)->isToday() ? 'font-weight: bold;' : '' }}" onmouseover="this.style.background='{{ $this->selectedDate === $date ? '#2563eb' : '#f3f4f6' }}'" onmouseout="this.style.background='{{ $this->selectedDate === $date ? '#2563eb' : 'transparent' }}'">
                        {{ Carbon\Carbon::parse($date)->day }}
                    </button>
                @endif
            </div>
        @endforeach
    </div>
</div>
