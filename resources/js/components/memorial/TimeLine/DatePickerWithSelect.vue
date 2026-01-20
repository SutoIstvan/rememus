<script setup lang="ts">
import { ref, computed } from 'vue'
import { CalendarDate, getLocalTimeZone } from '@internationalized/date'
import { Calendar } from '@/components/ui/calendar'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { ChevronLeft, ChevronRight } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'

const props = defineProps<{
  modelValue?: any
}>()

const emit = defineEmits(['update:modelValue'])

// Текущая отображаемая дата в календаре
const displayDate = ref(props.modelValue || new CalendarDate(new Date().getFullYear(), new Date().getMonth() + 1, 1))

// Список месяцев
const months = [
  { value: 1, label: 'Январь' },
  { value: 2, label: 'Февраль' },
  { value: 3, label: 'Март' },
  { value: 4, label: 'Апрель' },
  { value: 5, label: 'Май' },
  { value: 6, label: 'Июнь' },
  { value: 7, label: 'Июль' },
  { value: 8, label: 'Август' },
  { value: 9, label: 'Сентябрь' },
  { value: 10, label: 'Октябрь' },
  { value: 11, label: 'Ноябрь' },
  { value: 12, label: 'Декабрь' },
]

// Список годов (от 1900 до текущий год + 10)
const currentYear = new Date().getFullYear()
const years = Array.from({ length: currentYear - 1900 + 11 }, (_, i) => ({
  value: 1900 + i,
  label: String(1900 + i)
})).reverse()

const selectedMonth = computed({
  get: () => displayDate.value.month,
  set: (val) => {
    displayDate.value = new CalendarDate(displayDate.value.year, val, 1)
  }
})

const selectedYear = computed({
  get: () => displayDate.value.year,
  set: (val) => {
    displayDate.value = new CalendarDate(val, displayDate.value.month, 1)
  }
})

const onDateSelect = (value: any) => {
  emit('update:modelValue', value)
}

const previousMonth = () => {
  const newMonth = displayDate.value.month === 1 ? 12 : displayDate.value.month - 1
  const newYear = displayDate.value.month === 1 ? displayDate.value.year - 1 : displayDate.value.year
  displayDate.value = new CalendarDate(newYear, newMonth, 1)
}

const nextMonth = () => {
  const newMonth = displayDate.value.month === 12 ? 1 : displayDate.value.month + 1
  const newYear = displayDate.value.month === 12 ? displayDate.value.year + 1 : displayDate.value.year
  displayDate.value = new CalendarDate(newYear, newMonth, 1)
}
</script>

<template>
  <div class="p-3">
    <!-- Header с селектами -->
    <div class="flex items-center justify-between gap-2 mb-4">
      <Button variant="outline" size="icon" @click="previousMonth">
        <ChevronLeft class="h-4 w-4" />
      </Button>

      <div class="flex gap-2">
        <Select v-model="selectedMonth">
          <SelectTrigger class="w-[130px]">
            <SelectValue />
          </SelectTrigger>
          <SelectContent>
            <SelectItem
              v-for="month in months"
              :key="month.value"
              :value="month.value"
            >
              {{ month.label }}
            </SelectItem>
          </SelectContent>
        </Select>

        <Select v-model="selectedYear">
          <SelectTrigger class="w-[100px]">
            <SelectValue />
          </SelectTrigger>
          <SelectContent class="max-h-[200px]">
            <SelectItem
              v-for="year in years"
              :key="year.value"
              :value="year.value"
            >
              {{ year.label }}
            </SelectItem>
          </SelectContent>
        </Select>
      </div>

      <Button variant="outline" size="icon" @click="nextMonth">
        <ChevronRight class="h-4 w-4" />
      </Button>
    </div>

    <!-- Календарь -->
    <Calendar
      :model-value="modelValue"
      :month="displayDate"
      @update:model-value="onDateSelect"
    />
  </div>
</template>