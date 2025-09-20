<script setup lang="ts">
import { CalendarDate, DateFormatter, getLocalTimeZone, parseDate, today } from "@internationalized/date"
import { CalendarIcon } from "lucide-vue-next"
import { CalendarRoot, useDateFormatter } from "reka-ui"
import { createDecade, createYear, toDate } from "reka-ui/date"
import { computed, ref, watch, nextTick } from "vue"
import { cn } from "@/lib/utils"
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { 
  CalendarCell, 
  CalendarCellTrigger, 
  CalendarGrid, 
  CalendarGridBody, 
  CalendarGridHead, 
  CalendarGridRow, 
  CalendarHeadCell, 
  CalendarHeader, 
  CalendarHeading 
} from "@/components/ui/calendar"
import { Popover, PopoverContent, PopoverTrigger } from "@/components/ui/popover"
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select"

// Определяем props
const props = defineProps({
  name: {
    type: String,
    required: true
  },
  placeholder: {
    type: String,
    default: 'Выберите дату'
  },
  modelValue: {
    type: String,
    default: ''
  }
})

// Определяем emits
const emit = defineEmits(['update:modelValue'])

// Внутреннее состояние выбранной даты
const selectedDate = ref()

// Состояние для ручного ввода
const dayInput = ref("")
const monthInput = ref("")
const yearInput = ref("")
const isOpen = ref(false)

// Форматтер даты
const df = new DateFormatter("en-US", {
  dateStyle: "long",
})

// Плейсхолдер для календаря
const placeholder = ref(today(getLocalTimeZone()))

// Форматтер для селектов
const formatter = useDateFormatter("en")

// Генерация массива лет от 1900 до текущего года
const generateYears = () => {
  const currentYear = today(getLocalTimeZone()).year
  const years = []
  for (let year = 1900; year <= currentYear; year++) {
    years.push(new CalendarDate(year, 1, 1))
  }
  return years.reverse() // Обратный порядок, чтобы текущий год был сверху
}

const years = computed(() => generateYears())

// Функция для обработки выбора даты из календаря
const handleDateSelect = (date) => {
  selectedDate.value = date
  if (date) {
    dayInput.value = date.day.toString().padStart(2, '0')
    monthInput.value = date.month.toString().padStart(2, '0')
    yearInput.value = date.year.toString()
    // Обновляем placeholder для синхронизации селектов
    placeholder.value = date
    // Эмитим дату в формате YYYY-MM-DD для Laravel
    const formattedDate = `${date.year}-${date.month.toString().padStart(2, '0')}-${date.day.toString().padStart(2, '0')}`
    emit('update:modelValue', formattedDate)
  } else {
    emit('update:modelValue', '')
  }
  // console.log('Selected date:', date)
}

// Функция для обработки ручного ввода
const handleManualInput = () => {
  const day = parseInt(dayInput.value)
  const month = parseInt(monthInput.value)
  const year = parseInt(yearInput.value)
  
  if (day && month && year && day > 0 && day <= 31 && month > 0 && month <= 12 && year >= 1900) {
    try {
      const newDate = new CalendarDate(year, month, day)
      selectedDate.value = newDate
      placeholder.value = newDate
      // Эмитим дату в формате YYYY-MM-DD для Laravel
      const formattedDate = `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`
      emit('update:modelValue', formattedDate)
    } catch (error) {
      console.log('Invalid date:', error)
      emit('update:modelValue', '')
    }
  } else {
    emit('update:modelValue', '')
  }
}

// Рефы для полей ввода
const dayInputRef = ref()
const monthInputRef = ref()
const yearInputRef = ref()

// Автоматический переход к следующему полю
const handleDayInput = (event) => {
  const value = event.target.value
  if (value.length === 2 && parseInt(value) <= 31) {
    nextTick(() => {
      const monthEl = monthInputRef.value?.$el || monthInputRef.value
      if (monthEl && monthEl.focus) {
        monthEl.focus()
      } else if (monthEl && monthEl.querySelector) {
        monthEl.querySelector('input')?.focus()
      }
    })
  }
  handleManualInput()
}

const handleMonthInput = (event) => {
  const value = event.target.value
  if (value.length === 2 && parseInt(value) <= 12) {
    nextTick(() => {
      const yearEl = yearInputRef.value?.$el || yearInputRef.value
      if (yearEl && yearEl.focus) {
        yearEl.focus()
      } else if (yearEl && yearEl.querySelector) {
        yearEl.querySelector('input')?.focus()
      }
    })
  }
  handleManualInput()
}

const handleYearInput = (event) => {
  handleManualInput()
}

// Инициализация с текущей датой
const initializeInputs = () => {
  if (selectedDate.value) {
    dayInput.value = selectedDate.value.day.toString().padStart(2, '0')
    monthInput.value = selectedDate.value.month.toString().padStart(2, '0')
    yearInput.value = selectedDate.value.year.toString()
  } else {
    dayInput.value = ""
    monthInput.value = ""
    yearInput.value = ""
  }
}

// Инициализация компонента с переданным значением
const initializeFromModelValue = () => {
  if (props.modelValue) {
    try {
      // Парсим дату в формате YYYY-MM-DD
      const parsedDate = parseDate(props.modelValue)
      selectedDate.value = parsedDate
      placeholder.value = parsedDate
      dayInput.value = parsedDate.day.toString().padStart(2, '0')
      monthInput.value = parsedDate.month.toString().padStart(2, '0')
      yearInput.value = parsedDate.year.toString()
    } catch (error) {
      console.log('Error parsing initial date:', error)
    }
  }
}

// Отслеживание изменения modelValue извне
watch(() => props.modelValue, () => {
  initializeFromModelValue()
}, { immediate: true })

// Отслеживание изменений placeholder для обновления инпутов
watch(placeholder, (newPlaceholder) => {
  if (newPlaceholder && selectedDate.value) {
    // Обновляем инпуты при изменении placeholder через селекты
    if (selectedDate.value.year !== newPlaceholder.year || 
        selectedDate.value.month !== newPlaceholder.month) {
      try {
        const updatedDate = selectedDate.value.set({
          year: newPlaceholder.year,
          month: newPlaceholder.month
        })
        selectedDate.value = updatedDate
      } catch (error) {
        console.log('Error updating date:', error)
      }
    }
  }
}, { deep: true })
</script>

<template>
  <div class="space-y-4">
    <div class="flex flex-col space-y-2">
      <Popover v-model:open="isOpen">
        <div class="relative">
          <!-- Поля для ручного ввода -->
          <div class="flex items-center space-x-0.5 border border-gray-200 shadow-sm rounded-md px-3 py-1 w-[187px] bg-background">
            <!-- Скрытый input для формы -->
            <input type="hidden" :name="props.name" :value="props.modelValue" />
            
            <Input
              ref="dayInputRef"
              v-model="dayInput"
              placeholder="01"
              maxlength="2"
              class="w-8 h-6 p-0 text-center border-none focus-visible:ring-0 focus-visible:ring-offset-0"
              @input="handleDayInput"
              @keypress="(e) => { if (!/[0-9]/.test(e.key) && e.key !== 'Backspace' && e.key !== 'Delete' && e.key !== 'Tab') e.preventDefault() }"
            />
            <span class="text-muted-foreground">/</span>
            <Input
              ref="monthInputRef"
              v-model="monthInput"
              placeholder="01"
              maxlength="2"
              class="w-8 h-6 p-0 text-center border-none focus-visible:ring-0 focus-visible:ring-offset-0"
              @input="handleMonthInput"
              @keypress="(e) => { if (!/[0-9]/.test(e.key) && e.key !== 'Backspace' && e.key !== 'Delete' && e.key !== 'Tab') e.preventDefault() }"
            />
            <span class="text-muted-foreground">/</span>
            <Input
              ref="yearInputRef"
              v-model="yearInput"
              placeholder="2000"
              maxlength="4"
              class="w-12 h-6 p-0 text-center border-none focus-visible:ring-0 focus-visible:ring-offset-0"
              @input="handleYearInput"
              @keypress="(e) => { if (!/[0-9]/.test(e.key) && e.key !== 'Backspace' && e.key !== 'Delete' && e.key !== 'Tab') e.preventDefault() }"
            />
            <PopoverTrigger as-child>
              <Button 
                variant="ghost" 
                size="sm" 
                class="ml-auto h-6 w-6 p-0 cursor-pointer"
              >
                <CalendarIcon class="h-4 w-4 opacity-50 " />
              </Button>
            </PopoverTrigger>
          </div>
        </div>

        <PopoverContent class="w-auto p-0">
          <!-- Кастомный календарь с селектами -->
          <CalendarRoot
            v-slot="{ date, grid, weekDays }"
            v-model:placeholder="placeholder"
            :model-value="selectedDate"
            initial-focus
            :min-value="new CalendarDate(1900, 1, 1)"
            :max-value="today(getLocalTimeZone())"
            :class="cn('rounded-md border p-3')"
            @update:model-value="handleDateSelect"
          >
            <CalendarHeader>
              <CalendarHeading class="flex w-full items-center justify-between gap-2">
                <!-- Селект месяца -->
                <Select
                  :model-value="placeholder.month.toString()"
                  @update:model-value="(v) => {
                    if (!v || !placeholder) return;
                    const newMonth = Number(v);
                    if (newMonth === placeholder?.month) return;
                    placeholder = placeholder.set({ month: newMonth });
                  }"
                >
                  <SelectTrigger aria-label="Select month" class="w-[60%]">
                    <SelectValue placeholder="Select month" />
                  </SelectTrigger>
                  <SelectContent class="max-h-[200px]">
                    <SelectItem
                      v-for="month in createYear({ dateObj: placeholder })"
                      :key="month.toString()" 
                      :value="month.month.toString()"
                    >
                      {{ formatter.custom(toDate(month), { month: 'long' }) }}
                    </SelectItem>
                  </SelectContent>
                </Select>

                <!-- Селект года -->
                <Select
                  :model-value="placeholder.year.toString()"
                  @update:model-value="(v) => {
                    if (!v || !placeholder) return;
                    const newYear = Number(v);
                    if (newYear === placeholder?.year) return;
                    placeholder = placeholder.set({ year: newYear });
                  }"
                >
                  <SelectTrigger aria-label="Select year" class="w-[40%]">
                    <SelectValue placeholder="Select year" />
                  </SelectTrigger>
                  <SelectContent class="max-h-[200px]">
                    <SelectItem
                      v-for="yearValue in years"
                      :key="yearValue.toString()" 
                      :value="yearValue.year.toString()"
                    >
                      {{ yearValue.year }}
                    </SelectItem>
                  </SelectContent>
                </Select>
              </CalendarHeading>
            </CalendarHeader>

            <!-- Календарная сетка -->
            <div class="flex flex-col space-y-4 pt-4 sm:flex-row sm:gap-x-4 sm:gap-y-0">
              <CalendarGrid v-for="month in grid" :key="month.value.toString()">
                <CalendarGridHead>
                  <CalendarGridRow>
                    <CalendarHeadCell v-for="day in weekDays" :key="day">
                      {{ day }}
                    </CalendarHeadCell>
                  </CalendarGridRow>
                </CalendarGridHead>
                <CalendarGridBody class="grid">
                  <CalendarGridRow 
                    v-for="(weekDates, index) in month.rows" 
                    :key="`weekDate-${index}`" 
                    class="mt-2 w-full"
                  >
                    <CalendarCell
                      v-for="weekDate in weekDates"
                      :key="weekDate.toString()"
                      :date="weekDate"
                    >
                      <CalendarCellTrigger
                        :day="weekDate"
                        :month="month.value"
                      />
                    </CalendarCell>
                  </CalendarGridRow>
                </CalendarGridBody>
              </CalendarGrid>
            </div>
          </CalendarRoot>
        </PopoverContent>
      </Popover>
    </div>
  </div>
</template>