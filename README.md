# Calendar

A date picker calendar component for Laravel applications. Month view with date selection. Works with Livewire and Vue 3.

## Installation

```bash
composer require mrshanebarron/calendar
```

## Livewire Usage

### Basic Usage

```blade
<livewire:sb-calendar wire:model="selectedDate" />
```

### Display Selected Date

```blade
<livewire:sb-calendar wire:model="date" />
<p>Selected: {{ $date }}</p>
```

### Livewire Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `wire:model` | string | - | Selected date (YYYY-MM-DD format) |

## Vue 3 Usage

### Setup

```javascript
import { SbCalendar } from './vendor/sb-calendar';
app.component('SbCalendar', SbCalendar);
```

### Basic Usage

```vue
<template>
  <SbCalendar v-model="selectedDate" />
  <p v-if="selectedDate">Selected: {{ selectedDate }}</p>
</template>

<script setup>
import { ref } from 'vue';
const selectedDate = ref(null);
</script>
```

### With Default Date

```vue
<template>
  <SbCalendar v-model="selectedDate" />
</template>

<script setup>
import { ref } from 'vue';
// Pre-select today
const selectedDate = ref(new Date().toISOString().split('T')[0]);
</script>
```

### Form Integration

```vue
<template>
  <form @submit.prevent="submit">
    <div class="space-y-4">
      <div>
        <label class="block text-sm font-medium mb-1">Event Date</label>
        <SbCalendar v-model="form.date" />
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Event Name</label>
        <input v-model="form.name" type="text" class="w-full border rounded px-3 py-2" />
      </div>

      <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
        Create Event
      </button>
    </div>
  </form>
</template>

<script setup>
import { ref } from 'vue';

const form = ref({
  date: null,
  name: ''
});

const submit = () => {
  console.log('Creating event on:', form.value.date);
};
</script>
```

### Vue Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `modelValue` | String | - | Selected date in YYYY-MM-DD format |

### Events

| Event | Payload | Description |
|-------|---------|-------------|
| `update:modelValue` | `string` | Emitted when date is selected |

## Features

- **Month Navigation**: Previous/next month buttons
- **Today Highlight**: Current date shown in bold
- **Selected State**: Blue highlight on selected date
- **Standard Format**: Uses YYYY-MM-DD format

## Date Format

The component uses ISO date format: `YYYY-MM-DD`

Examples:
- `2024-01-15` (January 15, 2024)
- `2024-12-25` (December 25, 2024)

## Styling

Uses Tailwind CSS:
- White background with shadow
- Grid layout for days
- Blue highlight for selected date
- Gray hover states
- Rounded navigation buttons

## Requirements

- PHP 8.1+
- Laravel 10, 11, or 12
- Tailwind CSS 3.x

## License

MIT License
