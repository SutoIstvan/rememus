<script setup lang="ts">
import { computed, type HTMLAttributes } from 'vue'
import type { CheckboxRootEmits, CheckboxRootProps } from 'reka-ui'
import { CheckboxIndicator, CheckboxRoot } from 'reka-ui'
import { Check } from 'lucide-vue-next'
import { cn } from '@/lib/utils'

/**
 * 👉 НАШ API (то, что используют компоненты)
 */
const props = defineProps<
  CheckboxRootProps & {
    checked?: boolean
    class?: HTMLAttributes['class']
  }
>()

const emit = defineEmits<{
  (e: 'update:checked', value: boolean): void
}>()

/**
 * 🔥 АДАПТЕР
 * checked <-> modelValue (reka-ui)
 */
const modelValue = computed<boolean>({
  get() {
    return !!props.checked
  },
  set(value) {
    emit('update:checked', value)
  },
})
</script>

<template>
  <CheckboxRoot
    v-model="modelValue"
    data-slot="checkbox"
    :class="
      cn(
        'peer border-input data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground data-[state=checked]:border-primary focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive size-4 shrink-0 rounded-[4px] border shadow-xs transition-shadow outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50',
        props.class
      )
    "
  >
    <CheckboxIndicator
      data-slot="checkbox-indicator"
      class="flex items-center justify-center text-current transition-none"
    >
      <slot>
        <Check class="size-3.5" />
      </slot>
    </CheckboxIndicator>
  </CheckboxRoot>
</template>
