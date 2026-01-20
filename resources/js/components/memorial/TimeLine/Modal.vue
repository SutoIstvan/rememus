<script lang="ts">
export function formatDate(date: Date | undefined) {
  if (!date) {
    return ''
  }
  return date.toLocaleDateString('ru-RU', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric',
  })
}
</script>

<script setup lang="ts">
import { ref, watch, computed } from 'vue'
import { nanoid } from 'nanoid'
import { fromDate, getLocalTimeZone, CalendarDate } from '@internationalized/date'
import { CalendarIcon } from 'lucide-vue-next'
import { Dialog, DialogContent } from '@/components/ui/dialog'
import { Input } from '@/components/ui/input'
import { Button } from '@/components/ui/button'
import { Calendar } from '@/components/ui/calendar'
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover'

import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectLabel,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'

/**
 * 🔹 Типы событий
 */
const EVENT_TYPES = [
  { value: 'birth_child', label: 'Birth of a Child', mode: 'single' },
  { value: 'school', label: 'School', mode: 'range' },
  { value: 'work', label: 'Work', mode: 'range' },
  { value: 'wedding', label: 'Wedding', mode: 'single' },
  { value: 'other', label: 'Other', mode: 'single' },
]

const props = defineProps<{
  open: boolean
  item: any | null
  birthDate?: string
  deathDate?: string
}>()

const emit = defineEmits(['close', 'save'])

/**
 * 🔹 Минимальная дата для календаря (дата рождения)
 */
const minCalendarDate = computed(() => {
  if (!props.birthDate) return undefined
  
  const [year, month, day] = props.birthDate.split('-').map(Number)
  return new CalendarDate(year, month, day)
})

/**
 * 🔹 Максимальная дата для календаря (дата смерти)
 */
const maxCalendarDate = computed(() => {
  if (!props.deathDate) return undefined
  
  const [year, month, day] = props.deathDate.split('-').map(Number)
  return new CalendarDate(year, month, day)
})

/**
 * 🔹 Форма
 */
const getEmptyForm = () => ({
  id: nanoid(),
  title: '',
  description: '',
  type: '',
  location: '',
  related_person: '',
  media: null as File | null,
  media_preview: null as string | null,
  date: '',
  date_from: '',
  date_to: '',
  order: 0,
})

const form = ref(getEmptyForm())

/**
 * 🔹 Флаг: пользователь трогал заголовок
 */
const titleTouched = ref(false)

/**
 * 🔹 режим дат (single / range)
 */
const dateMode = computed(() => {
  const found = EVENT_TYPES.find(t => t.value === form.value.type)
  return found?.mode ?? 'single'
})

/**
 * 🔹 Input значения для дат (отображение)
 */
const inputDateValue = ref('')
const inputDateFromValue = ref('')
const inputDateToValue = ref('')

/**
 * 🔹 Реальные Date объекты (для формы)
 */
const actualDate = ref<Date | null>(null)
const actualDateFrom = ref<Date | null>(null)
const actualDateTo = ref<Date | null>(null)

/**
 * 🔹 Computed для календаря
 */
const calendarDate = computed(() => 
  actualDate.value ? fromDate(actualDate.value, getLocalTimeZone()) : undefined
)
const calendarDateFrom = computed(() => 
  actualDateFrom.value ? fromDate(actualDateFrom.value, getLocalTimeZone()) : undefined
)
const calendarDateTo = computed(() => 
  actualDateTo.value ? fromDate(actualDateTo.value, getLocalTimeZone()) : undefined
)

/**
 * 🔹 Popover states
 */
const openDate = ref(false)
const openDateFrom = ref(false)
const openDateTo = ref(false)

/**
 * 🔹 Placeholder для календаря - обновляется при открытии
 */
const placeholderDate = ref<any>(undefined)
const placeholderDateFrom = ref<any>(undefined)
const placeholderDateTo = ref<any>(undefined)

/**
 * 🔹 Обновление placeholder при открытии календаря
 */
watch(openDate, (isOpen) => {
  if (isOpen) {
    if (actualDate.value) {
      placeholderDate.value = fromDate(actualDate.value, getLocalTimeZone())
    } else if (props.deathDate) {
      const [year, month, day] = props.deathDate.split('-').map(Number)
      placeholderDate.value = new CalendarDate(year, month, day)
    } else if (props.birthDate) {
      const [year, month, day] = props.birthDate.split('-').map(Number)
      placeholderDate.value = new CalendarDate(year, month, day)
    } else {
      placeholderDate.value = fromDate(new Date(), getLocalTimeZone())
    }
  }
})

watch(openDateFrom, (isOpen) => {
  if (isOpen) {
    if (actualDateFrom.value) {
      placeholderDateFrom.value = fromDate(actualDateFrom.value, getLocalTimeZone())
    } else if (props.deathDate) {
      const [year, month, day] = props.deathDate.split('-').map(Number)
      placeholderDateFrom.value = new CalendarDate(year, month, day)
    } else if (props.birthDate) {
      const [year, month, day] = props.birthDate.split('-').map(Number)
      placeholderDateFrom.value = new CalendarDate(year, month, day)
    } else {
      placeholderDateFrom.value = fromDate(new Date(), getLocalTimeZone())
    }
  }
})

watch(openDateTo, (isOpen) => {
  if (isOpen) {
    if (actualDateTo.value) {
      placeholderDateTo.value = fromDate(actualDateTo.value, getLocalTimeZone())
    } else if (props.deathDate) {
      const [year, month, day] = props.deathDate.split('-').map(Number)
      placeholderDateTo.value = new CalendarDate(year, month, day)
    } else if (props.birthDate) {
      const [year, month, day] = props.birthDate.split('-').map(Number)
      placeholderDateTo.value = new CalendarDate(year, month, day)
    } else {
      placeholderDateTo.value = fromDate(new Date(), getLocalTimeZone())
    }
  }
})

/**
 * 🔹 Функция проверки доступности даты
 */
const isDateDisabled = (date: CalendarDate) => {
  // Дата не может быть позже даты смерти
  if (maxCalendarDate.value && date.compare(maxCalendarDate.value) > 0) {
    return true
  }
  // Дата не может быть раньше даты рождения
  if (minCalendarDate.value && date.compare(minCalendarDate.value) < 0) {
    return true
  }
  return false
}

/**
 * 🔹 Синхронизация с формой
 */
watch([actualDate, actualDateFrom, actualDateTo], ([date, dateFrom, dateTo]) => {
  if (date) {
    form.value.date = date.toISOString().split('T')[0]
  } else {
    form.value.date = ''
  }

  if (dateFrom) {
    form.value.date_from = dateFrom.toISOString().split('T')[0]
  } else {
    form.value.date_from = ''
  }

  if (dateTo) {
    form.value.date_to = dateTo.toISOString().split('T')[0]
  } else {
    form.value.date_to = ''
  }
})

/**
 * 🔹 Инициализация формы
 */
watch(
  () => props.item,
  (item) => {
    if (item) {
      form.value = { ...item }
      titleTouched.value = true

      if (item.date) {
        const [year, month, day] = item.date.split('-').map(Number)
        const date = new Date(year, month - 1, day)
        actualDate.value = date
        inputDateValue.value = formatDate(date)
      } else {
        actualDate.value = null
        inputDateValue.value = ''
      }

      if (item.date_from) {
        const [year, month, day] = item.date_from.split('-').map(Number)
        const date = new Date(year, month - 1, day)
        actualDateFrom.value = date
        inputDateFromValue.value = formatDate(date)
      } else {
        actualDateFrom.value = null
        inputDateFromValue.value = ''
      }

      if (item.date_to) {
        const [year, month, day] = item.date_to.split('-').map(Number)
        const date = new Date(year, month - 1, day)
        actualDateTo.value = date
        inputDateToValue.value = formatDate(date)
      } else {
        actualDateTo.value = null
        inputDateToValue.value = ''
      }
    } else {
      form.value = getEmptyForm()
      titleTouched.value = false
      inputDateValue.value = ''
      inputDateFromValue.value = ''
      inputDateToValue.value = ''
      actualDate.value = null
      actualDateFrom.value = null
      actualDateTo.value = null
    }
  },
  { immediate: true }
)

watch(
  () => props.open,
  (isOpen) => {
    if (!isOpen) {
      form.value = getEmptyForm()
      titleTouched.value = false

      inputDateValue.value = ''
      inputDateFromValue.value = ''
      inputDateToValue.value = ''

      actualDate.value = null
      actualDateFrom.value = null
      actualDateTo.value = null

      openDate.value = false
      openDateFrom.value = false
      openDateTo.value = false
    }
  }
)

/**
 * 🔹 Реакция на смену типа
 */
watch(
  () => form.value.type,
  (newType) => {
    form.value.date = ''
    form.value.date_from = ''
    form.value.date_to = ''
    inputDateValue.value = ''
    inputDateFromValue.value = ''
    inputDateToValue.value = ''
    actualDate.value = null
    actualDateFrom.value = null
    actualDateTo.value = null

    if (!titleTouched.value) {
      const found = EVENT_TYPES.find(t => t.value === newType)
      if (found) {
        form.value.title = found.label
      }
    }
  }
)

/**
 * 🔹 Загрузка файла
 */
const onFile = (e: Event) => {
  const file = (e.target as HTMLInputElement).files?.[0]
  if (!file) return

  form.value.media = file

  const reader = new FileReader()
  reader.onload = e => {
    form.value.media_preview = e.target?.result as string
  }
  reader.readAsDataURL(file)
}

/**
 * 🔹 Маска для ввода даты DD.MM.YYYY
 */
const formatDateInput = (value: string) => {
  const numbers = value.replace(/\D/g, '')

  let formatted = ''
  for (let i = 0; i < numbers.length && i < 8; i++) {
    if (i === 2 || i === 4) {
      formatted += '.'
    }
    formatted += numbers[i]
  }

  return formatted
}

const parseDateFromFormat = (dateStr: string) => {
  const match = dateStr.match(/^(\d{2})\.(\d{2})\.(\d{4})$/)
  if (match) {
    const day = parseInt(match[1])
    const month = parseInt(match[2])
    const year = parseInt(match[3])

    if (day >= 1 && day <= 31 && month >= 1 && month <= 12 && year >= 1900 && year <= 2100) {
      const date = new Date(year, month - 1, day)
      
      // Проверка на диапазон между датой рождения и смерти
      if (props.birthDate) {
        const [minYear, minMonth, minDay] = props.birthDate.split('-').map(Number)
        const minDate = new Date(minYear, minMonth - 1, minDay)
        if (date < minDate) {
          return null
        }
      }
      
      if (props.deathDate) {
        const [maxYear, maxMonth, maxDay] = props.deathDate.split('-').map(Number)
        const maxDate = new Date(maxYear, maxMonth - 1, maxDay)
        if (date > maxDate) {
          return null
        }
      }
      
      return date
    }
  }
  return null
}

const handleDateInput = (value: string) => {
  if (!value) {
    inputDateValue.value = ''
    actualDate.value = null
    return
  }

  const formatted = formatDateInput(value)
  inputDateValue.value = formatted

  if (formatted.length === 10) {
    const parsed = parseDateFromFormat(formatted)
    if (parsed) {
      actualDate.value = parsed
      inputDateValue.value = formatDate(parsed)
    }
  }
}

const handleDateFromInput = (value: string) => {
  if (!value) {
    inputDateFromValue.value = ''
    actualDateFrom.value = null
    return
  }

  const formatted = formatDateInput(value)
  inputDateFromValue.value = formatted

  if (formatted.length === 10) {
    const parsed = parseDateFromFormat(formatted)
    if (parsed) {
      actualDateFrom.value = parsed
      inputDateFromValue.value = formatDate(parsed)
    }
  }
}

const handleDateToInput = (value: string) => {
  if (!value) {
    inputDateToValue.value = ''
    actualDateTo.value = null
    return
  }

  const formatted = formatDateInput(value)
  inputDateToValue.value = formatted

  if (formatted.length === 10) {
    const parsed = parseDateFromFormat(formatted)
    if (parsed) {
      actualDateTo.value = parsed
      inputDateToValue.value = formatDate(parsed)
    }
  }
}

/**
 * 🔹 Сохранение
 */
const save = () => {
  console.log('Saving form:', form.value)
  emit('save', { ...form.value })
  emit('close')
}
</script>

<template>
  <Dialog :open="open" @update:open="emit('close')">
    <DialogContent class="sm:max-w-[500px]">
      <div class="flex flex-col space-y-1.5 text-center sm:text-left">
        <DialogDescription class="sr-only">
          {{ item ? 'Edit Event' : 'Create New Event' }}
        </DialogDescription>
      </div>

      <div class="space-y-4 py-4">
        <!-- Event Type -->
        <Select v-model="form.type">
          <SelectTrigger class="w-full">
            <SelectValue placeholder="Select event type" />
          </SelectTrigger>

          <SelectContent
            position="popper"
            class="w-[450px] max-w-full"
          >
            <SelectGroup>
              <SelectItem
                v-for="type in EVENT_TYPES"
                :key="type.value"
                :value="type.value"
              >
                {{ type.label }}
              </SelectItem>
            </SelectGroup>
          </SelectContent>
        </Select>

        <!-- Даты -->
        <div class="space-y-2">
          <template v-if="dateMode === 'single'">
            <div class="relative flex gap-2">
              <Input 
                :model-value="inputDateValue" 
                placeholder="15.01.2026 date" 
                class="bg-background pr-10"
                maxlength="10" 
                @update:model-value="handleDateInput" 
              />
              <Popover v-model:open="openDate">
                <PopoverTrigger as-child>
                  <Button variant="ghost" size="icon" class="absolute top-1/2 right-2 size-8 -translate-y-1/2">
                    <CalendarIcon class="size-4" />
                    <span class="sr-only">Select date</span>
                  </Button>
                </PopoverTrigger>
                <PopoverContent class="w-auto overflow-hidden p-0" align="end">
                  <Calendar 
                    :model-value="calendarDate"
                    v-model:placeholder="placeholderDate" 
                    layout="month-and-year"
                    :min-value="minCalendarDate"
                    :max-value="maxCalendarDate"
                    :is-date-disabled="isDateDisabled"
                    class="rounded-md border shadow-sm **:data-[slot=calendar-cell-trigger]:size-11"
                    @update:model-value="(value) => {
                      if (value) {
                        const date = value.toDate(getLocalTimeZone())
                        actualDate = date
                        inputDateValue = formatDate(date)
                        openDate = false
                      }
                    }" 
                  />
                </PopoverContent>
              </Popover>
            </div>
          </template>

          <template v-else>
            <div class="grid grid-cols-2 gap-4">
              <!-- Дата начала -->
              <div>
                <div class="relative flex gap-2">
                  <Input 
                    :model-value="inputDateFromValue" 
                    placeholder="15.01.2026 Start" 
                    class="bg-background pr-10"
                    maxlength="10" 
                    @update:model-value="handleDateFromInput" 
                  />
                  <Popover v-model:open="openDateFrom">
                    <PopoverTrigger as-child>
                      <Button variant="ghost" size="icon" class="absolute top-1/2 right-2 size-8 -translate-y-1/2">
                        <CalendarIcon class="size-4" />
                        <span class="sr-only">Select start date</span>
                      </Button>
                    </PopoverTrigger>
                    <PopoverContent class="w-auto overflow-hidden p-0" align="end">
                      <Calendar 
                        :model-value="calendarDateFrom"
                        v-model:placeholder="placeholderDateFrom" 
                        layout="month-and-year"
                        :min-value="minCalendarDate"
                        :max-value="maxCalendarDate"
                        :is-date-disabled="isDateDisabled"
                        class="rounded-md border shadow-sm **:data-[slot=calendar-cell-trigger]:size-11"
                        @update:model-value="(value) => {
                          if (value) {
                            const date = value.toDate(getLocalTimeZone())
                            actualDateFrom = date
                            inputDateFromValue = formatDate(date)
                            openDateFrom = false
                          }
                        }" 
                      />
                    </PopoverContent>
                  </Popover>
                </div>
              </div>

              <!-- Дата окончания -->
              <div>
                <div class="relative flex gap-2">
                  <Input 
                    :model-value="inputDateToValue" 
                    placeholder="15.01.2026 End" 
                    class="bg-background pr-10"
                    maxlength="10" 
                    @update:model-value="handleDateToInput" 
                  />
                  <Popover v-model:open="openDateTo">
                    <PopoverTrigger as-child>
                      <Button variant="ghost" size="icon" class="absolute top-1/2 right-2 size-8 -translate-y-1/2">
                        <CalendarIcon class="size-4" />
                        <span class="sr-only">Select end date</span>
                      </Button>
                    </PopoverTrigger>
                    <PopoverContent class="w-auto overflow-hidden p-0" align="end">
                      <Calendar 
                        :model-value="calendarDateTo"
                        v-model:placeholder="placeholderDateTo" 
                        layout="month-and-year"
                        :min-value="minCalendarDate"
                        :max-value="maxCalendarDate"
                        :is-date-disabled="isDateDisabled"
                        class="rounded-md border shadow-sm **:data-[slot=calendar-cell-trigger]:size-11"
                        @update:model-value="(value) => {
                          if (value) {
                            const date = value.toDate(getLocalTimeZone())
                            actualDateTo = date
                            inputDateToValue = formatDate(date)
                            openDateTo = false
                          }
                        }" 
                      />
                    </PopoverContent>
                  </Popover>
                </div>
              </div>
            </div>
          </template>
        </div>

        <!-- Заголовок -->
        <div class="space-y-2">
          <Input placeholder="Title" v-model="form.title" @input="titleTouched = true" />
        </div>

        <!-- Описание -->
        <div class="space-y-2">
          <textarea
            class="flex min-h-[50px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
            rows="2" 
            placeholder="Add event description" 
            v-model="form.description"
          ></textarea>
        </div>

        <!-- Медиа -->
        <div class="space-y-2">
          <div class="flex flex-col gap-3">
            <div class="relative">
              <input 
                type="file" 
                @change="onFile"
                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 pr-10 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" 
              />

              <Button 
                variant="ghost" 
                size="icon"
                class="absolute top-1/2 right-2 size-8 -translate-y-1/2 pointer-events-none"
              >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect>
                  <circle cx="9" cy="9" r="2"></circle>
                  <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path>
                </svg>
                <span class="sr-only">Photo</span>
              </Button>
            </div>

            <img 
              v-if="form.media_preview" 
              :src="form.media_preview"
              class="rounded-lg max-h-28 w-full object-cover border" 
              alt="Preview" 
            />
          </div>
        </div>
      </div>

      <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2 pt-1">
        <Button variant="outline" @click="emit('close')" class="mt-2 sm:mt-0">
          Cancel
        </Button>
        <Button @click="save">
          {{ item ? 'Save Changes' : 'Create Event' }}
        </Button>
      </div>
    </DialogContent>
  </Dialog>
</template>