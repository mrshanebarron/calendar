<?php

namespace MrShaneBarron\Calendar;

use Illuminate\Support\ServiceProvider;

class CalendarServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (class_exists(\Livewire\Livewire::class)) {
            \Livewire\Livewire::component('ld-calendar', Livewire\Calendar::class);
        }
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ld-calendar');
    }
}
