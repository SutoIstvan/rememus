<template>
  <section
    class="hero-section pt-[190px] md:pt-[210px] lg:pt-[210px] xl:pt-[220px] bg-no-repeat bg-cover bg-top relative z-0"
    :style="{ backgroundImage: `url('${backgroundImage}')` }">
    <!-- Hero Title Content -->
    <div
      class="mx-auto px-4 md:px-6 lg:px-8 flex flex-col items-center relative z-10 mb-[100px] lg:mb-[130px] xl:mb-[210px]">
      <div class="absolute mt-11 right-3 z-20 flex gap-3">
        <div v-if="customBackground">
          <Button type="button" variant="destructive" size="icon" @click="removeBackground"
            aria-label="Remove background">
            <X class="w-4 h-4" />
          </Button>
        </div>

        <div>
          <Button type="button" variant="secondary" @click="openBackgroundModal = true"
            class="bg-white/90 hover:bg-white text-gray-700 hover:text-gray-900">
            <ImageIcon class="w-5 h-5" />
            <span class="hidden sm:inline-block ml-2">Change background</span>
          </Button>
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

                <div class="absolute bottom-3 right-3">
                  <Button type="button" variant="secondary" @click="triggerFileUpload"
                    class="bg-white/90 hover:bg-white text-gray-700 hover:text-gray-900">
                    <Camera class="w-5 h-5" />
                    <span class="ml-2">Upload photo</span>
                  </Button>
                </div>

                <div v-if="selectedFile" class="absolute top-3 right-3">
                  <Button type="button" variant="destructive" size="icon" @click="removeImage" class="rounded-full"
                    aria-label="Remove image">
                    <X class="w-4 h-4" />
                  </Button>
                </div>
              </figure>
            </div>
          </div>

          <!-- Person Info Section -->
          <div class="lg:flex-1/2 pt-[30px] max-lg:px-5 max-lg:text-center max-lg:mt-[200px]">
            <div class="flex justify-center lg:justify-start">
              <Input id="name" type="text" placeholder="Enter Name" class="w-120" :value="name"
                @update:modelValue="updateName" />
            </div>
            <InputError :message="errors?.name" />

            <ul class="list-none space-y-2 mb-2 max-lg:!mb-0 mt-5">
              <li
                class="flex flex-col lg:flex-row items-center gap-3 mb-2 justify-center lg:justify-start text-pretty text-xl tracking-tighter xl:text-4xl/none sm:text-3xl">
                <!-- Дата рождения -->
                <div class="mb-4 w-full sm:w-120 lg:w-auto">
                  <div class="relative flex gap-2">
                    <Input :model-value="birthInput" placeholder="15.01.1900 Birth Date"
                      class="bg-background tracking-normal w-full lg:!w-58" maxlength="10"
                      @update:model-value="handleBirthInput" />
                    <Popover v-model:open="openBirth">
                      <PopoverTrigger as-child>
                        <Button variant="ghost" size="icon" class="absolute top-1/2 right-1 -translate-y-1/2 h-8 w-8"
                          aria-label="Open birth date calendar">
                          <CalendarIcon class="h-4 w-4" />
                        </Button>
                      </PopoverTrigger>
                      <PopoverContent class="w-auto overflow-hidden p-0" align="end">
                        <Calendar :model-value="calendarBirthDate" v-model:placeholder="placeholderBirth"
                          layout="month-and-year" :max-value="maxBirthDate"
                          class="rounded-md border shadow-sm **:data-[slot=calendar-cell-trigger]:size-11"
                          @update:model-value="(v) => {
                            if (v) {
                              const d = v.toDate(getLocalTimeZone())
                              birthDate = d
                              birthInput = formatDate(d)
                              emit('update:birth_date', formatDateISO(d))
                              openBirth = false
                            }
                          }" />
                      </PopoverContent>
                    </Popover>
                  </div>
                  <InputError :message="errors?.birth_date" />
                </div>

                <!-- Дата смерти -->
                <div class="mb-4 w-full sm:w-120 lg:w-auto">
                  <div class="relative flex gap-2">
                    <Input :model-value="deathInput" placeholder="15.01.2026 Passing Date"
                      class="bg-background pr-10 tracking-normal w-full lg:!w-58" maxlength="10"
                      @update:model-value="handleDeathInput" />
                    <Popover v-model:open="openDeath">
                      <PopoverTrigger as-child>
                        <Button variant="ghost" size="icon" class="absolute top-1/2 right-1 -translate-y-1/2 h-8 w-8"
                          aria-label="Open death date calendar">
                          <CalendarIcon class="h-4 w-4" />
                        </Button>
                      </PopoverTrigger>
                      <PopoverContent class="w-auto overflow-hidden p-0" align="end">
                        <Calendar :model-value="calendarDeathDate" v-model:placeholder="placeholderDeath"
                          layout="month-and-year" :min-value="minDeathDate"
                          class="rounded-md border shadow-sm **:data-[slot=calendar-cell-trigger]:size-11"
                          @update:model-value="(v) => {
                            if (v) {
                              const d = v.toDate(getLocalTimeZone())
                              deathDate = d
                              deathInput = formatDate(d)
                              emit('update:death_date', formatDateISO(d))
                              openDeath = false
                            }
                          }" />
                      </PopoverContent>
                    </Popover>
                  </div>
                  <InputError :message="errors?.death_date" />
                </div>
              </li>
            </ul>

            <div class="flex justify-center lg:justify-start">
              <div class="relative w-120">
                <MapPin class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground" />
                <Input type="text" placeholder="Birth Place" class="pl-10 w-full" :value="birth_place"
                  @update:modelValue="updateBirthPlace" />
                <InputError :message="errors?.birth_place" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Background Selection Modal -->
    <Dialog v-model:open="openBackgroundModal">
      <DialogContent class="max-w-3xl max-h-[80vh] overflow-y-auto">
        <DialogHeader>
          <DialogTitle>Choose Background</DialogTitle>
          <DialogDescription>
            Select a predefined background or upload your own custom image
          </DialogDescription>
        </DialogHeader>

        <div class="space-y-6">
          <!-- Predefined Backgrounds Grid -->
          <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <div v-for="(bg, index) in predefinedBackgrounds" :key="index" @click="selectPredefinedBackground(bg)"
              class="group relative cursor-pointer rounded-lg overflow-hidden border transition-all" :class="selectedBackgroundUrl === bg.url
                ? 'border-primary ring-1 ring-primary'
                : 'border-gray-200'">
              <img :src="bg.url" :alt="bg.name" class="w-full h-25 object-cover transition-transform duration-300
           group-hover:scale-110" />

              <div class="absolute inset-0 bg-black/40 flex items-center justify-center
           opacity-0 group-hover:opacity-100 transition-opacity">
                <span class="text-white text-sm font-medium">{{ bg.name }}</span>
              </div>

              <div v-if="selectedBackgroundUrl === bg.url"
                class="absolute top-2 right-2 bg-primary text-white rounded-full p-1">
                <Check class="w-4 h-4" />
              </div>
            </div>


          </div>

          <!-- Upload Custom Background -->
          <div class="border-t pt-4">
            <Button type="button" variant="outline" class="w-full" @click="triggerBackgroundUpload">
              <Upload class="w-4 h-4 mr-2" />
              Upload Custom Background
            </Button>
          </div>

          <!-- Preview of selected custom background -->
          <div v-if="tempCustomBackground" class="relative rounded-lg overflow-hidden border-2 border-primary">
            <img :src="tempCustomBackgroundPreview" alt="Custom background preview" class="w-full h-40 object-cover" />
            <div class="absolute top-2 left-2 bg-primary text-white px-2 py-1 rounded text-xs">
              Custom Upload
            </div>
            <Button type="button" variant="destructive" size="icon" class="absolute top-2 right-2"
              @click="removeTempCustomBackground">
              <X class="w-4 h-4" />
            </Button>
          </div>
        </div>

        <DialogFooter>
          <Button type="button" variant="outline" @click="openBackgroundModal = false">
            Cancel
          </Button>
          <Button type="button" @click="applyBackground">
            Apply Background
          </Button>
        </DialogFooter>
      </DialogContent>
    </Dialog>

    <!-- hidden inputs -->
    <input ref="imageFileInput" type="file" class="hidden" accept="image/*" @change="handleFileUpload" />
    <input ref="backgroundFileInput" type="file" class="hidden" accept="image/*" @change="handleBackgroundUpload" />
  </section>
</template>

<script setup lang="ts">
import { ref, watch, computed } from 'vue'
import { MapPin, Camera, X, ImageIcon, CalendarIcon, Check, Upload } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Calendar } from '@/components/ui/calendar'
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover'
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog'
import InputError from '@/components/InputError.vue'
import { fromDate, getLocalTimeZone, CalendarDate } from '@internationalized/date'

const props = defineProps({
  name: String,
  birth_date: String,
  death_date: String,
  birth_place: String,
  imagePreview: String,
  errors: Object
})

const emit = defineEmits([
  'update:name',
  'update:birth_date',
  'update:death_date',
  'update:birth_place',
  'update:image',
  'update:background_image',
  'update:background_url'
])

/* ---------- Background Selection ---------- */

const openBackgroundModal = ref(false)
const selectedBackgroundUrl = ref('/images/front/hero-bg.png')
const tempCustomBackground = ref<File | null>(null)
const tempCustomBackgroundPreview = ref<string>('')

// Predefined backgrounds - добавьте свои пути к картинкам
const predefinedBackgrounds = ref([
  { name: 'Default', url: '/images/front/hero-bg.png' },
  { name: 'Sunset', url: '/images/front/sunset.jpg' },
  { name: 'Mountains', url: '/images/front/mountains.jpg' },
  { name: 'Ocean', url: '/images/front/ocean.jpg' },
  { name: 'Forest', url: '/images/front/forest.jpg' },
  { name: 'Sky', url: '/images/front/sky.jpg' },
])

const selectPredefinedBackground = (bg: { name: string; url: string }) => {
  selectedBackgroundUrl.value = bg.url
  tempCustomBackground.value = null
  tempCustomBackgroundPreview.value = ''
}

const removeTempCustomBackground = () => {
  tempCustomBackground.value = null
  tempCustomBackgroundPreview.value = ''
  selectedBackgroundUrl.value = '/images/front/hero-bg.png'
  if (backgroundFileInput.value) backgroundFileInput.value.value = ''
}

const applyBackground = () => {
  if (tempCustomBackground.value) {
    // Применяем загруженный пользовательский фон
    customBackground.value = tempCustomBackground.value
    backgroundImage.value = tempCustomBackgroundPreview.value
    emit('update:background_image', tempCustomBackground.value)
    emit('update:background_url', null) // Очищаем URL
  } else {
    // Применяем предустановленный фон по URL
    customBackground.value = null
    backgroundImage.value = selectedBackgroundUrl.value
    emit('update:background_image', null) // Очищаем файл
    emit('update:background_url', selectedBackgroundUrl.value) // Отправляем URL
  }
  openBackgroundModal.value = false
}

/* ---------- dates ---------- */

const birthInput = ref('')
const deathInput = ref('')
const birthDate = ref<Date | null>(null)
const deathDate = ref<Date | null>(null)
const openBirth = ref(false)
const openDeath = ref(false)

const calendarBirthDate = computed(() =>
  birthDate.value ? fromDate(birthDate.value, getLocalTimeZone()) : undefined
)

const calendarDeathDate = computed(() =>
  deathDate.value ? fromDate(deathDate.value, getLocalTimeZone()) : undefined
)

const maxBirthDate = computed(() => {
  if (deathDate.value) {
    return fromDate(deathDate.value, getLocalTimeZone())
  }
  return fromDate(new Date(), getLocalTimeZone())
})

const minDeathDate = computed(() => {
  if (birthDate.value) {
    return fromDate(birthDate.value, getLocalTimeZone())
  }
  return undefined
})

const placeholderBirth = ref<any>(undefined)
const placeholderDeath = ref<any>(undefined)

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

// Форматирует Date в YYYY-MM-DD без сдвига таймзоны
const formatDateISO = (d: Date) => {
  const year = d.getFullYear()
  const month = String(d.getMonth() + 1).padStart(2, '0')
  const day = String(d.getDate()).padStart(2, '0')
  return `${year}-${month}-${day}`
}

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

const handleBirthInput = (value: string | number) => {
  const strValue = String(value)
  if (!strValue) {
    birthInput.value = ''
    birthDate.value = null
    emit('update:birth_date', '')
    return
  }

  const formatted = formatDateInput(strValue)
  birthInput.value = formatted

  if (formatted.length === 10) {
    const parsed = parseDateFromFormat(formatted)
    if (parsed) {
      birthDate.value = parsed
      birthInput.value = formatDate(parsed)
      emit('update:birth_date', formatDateISO(parsed))
    }
  }
}

const handleDeathInput = (value: string | number) => {
  const strValue = String(value)
  if (!strValue) {
    deathInput.value = ''
    deathDate.value = null
    emit('update:death_date', '')
    return
  }

  const formatted = formatDateInput(strValue)
  deathInput.value = formatted

  if (formatted.length === 10) {
    const parsed = parseDateFromFormat(formatted)
    if (parsed) {
      deathDate.value = parsed
      deathInput.value = formatDate(parsed)
      emit('update:death_date', formatDateISO(parsed))
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
const previewImage = ref<string>(props.imagePreview || '/images/front/avatar_2.png')
const customBackground = ref<File | null>(null)
const backgroundImage = ref<string>('/images/front/hero-bg.png')

const imageFileInput = ref<HTMLInputElement | null>(null)
const backgroundFileInput = ref<HTMLInputElement | null>(null)

const updateName = (v: string | number) => emit('update:name', String(v))
const updateBirthPlace = (v: string | number) => emit('update:birth_place', String(v))

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
  tempCustomBackground.value = file

  const reader = new FileReader()
  reader.onload = ev => {
    tempCustomBackgroundPreview.value = ev.target?.result as string
    selectedBackgroundUrl.value = ''
  }
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
  selectedBackgroundUrl.value = '/images/front/hero-bg.png'
  emit('update:background_image', null)
  emit('update:background_url', '/images/front/hero-bg.png') // Возвращаем дефолтный фон
  if (backgroundFileInput.value) backgroundFileInput.value.value = ''
}
</script>