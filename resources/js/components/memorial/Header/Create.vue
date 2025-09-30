<template>
  <section
    class="hero-section pt-[190px] md:pt-[210px] lg:pt-[210px] xl:pt-[220px] bg-no-repeat bg-cover bg-top relative z-0"
    :style="{ backgroundImage: `url('${backgroundImage}')` }">
    <!-- Hero Title Content -->
    <div
      class="mx-auto px-4 md:px-6 lg:px-8 flex flex-col items-center relative z-10 mb-[100px] lg:mb-[130px] xl:mb-[210px]">
      <div class="absolute mt-11 right-3 z-20 flex gap-3">
        <!-- Remove Background Button -->
        <div v-if="customBackground">
          <button type="button" @click="removeBackground"
            class="bg-red-500/80 hover:bg-red-500 text-white rounded-lg px-3 py-3 shadow-lg transition-all duration-200 hover:scale-105 flex items-center gap-2"
            title="Вернуть стандартный фон">
            <X class="w-4 h-4" />
          </button>
        </div>

        <!-- Upload Background Button -->
        <div>
          <button type="button" @click="triggerBackgroundUpload"
            class="bg-white/80 hover:bg-white cursor-pointer text-gray-700 hover:text-gray-900 rounded-lg px-2 sm:px-3 py-2 shadow-lg transition-all duration-200 hover:scale-105 flex items-center gap-2"
            title="Change background">
            <ImageIcon class="w-5 h-5" />
            <span class="text-sm font-medium hidden sm:block">Change background</span>
          </button>
        </div>
      </div>
    </div>

    <!-- Hero Bottom Item -->
    <div class="w-full bg-white dark:bg-black">
      <div class="relative z-0">
        <div class="relative w-full bg-gradient-to-t from-white dark:from-background-8 from-50% to-transparent"></div>
        <div class="flex flex-col lg:flex-row">
          <!-- Image Section -->
          <div class="lg:flex-1/3 lg:pe-[42px]">
            <div class="relative h-full max-lg:mx-auto">
              <figure
                class="shadow-lg absolute lg:right-0 lg:bottom-0 w-[300px] max-lg:left-1/2 max-lg:-translate-x-1/2 max-lg:top-[-100px] bg-white dark:bg-background-9 rounded-[10px] overflow-hidden p-1 group">
                <img :src="previewImage" :alt="name" class="w-[300px] h-[300px] object-cover rounded-[10px]" />

                <!-- Upload Button Overlay -->
                <div class="absolute bottom-3 right-3">
                  <button type="button" @click="triggerFileUpload"
                    class="bg-white/80 hover:bg-white cursor-pointer text-gray-700 hover:text-gray-900 rounded-lg px-4 py-2 shadow-lg transition-all duration-200 hover:scale-105 flex items-center gap-2"
                    title="Upload photo">
                    <Camera class="w-5 h-5" />
                    <span class="text-sm font-medium">Upload photo</span>
                  </button>
                </div>

                <!-- Remove Button -->
                <div v-if="selectedFile" class="absolute top-3 right-3">
                  <button type="button" @click="removeImage"
                    class="bg-red-500/90 hover:bg-red-500 text-white rounded-full p-2 shadow-lg transition-all duration-200 hover:scale-110"
                    title="Удалить фото">
                    <X class="w-4 h-4" />
                  </button>
                </div>
              </figure>
            </div>
          </div>

          <!-- Person Info Section -->
          <div class="lg:flex-1/2 pt-[30px] max-lg:px-5 max-lg:text-center max-lg:mt-[200px]">
            <div class="flex justify-center lg:justify-start">
              <Input id="name" type="text" placeholder="Enter Name" class="w-97 text-lg" :value="name"
                @update:modelValue="updateName" />
            </div>
            <InputError :message="errors?.name" />

            <ul class="list-none space-y-2 mb-2 max-lg:!mb-0 mt-5">
              <li
                class="flex items-center gap-3 mb-2 justify-center lg:justify-start text-pretty text-xl tracking-tighter xl:text-4xl/none sm:text-3xl">
                <div class="mb-4">
                  <DatePicker placeholder="Выберите дату рождения" :value="birth_date"
                    @update:modelValue="updateBirthDate" />
                  <InputError :message="errors?.birth_date" />
                </div>

                <div class="mb-4">
                  <DatePicker placeholder="Выберите дату смерти" :value="death_date"
                    @update:modelValue="updateDeathDate" />
                  <InputError :message="errors?.death_date" />
                </div>
              </li>
            </ul>
            <div class="flex justify-center lg:justify-start">

              <div class="relative w-97 ">
                <MapPin class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground" />
                <Input type="text" placeholder="Enter location" class="pl-10 w-full text-lg" :value="grave_location"
                  @update:modelValue="updateGraveLocation" />
                <InputError :message="errors?.grave_location" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Скрытые файловые инпуты -->
    <input type="file" ref="imageFileInput" class="hidden" accept="image/*" @change="handleFileUpload" />
    <input type="file" ref="backgroundFileInput" class="hidden" accept="image/*" @change="handleBackgroundUpload" />
  </section>
</template>

<script setup lang="ts">
import { MapPin, Camera, X, ImageIcon } from 'lucide-vue-next'
import { Input } from '@/components/ui/input'
import DatePicker from '@/components/DatePicker.vue'
import InputError from '@/components/InputError.vue'

import { ref } from 'vue'

const props = defineProps({
  name: String,
  birth_date: String,
  death_date: String,
  grave_location: String,
  imagePreview: String,
  errors: Object
})

const emit = defineEmits([
  'update:name',
  'update:birth_date',
  'update:death_date',
  'update:grave_location',
  'update:image',
  'update:background_image'
])

// локальные состояния для превью
const selectedFile = ref<File | null>(null)
const previewImage = ref<string>('/images/front/hero-bg.png')
const customBackground = ref<File | null>(null)
const backgroundImage = ref<string>('/images/front/hero-bg.png')

// refs для input
const imageFileInput = ref<HTMLInputElement | null>(null)
const backgroundFileInput = ref<HTMLInputElement | null>(null)

// Методы для обновления данных
const updateName = (value: string) => {
  emit('update:name', value)
}

const updateBirthDate = (value: string) => {
  emit('update:birth_date', value)
}

const updateDeathDate = (value: string) => {
  emit('update:death_date', value)
}

const updateGraveLocation = (value: string) => {
  emit('update:grave_location', value)
}

const triggerFileUpload = () => {
  // ИСПРАВЛЕНО: Очищаем значение input перед открытием
  if (imageFileInput.value) {
    imageFileInput.value.value = ''
  }
  imageFileInput.value?.click()
}

const triggerBackgroundUpload = () => {
  // ИСПРАВЛЕНО: Очищаем значение input перед открытием
  if (backgroundFileInput.value) {
    backgroundFileInput.value.value = ''
  }
  backgroundFileInput.value?.click()
}

const handleFileUpload = (event: Event) => {
  const file = (event.target as HTMLInputElement).files?.[0]
  if (file) {
    selectedFile.value = file
    emit('update:image', file)

    const reader = new FileReader()
    reader.onload = (e) => {
      previewImage.value = e.target?.result as string
    }
    reader.readAsDataURL(file)
  }
}

const handleBackgroundUpload = (event: Event) => {
  const file = (event.target as HTMLInputElement).files?.[0]
  if (file) {
    customBackground.value = file
    emit('update:background_image', file)

    const reader = new FileReader()
    reader.onload = (e) => {
      backgroundImage.value = e.target?.result as string
    }
    reader.readAsDataURL(file)
  }
}

const removeImage = () => {
  selectedFile.value = null
  previewImage.value = '/images/front/hero-bg.png'
  emit('update:image', null)

  // ИСПРАВЛЕНО: Очищаем input при удалении
  if (imageFileInput.value) {
    imageFileInput.value.value = ''
  }
}

const removeBackground = () => {
  customBackground.value = null
  backgroundImage.value = '/images/front/hero-bg.png'
  emit('update:background_image', null)

  // ИСПРАВЛЕНО: Очищаем input при удалении
  if (backgroundFileInput.value) {
    backgroundFileInput.value.value = ''
  }
}
</script>