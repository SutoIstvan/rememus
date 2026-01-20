<script lang="ts" setup>
import type { CalendarRootEmits, CalendarRootProps } from "reka-ui"
import type { HTMLAttributes } from "vue"
import { computed } from "vue"
import { reactiveOmit } from "@vueuse/core"
import { CalendarRoot, useForwardPropsEmits } from "reka-ui"
import { cn } from "@/lib/utils"
import { CalendarCell, CalendarCellTrigger, CalendarGrid, CalendarGridBody, CalendarGridHead, CalendarGridRow, CalendarHeadCell, CalendarHeader, CalendarHeading, CalendarNextButton, CalendarPrevButton } from "."
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select"

export type LayoutTypes = 'month-and-year' | 'month-only' | 'year-only'

const props = withDefaults(
  defineProps<CalendarRootProps & { 
    class?: HTMLAttributes["class"]
    layout?: LayoutTypes
  }>(),
  {
    layout: undefined
  }
)

const emits = defineEmits<CalendarRootEmits>()

const delegatedProps = reactiveOmit(props, "class", "layout")

const forwarded = useForwardPropsEmits(delegatedProps, emits)

// Месяцы
const months = [
  { value: 1, label: 'Jan' },
  { value: 2, label: 'Feb' },
  { value: 3, label: 'Mar' },
  { value: 4, label: 'Apr' },
  { value: 5, label: 'May' },
  { value: 6, label: 'Jun' },
  { value: 7, label: 'Jul' },
  { value: 8, label: 'Aug' },
  { value: 9, label: 'Sep' },
  { value: 10, label: 'Oct' },
  { value: 11, label: 'Nov' },
  { value: 12, label: 'Dec' },
]

// 🔥 ИСПРАВЛЕНО: Динамический диапазон годов на основе minValue и maxValue
const years = computed(() => {
  const currentYear = new Date().getFullYear()
  
  // Определяем минимальный год
  let minYear = 1900
  if (props.minValue && 'year' in props.minValue) {
    minYear = props.minValue.year
  }
  
  // Определяем максимальный год
  let maxYear = currentYear
  if (props.maxValue && 'year' in props.maxValue) {
    maxYear = props.maxValue.year
  }
  
  // Создаем массив годов от minYear до maxYear
  const yearCount = maxYear - minYear + 1
  return Array.from({ length: yearCount }, (_, i) => ({
    value: minYear + i,
    label: String(minYear + i)
  })).reverse()
})

const showMonthSelect = computed(() => props.layout === 'month-and-year' || props.layout === 'month-only')
const showYearSelect = computed(() => props.layout === 'month-and-year' || props.layout === 'year-only')
</script>

<template>
  <CalendarRoot
    v-slot="{ date, grid, weekDays }"
    :class="cn('p-3', props.class)"
    v-bind="forwarded"
  >
    <CalendarHeader>
      <CalendarPrevButton />
      
      <!-- Селекты месяца и года при использовании layout -->
      <template v-if="layout && (showMonthSelect || showYearSelect)">
        <div class="flex gap-2 items-center justify-center flex-1">
          <Select 
            v-if="showMonthSelect"
            :model-value="date.month"
            @update:model-value="(val) => {
              const newDate = date.set({ month: Number(val) })
              emits('update:placeholder', newDate)
            }"
          >
            <SelectTrigger class="w-[100px] h-7 text-sm font-medium">
              <SelectValue>
                {{ months.find(m => m.value === date.month)?.label }}
              </SelectValue>
            </SelectTrigger>
            <SelectContent class="max-h-[200px] overflow-y-auto">
              <SelectItem
                v-for="month in months"
                :key="month.value"
                :value="month.value"
              >
                {{ month.label }}
              </SelectItem>
            </SelectContent>
          </Select>

          <Select 
            v-if="showYearSelect"
            :model-value="date.year"
            @update:model-value="(val) => {
              const newDate = date.set({ year: Number(val) })
              emits('update:placeholder', newDate)
            }"
          >
            <SelectTrigger class="w-[80px] h-7 text-sm font-medium">
              <SelectValue>
                {{ date.year }}
              </SelectValue>
            </SelectTrigger>
            <SelectContent class="max-h-[200px] overflow-y-auto">
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
      </template>

      <!-- Обычный заголовок без layout -->
      <CalendarHeading v-else />
      
      <CalendarNextButton />
    </CalendarHeader>

    <div class="flex flex-col gap-y-4 mt-4 sm:flex-row sm:gap-x-4 sm:gap-y-0">
      <CalendarGrid v-for="month in grid" :key="month.value.toString()">
        <CalendarGridHead>
          <CalendarGridRow>
            <CalendarHeadCell
              v-for="day in weekDays" :key="day"
            >
              {{ day }}
            </CalendarHeadCell>
          </CalendarGridRow>
        </CalendarGridHead>
        <CalendarGridBody>
          <CalendarGridRow v-for="(weekDates, index) in month.rows" :key="`weekDate-${index}`" class="mt-2 w-full">
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
</template>