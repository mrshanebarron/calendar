<?php

namespace MrShaneBarron\calendar;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\calendar\Livewire\calendar;
use MrShaneBarron\calendar\View\Components\calendar as Bladecalendar;
use Livewire\Livewire;

class calendarServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ld-calendar.php', 'ld-calendar');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ld-calendar');

        Livewire::component('ld-calendar', calendar::class);

        $this->loadViewComponentsAs('ld', [
            Bladecalendar::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/ld-calendar.php' => config_path('ld-calendar.php'),
            ], 'ld-calendar-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/ld-calendar'),
            ], 'ld-calendar-views');
        }
    }
}
