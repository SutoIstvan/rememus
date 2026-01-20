<script lang="ts">
export function formatDate(date: Date | undefined) {
  if (!date) return ''
  return date.toLocaleDateString('en-US', {
    day: '2-digit',
    month: 'long',
    year: 'numeric',
  })
}
</script>

<script setup lang="ts">
import { ref, watch } from 'vue'
import type { DateValue } from '@internationalized/date'
import { fromDate, getLocalTimeZone } from '@internationalized/date'
import { parseDate } from 'chrono-node'
import { CalendarIcon } from 'lucide-vue-next'
import { Calendar } from '@/components/ui/calendar'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from '@/components/ui/popover'

const props = defineProps<{
  modelValue: string | null
  label?: string
}>()

const emit = defineEmits(['update:modelValue'])

const inputValue = ref('')
const nativeDate = ref<Date | undefined>(undefined)
const calendarValue = ref<DateValue | null>(null)
const open = ref(false)

/**
 * 🔁 sync из v-model → Calendar
 */
watch(
  () => props.modelValue,
  (val) => {
    if (!val) {
      inputValue.value = ''
      nativeDate.value = undefined
      calendarValue.value = null
      return
    }

    const parsed = new Date(val)
    if (!isNaN(parsed.getTime())) {
      nativeDate.value = parsed
      inputValue.value = formatDate(parsed)
      calendarValue.value = fromDate(parsed, getLocalTimeZone())
    }
  },
  { immediate: true }
)

/**
 * ⬆️ update v-model (Date → ISO)
 */
const updateDate = (date?: Date) => {
  nativeDate.value = date
  if (!date) {
    emit('update:modelValue', null)
    return
  }

  emit('update:modelValue', date.toISOString().slice(0, 10))
}
</script>

<template>
  <div class="flex flex-col gap-2">
    <Label v-if="label" class="px-1">{{ label }}</Label>

    <div class="relative flex gap-2">
      <Input
        :model-value="inputValue"
        placeholder="Tomorrow, next year, 15 Jan 2024"
        class="bg-background pr-10"
        @update:model-value="(value) => {
          inputValue = value.toString()
          const parsed = parseDate(value.toString())
          if (parsed) {
            updateDate(parsed)
            calendarValue = fromDate(parsed, getLocalTimeZone())
          }
        }"
      />

      <Popover v-model:open="open">
        <PopoverTrigger as-child>
          <Button
            variant="ghost"
            class="absolute top-1/2 right-2 size-6 -translate-y-1/2"
          >
            <CalendarIcon class="size-3.5" />
          </Button>
        </PopoverTrigger>

        <PopoverContent class="w-auto p-2" align="end">
          <Calendar
            v-model="calendarValue"
            layout="month-and-year"
            :from-year="1900"
            :to-year="new Date().getFullYear() + 10"
            disable-days-outside-current-view
            class="rounded-md border"
            @update:model-value="(value) => {
              if (value) {
                const d = value.toDate(getLocalTimeZone())
                updateDate(d)
                inputValue = formatDate(d)
                open = false
              }
            }"
          />
        </PopoverContent>
      </Popover>
    </div>
  </div>
</template>
