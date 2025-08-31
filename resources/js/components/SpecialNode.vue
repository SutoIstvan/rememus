<script setup>
import { computed } from 'vue'
import { Position, Handle } from '@vue-flow/core'

const props = defineProps({
  position: {
    type: Object,
    required: true,
  },
  data: {
    type: Object,
    required: true,
  }
})

const x = computed(() => `${Math.round(props.position.x)}px`)
const y = computed(() => `${Math.round(props.position.y)}px`)
</script>

<template>
  <div class="node-with-avatar">
    <!-- Handles для всех позиций -->
    <!-- Top handles -->
    <Handle type="target" :position="Position.Top" id="target-top" />
    <Handle type="source" :position="Position.Top" id="source-top" />
    
    <!-- Left handles -->
    <Handle type="target" :position="Position.Left" id="target-left" />
    <Handle type="source" :position="Position.Left" id="source-left" />
    
    <!-- Right handles -->
    <Handle type="target" :position="Position.Right" id="target-right" />
    <Handle type="source" :position="Position.Right" id="source-right" />
    
    <!-- Bottom handles -->
    <Handle type="target" :position="Position.Bottom" id="target-bottom" />
    <Handle type="source" :position="Position.Bottom" id="source-bottom" />

    <!-- Аватарка -->
    <img v-if="props.data.avatar" :src="props.data.avatar" alt="avatar" class="avatar" />

    <!-- Метка -->
    <div class="label">{{ props.data.label }}</div>

    <!-- Координаты -->
    <div class="coordinates">
      {{ x }} {{ y }}
    </div>
  </div>
</template>

<style scoped>
.node-with-avatar {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  position: relative;
  /* background: white; */
  /* border: 2px solid #ddd; */
  border-radius: 8px;
  padding: 5px;
  min-width: 80px;
  min-height: 100px;
}

.avatar {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  object-fit: cover;
  margin-bottom: 4px;
  border: 2px solid #666;
}

.label {
  font-size: 12px;
  font-weight: bold;
  text-align: center;
  margin-bottom: 2px;
}

.coordinates {
  font-size: 10px;
  color: #666;
  text-align: center;
}

/* Стили для handles */
.vue-flow__handle {
  background: #555 !important;
  border: 2px solid #fff !important;
  width: 8px !important;
  height: 8px !important;
}

/* Скрываем handles по умолчанию, показываем только при hover */
.vue-flow__handle {
  opacity: 0;
  transition: opacity 0.2s;
}

.node-with-avatar:hover .vue-flow__handle {
  opacity: 1;
}

/* Позиционирование handles */
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