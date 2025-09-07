<template>
    <section
        class="hero-section pt-[190px] md:pt-[230px] lg:pt-[230px] xl:pt-[220px] bg-[url('/images/front/hero-bg.png')] bg-no-repeat bg-cover bg-top relative z-0">
        <!-- Hero Title Content -->
        <div
            class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 flex flex-col items-center space-y-[124px] relative z-10 mb-[100px] lg:mb-[130px] xl:mb-[210px]">
            <!-- Дополнительный контент можно добавить здесь -->
        </div>

        <!-- Hero Bottom Item -->
        <div class="w-full bg-white dark:bg-black">
            <div class="relative z-0">
                <div class="relative w-full bg-gradient-to-t from-white dark:from-background-8 from-50% to-transparent">
                </div>
                <div class="flex flex-col lg:flex-row">
                    <!-- Image Section -->
                    <div class="lg:flex-1/3 lg:pe-[42px]">
                        <div class="relative h-full max-lg:mx-auto">
                            <figure class="shadow-lg absolute lg:right-0 lg:bottom-0 w-[300px]
                                    max-lg:left-1/2 max-lg:-translate-x-1/2 max-lg:top-[-100px]
                                    bg-white dark:bg-background-9 rounded-[10px] overflow-hidden p-1">
                                <img :src="person.image" :alt="person.name"
                                    class="w-[300px] h-[300px] object-cover rounded-[10px]" />
                            </figure>
                        </div>
                    </div>

                    <!-- Person Info Section -->
                    <div class="lg:flex-1/2 pt-[30px] max-lg:px-5 max-lg:text-center max-lg:mt-[200px]">

                        <h2 class="w-100">
                            <Input
                                v-model="memorialName"
                                type="text"
                                placeholder="Enter Name"
                                class="w-full text-lg"
                            />
                        </h2>

                        <ul class="list-none space-y-2 mb-8 max-lg:!mb-0 mt-5">
                                <li
                                    class="flex items-center gap-3 mb-3 justify-center lg:justify-start text-pretty text-xl tracking-tighter xl:text-4xl/none sm:text-3xl">
                                    <Calendar class="w-6 h-6 text-primary" />
                                    {{ person.birthYear }} - {{ person.deathYear }}

                                        <!-- Инпут для открытия Picker -->
    <input 
      type="text" 
      readonly 
      :value="format(currentValue, 'yyyy-MM-dd')" 
      @click="openPicker" 
      class="border px-3 py-2 rounded cursor-pointer w-full max-w-xs"
    />

    <!-- Модальное окно -->
    <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
      <div class="bg-white dark:bg-gray-800 p-4 rounded shadow-lg">
        <div class="flex justify-between items-center mb-4">
          <h3 class="font-bold">Select date</h3>
          <button @click="closePicker" class="text-red-500 font-bold">X</button>
        </div>

        <div class="picker-group">
          <VueScrollPicker :options="years" :model-value="currentYear" @update:model-value="handleUpdateYear" />
          <VueScrollPicker :options="months" :model-value="currentMonth" @update:model-value="handleUpdateMonth" />
          <VueScrollPicker :options="days" :model-value="currentDay" @update:model-value="handleUpdateDay" />
        </div>

        <div class="mt-4 flex justify-end">
          <button @click="closePicker" class="px-4 py-2 bg-blue-600 text-white rounded">Готово</button>
        </div>
      </div>
    </div>
    
                                </li>
                                <li
                                    class="flex items-center gap-3 mb-3 justify-center lg:justify-start">
                                    <MapPin class="w-6 h-6 text-primary" />
                                    <Input
                                        v-model="memorialName"
                                        type="text"
                                        placeholder="Enter location"
                                        class="w-90 text-lg"
                                    />
                                </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import BlurReveal from '@/components/ui/blur-reveal/BlurReveal.vue'
import { MapPin, Calendar, Calendar1 } from "lucide-vue-next";
import Input from '@/components/ui/input/Input.vue';
import { ref, watch, onMounted, computed } from "vue";

import { format, setDate, setHours, setMinutes, setMonth, setSeconds, setYear } from 'date-fns'
import { VueScrollPicker, VueScrollPickerValue } from 'vue-scroll-picker'
import 'vue-scroll-picker/style.css'

// Текущее выбранное значение даты
const currentValue = ref(new Date())

// Модальное окно
const isOpen = ref(false)

// Вычисления для каждого столбца
const currentYear = computed(() => currentValue.value.getFullYear())
const currentMonth = computed(() => currentValue.value.getMonth() + 1)
const currentDay = computed(() => currentValue.value.getDate())


// Данные для Picker
const years = computed(() => {
  const currYear = new Date().getFullYear()
  const lastYear = 1980
  return Array.from({ length: currYear - lastYear + 1 }, (_, index) => lastYear + index).reverse()
})
const months = Array.from({ length: 12 }, (_, index) => index + 1)
const days = computed(() => {
  const lastDay = new Date(currentYear.value, currentMonth.value, 0).getDate()
  return Array.from({ length: lastDay }, (_, index) => index + 1)
})

// Обработчики изменений
function handleUpdateYear(value: VueScrollPickerValue | undefined) { currentValue.value = setYear(currentValue.value, value as number) }
function handleUpdateMonth(value: VueScrollPickerValue | undefined) { currentValue.value = setMonth(currentValue.value, (value as number) - 1) }
function handleUpdateDay(value: VueScrollPickerValue | undefined) { currentValue.value = setDate(currentValue.value, value as number) }
// Функция открытия модального окна
function openPicker() { isOpen.value = true }
function closePicker() { isOpen.value = false }

const memorialName = ref("");


// Определяем props от Laravel контроллера
const props = defineProps({
    person: {
        type: Object,
        default: () => ({
            name: 'Arnold Shannon',
            image: '/images/front/testimonial-1.jpg',
            birthYear: '1975 jan 15',
            deathYear: '2023 mar 23',
            location: 'Jacksonville, Florida'
        })
    }
})

</script>

<style scoped>
.picker-group {
  display: flex;
  gap: 4px;
}
</style>