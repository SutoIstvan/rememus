<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

// Подкомпоненты
import HeaderCreate from '@/components/memorial/Header/Create.vue'
import FamilyTreeCreate from '@/components/memorial/FamilyTree/Create.vue'
import { Button } from '@/components/ui/button'
import { store as memorialsStore } from '@/routes/memorials'

// Храним File объекты аватаров отдельно
const avatarFiles = ref<Map<string, File>>(new Map())

// форма
const form = useForm({
  name: '',
  birth_date: '',
  death_date: '',
  grave_location: '',
  image: null as File | null,
  background_image: null as File | null,
  family_tree: [],
  gallery: [],
  timeline: [],
})

const submit = () => {
  // Создаём FormData вручную
  const formData = new FormData()
  
  // Добавляем основные поля
  formData.append('name', form.name)
  formData.append('birth_date', form.birth_date)
  formData.append('death_date', form.death_date)
  formData.append('grave_location', form.grave_location)
  
  // Добавляем изображения
  if (form.image) {
    formData.append('image', form.image)
  }
  if (form.background_image) {
    formData.append('background_image', form.background_image)
  }
  
  // Добавляем family_tree данные
  form.family_tree.forEach((member, index) => {
    formData.append(`family_tree[${index}][id]`, member.id)
    formData.append(`family_tree[${index}][name]`, member.name)
    formData.append(`family_tree[${index}][role]`, member.role)
    formData.append(`family_tree[${index}][qr_code]`, member.qr_code || '')
    
    // ИСПРАВЛЕНО: конвертируем position в JSON строку
    if (member.position) {
      formData.append(`family_tree[${index}][position]`, JSON.stringify(member.position))
    }
    
    // ИСПРАВЛЕНО: добавляем файл аватара напрямую из Map
    const avatarFile = avatarFiles.value.get(member.id)
    if (avatarFile) {
      formData.append(`family_tree[${index}][avatar]`, avatarFile, avatarFile.name)
    }
  })
  
  // Отправляем через обычный POST, а не через form.post
  form.transform(() => formData).post(memorialsStore(), {
    forceFormData: true,
    preserveScroll: true,
    onSuccess: () => {
      console.log('Сохранено!')
      form.reset()
      avatarFiles.value.clear()
    },
    onError: (errors) => {
      console.error('Ошибки валидации:', errors)
    }
  })
}

const handleAvatarFilesUpdate = (files: Map<string, File>) => {
  avatarFiles.value = files
}
</script>

<template>
  <div class="bg-white dark:bg-black min-h-screen">
    <form @submit.prevent="submit" class="space-y-8">
      <!-- Главная информация -->
      <HeaderCreate
        v-model:name="form.name"
        v-model:birth_date="form.birth_date"
        v-model:death_date="form.death_date"
        v-model:grave_location="form.grave_location"
        v-model:image="form.image"
        v-model:background_image="form.background_image"
        :errors="form.errors"
      />

      <!-- Семейное дерево -->
      <FamilyTreeCreate 
        v-model="form.family_tree" 
        @update:avatar-files="handleAvatarFilesUpdate"
      />

      <!-- Кнопка сохранения -->
      <div class="mt-8 px-4 md:px-6 lg:px-8 pb-12">
        <Button type="submit" class="w-full" :disabled="form.processing">
          {{ form.processing ? 'Сохранение...' : 'Сохранить мемориал' }}
        </Button>
      </div>
    </form>
  </div>
</template>