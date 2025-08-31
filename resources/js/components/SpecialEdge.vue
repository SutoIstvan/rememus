<template>
  <g>
    <path
      :id="id"
      class="animated-edge"
      :d="edgePath"
      fill="none"
      stroke="#b1b1b7"
      stroke-width="1"
      :marker-end="markerEnd"
    />
  </g>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import { getBezierPath, EdgeProps } from '@vue-flow/core'
import { Position } from '@vue-flow/core'

const props = defineProps<EdgeProps>()

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


const id = computed(() => props.id)
const markerEnd = computed(() => props.markerEnd)
</script>

<style scoped>
.animated-edge {
  stroke-dasharray: 5;
  animation: dash 1s linear infinite;
}

@keyframes dash {
  to {
    stroke-dashoffset: -10;
  }
}
</style>
