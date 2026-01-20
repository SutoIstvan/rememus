<template>
  <section
    class="hero-section pt-[190px] md:pt-[210px] lg:pt-[210px] xl:pt-[220px] bg-no-repeat bg-cover bg-top relative z-0"
    :style="{ backgroundImage: `url('${backgroundImage}')` }"
  >
    <!-- Hero Title Content -->
    <div
      class="mx-auto px-4 md:px-6 lg:px-8 flex flex-col items-center relative z-10 mb-[100px] lg:mb-[130px] xl:mb-[210px]"
    >
      <div class="absolute mt-11 right-3 z-20 flex gap-3">
        <div v-if="customBackground">
          <button
            type="button"
            @click="removeBackground"
            class="bg-red-500/80 hover:bg-red-500 text-white rounded-lg px-3 py-3 shadow-lg transition-all duration-200 hover:scale-105 flex items-center gap-2"
          >
            <X class="w-4 h-4" />
          </button>
        </div>

        <div>
          <button
            type="button"
            @click="triggerBackgroundUpload"
            class="bg-white/80 hover:bg-white cursor-pointer text-gray-700 hover:text-gray-900 rounded-lg px-2 sm:px-3 py-2 shadow-lg transition-all duration-200 hover:scale-105 flex items-center gap-2"
          >
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
                class="shadow-lg absolute lg:right-0 lg:bottom-0 w-[300px] max-lg:left-1/2 max-lg:-translate-x-1/2 max-lg:top-[-100px] bg-white dark:bg-background-9 rounded-[10px] overflow-hidden p-1 group"
              >
                <img
                  :src="previewImage"
                  :alt="name"
                  class="w-[300px] h-[300px] object-cover rounded-[10px]"
                />

                <div class="absolute bottom-3 right-3">
                  <button
                    type="button"
                    @click="triggerFileUpload"
                    class="bg-white/80 hover:bg-white cursor-pointer text-gray-700 hover:text-gray-900 rounded-lg px-4 py-2 shadow-lg transition-all duration-200 hover:scale-105 flex items-center gap-2"
                  >
                    <Camera class="w-5 h-5" />
                    <span class="text-sm font-medium">Upload photo</span>
                  </button>
                </div>

                <div v-if="selectedFile" class="absolute top-3 right-3">
                  <button
                    type="button"
                    @click="removeImage"
                    class="bg-red-500/90 hover:bg-red-500 text-white rounded-full p-2 shadow-lg transition-all duration-200 hover:scale-110"
                  >
                    <X class="w-4 h-4" />
                  </button>
                </div>
              </figure>
            </div>
          </div>

          <!-- Person Info Section -->
          <div class="lg:flex-1/2 pt-[30px] max-lg:px-5 max-lg:text-center max-lg:mt-[200px]">
            <div class="flex justify-center lg:justify-start">
              <Input
                id="name"
                type="text"
                placeholder="Enter Name"
                class="w-97 text-lg"
                :value="name"
                @update:modelValue="updateName"
              />
            </div>
            <InputError :message="errors?.name" />

            <ul class="list-none space-y-2 mb-2 max-lg:!mb-0 mt-5">
              <li
                class="flex items-center gap-3 mb-2 justify-center lg:justify-start text-pretty text-xl tracking-tighter xl:text-4xl/none sm:text-3xl"
              >
                <!-- Дата рождения -->
                <div class="mb-4">
                  <div class="relative flex gap-2">
                    <Input
                      :model-value="birthInput"
                      placeholder="15.01.2026 Birth"
                      class="bg-background text-sm"
                      maxlength="10"
                      @update:model-value="handleBirthInput"
                    />
                    <Popover v-model:open="openBirth">
                      <PopoverTrigger as-child>
                        <button
                          type="button"
                          class="absolute top-1/2 right-2 size-8 -translate-y-1/2"
                        >
                          <CalendarIcon class="size-4" />
                        </button>
                      </PopoverTrigger>
                      <PopoverContent class="w-auto overflow-hidden p-0" align="end">
                        <Calendar
                          :model-value="calendarBirthDate"
                          v-model:placeholder="placeholderBirth"
                          layout="month-and-year"
                          :max-value="maxBirthDate"
                          class="rounded-md border shadow-sm **:data-[slot=calendar-cell-trigger]:size-11"
                          @update:model-value="(v) => {
                            if (v) {
                              const d = v.toDate(getLocalTimeZone())
                              birthDate = d
                              birthInput = formatDate(d)
                              emit('update:birth_date', d.toISOString().split('T')[0])
                              openBirth = false
                            }
                          }"
                        />
                      </PopoverContent>
                    </Popover>
                  </div>
                  <InputError :message="errors?.birth_date" />
                </div>

                <!-- Дата смерти -->
                <div class="mb-4">
                  <div class="relative flex gap-2">
                    <Input
                      :model-value="deathInput"
                      placeholder="15.01.2026 Death"
                      class="bg-background pr-10"
                      maxlength="10"
                      @update:model-value="handleDeathInput"
                    />
                    <Popover v-model:open="openDeath">
                      <PopoverTrigger as-child>
                        <button
                          type="button"
                          class="absolute top-1/2 right-2 size-8 -translate-y-1/2"
                        >
                          <CalendarIcon class="size-4" />
                        </button>
                      </PopoverTrigger>
                      <PopoverContent class="w-auto overflow-hidden p-0" align="end">
                        <Calendar
                          :model-value="calendarDeathDate"
                          v-model:placeholder="placeholderDeath"
                          layout="month-and-year"
                          :min-value="minDeathDate"
                          class="rounded-md border shadow-sm **:data-[slot=calendar-cell-trigger]:size-11"
                          @update:model-value="(v) => {
                            if (v) {
                              const d = v.toDate(getLocalTimeZone())
                              deathDate = d
                              deathInput = formatDate(d)
                              emit('update:death_date', d.toISOString().split('T')[0])
                              openDeath = false
                            }
                          }"
                        />
                      </PopoverContent>
                    </Popover>
                  </div>
                  <InputError :message="errors?.death_date" />
                </div>
              </li>
            </ul>

            <div class="flex justify-center lg:justify-start">
              <div class="relative w-97">
                <MapPin class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground" />
                <Input
                  type="text"
                  placeholder="Enter location"
                  class="pl-10 w-full text-lg"
                  :value="grave_location"
                  @update:modelValue="updateGraveLocation"
                />
                <InputError :message="errors?.grave_location" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- hidden inputs -->
    <input ref="imageFileInput" type="file" class="hidden" accept="image/*" @change="handleFileUpload" />
    <input ref="backgroundFileInput" type="file" class="hidden" accept="image/*" @change="handleBackgroundUpload" />
  </section>
</template>

<script setup lang="ts">
import { ref, watch, computed } from 'vue'
import { MapPin, Camera, X, ImageIcon, CalendarIcon } from 'lucide-vue-next'
import { Input } from '@/components/ui/input'
import { Calendar } from '@/components/ui/calendar'
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover'
import InputError from '@/components/InputError.vue'
import { fromDate, getLocalTimeZone, CalendarDate } from '@internationalized/date'

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

/* ---------- dates ---------- */

const birthInput = ref('')
const deathInput = ref('')
const birthDate = ref<Date | null>(null)
const deathDate = ref<Date | null>(null)
const openBirth = ref(false)
const openDeath = ref(false)

/**
 * 🔹 Computed для календаря - преобразуем Date в CalendarDate
 */
const calendarBirthDate = computed(() => 
  birthDate.value ? fromDate(birthDate.value, getLocalTimeZone()) : undefined
)

const calendarDeathDate = computed(() => 
  deathDate.value ? fromDate(deathDate.value, getLocalTimeZone()) : undefined
)

/**
 * 🔹 Ограничения для календарей
 */
const maxBirthDate = computed(() => {
  // Дата рождения не может быть позже даты смерти
  if (deathDate.value) {
    return fromDate(deathDate.value, getLocalTimeZone())
  }
  // Или не позже сегодня
  return fromDate(new Date(), getLocalTimeZone())
})

const minDeathDate = computed(() => {
  // Дата смерти не может быть раньше даты рождения
  if (birthDate.value) {
    return fromDate(birthDate.value, getLocalTimeZone())
  }
  return undefined
})

/**
 * 🔹 Placeholder для календарей - обновляется при открытии
 */
const placeholderBirth = ref<any>(undefined)
const placeholderDeath = ref<any>(undefined)

/**
 * 🔹 Обновление placeholder при открытии календаря
 */
watch(openBirth, (isOpen) => {
  if (isOpen) {
    if (birthDate.value) {
      placeholderBirth.value = fromDate(birthDate.value, getLocalTimeZone())
    } else {
      placeholderBirth.value = fromDate(new Date(), getLocalTimeZone())
    }
  }
})

watch(openDeath, (isOpen) => {
  if (isOpen) {
    if (deathDate.value) {
      placeholderDeath.value = fromDate(deathDate.value, getLocalTimeZone())
    } else {
      placeholderDeath.value = fromDate(new Date(), getLocalTimeZone())
    }
  }
})

const formatDate = (d: Date) =>
  d.toLocaleDateString('ru-RU', { day: '2-digit', month: '2-digit', year: 'numeric' })

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
      return new Date(year, month - 1, day)
    }
  }
  return null
}

const handleBirthInput = (value: string) => {
  if (!value) {
    birthInput.value = ''
    birthDate.value = null
    emit('update:birth_date', '')
    return
  }

  const formatted = formatDateInput(value)
  birthInput.value = formatted

  if (formatted.length === 10) {
    const parsed = parseDateFromFormat(formatted)
    if (parsed) {
      birthDate.value = parsed
      birthInput.value = formatDate(parsed)
      emit('update:birth_date', parsed.toISOString().split('T')[0])
    }
  }
}

const handleDeathInput = (value: string) => {
  if (!value) {
    deathInput.value = ''
    deathDate.value = null
    emit('update:death_date', '')
    return
  }

  const formatted = formatDateInput(value)
  deathInput.value = formatted

  if (formatted.length === 10) {
    const parsed = parseDateFromFormat(formatted)
    if (parsed) {
      deathDate.value = parsed
      deathInput.value = formatDate(parsed)
      emit('update:death_date', parsed.toISOString().split('T')[0])
    }
  }
}

watch(
  () => props.birth_date,
  v => {
    if (!v) return
    const [y, m, d] = v.split('-').map(Number)
    const date = new Date(y, m - 1, d)
    birthDate.value = date
    birthInput.value = formatDate(date)
  },
  { immediate: true }
)

watch(
  () => props.death_date,
  v => {
    if (!v) return
    const [y, m, d] = v.split('-').map(Number)
    const date = new Date(y, m - 1, d)
    deathDate.value = date
    deathInput.value = formatDate(date)
  },
  { immediate: true }
)

/* ---------- image / background ---------- */

const selectedFile = ref<File | null>(null)
const previewImage = ref<string>(props.imagePreview || '/images/front/hero-bg.png')
const customBackground = ref<File | null>(null)
const backgroundImage = ref<string>('/images/front/hero-bg.png')

const imageFileInput = ref<HTMLInputElement | null>(null)
const backgroundFileInput = ref<HTMLInputElement | null>(null)

const updateName = (v: string) => emit('update:name', v)
const updateGraveLocation = (v: string) => emit('update:grave_location', v)

const triggerFileUpload = () => {
  if (imageFileInput.value) imageFileInput.value.value = ''
  imageFileInput.value?.click()
}

const triggerBackgroundUpload = () => {
  if (backgroundFileInput.value) backgroundFileInput.value.value = ''
  backgroundFileInput.value?.click()
}

const handleFileUpload = (e: Event) => {
  const file = (e.target as HTMLInputElement).files?.[0]
  if (!file) return
  selectedFile.value = file
  emit('update:image', file)

  const reader = new FileReader()
  reader.onload = ev => (previewImage.value = ev.target?.result as string)
  reader.readAsDataURL(file)
}

const handleBackgroundUpload = (e: Event) => {
  const file = (e.target as HTMLInputElement).files?.[0]
  if (!file) return
  customBackground.value = file
  emit('update:background_image', file)

  const reader = new FileReader()
  reader.onload = ev => (backgroundImage.value = ev.target?.result as string)
  reader.readAsDataURL(file)
}

const removeImage = () => {
  selectedFile.value = null
  previewImage.value = '/images/front/hero-bg.png'
  emit('update:image', null)
  if (imageFileInput.value) imageFileInput.value.value = ''
}

const removeBackground = () => {
  customBackground.value = null
  backgroundImage.value = '/images/front/hero-bg.png'
  emit('update:background_image', null)
  if (backgroundFileInput.value) backgroundFileInput.value.value = ''
}
</script>