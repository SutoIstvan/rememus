<script setup lang="ts">
import { computed } from 'vue'
import { Check } from 'lucide-vue-next'

const props = defineProps<{
    id: string
    label: string
    checked?: boolean
}>()

const emit = defineEmits<{
    'update:checked': [value: boolean]
}>()

const isChecked = computed(() => props.checked ?? false)

const toggle = () => {
    emit('update:checked', !isChecked.value)
}
</script>

<template>
    <label :for="id"
        class="group/field-label peer/field-label flex w-fit cursor-pointer select-none items-center gap-2 rounded-full border text-sm font-medium leading-snug transition-all duration-100 ease-linear"
        :class="[
            isChecked
                ? 'border-primary bg-primary/5 dark:bg-primary/10'
                : 'border-input hover:border-primary/50'
        ]">
        <div role="group"
            class="group/field flex flex-row items-center gap-1.5 overflow-hidden px-3 py-1.5 transition-all duration-100 ease-linear"
            :class="{ '!pl-2': isChecked }">
            <button :id="id" type="button" role="checkbox" :aria-checked="isChecked"
                :data-state="isChecked ? 'checked' : 'unchecked'"
                class="peer size-4 shrink-0 rounded-full border shadow-xs outline-none transition-all duration-100 ease-linear focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:cursor-not-allowed disabled:opacity-50"
                :class="[
                    isChecked
                        ? 'ml-0 translate-x-0 border-primary bg-primary text-primary-foreground'
                        : '-ml-6 -translate-x-1 border-input'
                ]" @click="toggle">
                <span v-if="isChecked" class="grid place-content-center text-current">
                    <Check class="size-3" />
                </span>
            </button>
            <span class="text-sm font-medium leading-snug">{{ label }}</span>
        </div>
    </label>
</template>
