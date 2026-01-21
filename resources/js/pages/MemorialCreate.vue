<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import { toast } from "vue-sonner"
import { Toaster } from '@/components/ui/sonner'
import 'vue-sonner/style.css'

// Подкомпоненты
import HeaderCreate from '@/components/memorial/Header/Create.vue'
import FamilyTreeCreate from '@/components/memorial/FamilyTree/Create.vue'
import GalleryCreate from '@/components/memorial/Gallery/Create.vue'
import TimelineCreate from '@/components/memorial/TimeLine/Create.vue'
import FeaturesCreate from '@/components/memorial/Features/Create.vue'

import { Button } from '@/components/ui/button'
import { store as memorialsStore } from '@/routes/memorials'

// Храним File объекты аватаров отдельно
const avatarFiles = ref<Map<string, File>>(new Map())

// Форма
const form = useForm({
  name: '',
  birth_date: '',
  death_date: '',
  grave_location: '',
  image: null as File | null,
  background_image: null as File | null,

  family_tree: [],
  gallery: [] as File[],
  timeline: [],

  // FEATURES
  characteristics: [] as string[],
  customTraits: '',
  hobbies: [] as string[],
  additionalHobbies: '',
  retirement: '',
  habits: '',
  stories: '',
  wisdom: '',
})

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

const submit = () => {
  const formData = new FormData()

  // Основные поля
  formData.append('name', form.name)
  formData.append('birth_date', form.birth_date)
  formData.append('death_date', form.death_date)
  formData.append('grave_location', form.grave_location)

  // Изображения
  if (form.image) {
    formData.append('image', form.image)
  }
  if (form.background_image) {
    formData.append('background_image', form.background_image)
  }

  // Галерея
  if (form.gallery.length > 0) {
    form.gallery.forEach((file, index) => {
      formData.append(`gallery[${index}]`, file)
    })
  }

  // Семейное дерево (без main_person)
  const familyTreeWithoutMainPerson = form.family_tree.filter(
    (member: any) => member.role !== 'main_person' && member.name
  )

  familyTreeWithoutMainPerson.forEach((member: any, index: number) => {
    formData.append(`family_tree[${index}][id]`, member.id)
    formData.append(`family_tree[${index}][name]`, member.name || '')
    formData.append(`family_tree[${index}][role]`, member.role)
    formData.append(`family_tree[${index}][qr_code]`, member.qr_code || '')

    if (member.position) {
      formData.append(
        `family_tree[${index}][position]`,
        JSON.stringify(member.position)
      )
    }

    const avatarFile = avatarFiles.value.get(member.id)
    if (avatarFile && member.id !== 'you') {
      formData.append(
        `family_tree[${index}][avatar]`,
        avatarFile,
        avatarFile.name
      )
    }
  })

  // TIMELINE
  if (form.timeline.length > 0) {
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

  // 🔥 FEATURES - ПРАВИЛЬНАЯ ОТПРАВКА МАССИВОВ
  
  // Characteristics - отправляем каждый элемент массива
  if (form.characteristics && form.characteristics.length > 0) {
    form.characteristics.forEach((char, index) => {
      formData.append(`characteristics[${index}]`, char)
    })
  } else {
    // Если массив пустой, отправляем пустой массив
    formData.append('characteristics', JSON.stringify([]))
  }

  // Hobbies - отправляем каждый элемент массива
  if (form.hobbies && form.hobbies.length > 0) {
    form.hobbies.forEach((hobby, index) => {
      formData.append(`hobbies[${index}]`, hobby)
    })
  } else {
    // Если массив пустой, отправляем пустой массив
    formData.append('hobbies', JSON.stringify([]))
  }

  // Текстовые поля (конвертируем из camelCase в snake_case для Laravel)
  formData.append('custom_traits', form.customTraits || '')
  formData.append('additional_hobbies', form.additionalHobbies || '')
  formData.append('retirement', form.retirement || '')
  formData.append('habits', form.habits || '')
  formData.append('stories', form.stories || '')
  formData.append('wisdom', form.wisdom || '')

  // 🔍 ОТЛАДКА: Проверяем что попало в FormData
  console.log('=== FORMDATA CONTENTS ===')
  for (let pair of formData.entries()) {
    console.log(pair[0], '=', pair[1])
  }
  console.log('=========================')

  form.transform(() => formData).post(memorialsStore(), {
    forceFormData: true,
    preserveScroll: true,
    onSuccess: () => {
      toast.success('Memorial saved')
      form.reset()
      avatarFiles.value.clear()
    },
    onError: (errors) => {
      console.error('=== SUBMIT ERRORS ===', errors)
      const errorMessages = Object.values(errors).join('\n')
      toast.error(errorMessages || 'Unknown error', { duration: 8000 })
    }
  })
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
  <div class="bg-white dark:bg-black min-h-screen">
    <form @submit.prevent="submit" class="space-y-8">

      <HeaderCreate
        v-model:name="form.name"
        v-model:birth_date="form.birth_date"
        v-model:death_date="form.death_date"
        v-model:grave_location="form.grave_location"
        v-model:image="form.image"
        v-model:background_image="form.background_image"
        :errors="form.errors"
      />

      <FamilyTreeCreate
        :model-value="form.family_tree"
        :main-person-name="form.name"
        :main-person-avatar="form.image"
        @update:model-value="handleFamilyTreeUpdate"
        @update:avatar-files="handleAvatarFilesUpdate"
      />

      <GalleryCreate @update:gallery-files="handleGalleryUpdate" />

      <TimelineCreate
        v-model="form.timeline"
        :birth-date="form.birth_date"
        :death-date="form.death_date"
      />

      <FeaturesCreate
        v-model:characteristics="form.characteristics"
        v-model:hobbies="form.hobbies"
        v-model:custom-traits="form.customTraits"
        v-model:additional-hobbies="form.additionalHobbies"
        v-model:retirement="form.retirement"
        v-model:habits="form.habits"
        v-model:stories="form.stories"
        v-model:wisdom="form.wisdom"
      />

      <div class="mt-8 px-4 md:px-6 lg:px-8 pb-12">
        <Button type="submit" class="w-full" :disabled="form.processing">
          {{ form.processing ? 'Сохранение...' : 'Сохранить мемориал' }}
        </Button>
      </div>

      <Toaster class="pointer-events-auto" position="top-center" />
    </form>
  </div>
</template>