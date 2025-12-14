<template>
  <div class="bg-white rounded-lg shadow border border-gray-200">
    <div class="flex items-center justify-between px-4 py-3 border-b">
      <button @click="previousMonth" class="p-2 hover:bg-gray-100 rounded-lg"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg></button>
      <span class="text-lg font-semibold text-gray-900">{{ monthName }} {{ year }}</span>
      <button @click="nextMonth" class="p-2 hover:bg-gray-100 rounded-lg"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></button>
    </div>
    <div class="grid grid-cols-7 gap-px bg-gray-200">
      <div v-for="day in ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']" :key="day" class="bg-gray-50 py-2 text-center text-xs font-medium text-gray-500">{{ day }}</div>
      <div v-for="(date, i) in days" :key="i" class="bg-white min-h-[40px] flex items-center justify-center">
        <button v-if="date" @click="selectDate(date)" :class="['w-8 h-8 rounded-full flex items-center justify-center text-sm', modelValue === date ? 'bg-blue-600 text-white' : 'hover:bg-gray-100 text-gray-900', isToday(date) ? 'font-bold' : '']">{{ getDay(date) }}</button>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, computed } from 'vue';

export default {
  name: 'LdCalendar',
  props: { modelValue: String },
  emits: ['update:modelValue'],
  setup(props, { emit }) {
    const now = new Date();
    const year = ref(now.getFullYear());
    const month = ref(now.getMonth());
    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const monthName = computed(() => months[month.value]);

    const days = computed(() => {
      const start = new Date(year.value, month.value, 1);
      const end = new Date(year.value, month.value + 1, 0);
      const result = [];
      for (let i = 0; i < start.getDay(); i++) result.push(null);
      for (let d = 1; d <= end.getDate(); d++) {
        result.push(`${year.value}-${String(month.value + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`);
      }
      return result;
    });

    const previousMonth = () => { if (month.value === 0) { month.value = 11; year.value--; } else month.value--; };
    const nextMonth = () => { if (month.value === 11) { month.value = 0; year.value++; } else month.value++; };
    const selectDate = (date) => emit('update:modelValue', date);
    const getDay = (date) => parseInt(date.split('-')[2]);
    const isToday = (date) => date === new Date().toISOString().split('T')[0];

    return { year, month, monthName, days, previousMonth, nextMonth, selectDate, getDay, isToday };
  }
};
</script>
