<?php

namespace MrShaneBarron\Calendar\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class Calendar extends Component
{
    public string $currentMonth;
    public int $currentYear;
    public array $events = [];
    public ?string $selectedDate = null;

    public function mount(
        ?string $month = null,
        ?int $year = null,
        array $events = []
    ): void {
        $now = Carbon::now();
        $this->currentMonth = $month ?? $now->format('m');
        $this->currentYear = $year ?? $now->year;
        $this->events = $events;
    }

    public function previousMonth(): void
    {
        $date = Carbon::createFromDate($this->currentYear, $this->currentMonth, 1)->subMonth();
        $this->currentMonth = $date->format('m');
        $this->currentYear = $date->year;
    }

    public function nextMonth(): void
    {
        $date = Carbon::createFromDate($this->currentYear, $this->currentMonth, 1)->addMonth();
        $this->currentMonth = $date->format('m');
        $this->currentYear = $date->year;
    }

    public function selectDate(string $date): void
    {
        $this->selectedDate = $date;
        $this->dispatch('date-selected', date: $date);
    }

    public function getDays(): array
    {
        $start = Carbon::createFromDate($this->currentYear, $this->currentMonth, 1);
        $end = $start->copy()->endOfMonth();
        $days = [];

        // Add padding for days before month starts
        for ($i = 0; $i < $start->dayOfWeek; $i++) {
            $days[] = null;
        }

        // Add days of month
        for ($day = 1; $day <= $end->day; $day++) {
            $days[] = Carbon::createFromDate($this->currentYear, $this->currentMonth, $day);
        }

        return $days;
    }

    public function getEventsForDate(string $date): array
    {
        return array_filter($this->events, fn($event) => ($event['date'] ?? '') === $date);
    }

    public function render()
    {
        return view('ld-calendar::livewire.calendar');
    }
}
