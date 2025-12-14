# Laravel Design Calendar

Calendar component with events for Laravel. Supports Livewire, Blade, and Vue 3.

## Installation

```bash
composer require mrshanebarron/calendar
```

## Usage

### Livewire Component

```blade
<livewire:ld-calendar />
```

### Blade Component

```blade
<x-ld-calendar />
```

## Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=ld-calendar-config
```

## Customization

### Publishing Views

```bash
php artisan vendor:publish --tag=ld-calendar-views
```

## License

MIT
