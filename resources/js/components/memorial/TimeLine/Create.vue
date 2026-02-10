<script setup lang="ts">
import { ref, watch } from 'vue'
import { Button } from '@/components/ui/button'
import TimelineModal from '../TimeLine/Modal.vue'
import TimelineFeatures from '../TimeLine/Features.vue'

const props = defineProps<{
  modelValue: any[] | null
  birthDate?: string  // ДОБАВЛЕНО
  deathDate?: string
}>()

const emit = defineEmits(['update:modelValue'])

const items = ref<any[]>([])
const modalOpen = ref(false)
const editingItem = ref<any | null>(null)

const normalizeReverse = () => {
  items.value = items.value.map((item, index) => ({
    ...item,
    reverse: index % 2 === 1,
  }))
}

watch(
  () => props.modelValue,
  (val) => {
    items.value = Array.isArray(val) ? [...val] : []
    normalizeReverse()
  },
  { immediate: true }
)

const openCreate = () => {
  editingItem.value = null
  modalOpen.value = true
}

const openEdit = (item: any) => {
  const editItem = { ...item }

  // If there's a media field that's a string (URL), set it as media_preview
  if (editItem.media && typeof editItem.media === 'string') {
    editItem.media_preview = editItem.media
  }

  editingItem.value = editItem
  modalOpen.value = true
}

const saveItem = (item: any) => {
  if (editingItem.value) {
    const index = items.value.findIndex(
      i => i.id === editingItem.value!.id
    )
    if (index !== -1) {
      items.value[index] = item
    }
  } else {
    item.order = items.value.length
    items.value.push(item)
  }

  normalizeReverse()
  editingItem.value = null
  emit('update:modelValue', items.value)
}

const removeItem = (id: string) => {
  items.value = items.value.filter(i => i.id !== id)
  normalizeReverse()
  emit('update:modelValue', items.value)
}
</script>

<template>
  <section class="px-4 md:px-6 lg:px-8">
    <div class="text-center space-y-5 mx-auto mt-1 md:mt-[10px]">
      <!-- <span class="badge badge-green">
        Timeline
      </span> -->

      <p class="text-muted-foreground max-w-xl mx-auto">
        The timeline allows you to record key life events, including education, family milestones, professional
        life, and other significant moments.
      </p>

    </div>
    <div class="text-center space-y-5 mx-auto mt-5 md:mt-[10px]">

      <Button type="button" @click="openCreate"
        class="items-center gap-2 cursor-pointer bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
        Add Event
      </Button>
    </div>

    <TimelineFeatures :features="items" @edit="openEdit" @remove="removeItem" />

    <TimelineModal :open="modalOpen" :item="editingItem" :birth-date="birthDate" :death-date="deathDate"
      @close="modalOpen = false" @save="saveItem" />
  </section>
</template>