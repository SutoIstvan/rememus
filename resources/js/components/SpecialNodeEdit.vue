<script setup lang="ts">
import { ref, watch } from 'vue'
import { Handle, Position } from '@vue-flow/core'

// props с типами
const props = defineProps<{ 
  data: { 
    label: string, 
    avatar?: string,
    isAddButton?: boolean,
    addType?: string
  } 
}>()

// Лейбл
const label = ref(props.data.label)
watch(label, (newVal) => {
  props.data.label = newVal // обновляем данные узла
})

// QR код
const code = ref('')

// Аватар
const avatarPreview = ref(props.data.avatar || null)

function onFileChange(event: Event) {
  const file = (event.target as HTMLInputElement).files?.[0]
  if (!file) return

  const reader = new FileReader()
  reader.onload = (e) => {
    avatarPreview.value = e.target?.result as string
    props.data.avatar = avatarPreview.value
  }
  reader.readAsDataURL(file)
}
</script>

<template>
  <!-- Кнопка добавления -->
  <div v-if="props.data.isAddButton" class="add-button-node">
    <div class="add-button-content">
      <div class="add-icon">+</div>
      <div class="add-text">{{ props.data.label }}</div>
    </div>
  </div>

  <!-- Обычная карточка семьи -->
  <div v-else class="node-with-avatar">
    <!-- Handles для всех позиций -->
    <Handle type="target" :position="Position.Top" id="target-top" />
    <Handle type="source" :position="Position.Top" id="source-top" />
    <Handle type="target" :position="Position.Left" id="target-left" />
    <Handle type="source" :position="Position.Left" id="source-left" />
    <Handle type="target" :position="Position.Right" id="target-right" />
    <Handle type="source" :position="Position.Right" id="source-right" />
    <Handle type="target" :position="Position.Bottom" id="target-bottom" />
    <Handle type="source" :position="Position.Bottom" id="source-bottom" />

    <!-- Аватарка -->
    <img v-if="avatarPreview" :src="avatarPreview" alt="avatar" class="avatar" />
    
    <!-- Загрузка аватара если его нет -->
    <div v-else class="avatar-placeholder">
      <input 
        type="file" 
        @change="onFileChange" 
        accept="image/*"
        class="avatar-input"
        :id="`avatar-upload-${props.id}`"
      />
      <label :for="`avatar-upload-${props.id}`" class="avatar-label">📷</label>
    </div>

    <!-- Метка -->
    <input 
      type="text" 
      v-model="label" 
      class="label-input mt-1"
      placeholder="Enter name"
    />

    <input 
      type="text" 
      v-model="code" 
      class="label-input mt-1"
      placeholder="Enter qr code"
    />    
  </div>
</template>

<style scoped>
/* Стили для кнопки добавления */
.add-button-node {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 90px;
  height: 105px;
  border: 2px dashed #28a745;
  border-radius: 8px;
  background: #f8f9fa;
  cursor: pointer;
  transition: all 0.2s ease;
}

.add-button-node:hover {
  background: #e9f7ef;
  border-color: #20c938;
}

.add-button-content {
  text-align: center;
  color: #28a745;
}

.add-icon {
  font-size: 32px;
  font-weight: bold;
  margin-bottom: 4px;
}

.add-text {
  font-size: 10px;
  font-weight: 500;
  line-height: 1.2;
}

/* Стили для карточки с аватаркой */
.node-with-avatar {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  position: relative;
  border-radius: 4px;
  padding: 6px;
  min-width: 80px;
  min-height: 115px;
  width: 90px;
  border: 1px solid #e0e0e0;
  cursor: default !important;
  background: white;
}

.label-input {
  width: 100%;
  font-size: 11px;
  text-align: center;
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 1px 2px 0px 2px;
}

.avatar {
  width: 70px;
  aspect-ratio: 1;
  object-fit: cover;
  border-radius: 50%;
  border: 3px solid white;
  box-shadow: 0rem 0.2rem 0.6rem 0rem rgba(32, 46, 66, 0.103);
}

.avatar-placeholder {
  width: 70px;
  height: 70px;
  border-radius: 50%;
  border: 2px dashed #ccc;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
}

.avatar-input {
  position: absolute;
  opacity: 0;
  width: 100%;
  height: 100%;
  cursor: pointer;
}

.avatar-label {
  font-size: 24px;
  cursor: pointer;
}

/* Стили для handles */
.vue-flow__handle {
  width: 0 !important;
  height: 0 !important;
  opacity: 0 !important;
  pointer-events: none !important;
}

.node-with-avatar:hover .vue-flow__handle {
  opacity: 1;
  width: 8px !important;
  height: 8px !important;
  background: #555 !important;
  border: 2px solid #fff !important;
}

.vue-flow__handle[data-handlepos="top"] { top: -4px; }
.vue-flow__handle[data-handlepos="bottom"] { bottom: -4px; }
.vue-flow__handle[data-handlepos="left"] { left: -4px; }
.vue-flow__handle[data-handlepos="right"] { right: -4px; }
</style>