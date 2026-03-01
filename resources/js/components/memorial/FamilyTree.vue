<script setup lang="ts">
import { ref, computed } from 'vue'
import { VueFlow } from '@vue-flow/core'
import { markRaw } from 'vue'
import { Position } from '@vue-flow/core'

import SpecialNode from '@/components/SpecialNode.vue'
import SpecialEdge from '@/components/SpecialEdge.vue'
import MarriageEdge from '@/components/MarriageEdge.vue'
import BlurReveal from '@/components/ui/blur-reveal/BlurReveal.vue'

const props = defineProps({
  familyData: {
    type: Array,
    default: () => []
  },
  memorial: {
    type: Object,
    default: () => ({})
  }
})

const edgeTypes = {
  special: markRaw(SpecialEdge),
  marriage: markRaw(MarriageEdge),
}

// Role → node ID mapping (same as Edit.vue)
const roleToNodeId: Record<string, string> = {
  father: 'dad',
  mother: 'mom',
  grandfather_paternal: 'grandpa_dad',
  grandmother_paternal: 'grandma_dad',
  grandfather_maternal: 'grandpa_mom',
  grandmother_maternal: 'grandma_mom',
  spouse: 'wife',
  child: 'child',
  sibling: 'brother',
  other: 'other',
}

// Fixed positions for each node (same as Edit.vue layout)
const nodePositions: Record<string, { x: number; y: number }> = {
  grandpa_dad: { x: 75, y: 8 },
  grandma_dad: { x: 200, y: 8 },
  grandpa_mom: { x: 330, y: 8 },
  grandma_mom: { x: 460, y: 8 },
  dad: { x: 190, y: 170 },
  mom: { x: 345, y: 170 },
  you: { x: 265, y: 331 },
  wife: { x: 135, y: 331 },
  brother: { x: 375, y: 331 },
  child: { x: 245, y: 490 },
  other: { x: 100, y: 650 },
}

const nodeStyle = { width: '90px', height: '105px', padding: '5px' }

// Helper to resolve avatar URL
function resolveAvatar(avatar: string | null): string {
  if (!avatar) return ''
  if (avatar.startsWith('http') || avatar.startsWith('/storage') || avatar.startsWith('data:')) return avatar
  return `/storage/${avatar}`
}

// Build nodes dynamically from DB data
const nodes = computed(() => {
  const familyMembers = props.familyData as any[]
  const result: any[] = []
  const nodeIds = new Set<string>()

  // Always add the main person ('you') node
  const mainPhoto = props.memorial?.photo
    ? (props.memorial.photo.startsWith('http') || props.memorial.photo.startsWith('/storage')
      ? props.memorial.photo
      : `/storage/${props.memorial.photo}`)
    : ''

  result.push({
    id: 'you',
    position: { ...nodePositions.you },
    style: { ...nodeStyle },
    data: {
      label: props.memorial?.name || '',
      avatar: mainPhoto,
    }
  })
  nodeIds.add('you')

  // Track counters for dynamic nodes (siblings, children, spouses, others)
  let siblingIndex = 0
  let childIndex = 0
  let spouseIndex = 0
  let otherIndex = 0

  familyMembers.forEach((member: any) => {
    const role = member.role
    const baseNodeId = roleToNodeId[role]
    if (!baseNodeId) return

    let nodeId: string
    let position: { x: number; y: number }

    // Roles with fixed single nodes
    if (['dad', 'mom', 'grandpa_dad', 'grandma_dad', 'grandpa_mom', 'grandma_mom'].includes(baseNodeId)) {
      nodeId = baseNodeId
      position = { ...nodePositions[baseNodeId] }
    }
    // Dynamic roles: use saved position or calculate offset
    else if (baseNodeId === 'brother') {
      nodeId = member.node_id || (siblingIndex === 0 ? 'brother' : `brother-${siblingIndex}`)
      position = member.position || { x: 375 + siblingIndex * 110, y: 331 }
      siblingIndex++
    } else if (baseNodeId === 'child') {
      nodeId = member.node_id || (childIndex === 0 ? 'child' : `child-${childIndex}`)
      position = member.position || { x: 245 - childIndex * 110, y: 490 }
      childIndex++
    } else if (baseNodeId === 'wife') {
      nodeId = member.node_id || (spouseIndex === 0 ? 'wife' : `wife-${spouseIndex}`)
      position = member.position || { x: 135 - spouseIndex * 110, y: 331 }
      spouseIndex++
    } else if (baseNodeId === 'other') {
      nodeId = member.node_id || `other-${otherIndex}`
      position = member.position || { x: 100 + otherIndex * 110, y: 650 }
      otherIndex++
    } else {
      return
    }

    result.push({
      id: nodeId,
      position,
      style: { ...nodeStyle },
      data: {
        label: member.name || '',
        avatar: resolveAvatar(member.avatar),
        qr_code: member.qr_code || '',
      }
    })
    nodeIds.add(nodeId)
  })

  return result
})

// Set of existing node IDs for edge filtering
const existingNodeIds = computed(() => new Set(nodes.value.map((n: any) => n.id)))

// All possible edges — filtered to only include edges where both source and target exist
const edges = computed(() => {
  const ids = existingNodeIds.value

  // Build all potential edges
  const allEdges: any[] = []

  // Parents → you
  allEdges.push(
    { id: 'mom-you', source: 'mom', target: 'you', type: 'special', sourcePosition: Position.Bottom, targetPosition: Position.Top, sourceHandle: 'source-bottom', targetHandle: 'target-top' },
    { id: 'dad-you', source: 'dad', target: 'you', type: 'special', sourcePosition: Position.Bottom, targetPosition: Position.Top, sourceHandle: 'source-bottom', targetHandle: 'target-top' },
  )

  // Grandparents → mom
  allEdges.push(
    { id: 'grandma_mom-mom', source: 'grandma_mom', target: 'mom', type: 'special', sourcePosition: Position.Bottom, targetPosition: Position.Top, sourceHandle: 'source-bottom', targetHandle: 'target-top' },
    { id: 'grandpa_mom-mom', source: 'grandpa_mom', target: 'mom', type: 'special', sourcePosition: Position.Bottom, targetPosition: Position.Top, sourceHandle: 'source-bottom', targetHandle: 'target-top' },
  )

  // Grandparents → dad
  allEdges.push(
    { id: 'grandma_dad-dad', source: 'grandma_dad', target: 'dad', type: 'special', sourcePosition: Position.Bottom, targetPosition: Position.Top, sourceHandle: 'source-bottom', targetHandle: 'target-top' },
    { id: 'grandpa_dad-dad', source: 'grandpa_dad', target: 'dad', type: 'special', sourcePosition: Position.Bottom, targetPosition: Position.Top, sourceHandle: 'source-bottom', targetHandle: 'target-top' },
  )

  // Spouses (marriage edges: you → each spouse)
  nodes.value.forEach((n: any) => {
    if (n.id === 'wife' || n.id.startsWith('wife-')) {
      allEdges.push({
        id: `you-${n.id}`, source: 'you', target: n.id, type: 'marriage',
        sourcePosition: Position.Left, targetPosition: Position.Right,
        sourceHandle: 'source-left', targetHandle: 'target-right'
      })
    }
  })

  // Children (you → each child)
  nodes.value.forEach((n: any) => {
    if (n.id === 'child' || n.id.startsWith('child-') || n.id.startsWith('child')) {
      if (n.id === 'you') return
      // Check role-based: node IDs starting with 'child'
      const isChild = n.id === 'child' || n.id.startsWith('child-') || n.id.startsWith('child')
      // Avoid matching 'you' or other nodes
      const familyMember = (props.familyData as any[]).find((m: any) => (m.node_id === n.id || roleToNodeId[m.role] === 'child'))
      if (familyMember?.role === 'child' || n.id === 'child' || n.id.startsWith('child-')) {
        allEdges.push({
          id: `you-${n.id}`, source: 'you', target: n.id, type: 'special',
          sourcePosition: Position.Bottom, targetPosition: Position.Top,
          sourceHandle: 'source-bottom', targetHandle: 'target-top'
        })
      }
    }
  })

  // Siblings (mom → each sibling)
  nodes.value.forEach((n: any) => {
    if (n.id === 'brother' || n.id.startsWith('brother-')) {
      allEdges.push({
        id: `mom-${n.id}`, source: 'mom', target: n.id, type: 'special',
        sourcePosition: Position.Bottom, targetPosition: Position.Top,
        sourceHandle: 'source-bottom', targetHandle: 'target-top'
      })
    }
  })

  // Filter: only include edges where both source and target nodes exist
  return allEdges.filter(e => ids.has(e.source) && ids.has(e.target))
})

// Animation directive
const vScrollAnimate = {
  mounted(el: any, binding: any) {
    const { delay = 0, direction = 'up', offset = 100 } = binding.value || {}
    el.style.opacity = '0'
    el.style.transition = 'all 0.6s ease-out'
    switch (direction) {
      case 'up': el.style.transform = 'translateY(30px)'; break
      case 'down': el.style.transform = 'translateY(-30px)'; break
      case 'left': el.style.transform = 'translateX(-30px)'; break
      case 'right': el.style.transform = 'translateX(30px)'; break
    }
    if (delay > 0) el.style.transitionDelay = `${delay}ms`
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            setTimeout(() => {
              ; (entry.target as HTMLElement).style.opacity = '1'
                ; (entry.target as HTMLElement).style.transform = 'translate(0, 0)'
            }, delay)
            observer.unobserve(entry.target)
          }
        })
      },
      { root: null, rootMargin: `0px 0px -${offset}px 0px`, threshold: 0.1 }
    )
    observer.observe(el)
    el._observer = observer
  },
  unmounted(el: any) {
    if (el._observer) el._observer.disconnect()
  }
}
</script>

<template>


  <div
    class="flex min-h-screen flex-col items-center bg-white p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]">
    <BlurReveal :duration="1" :delay="0.15" blur="16px" :y-offset="16">
      <div class="text-center space-y-5 mx-auto mt-10 md:mt-[70px]">
        <span v-scroll-animate="{ delay: 200 }" class="badge badge-green">
          Family Tree
        </span>
      </div>
    </BlurReveal>
    <div
      class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0">

      <div style="width: 100%; height: 900px; ">

        <!-- 
          :nodes-draggable="false"
          :nodes-connectable="false"
          :edges-draggable="false"
          :pan-on-scroll="false"
          :pan-on-drag="false"
          :zoom-on-scroll="false"
          :zoom-on-pinching="false" -->


        <VueFlow :nodes="nodes" :edges="edges" fit-view-on-init :edge-types="edgeTypes"
          v-scroll-animate="{ direction: 'up', offset: 200 }" :zoom-on-scroll="false" :zoom-on-pinch="false"
          :zoom-on-double-click="false" :pan-on-drag="false" :nodes-draggable="false" :nodes-connectable="false"
          :elements-selectable="false">
          <template #node-default="nodeProps">
            <SpecialNode v-bind="nodeProps" class="shadow-sm" />
          </template>
          <!-- <Background /> -->
          <!-- <Controls /> -->
        </VueFlow>
      </div>
    </div>

  </div>
</template>

<style scoped>
.special-node {
  font-size: 14px;
  cursor: pointer;
  transition: border 0.3s ease;
  border-color: aqua;
}

.vue-flow-container {
  position: relative;
  width: 100%;
  height: 100vh;
  overflow: hidden;
}

.clouds-background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 0;
  background: linear-gradient(135deg,
      rgba(135, 206, 235, 0.8) 0%,
      rgba(176, 224, 230, 0.6) 50%,
      rgba(230, 248, 255, 0.4) 100%);
}

.cloud-svg {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
}

.vue-flow-main {
  position: relative;
  z-index: 1;
  width: 100%;
  height: 100%;
}

/* Анимации для облаков */
.cloud {
  transform-origin: center;
}

.cloud-1 {
  animation: float-1 25s ease-in-out infinite;
}

.cloud-2 {
  animation: float-2 30s ease-in-out infinite;
}

.cloud-3 {
  animation: float-3 35s ease-in-out infinite;
}

.cloud-4 {
  animation: float-4 28s ease-in-out infinite;
}

.cloud-5 {
  animation: float-5 32s ease-in-out infinite;
}

.cloud-6 {
  animation: float-6 22s ease-in-out infinite;
}

.cloud-7 {
  animation: float-7 27s ease-in-out infinite;
}

.cloud-8 {
  animation: float-8 31s ease-in-out infinite;
}

.cloud-9 {
  animation: float-9 26s ease-in-out infinite;
}

/* Различные анимации плавания */
@keyframes float-1 {

  0%,
  100% {
    transform: translate(0, 0) scale(1);
  }

  25% {
    transform: translate(30px, -20px) scale(1.05);
  }

  50% {
    transform: translate(-20px, -10px) scale(0.95);
  }

  75% {
    transform: translate(10px, 15px) scale(1.02);
  }
}

@keyframes float-2 {

  0%,
  100% {
    transform: translate(0, 0) scale(1);
  }

  33% {
    transform: translate(-25px, 20px) scale(1.08);
  }

  66% {
    transform: translate(35px, -15px) scale(0.92);
  }
}

@keyframes float-3 {

  0%,
  100% {
    transform: translate(0, 0) scale(1);
  }

  20% {
    transform: translate(15px, -25px) scale(1.03);
  }

  40% {
    transform: translate(-30px, 10px) scale(0.97);
  }

  60% {
    transform: translate(20px, 25px) scale(1.06);
  }

  80% {
    transform: translate(-10px, -15px) scale(0.94);
  }
}

@keyframes float-4 {

  0%,
  100% {
    transform: translate(0, 0) scale(1);
  }

  30% {
    transform: translate(-20px, -30px) scale(1.04);
  }

  70% {
    transform: translate(25px, 20px) scale(0.96);
  }
}

@keyframes float-5 {

  0%,
  100% {
    transform: translate(0, 0) scale(1);
  }

  25% {
    transform: translate(40px, 15px) scale(1.07);
  }

  50% {
    transform: translate(-15px, -25px) scale(0.93);
  }

  75% {
    transform: translate(-35px, 30px) scale(1.01);
  }
}

@keyframes float-6 {

  0%,
  100% {
    transform: translate(0, 0) scale(1);
  }

  40% {
    transform: translate(-40px, -10px) scale(1.1);
  }

  80% {
    transform: translate(20px, -20px) scale(0.9);
  }
}

@keyframes float-7 {

  0%,
  100% {
    transform: translate(0, 0) scale(1);
  }

  35% {
    transform: translate(25px, 25px) scale(1.05);
  }

  70% {
    transform: translate(-30px, -20px) scale(0.95);
  }
}

@keyframes float-8 {

  0%,
  100% {
    transform: translate(0, 0) scale(1);
  }

  45% {
    transform: translate(-25px, 35px) scale(1.08);
  }

  85% {
    transform: translate(30px, -25px) scale(0.92);
  }
}

@keyframes float-9 {

  0%,
  100% {
    transform: translate(0, 0) scale(1);
  }

  30% {
    transform: translate(35px, -20px) scale(1.06);
  }

  60% {
    transform: translate(-20px, 25px) scale(0.94);
  }
}

/* Адаптивность */
@media (max-width: 768px) {
  .cloud {
    transform: scale(0.7);
  }
}
</style>
