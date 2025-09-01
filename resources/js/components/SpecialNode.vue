<script setup lang="ts">
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
    <!-- <div class="coordinates">
      {{ x }} {{ y }}
    </div> -->
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
  border: 1px solid #cccccc;
  cursor: pointer !important; /* палец-указатель */
}

.avatar {
  width: 70px;
  aspect-ratio: 1;
  object-fit: cover;
  border-radius: 50%;
  border: 3px solid white;
  box-shadow: 0rem 0.2rem 0.6rem 0rem rgba(32, 46, 66, 0.103);
}

.label {
  margin-top: 4px;
  font-size: 12px;
  font-weight: 300;
  text-align: center;
  color: #555;
  height: 33px;              /* фиксированная высота */
  display: flex;             /* делаем flex-контейнер */
  align-items: center;       /* вертикальное выравнивание */
  justify-content: center;   /* горизонтальное выравнивание */
  /* margin-bottom: 2px; */
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
.node-with-avatar:hover {
  border: 1px solid #a7dcff !important; /* голубая рамка */
  background-color: rgba(100, 193, 255, 0.1); /* лёгкая голубая заливка */
}

/* Скрываем визуально, но handles остаются для edge анимации */
.vue-flow__handle {
  width: 0 !important;
  height: 0 !important;
  opacity: 0 !important;
  pointer-events: none !important; /* чтобы не мешали кликам */
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