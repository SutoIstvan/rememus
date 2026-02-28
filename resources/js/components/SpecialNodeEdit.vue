<script setup lang="ts">
import { ref, watch } from 'vue'
import { Handle, Position } from '@vue-flow/core'

// props с типами
const props = defineProps<{
  id: string,
  data: {
    label: string,
    avatar?: string,
    qr_code?: string,
    isAddButton?: boolean,
    addType?: string,
    isMainPerson?: boolean // НОВОЕ: флаг главного персонажа
  }
}>()

// emit для обновления данных
const emit = defineEmits(['update-node-data'])

// Лейбл
const label = ref(props.data.label)
console.log(`SpecialNodeEdit (${props.id}) initialized with label:`, props.data.label)
if (props.id === 'you') {
  console.log(`SpecialNodeEdit (you) avatar prop:`, props.data.avatar)
}

watch(label, (newVal) => {
  // ИСПРАВЛЕНО: не отправляем изменения для главного персонажа
  if (!props.data.isMainPerson) {
    emit('update-node-data', props.id, 'label', newVal)
  }
})

// Синхронизация label с props (для главного персонажа)
watch(() => props.data.label, (newVal) => {
  console.log(`SpecialNodeEdit (${props.id}) prop label changed to:`, newVal)
  label.value = newVal
})

// QR код
const code = ref(props.data.qr_code || '')
watch(code, (newVal) => {
  emit('update-node-data', props.id, 'qr_code', newVal)
})

// Аватар - теперь храним File объект отдельно
const avatarPreview = ref<string | null | undefined>(props.data.avatar || null)
const avatarFile = ref<File | null>(null)

// Синхронизация аватара с props (для главного персонажа)
watch(() => props.data.avatar, (newVal) => {
  console.log(`SpecialNodeEdit (${props.id}) avatar watcher fired:`, newVal)
  avatarPreview.value = newVal
})

function onFileChange(event: Event) {
  // ИСПРАВЛЕНО: блокируем для главного персонажа
  if (props.data.isMainPerson) return

  const file = (event.target as HTMLInputElement).files?.[0]
  if (!file) return

  // Создаём превью через URL.createObjectURL
  avatarPreview.value = URL.createObjectURL(file)

  // Сохраняем File объект
  avatarFile.value = file

  // Отправляем File в родительский компонент
  emit('update-node-data', props.id, 'avatar', file)
}

function clearAvatar() {
  avatarPreview.value = null
  avatarFile.value = null
  emit('update-node-data', props.id, 'avatar', null)
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
  <div v-else class="node-with-avatar" :class="{ 'main-person': props.data.isMainPerson }">
    <!-- Visual Debug for Avatar URL -->
    <!-- <div v-if="props.data.isMainPerson"
      style="position: absolute; top: -20px; font-size: 8px; color: red; background: white; z-index: 100;">
      {{ props.data.avatar }}
    </div> -->

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
    <div class="avatar-container">
      <div v-if="avatarPreview" class="avatar-wrapper">
        <img :src="avatarPreview" alt="avatar" class="avatar"
          :id="props.data.isMainPerson ? `avatar-upload-${props.id}` : undefined" />
        <!-- Кнопка удаления аватара (только для членов семьи, не главного) -->
        <button v-if="!props.data.isMainPerson" class="avatar-clear-btn" @click.stop="clearAvatar" title="Delete">
          <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="3 6 5 6 21 6" />
            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
            <path d="M10 11v6" />
            <path d="M14 11v6" />
            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
          </svg>
        </button>
      </div>

      <!-- Загрузка аватара если его нет -->
      <div v-else class="avatar-placeholder">
        <input type="file" @change="onFileChange" accept="image/*" class="avatar-input"
          :id="`avatar-upload-${props.id}`" :disabled="props.data.isMainPerson" />
        <label :for="`avatar-upload-${props.id}`" class="avatar-label" :class="{ 'disabled': props.data.isMainPerson }">

          <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 24 24" fill="none">
            <path
              d="M7 11C8.10457 11 9 10.1046 9 9C9 7.89543 8.10457 7 7 7C5.89543 7 5 7.89543 5 9C5 10.1046 5.89543 11 7 11Z"
              stroke="#dbdbdb" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M5.56055 21C11.1305 11.1 15.7605 9.35991 21.0005 15.7899" stroke="#dbdbdb" stroke-width="1.5"
              stroke-linecap="round" stroke-linejoin="round" />
            <path
              d="M12.28 3H5C3.93913 3 2.92172 3.42136 2.17157 4.17151C1.42142 4.92165 1 5.93913 1 7V17C1 18.0609 1.42142 19.0782 2.17157 19.8284C2.92172 20.5785 3.93913 21 5 21H17C18.0609 21 19.0783 20.5785 19.8284 19.8284C20.5786 19.0782 21 18.0609 21 17V12"
              stroke="#dbdbdb" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M18.75 8.82996V0.829956" stroke="#dbdbdb" stroke-width="1.5" stroke-linecap="round"
              stroke-linejoin="round" />
            <path d="M15.5508 4.02996L18.7508 0.829956L21.9508 4.02996" stroke="#dbdbdb" stroke-width="1.5"
              stroke-linecap="round" stroke-linejoin="round" />
          </svg>

        </label>
      </div>

      <!-- Бейдж "Главный" -->
      <!-- <div v-if="props.data.isMainPerson" class="main-badge">Главный</div> -->
    </div>

    <!-- Метка -->
    <input type="text" v-model="label" class="label-input mt-2" placeholder="Name" :readonly="props.data.isMainPerson"
      :disabled="props.data.isMainPerson" :class="{ 'readonly': props.data.isMainPerson }" />

    <input type="text" v-model="code" class="label-input mt-1" placeholder="Qr Code" :readonly="props.data.isMainPerson"
      :disabled="props.data.isMainPerson" :class="{ 'readonly': props.data.isMainPerson }" />
  </div>
</template>

<style scoped>
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

/* НОВОЕ: Стили для главного персонажа */
.node-with-avatar.main-person {
  border: 1px solid #7da30237;
  box-shadow: #73e7391c 0px 0px 0px 3px;
  border-radius: 5px;
  background: #ffffff;
}

.avatar-container {
  position: relative;
  width: 70px;
}

/* НОВОЕ: Бейдж "Главный" */
.main-badge {
  position: absolute;
  top: -8px;
  right: -8px;
  background: #4CAF50;
  color: white;
  font-size: 8px;
  padding: 2px 6px;
  border-radius: 10px;
  font-weight: bold;
  z-index: 10;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.label-input {
  width: 100%;
  font-size: 11px;
  border: 1px solid #dbdbdb;
  border-radius: 2px;
  padding: 1px 2px 0px 2px;
}

/* НОВОЕ: Стили для readonly инпута */
.label-input.readonly {
  background: #f5f5f5;
  cursor: not-allowed;
  color: #666;
  border-color: #ddd;
}

.avatar-wrapper {
  position: relative;
  width: 70px;
  height: 70px;
}

.avatar {
  width: 70px;
  aspect-ratio: 1;
  object-fit: cover;
  border-radius: 50%;
  border: 3px solid white;
  box-shadow: 0rem 0.2rem 0.6rem 0rem rgba(32, 46, 66, 0.103);
}

.avatar-clear-btn {
  position: absolute;
  top: 0;
  right: 0;
  width: 18px;
  height: 18px;
  border-radius: 50%;
  background: rgba(220, 53, 69, 0.85);
  color: white;
  border: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0;
  z-index: 10;
  transition: background 0.2s;
}

.avatar-clear-btn:hover {
  background: rgba(180, 30, 45, 1);
}

.avatar-placeholder {
  width: 70px;
  height: 70px;
  border-radius: 50%;
  border: 1.4px dashed #dbdbdb;
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

/* НОВОЕ: Отключенная загрузка для главного персонажа */
.avatar-label.disabled {
  cursor: not-allowed;
  opacity: 0.5;
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

.vue-flow__handle[data-handlepos="top"] {
  top: -4px;
}

.vue-flow__handle[data-handlepos="bottom"] {
  bottom: -4px;
}

.vue-flow__handle[data-handlepos="left"] {
  left: -4px;
}

.vue-flow__handle[data-handlepos="right"] {
  right: -4px;
}
</style>