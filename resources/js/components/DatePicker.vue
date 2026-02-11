<script setup lang="ts">
import { CalendarDate, getLocalTimeZone, today } from "@internationalized/date";
import { CalendarIcon } from "lucide-vue-next";
import { CalendarRoot, useDateFormatter } from "reka-ui";
import { createYear, toDate } from "reka-ui/date";
import { computed, ref, watch, nextTick } from "vue";
import { cn } from "@/lib/utils";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import {
  CalendarCell,
  CalendarCellTrigger,
  CalendarGrid,
  CalendarGridBody,
  CalendarGridHead,
  CalendarGridRow,
  CalendarHeadCell,
  CalendarHeader,
  CalendarHeading,
} from "@/components/ui/calendar";
import { Popover, PopoverContent, PopoverTrigger } from "@/components/ui/popover";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";

// props (переименовал placeholder -> inputPlaceholder чтобы не конфликтовать с внутренним calendarPlaceholder)
const props = defineProps({
  name: {
    type: String,
    required: true,
  },
  inputPlaceholder: {
    type: String,
    default: "Выберите дату",
  },
  modelValue: {
    type: String,
    default: "",
  },
});

const emit = defineEmits(["update:modelValue"]);

// selected date — CalendarDate или null
const selectedDate = ref<CalendarDate | null>(null);

// ручной ввод (dd / mm / yyyy)
const dayInput = ref("");
const monthInput = ref("");
const yearInput = ref("");
const isOpen = ref(false);

// локальный "placeholder" для календаря (CalendarDate) — чтобы не конфликтовать с props.inputPlaceholder
const calendarPlaceholder = ref<CalendarDate>(today(getLocalTimeZone()));

// форматтер (используется для вывода названий месяцев в селекте)
const formatter = useDateFormatter("en");

// годы (1900..current)
const generateYears = () => {
  const currentYear = today(getLocalTimeZone()).year;
  const yearsArr: CalendarDate[] = [];
  for (let year = 1900; year <= currentYear; year++) {
    yearsArr.push(new CalendarDate(year, 1, 1));
  }
  return yearsArr.reverse();
};
const years = computed(() => generateYears());

// refs для полей ввода
const dayInputRef = ref<HTMLInputElement | null>(null);
const monthInputRef = ref<HTMLInputElement | null>(null);
const yearInputRef = ref<HTMLInputElement | null>(null);

// Вспомогательная: дни в месяце
function daysInMonth(year: number, month: number) {
  return new Date(year, month, 0).getDate();
}

// Обработчик выбора даты из календаря (CalendarRoot должен отдавать CalendarDate)
function handleDateSelect(date: any) {
  if (!date) {
    selectedDate.value = null;
    dayInput.value = "";
    monthInput.value = "";
    yearInput.value = "";
    emit("update:modelValue", "");
    return;
  }

  // ожидаем, что date имеет { year, month, day }
  selectedDate.value = date;
  calendarPlaceholder.value = date;
  dayInput.value = String(date.day).padStart(2, "0");
  monthInput.value = String(date.month).padStart(2, "0");
  yearInput.value = String(date.year);
  const formattedDate = `${date.year}-${String(date.month).padStart(2, "0")}-${String(date.day).padStart(2, "0")}`;
  emit("update:modelValue", formattedDate);
}

// Ручной ввод — собираем дату и валидируем
function handleManualInput() {
  const day = parseInt(dayInput.value || "", 10);
  const month = parseInt(monthInput.value || "", 10);
  const year = parseInt(yearInput.value || "", 10);

  if (
    Number.isInteger(day) &&
    Number.isInteger(month) &&
    Number.isInteger(year) &&
    day >= 1 &&
    month >= 1 &&
    month <= 12 &&
    year >= 1900
  ) {
    try {
      // скорректируем день под выбранный месяц/год
      const maxDay = daysInMonth(year, month);
      const safeDay = Math.min(day, maxDay);
      const newDate = new CalendarDate(year, month, safeDay);
      selectedDate.value = newDate;
      calendarPlaceholder.value = newDate;
      const formatted = `${year}-${String(month).padStart(2, "0")}-${String(safeDay).padStart(2, "0")}`;
      emit("update:modelValue", formatted);
      return;
    } catch (e) {
      // fallthrough -> emit empty
      console.warn("Invalid manual date:", e);
    }
  }

  // если невалидно — очистим
  emit("update:modelValue", "");
}

// Автофокус переходы
function handleDayInput(event: Event) {
  const v = (event.target as HTMLInputElement).value;
  if (v.length === 2 && parseInt(v, 10) <= 31) {
    nextTick(() => {
      const el = monthInputRef.value;
      el?.focus?.();
    });
  }
  handleManualInput();
}

function handleMonthInput(event: Event) {
  const v = (event.target as HTMLInputElement).value;
  if (v.length === 2 && parseInt(v, 10) <= 12) {
    nextTick(() => {
      const el = yearInputRef.value;
      el?.focus?.();
    });
  }
  handleManualInput();
}

function handleYearInput() {
  handleManualInput();
}

// Инициализация из modelValue (ожидаем формат YYYY-MM-DD)
function initializeFromModelValue() {
  const val = props.modelValue;
  if (!val || typeof val !== "string") {
    // очистка
    selectedDate.value = null;
    dayInput.value = "";
    monthInput.value = "";
    yearInput.value = "";
    return;
  }

  const m = val.match(/^(\d{4})-(\d{2})-(\d{2})$/);
  if (m) {
    const year = parseInt(m[1], 10);
    const month = parseInt(m[2], 10);
    const day = parseInt(m[3], 10);
    try {
      const parsed = new CalendarDate(year, month, day);
      selectedDate.value = parsed;
      calendarPlaceholder.value = parsed;
      dayInput.value = String(day).padStart(2, "0");
      monthInput.value = String(month).padStart(2, "0");
      yearInput.value = String(year);
    } catch (e) {
      console.warn("Error parsing initial date:", e);
    }
  }
}

// слежка за внешним modelValue
watch(
  () => props.modelValue,
  () => {
    initializeFromModelValue();
  },
  { immediate: true }
);

// При изменении calendarPlaceholder — синхронизируем selectedDate (если уже выбрана дата)
// (мы не меняем modelValue пока не выбран день)
watch(
  calendarPlaceholder,
  (newPlaceholder) => {
    if (!newPlaceholder) return;
    if (selectedDate.value) {
      // сохраним день если возможно
      const day = selectedDate.value.day ?? 1;
      const max = daysInMonth(newPlaceholder.year, newPlaceholder.month);
      const safeDay = Math.min(day, max);
      try {
        selectedDate.value = new CalendarDate(newPlaceholder.year, newPlaceholder.month, safeDay);
      } catch {
        // ignore
      }
    }
  },
  { deep: true }
);

// Сеттеры для селектов месяца/года
function setMonth(v: string | number | null) {
  if (!v) return;
  const newMonth = Number(v);
  if (Number.isNaN(newMonth)) return;
  if (calendarPlaceholder.value.month === newMonth) return;
  const year = calendarPlaceholder.value.year;
  const day = selectedDate.value?.day ?? 1;
  const max = daysInMonth(year, newMonth);
  const safeDay = Math.min(day, max);
  calendarPlaceholder.value = new CalendarDate(year, newMonth, safeDay);
}

function setYear(v: string | number | null) {
  if (!v) return;
  const newYear = Number(v);
  if (Number.isNaN(newYear)) return;
  if (calendarPlaceholder.value.year === newYear) return;
  const month = calendarPlaceholder.value.month;
  const day = selectedDate.value?.day ?? 1;
  const max = daysInMonth(newYear, month);
  const safeDay = Math.min(day, max);
  calendarPlaceholder.value = new CalendarDate(newYear, month, safeDay);
}
</script>

<template>
  <div class="space-y-4">
    <div class="flex flex-col space-y-2">
      <Popover v-model:open="isOpen">
        <div class="relative">
          <!-- Поля для ручного ввода -->
          <div
            class="flex items-center space-x-0.5 border border-gray-200 shadow-sm rounded-md px-3 py-1 w-[187px] bg-background">
            <!-- Скрытый input для формы -->
            <input type="hidden" :name="props.name" :value="props.modelValue" />

            <Input ref="dayInputRef" v-model="dayInput" placeholder="01" maxlength="2"
              class="w-8 h-6 p-0 text-center border-none focus-visible:ring-0 focus-visible:ring-offset-0"
              @input="handleDayInput"
              @keypress="(e) => { if (!/[0-9]/.test(e.key) && e.key !== 'Backspace' && e.key !== 'Delete' && e.key !== 'Tab') e.preventDefault() }" />
            <span class="text-muted-foreground">/</span>
            <Input ref="monthInputRef" v-model="monthInput" placeholder="01" maxlength="2"
              class="w-8 h-6 p-0 text-center border-none focus-visible:ring-0 focus-visible:ring-offset-0"
              @input="handleMonthInput"
              @keypress="(e) => { if (!/[0-9]/.test(e.key) && e.key !== 'Backspace' && e.key !== 'Delete' && e.key !== 'Tab') e.preventDefault() }" />
            <span class="text-muted-foreground">/</span>
            <Input ref="yearInputRef" v-model="yearInput" placeholder="2000" maxlength="4"
              class="w-12 h-6 p-0 text-center border-none focus-visible:ring-0 focus-visible:ring-offset-0"
              @input="handleYearInput"
              @keypress="(e) => { if (!/[0-9]/.test(e.key) && e.key !== 'Backspace' && e.key !== 'Delete' && e.key !== 'Tab') e.preventDefault() }" />
            <PopoverTrigger as-child>
              <Button variant="ghost" size="sm" class="ml-auto h-6 w-6 p-0 cursor-pointer">
                <CalendarIcon class="h-4 w-4 opacity-50 " />
              </Button>
            </PopoverTrigger>
          </div>
        </div>

        <PopoverContent class="w-auto p-0">
          <!-- Кастомный календарь с селектами -->
          <CalendarRoot v-slot="{ grid, weekDays }" v-model:placeholder="calendarPlaceholder"
            :model-value="selectedDate" initial-focus :min-value="new CalendarDate(1900, 1, 1)"
            :max-value="today(getLocalTimeZone())" :class="cn('rounded-md border p-3')"
            @update:model-value="handleDateSelect">
            <CalendarHeader>
              <CalendarHeading class="flex w-full items-center justify-between gap-2">
                <!-- Селект месяца -->
                <Select :model-value="String(calendarPlaceholder.month)" @update:model-value="setMonth">
                  <SelectTrigger aria-label="Select month" class="w-[60%]">
                    <SelectValue placeholder="Select month" />
                  </SelectTrigger>
                  <SelectContent class="max-h-[200px]">
                    <SelectItem v-for="month in createYear({ dateObj: calendarPlaceholder })" :key="month.toString()"
                      :value="month.month.toString()">
                      {{ formatter.custom(toDate(month), { month: 'long' }) }}
                    </SelectItem>
                  </SelectContent>
                </Select>

                <!-- Селект года -->
                <Select :model-value="String(calendarPlaceholder.year)" @update:model-value="setYear">
                  <SelectTrigger aria-label="Select year" class="w-[40%]">
                    <SelectValue placeholder="Select year" />
                  </SelectTrigger>
                  <SelectContent class="max-h-[200px]">
                    <SelectItem v-for="yearValue in years" :key="yearValue.toString()"
                      :value="yearValue.year.toString()">
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
                  <CalendarGridRow v-for="(weekDates, index) in month.rows" :key="`weekDate-${index}`"
                    class="mt-2 w-full">
                    <CalendarCell v-for="weekDate in weekDates" :key="weekDate.toString()" :date="weekDate">
                      <CalendarCellTrigger :day="weekDate" :month="month.value" />
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
