<?php

namespace MrShaneBarron\Calendar\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class Calendar extends Component
{
    public int $year;
    public int $month;
    public ?string $selectedDate = null;
    public array $events = [];

    public function mount(?int $year = null, ?int $month = null, array $events = []): void
    {
        $this->year = $year ?? now()->year;
        $this->month = $month ?? now()->month;
        $this->events = $events;
    }

    public function previousMonth(): void
    {
        $date = Carbon::create($this->year, $this->month, 1)->subMonth();
        $this->year = $date->year;
        $this->month = $date->month;
    }

    public function nextMonth(): void
    {
        $date = Carbon::create($this->year, $this->month, 1)->addMonth();
        $this->year = $date->year;
        $this->month = $date->month;
    }

    public function selectDate(string $date): void
    {
        $this->selectedDate = $date;
        $this->dispatch('date-selected', date: $date);
    }

    public function getDays(): array
    {
        $start = Carbon::create($this->year, $this->month, 1);
        $end = $start->copy()->endOfMonth();
        $days = [];

        // Add empty days for alignment
        for ($i = 0; $i < $start->dayOfWeek; $i++) $days[] = null;

        // Add days of month
        for ($d = 1; $d <= $end->day; $d++) {
            $days[] = Carbon::create($this->year, $this->month, $d)->format('Y-m-d');
        }

        return $days;
    }

    public function render()
    {
        return view('ld-calendar::livewire.calendar', ['days' => $this->getDays()]);
    }
}
