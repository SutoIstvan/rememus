<script setup lang="ts">
import { CalendarDate, DateFormatter, getLocalTimeZone, parseDate, today } from "@internationalized/date"
import { CalendarIcon } from "lucide-vue-next"
import { CalendarRoot, useDateFormatter } from "reka-ui"
import { createDecade, createYear, toDate } from "reka-ui/date"
import { computed, ref } from "vue"
import { cn } from "@/lib/utils"
import { Button } from "@/components/ui/button"
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

// Внутреннее состояние выбранной даты
const selectedDate = ref()

// Форматтер даты
const df = new DateFormatter("en-US", {
  dateStyle: "long",
})

// Плейсхолдер для календаря
const placeholder = ref(today(getLocalTimeZone()))

// Форматтер для селектов
const formatter = useDateFormatter("en")

// Функция для обработки выбора даты
const handleDateSelect = (date) => {
  selectedDate.value = date
  // Здесь можете добавить эмит события или другую логику
  console.log('Selected date:', date)
}
</script>

<template>
  <div class="space-y-4">
    <div class="flex flex-col space-y-2">
      <!-- <label class="text-sm font-medium">Date of birth</label> -->
      <Popover>
        <PopoverTrigger as-child>
          <Button
            variant="outline" 
            :class="cn(
              'w-[180px] ps-3 text-start text-lg',
              !selectedDate && 'text-muted-foreground',
            )"
          >
            <span>{{ selectedDate ? df.format(toDate(selectedDate)) : placeholder }}</span>
            <CalendarIcon class="ms-auto h-4 w-4 opacity-50" />
          </Button>
        </PopoverTrigger>
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
                  :default-value="placeholder.month.toString()"
                  @update:model-value="(v) => {
                    if (!v || !placeholder) return;
                    if (Number(v) === placeholder?.month) return;
                    placeholder = placeholder.set({
                      month: Number(v),
                    })
                  }"
                >
                  <SelectTrigger aria-label="Select month" class="w-[60%]">
                    <SelectValue placeholder="Select month" />
                  </SelectTrigger>
                  <SelectContent class="max-h-[200px]">
                    <SelectItem
                      v-for="month in createYear({ dateObj: date })"
                      :key="month.toString()" 
                      :value="month.month.toString()"
                    >
                      {{ formatter.custom(toDate(month), { month: 'long' }) }}
                    </SelectItem>
                  </SelectContent>
                </Select>

                <!-- Селект года -->
                <Select
                  :default-value="placeholder.year.toString()"
                  @update:model-value="(v) => {
                    if (!v || !placeholder) return;
                    if (Number(v) === placeholder?.year) return;
                    placeholder = placeholder.set({
                      year: Number(v),
                    })
                  }"
                >
                  <SelectTrigger aria-label="Select year" class="w-[40%]">
                    <SelectValue placeholder="Select year" />
                  </SelectTrigger>
                  <SelectContent class="max-h-[200px]">
                    <SelectItem
                      v-for="yearValue in createDecade({ dateObj: date, startIndex: -10, endIndex: 10 })"
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
      <!-- <p class="text-sm text-muted-foreground">
        Your date of birth is used to calculate your age.
      </p> -->
    </div>

    <!-- Кнопка для демонстрации выбранной даты -->
    <!-- <Button @click="console.log('Selected:', selectedDate)" v-if="selectedDate">
      Selected: {{ df.format(toDate(selectedDate)) }}
    </Button> -->
  </div>
</template>