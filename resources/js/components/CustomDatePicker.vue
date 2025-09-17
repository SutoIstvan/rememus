<template>
    <div>
        <!-- Инпут для открытия Picker -->
        <input 
            type="text" 
            readonly 
            :value="formattedDate" 
            :placeholder="placeholder"
            @click="openPicker" 
            class="w-full border border-gray-300 rounded-lg px-3 py-2 cursor-pointer focus:ring-2 focus:ring-primary focus:border-transparent hover:border-gray-400 transition-colors"
        />
        
        <!-- Скрытое поле для отправки формы -->
        <input 
            type="hidden" 
            :name="name" 
            :value="selectedDate ? selectedDate.toISOString().split('T')[0] : ''" 
        />

        <!-- Модальное окно -->
        <teleport to="body">
            <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-md w-full mx-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-lg">{{ placeholder || 'Выберите дату' }}</h3>
                        <button @click="closePicker" class="text-red-500 font-bold text-xl hover:text-red-700 transition-colors">
                            ×
                        </button>
                    </div>

                    <div class="picker-group mb-6">
                        <div class="picker-column">
                            <label class="text-sm font-medium block mb-2">Год</label>
                            <VueScrollPicker 
                                :options="availableYears" 
                                :model-value="currentYear" 
                                @update:model-value="handleUpdateYear" 
                                class="picker-scroll"
                            />
                        </div>
                        <div class="picker-column">
                            <label class="text-sm font-medium block mb-2">Месяц</label>
                            <VueScrollPicker 
                                :options="monthsWithLabels" 
                                :model-value="currentMonth" 
                                @update:model-value="handleUpdateMonth"
                                class="picker-scroll"
                            />
                        </div>
                        <div class="picker-column">
                            <label class="text-sm font-medium block mb-2">День</label>
                            <VueScrollPicker 
                                :options="availableDays" 
                                :model-value="currentDay" 
                                @update:model-value="handleUpdateDay"
                                class="picker-scroll"
                            />
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button 
                            @click="closePicker" 
                            class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
                        >
                            Отмена
                        </button>
                        <button 
                            @click="confirmSelection" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                        >
                            Выбрать
                        </button>
                    </div>
                </div>
            </div>
        </teleport>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, watch } from 'vue';
import { format } from 'date-fns';
import { VueScrollPicker, VueScrollPickerValue } from 'vue-scroll-picker';
import 'vue-scroll-picker/style.css';

// Props
interface Props {
    name: string;
    placeholder?: string;
    minDate?: Date;
    maxDate?: Date;
    modelValue?: Date;
}

const props = withDefaults(defineProps<Props>(), {
    placeholder: 'Выберите дату',
    modelValue: undefined
});

// Emits
const emit = defineEmits<{
    'update:modelValue': [date: Date | null];
}>();

// Reactive data
const isOpen = ref(false);
const selectedDate = ref<Date | null>(props.modelValue || null);
const tempDate = ref<Date>(props.modelValue || new Date());

// Computed values
const formattedDate = computed(() => {
    return selectedDate.value 
        ? format(selectedDate.value, 'dd.MM.yyyy')
        : '';
});

const currentYear = computed(() => tempDate.value.getFullYear());
const currentMonth = computed(() => tempDate.value.getMonth() + 1);
const currentDay = computed(() => tempDate.value.getDate());

const availableYears = computed(() => {
    const currentYear = new Date().getFullYear();
    const startYear = props.minDate?.getFullYear() || 1900;
    const endYear = props.maxDate?.getFullYear() || currentYear;
    
    return Array.from(
        { length: endYear - startYear + 1 }, 
        (_, index) => startYear + index
    ).reverse();
});

const monthsWithLabels = computed(() => {
    return Array.from({ length: 12 }, (_, index) => ({
        value: index + 1,
        label: new Intl.DateTimeFormat('ru', { month: 'long' }).format(new Date(2000, index, 1))
    }));
});

const availableDays = computed(() => {
    const year = tempDate.value.getFullYear();
    const month = tempDate.value.getMonth() + 1;
    const lastDay = new Date(year, month, 0).getDate();
    
    return Array.from({ length: lastDay }, (_, index) => index + 1);
});

// Methods
const openPicker = () => {
    if (selectedDate.value) {
        tempDate.value = new Date(selectedDate.value);
    } else {
        tempDate.value = new Date();
    }
    isOpen.value = true;
};

const closePicker = () => {
    isOpen.value = false;
};

const confirmSelection = () => {
    selectedDate.value = new Date(tempDate.value);
    emit('update:modelValue', selectedDate.value);
    closePicker();
};

const handleUpdateYear = (value: VueScrollPickerValue | undefined) => {
    if (value) {
        tempDate.value = new Date(value as number, tempDate.value.getMonth(), tempDate.value.getDate());
    }
};

const handleUpdateMonth = (value: VueScrollPickerValue | undefined) => {
    if (value) {
        const monthIndex = (value as number) - 1;
        tempDate.value = new Date(tempDate.value.getFullYear(), monthIndex, tempDate.value.getDate());
    }
};

const handleUpdateDay = (value: VueScrollPickerValue | undefined) => {
    if (value) {
        tempDate.value = new Date(tempDate.value.getFullYear(), tempDate.value.getMonth(), value as number);
    }
};

// Watch for external changes
watch(() => props.modelValue, (newValue) => {
    selectedDate.value = newValue || null;
});

// Validation for min/max dates
watch(tempDate, (newDate) => {
    if (props.minDate && newDate < props.minDate) {
        tempDate.value = new Date(props.minDate);
    }
    if (props.maxDate && newDate > props.maxDate) {
        tempDate.value = new Date(props.maxDate);
    }
});
</script>

<style scoped>
.picker-group {
    display: flex;
    gap: 12px;
    max-height: 200px;
}

.picker-column {
    flex: 1;
    text-align: center;
}

/* Custom styles for Vue Scroll Picker */
:deep(.vue-scroll-picker-group) {
    height: 150px;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    overflow: hidden;
}

:deep(.vue-scroll-picker-item) {
    padding: 8px 12px;
    font-size: 14px;
    border-bottom: 1px solid #f3f4f6;
    cursor: pointer;
    transition: all 0.2s;
}

:deep(.vue-scroll-picker-item:hover) {
    background-color: #f9fafb;
}

:deep(.vue-scroll-picker-item.selected) {
    background-color: #3b82f6;
    color: white;
    font-weight: 600;
}

:deep(.vue-scroll-picker-item.selected:hover) {
    background-color: #2563eb;
}

.picker-scroll {
    border-radius: 6px;
    overflow: hidden;
}
</style>