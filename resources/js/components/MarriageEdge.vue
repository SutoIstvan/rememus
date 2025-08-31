<template>
  <g>
    <path
      :id="id"
      :class="edgeClass"
      :d="edgePath"
      fill="none"
      stroke-width="1"
      :stroke="strokeColor"
      :stroke-dasharray="strokeDashArray"
      :marker-end="markerEnd"
    />
    <!-- Сердечко для супружеских связей -->
    <text
      v-if="props.type === 'marriage'"
      :x="centerX"
      :y="centerY +4"
      text-anchor="middle"
      class="marriage-heart"
      font-size="10"
      fill="#e74c3c"
    >
      ❤️
    </text>
  </g>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import { getBezierPath, getStraightPath, EdgeProps } from '@vue-flow/core'
import { Position } from '@vue-flow/core'

const props = defineProps<EdgeProps>()

const edgeClass = computed(() => {
  if (props.type === 'marriage') return 'marriage-edge'
  if (props.type === 'sibling') return 'sibling-edge'
  return 'animated-edge'
})

const strokeColor = computed(() => {
  if (props.type === 'marriage') return '#e74c3c'
  if (props.type === 'sibling') return '#f39c12'
  return '#b1b1b7'
})

const strokeWidth = computed(() => {
  if (props.type === 'marriage') return '2'
  if (props.type === 'sibling') return '1.5'
  return '1'
})

const strokeDashArray = computed(() => {
  if (props.type === 'marriage') return '8,4'  // Пунктирная линия для супружеских связей
  if (props.type === 'sibling') return '6,3'   // Другой пунктир для сиблингов
  return '5,2'  // Стандартный пунктир для родственных связей
})

const edgePath = computed(() => {
  const {
    sourceX,
    sourceY,
    sourcePosition = Position.Bottom,
    targetX,
    targetY,
    targetPosition = Position.Top,
  } = props

  if (
    typeof sourceX !== 'number' ||
    typeof sourceY !== 'number' ||
    typeof targetX !== 'number' ||
    typeof targetY !== 'number'
  ) {
    return ''
  }

  // Для горизонтальных связей (супружеские, сиблинги) используем прямую линию
  if (props.type === 'marriage' || props.type === 'sibling') {
    const [path] = getStraightPath({
      sourceX,
      sourceY,
      targetX,
      targetY,
    })
    return path
  }

  // Для родительских связей используем изогнутую линию
  const [path] = getBezierPath({
    sourceX,
    sourceY,
    sourcePosition,
    targetX,
    targetY,
    targetPosition,
  })

  return path
})

// Вычисляем центр линии для размещения сердечка
const centerX = computed(() => {
  if (typeof props.sourceX === 'number' && typeof props.targetX === 'number') {
    return (props.sourceX + props.targetX) / 2
  }
  return 0
})

const centerY = computed(() => {
  if (typeof props.sourceY === 'number' && typeof props.targetY === 'number') {
    return (props.sourceY + props.targetY) / 2
  }
  return 0
})

const id = computed(() => props.id)
const markerEnd = computed(() => props.markerEnd)
</script>

<style scoped>
.animated-edge {
  animation: dash 1s linear infinite;
}

.marriage-edge {
  animation: marriage-dash 1.5s linear infinite;
}

.sibling-edge {
  animation: sibling-dash 1.2s linear infinite;
}

/* Анимация для обычных родственных связей */
@keyframes dash {
  to {
    stroke-dashoffset: -7;
  }
}

/* Анимация для супружеских связей (красная, более медленная) */
@keyframes marriage-dash {
  to {
    stroke-dashoffset: -12;
  }
}

/* Анимация для связей между сиблингами (оранжевая, средняя скорость) */
@keyframes sibling-dash {
  to {
    stroke-dashoffset: -9;
  }
}

/* Стиль для сердечка */
.marriage-heart {
  font-weight: bold;
  filter: drop-shadow(1px 1px 1px rgba(0,0,0,0.3));
}
</style>