<script setup lang="ts">
import { useForm, router } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import axios from 'axios'
import { Loader2 } from 'lucide-vue-next'
import { toast } from "vue-sonner"
import { Toaster } from '@/components/ui/sonner'
import { Head } from '@inertiajs/vue3';

import 'vue-sonner/style.css'

// Подкомпоненты
import HeaderCreate from '@/components/memorial/Header/Create.vue'
import FamilyTreeCreate from '@/components/memorial/FamilyTree/Create.vue'
import GalleryCreate from '@/components/memorial/Gallery/Create.vue'
import TimelineCreate from '@/components/memorial/TimeLine/Create.vue'
import FeaturesCreate from '@/components/memorial/Features/Create.vue'
import BurialLocationCreate from '@/components/memorial/BurialLocation/Create.vue'

import { Button } from '@/components/ui/button'
import { Switch } from '@/components/ui/switch'
import { Label } from '@/components/ui/label'
import { store as memorialsStore } from '@/routes/memorials'

// Храним File объекты аватаров отдельно
const avatarFiles = ref<Map<string, File>>(new Map())

// Состояния активности секций
const sectionsEnabled = ref({
  familyTree: true,
  gallery: true,
  timeline: true,
  features: true,
  burialLocation: true,
})

// Прогресс загрузки галереи
const uploadingPhotos = ref(false)
const uploadProgress = ref({ current: 0, total: 0 })

// Форма
const form = useForm({
  name: '',
  birth_date: '',
  death_date: '',
  birth_place: '',
  grave_location: '',
  image: null as File | null,
  background_image: null as File | null,
  background_url: null,

  family_tree: [] as any[],
  gallery: [] as File[],
  timeline: [] as any[],

  // FEATURES
  characteristics: [] as string[],
  customTraits: '',
  hobbies: [] as string[],
  additionalHobbies: '',
  retirement: '',
  habits: '',
  stories: '',
  wisdom: '',

  // BURIAL LOCATION
  graveParcel: '',
  graveLine: '',
  graveNumber: '',
  coordinates: '',
  gravePhoto: null as File | null,

  // Флаги активности секций
  family_tree_enabled: true,
  gallery_enabled: true,
  timeline_enabled: true,
  features_enabled: true,
  burial_location_enabled: true,
})

// Синхронизация состояния переключателей с формой
watch(sectionsEnabled, (newVal) => {
  form.family_tree_enabled = newVal.familyTree
  form.gallery_enabled = newVal.gallery
  form.timeline_enabled = newVal.timeline
  form.features_enabled = newVal.features
  form.burial_location_enabled = newVal.burialLocation
}, { deep: true })

// Синхронизация имени с деревом
watch(() => form.name, (newName) => {
  const youNode = form.family_tree.find((node: any) => node.id === 'you')
  if (youNode) {
    youNode.name = newName
  }
})

// Синхронизация аватара
watch(() => form.image, (newImage) => {
  if (newImage) {
    avatarFiles.value.set('you', newImage)

    const youNode = form.family_tree.find((node: any) => node.id === 'you')
    if (youNode) {
      const reader = new FileReader()
      reader.onload = (e) => {
        youNode.avatar = e.target?.result as string
      }
      reader.readAsDataURL(newImage)
    }
  } else {
    avatarFiles.value.delete('you')
    const youNode = form.family_tree.find((node: any) => node.id === 'you')
    if (youNode) youNode.avatar = ''
  }
})

// НОВОЕ: Синхронизация Family Tree -> Timeline
const syncFamilyToTimeline = () => {
  let hasChanges = false
  const newTimeline = [...form.timeline]

  // Проходим по членам семьи
  form.family_tree.forEach((member: any) => {
    // Нас интересуют только супруги и дети с заполненным именем
    if ((member.role === 'spouse' || member.role === 'child') && member.name) {
      // Ищем существующее событие в таймлайне для этого члена семьи
      const existingEventIndex = newTimeline.findIndex(
        (event: any) => event.related_person === member.id
      )

      const eventType = member.role === 'spouse' ? 'wedding' : 'birth_child'
      const eventTitle = member.role === 'spouse'
        ? 'Wedding'
        : 'Birth of a Child'
      const eventDescription = member.role === 'spouse'
        ? `Marriage to ${member.name}`
        : `Birth of ${member.name}`

      // Получаем фото
      let media: File | string | null = null
      if (avatarFiles.value.has(member.id)) {
        media = avatarFiles.value.get(member.id) as File
      } else if (member.avatar) {
        media = member.avatar
      }

      if (existingEventIndex !== -1) {
        // ОБНОВЛЕНИЕ
        const event = newTimeline[existingEventIndex] // Mutate copy reference in array
        let eventChanged = false

        // Обновляем заголовок если он старый или отличается
        if (event.title !== eventTitle) {
          event.title = eventTitle
          eventChanged = true
        }

        // Обновляем описание если имя изменилось
        if (event.description !== eventDescription) {
          event.description = eventDescription
          eventChanged = true
        }

        if (media && event.media !== media) {
          event.media = media
          eventChanged = true
        }

        if (eventChanged) hasChanges = true

      } else {
        // СОЗДАНИЕ
        const newEvent = {
          id: `timeline-${member.id}`,
          title: eventTitle,
          description: eventDescription,
          type: eventType,
          location: '',
          date: '',
          related_person: member.id,
          media: media
        }
        newTimeline.push(newEvent)
        hasChanges = true
      }
    }
  })

  // Если были изменения, обновляем весь массив, чтобы триггернуть реактивность
  if (hasChanges) {
    form.timeline = newTimeline
  }
}

// НОВОЕ: Синхронизация Header -> Timeline (Основной персонаж)
const syncHeaderToTimeline = () => {
  if (!form.name) return

  const timelineId = 'timeline-main-birth'
  const newTimeline = [...form.timeline]
  const existingEventIndex = newTimeline.findIndex(
    (event: any) => event.id === timelineId
  )

  const eventTitle = 'Born'
  const eventDescription = `Born ${form.name}`
  const eventDate = form.birth_date

  // Фото берем из avatarFiles ('you') или form.image
  let media: File | null = null
  if (avatarFiles.value.has('you')) {
    media = avatarFiles.value.get('you') as File
  } else if (form.image) {
    media = form.image
  }

  if (existingEventIndex !== -1) {
    // ОБНОВЛЕНИЕ
    const event = newTimeline[existingEventIndex]
    let hasChanges = false

    if (event.description !== eventDescription) {
      event.description = eventDescription
      hasChanges = true
    }
    if (event.date !== eventDate) {
      event.date = eventDate
      hasChanges = true
    }
    if (media && event.media !== media) {
      event.media = media
      hasChanges = true
    }

    if (hasChanges) {
      form.timeline = newTimeline
    }
  } else {
    // СОЗДАНИЕ
    const newEvent = {
      id: timelineId,
      title: eventTitle,
      description: eventDescription,
      type: 'born',
      location: '', // Можно добавить место рождения если будет поле
      date: eventDate,
      related_person: 'you',
      media: media
    }
    newTimeline.push(newEvent)
    form.timeline = newTimeline
  }
}

// Следим за изменениями в хедере
watch(() => [form.name, form.birth_date, form.image], () => {
  syncHeaderToTimeline()
})

// Следим за изменениями в дереве (добавление/удаление/изменение имен)
watch(() => form.family_tree, () => {
  syncFamilyToTimeline()
}, { deep: true })

// Следим за изменениями файлов аватаров (чтобы обновить фото в таймлайне)
watch(() => avatarFiles.value, () => {
  syncFamilyToTimeline()
}, { deep: true })

const submit = async () => {
  const formData = new FormData()

  // Основные поля
  formData.append('name', form.name)
  formData.append('birth_date', form.birth_date)
  formData.append('death_date', form.death_date)
  formData.append('birth_place', form.birth_place)
  formData.append('grave_location', form.grave_location)

  // Изображения
  if (form.image) formData.append('image', form.image)
  if (form.background_image) formData.append('background_image', form.background_image)
  if (form.background_url) formData.append('background_url', form.background_url)

  // Флаги активности секций
  formData.append('family_tree_enabled', form.family_tree_enabled ? '1' : '0')
  formData.append('gallery_enabled', form.gallery_enabled ? '1' : '0')
  formData.append('timeline_enabled', form.timeline_enabled ? '1' : '0')
  formData.append('features_enabled', form.features_enabled ? '1' : '0')
  formData.append('burial_location_enabled', form.burial_location_enabled ? '1' : '0')

  // Семейное дерево (только если секция активна)
  if (form.family_tree_enabled) {
    const familyTreeWithoutMainPerson = form.family_tree.filter(
      (member: any) => member.role !== 'main_person' && member.name
    )
    familyTreeWithoutMainPerson.forEach((member: any, index: number) => {
      formData.append(`family_tree[${index}][id]`, member.id)
      formData.append(`family_tree[${index}][name]`, member.name || '')
      formData.append(`family_tree[${index}][role]`, member.role)
      formData.append(`family_tree[${index}][qr_code]`, member.qr_code || '')
      if (member.position) {
        formData.append(`family_tree[${index}][position]`, JSON.stringify(member.position))
      }
      const avatarFile = avatarFiles.value.get(member.id)
      if (avatarFile && member.id !== 'you') {
        formData.append(`family_tree[${index}][avatar]`, avatarFile, avatarFile.name)
      }
    })
  }

  // TIMELINE (только если секция активна)
  if (form.timeline_enabled && form.timeline.length > 0) {
    form.timeline.forEach((item: any, index: number) => {
      formData.append(`timeline[${index}][id]`, item.id)
      formData.append(`timeline[${index}][title]`, item.title)
      formData.append(`timeline[${index}][description]`, item.description || '')
      formData.append(`timeline[${index}][type]`, item.type || '')
      formData.append(`timeline[${index}][location]`, item.location || '')
      formData.append(`timeline[${index}][related_person]`, item.related_person || '')
      if (item.date) formData.append(`timeline[${index}][date]`, item.date)
      if (item.date_from) formData.append(`timeline[${index}][date_from]`, item.date_from)
      if (item.date_to) formData.append(`timeline[${index}][date_to]`, item.date_to)
      if (item.media instanceof File) {
        formData.append(`timeline[${index}][media]`, item.media)
      }
    })
  }

  // FEATURES (только если секция активна)
  if (form.features_enabled) {
    if (Array.isArray(form.characteristics)) {
      form.characteristics.forEach((char, index) => formData.append(`characteristics[${index}]`, char))
    }
    if (Array.isArray(form.hobbies)) {
      form.hobbies.forEach((hobby, index) => formData.append(`hobbies[${index}]`, hobby))
    }
    formData.append('custom_traits', form.customTraits || '')
    formData.append('additional_hobbies', form.additionalHobbies || '')
    formData.append('retirement', form.retirement || '')
    formData.append('habits', form.habits || '')
    formData.append('stories', form.stories || '')
    formData.append('wisdom', form.wisdom || '')
  }

  // BURIAL LOCATION (только если секция активна)
  if (form.burial_location_enabled) {
    formData.append('grave_parcel', form.graveParcel || '')
    formData.append('grave_line', form.graveLine || '')
    formData.append('grave_number', form.graveNumber || '')
    formData.append('coordinates', form.coordinates || '')
    if (form.gravePhoto instanceof File) {
      formData.append('grave_photo', form.gravePhoto)
    }
  }

  // ── ШАГ 1: Создаём мемориал (без галереи) ──────────────────────────────
  form.processing = true
  let slug: string
  let redirectUrl: string

  try {
    const response = await axios.post(memorialsStore.url(), formData, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' },
    })
    slug = response.data.slug
    redirectUrl = response.data.redirect_url
  } catch (err: any) {
    form.processing = false
    const errors = err.response?.data?.errors
    if (errors) {
      form.setError(errors)
      const msg = Object.values(errors).flat().join('\n')
      toast.error(msg || 'Validation error', { duration: 8000 })
    } else {
      toast.error('Failed to create memorial', { duration: 8000 })
    }
    return
  }

  // ── ШАГ 2: Загружаем фото галереи по одному ────────────────────────────
  const galleryFiles = form.gallery_enabled && form.gallery.length > 0 ? [...form.gallery] : []

  if (galleryFiles.length > 0) {
    uploadingPhotos.value = true
    uploadProgress.value = { current: 0, total: galleryFiles.length }

    for (const file of galleryFiles) {
      try {
        const photoData = new FormData()
        photoData.append('photo', file)
        await axios.post(`/memorial/${slug}/photos`, photoData, {
          headers: { 'X-Requested-With': 'XMLHttpRequest' },
        })
      } catch {
        // Не останавливаемся — пробуем загрузить остальные
        toast.warning(`Failed to upload one photo, skipping`, { duration: 4000 })
      } finally {
        uploadProgress.value.current++
      }
    }

    uploadingPhotos.value = false
  }

  // ── Переходим на страницу редактирования ──────────────────────────────
  form.reset()
  avatarFiles.value.clear()
  router.visit(redirectUrl)
}

const handleFamilyTreeUpdate = (updatedTree: any[]) => {
  form.family_tree = updatedTree
}

const handleAvatarFilesUpdate = (files: Map<string, File>) => {
  files.forEach((file, key) => {
    if (key !== 'you') avatarFiles.value.set(key, file)
  })
}

const handleGalleryUpdate = (galleryFiles: File[]) => {
  form.gallery = galleryFiles
}
</script>

<template>

  <Head title="Memorial Create" />

  <div class="bg-white dark:bg-black min-h-screen">
    <form @submit.prevent="submit" class="space-y-8">

      <HeaderCreate v-model:name="form.name" v-model:birth_date="form.birth_date" v-model:death_date="form.death_date"
        v-model:birth_place="form.birth_place" v-model:image="form.image"
        v-model:background_image="form.background_image" v-model:background_url="form.background_url"
        :errors="form.errors" />

      <!-- Family Tree Section -->
      <div class="space-y-4">
        <div class="px-4 md:px-6 lg:px-8 flex items-center justify-between">
          <div class="mx-auto mt-10 md:mt-[7px] w-[760px]">


            <div class="grid grid-cols-[1fr_auto_1fr] items-center">
              <!-- Левая пустая колонка -->
              <div></div>

              <!-- Центр -->
              <div class="text-center">
                <span class="badge badge-green">
                  Family Tree
                </span>
              </div>

              <!-- Правая часть -->
              <div class="flex justify-end items-center space-x-1">
                <Label for="family-tree-toggle" class="cursor-pointer">
                  {{ sectionsEnabled.familyTree ? 'Active' : 'Disabled' }}
                </Label>
                <Switch id="family-tree-toggle" v-model="sectionsEnabled.familyTree" />

              </div>
            </div>


          </div>
        </div>
        <div class="relative transition-all duration-300"
          :class="sectionsEnabled.familyTree ? 'h-auto' : 'h-[300px] overflow-hidden'">
          <div v-if="!sectionsEnabled.familyTree" class="absolute inset-0 bg-white/10 z-10 cursor-not-allowed"></div>
          <div :class="{ 'opacity-80 blur-sm': !sectionsEnabled.familyTree }">
            <FamilyTreeCreate :model-value="form.family_tree" :main-person-name="form.name"
              :main-person-avatar="form.image" :disabled="!sectionsEnabled.familyTree"
              @update:model-value="handleFamilyTreeUpdate" @update:avatar-files="handleAvatarFilesUpdate" />
          </div>
        </div>
      </div>

      <!-- Gallery Section -->
      <div class="space-y-4">
        <div class="px-4 md:px-6 lg:px-8 flex items-center justify-between">
          <div class="mx-auto mt-10 md:mt-[7px] w-[760px]">


            <div class="grid grid-cols-[1fr_auto_1fr] items-center">
              <div></div>
              <div class="text-center">
                <span class="badge badge-green">
                  Gallery
                </span>
              </div>
              <div class="flex justify-end items-center space-x-1">
                <Label for="gallery-toggle" class="cursor-pointer">
                  {{ sectionsEnabled.gallery ? 'Active' : 'Disabled' }}
                </Label>
                <Switch id="gallery-toggle" v-model="sectionsEnabled.gallery" />

              </div>
            </div>
          </div>
        </div>
        <div class="relative">
          <div v-if="!sectionsEnabled.gallery" class="absolute inset-0 bg-white/10 z-10 cursor-not-allowed"></div>
          <div :class="{ 'opacity-80 blur-sm': !sectionsEnabled.gallery }">
            <GalleryCreate :disabled="!sectionsEnabled.gallery" @update:gallery-files="handleGalleryUpdate" />
          </div>
        </div>
      </div>

      <!-- Timeline Section -->
      <div class="space-y-4">
        <div class="px-4 md:px-6 lg:px-8 flex items-center justify-between">
          <div class="mx-auto mt-10 md:mt-[7px] w-[760px]">


            <div class="grid grid-cols-[1fr_auto_1fr] items-center">
              <div></div>
              <div class="text-center">
                <span class="badge badge-green">
                  Timeline
                </span>
              </div>
              <div class="flex justify-end items-center space-x-1">
                <Label for="timeline-toggle" class="cursor-pointer">
                  {{ sectionsEnabled.timeline ? 'Active' : 'Disabled' }}
                </Label>
                <Switch id="timeline-toggle" v-model="sectionsEnabled.timeline" />

              </div>
            </div>
          </div>
        </div>
        <div class="relative transition-all duration-300"
          :class="sectionsEnabled.timeline ? 'h-auto' : 'h-[490px] overflow-hidden'">
          <div v-if="!sectionsEnabled.timeline" class="absolute inset-0 bg-white/10 z-10 cursor-not-allowed"></div>
          <div :class="{ 'opacity-70 blur-sm': !sectionsEnabled.timeline }">
            <TimelineCreate v-model="form.timeline" :birth-date="form.birth_date" :death-date="form.death_date"
              :disabled="!sectionsEnabled.timeline" />
          </div>
        </div>
      </div>

      <!-- Features Section -->
      <div class="space-y-4">
        <!-- <div class="px-4 md:px-6 lg:px-8 flex items-center justify-between">
          <div class="mx-auto mt-10 md:mt-[7px] max-w-3xl">
            <div class="grid grid-cols-3 items-center">
              <div></div>
              <div class="text-center">
                <span class="badge badge-green">
                  Memories
                </span>
              </div>
              <div class="flex justify-end items-center space-x-1 pr-40">
                <Switch id="features-toggle" v-model="sectionsEnabled.features" />
                <Label for="features-toggle" class="cursor-pointer">
                  {{ sectionsEnabled.features ? 'Активно' : 'Отключено' }}
                </Label>
              </div>
            </div>
          </div>
        </div> -->
        <div class="relative">
          <div v-if="!sectionsEnabled.features" class="absolute inset-0 bg-black/50 z-10 cursor-not-allowed"></div>
          <div :class="{ 'opacity-50 blur-sm': !sectionsEnabled.features }">
            <FeaturesCreate v-model:characteristics="form.characteristics" v-model:hobbies="form.hobbies"
              v-model:custom-traits="form.customTraits" v-model:additional-hobbies="form.additionalHobbies"
              v-model:retirement="form.retirement" v-model:habits="form.habits" v-model:stories="form.stories"
              v-model:wisdom="form.wisdom" :disabled="!sectionsEnabled.features" />
          </div>
        </div>
      </div>

      <!-- Burial Location Section -->
      <div class="space-y-4">
        <div class="px-4 md:px-6 lg:px-8 flex items-center justify-between">
          <div class="mx-auto mt-10 md:mt-[7px] w-[760px]">


            <div class="grid grid-cols-[1fr_auto_1fr] items-center">
              <!-- Левая пустая колонка -->
              <div></div>
              <!-- Центр -->
              <div class="text-center">
                <span class="badge badge-green">
                  Burial Location
                </span>
              </div>

              <!-- Правая часть -->
              <div class="flex justify-end items-center space-x-1">
                <Label for="burial-location-toggle" class="cursor-pointer">
                  {{ sectionsEnabled.burialLocation ? 'Active' : 'Disabled' }}
                </Label>
                <Switch id="burial-location-toggle" v-model="sectionsEnabled.burialLocation" />

              </div>
            </div>
          </div>
        </div>
        <div class="relative transition-all duration-300"
          :class="sectionsEnabled.burialLocation ? 'h-auto' : 'h-[275px] overflow-hidden'">
          <div v-if="!sectionsEnabled.burialLocation" class="absolute inset-0 bg-white/10 z-10 cursor-not-allowed">
          </div>
          <div :class="{ 'opacity-80 blur-sm': !sectionsEnabled.burialLocation }">
            <BurialLocationCreate v-model:grave-location="form.grave_location" v-model:grave-parcel="form.graveParcel"
              v-model:grave-line="form.graveLine" v-model:grave-number="form.graveNumber"
              v-model:coordinates="form.coordinates" v-model:grave-photo="form.gravePhoto"
              :disabled="!sectionsEnabled.burialLocation" />
          </div>
        </div>
      </div>

      <div class="text-center space-y-5 mx-auto mt-5 md:mt-[10px]">
        <div v-if="uploadingPhotos" class="text-center text-sm text-gray-500 mt-2">
          <!-- Uploading photos: {{ uploadProgress.current }} / {{ uploadProgress.total }} -->
        </div>
        <Button type="submit"
          class="items-center gap-2 cursor-pointer bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
          :disabled="form.processing || uploadingPhotos">
          <Loader2 v-if="form.processing || uploadingPhotos" class="w-4 h-4 mr-2 animate-spin" />
          {{ uploadingPhotos ? `Uploading photos ${uploadProgress.current}/${uploadProgress.total}` : form.processing
            ? 'Saving' : 'Save Memorial' }}
        </Button>
      </div>

      <Toaster class="pointer-events-auto" position="top-center" />
    </form>
  </div>
</template>