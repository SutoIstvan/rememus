<script setup lang="ts">

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


const memorialLink = props.data.qr_code ? `/memorial/${props.data.qr_code}` : null
</script>

<template>
  <component :is="memorialLink ? 'a' : 'div'" :href="memorialLink" :target="memorialLink ? '_blank' : undefined"
    class="node-with-avatar" :class="{ 'has-link': memorialLink }">
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

    <!-- Аватарка с QR иконкой -->
    <div class="avatar-wrapper">
      <img v-if="props.data.avatar" :src="props.data.avatar" alt="avatar" class="avatar" />
      <div v-if="props.data.qr_code" class="qr-badge" title="View memorial">
        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="#555"
          stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="2" y="2" width="8" height="8" rx="1" />
          <rect x="14" y="2" width="8" height="8" rx="1" />
          <rect x="2" y="14" width="8" height="8" rx="1" />
          <rect x="14" y="14" width="4" height="4" rx="0.5" />
          <rect x="20" y="14" width="2" height="2" />
          <rect x="14" y="20" width="2" height="2" />
          <rect x="20" y="20" width="2" height="2" />
        </svg>
      </div>
    </div>

    <!-- Метка -->
    <div class="label">{{ props.data.label }}</div>
  </component>
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
  cursor: pointer !important;
  text-decoration: none;
  color: inherit;
}

.node-with-avatar.has-link {
  cursor: pointer !important;
}

.avatar-wrapper {
  position: relative;
  display: inline-block;
}

.avatar {
  width: 70px;
  aspect-ratio: 1;
  object-fit: cover;
  border-radius: 50%;
  border: 3px solid white;
  box-shadow: 0rem 0.2rem 0.6rem 0rem rgba(32, 46, 66, 0.103);
}

.qr-badge {
  position: absolute;
  bottom: 0;
  right: -2px;
  width: 18px;
  height: 18px;
  background: #f0f0f0;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
  border: 2px solid white;
}

.label {
  margin-top: 4px;
  font-size: 12px;
  font-weight: 300;
  text-align: center;
  color: #555;
  height: 33px;
  display: flex;
  align-items: center;
  justify-content: center;
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
  border: 1px solid #a7dcff !important;
  /* голубая рамка */
  background-color: rgba(100, 193, 255, 0.1);
  /* лёгкая голубая заливка */
}

/* Скрываем визуально, но handles остаются для edge анимации */
.vue-flow__handle {
  width: 0 !important;
  height: 0 !important;
  opacity: 0 !important;
  pointer-events: none !important;
  /* чтобы не мешали кликам */
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