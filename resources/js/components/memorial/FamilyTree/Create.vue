<script setup lang="ts">
import { ref, watch } from 'vue'
import { VueFlow } from '@vue-flow/core'
import { markRaw } from 'vue'
import { Position } from '@vue-flow/core'
import SpecialEdge from '@/components/SpecialEdge.vue'
import MarriageEdge from '@/components/MarriageEdge.vue'
import SpecialNodeEdit from '@/components/SpecialNodeEdit.vue'
import { Controls } from '@vue-flow/controls'

// Props и emits
const props = defineProps({
  modelValue: {
    type: Array,
    default: () => []
  }
})

const emit = defineEmits(['update:modelValue', 'update:avatarFiles'])

// Храним File объекты отдельно
const avatarFiles = ref<Map<string, File>>(new Map())

const edgeTypes = {
  special: markRaw(SpecialEdge),
  marriage: markRaw(MarriageEdge),
}

// ... остальной код nodes, edges без изменений ...

const nodes = ref([
  {
    id: 'dad',
    position: { x: 190, y: 170 },
    style: { width: '90px', height: '105px', padding: '5px' },
    data: {
      label: '',
      avatar: '',
      qr_code: '',
      role: 'father'
    }
  },
  {
    id: 'mom',
    position: { x: 345, y: 170 },
    style: { width: '90px', height: '105px', padding: '5px' },
    data: {
      label: '',
      avatar: '',
      qr_code: '',
      role: 'mother'
    }
  },
  {
    id: 'you',
    position: { x: 265, y: 331 },
    style: { width: '90px', height: '105px', padding: '5px' },
    data: {
      label: '',
      avatar: '',
      qr_code: '',
      role: 'main_person',
      canAddChild: true
    }
  },
  {
    id: 'grandpa_dad',
    position: { x: 75, y: 8 },
    style: { width: '90px', height: '105px', padding: '5px' },
    data: {
      label: '',
      avatar: '',
      qr_code: '',
      role: 'grandfather_paternal'
    }
  },
  {
    id: 'grandma_dad',
    position: { x: 200, y: 8 },
    style: { width: '90px', height: '105px', padding: '5px' },
    data: {
      label: '',
      avatar: '',
      qr_code: '',
      role: 'grandmother_paternal'
    }
  },
  {
    id: 'grandpa_mom',
    position: { x: 330, y: 8 },
    style: { width: '90px', height: '105px', padding: '5px' },
    data: {
      label: '',
      avatar: '',
      qr_code: '',
      role: 'grandfather_maternal'
    }
  },
  {
    id: 'grandma_mom',
    position: { x: 460, y: 8 },
    style: { width: '90px', height: '105px', padding: '5px' },
    data: {
      label: '',
      avatar: '',
      qr_code: '',
      role: 'grandmother_maternal'
    }
  },
  {
    id: 'wife',
    position: { x: 135, y: 331 },
    style: { width: '90px', height: '105px', padding: '5px' },
    data: {
      label: '',
      avatar: '',
      qr_code: '',
      role: 'spouse'
    }
  },
  {
    id: 'child',
    position: { x: 245, y: 490 },
    style: { width: '90px', height: '105px', padding: '5px' },
    data: {
      label: '',
      avatar: '',
      qr_code: '',
      role: 'child'
    }
  },
  {
    id: 'brother',
    position: { x: 375, y: 331 },
    style: { width: '90px', height: '105px', padding: '5px' },
    data: {
      label: '',
      avatar: '',
      qr_code: '',
      role: 'sibling',
      canAddBrother: true
    }
  },
  // Кнопки добавления
  {
    id: 'add-wife-btn',
    position: { x: 25, y: 331 },
    style: { width: '90px', height: '105px', padding: '5px' },
    type: 'input',
    data: {
      label: '+ Добавить жену',
      isAddButton: true,
      addType: 'wife'
    }
  },
  {
    id: 'add-brother-btn',
    position: { x: 485, y: 331 },
    style: { width: '90px', height: '105px', padding: '5px' },
    type: 'input',
    data: {
      label: '+ Добавить брата',
      isAddButton: true,
      addType: 'brother'
    }
  },
  {
    id: 'add-child-btn',
    position: { x: 355, y: 490 },
    style: { width: '90px', height: '105px', padding: '5px' },
    type: 'input',
    data: {
      label: '+ Добавить ребенка',
      isAddButton: true,
      addType: 'child'
    }
  }
])

const edges = ref([
  { 
    id: 'mom-you', 
    source: 'mom', 
    target: 'you', 
    type: 'special',
    sourcePosition: Position.Bottom,
    targetPosition: Position.Top,
    sourceHandle: 'source-bottom',
    targetHandle: 'target-top'
  },
  { 
    id: 'dad-you', 
    source: 'dad', 
    target: 'you', 
    type: 'special',
    sourcePosition: Position.Bottom,
    targetPosition: Position.Top,
    sourceHandle: 'source-bottom',
    targetHandle: 'target-top'
  },
  { 
    id: 'grandma_mom-mom', 
    source: 'grandma_mom', 
    target: 'mom', 
    type: 'special',
    sourcePosition: Position.Bottom,
    targetPosition: Position.Top,
    sourceHandle: 'source-bottom',
    targetHandle: 'target-top'
  },
  { 
    id: 'grandpa_mom-mom', 
    source: 'grandpa_mom', 
    target: 'mom', 
    type: 'special',
    sourcePosition: Position.Bottom,
    targetPosition: Position.Top,
    sourceHandle: 'source-bottom',
    targetHandle: 'target-top'
  },
  { 
    id: 'grandma_dad-dad', 
    source: 'grandma_dad', 
    target: 'dad', 
    type: 'special',
    sourcePosition: Position.Bottom,
    targetPosition: Position.Top,
    sourceHandle: 'source-bottom',
    targetHandle: 'target-top'
  },
  { 
    id: 'grandpa_dad-dad', 
    source: 'grandpa_dad', 
    target: 'dad', 
    type: 'special',
    sourcePosition: Position.Bottom,
    targetPosition: Position.Top,
    sourceHandle: 'source-bottom',
    targetHandle: 'target-top'
  },
  { 
    id: 'you-wife', 
    source: 'you', 
    target: 'wife', 
    type: 'marriage',
    sourcePosition: Position.Left,
    targetPosition: Position.Right,
    sourceHandle: 'source-left',
    targetHandle: 'target-right'
  },
  { 
    id: 'you-child', 
    source: 'you', 
    target: 'child', 
    type: 'special',
    sourcePosition: Position.Bottom,
    targetPosition: Position.Top,
    sourceHandle: 'source-bottom',
    targetHandle: 'target-top'
  },
  { 
    id: 'mom-brother', 
    source: 'mom', 
    target: 'brother', 
    type: 'special',
    sourcePosition: Position.Bottom,
    targetPosition: Position.Top,
    sourceHandle: 'source-bottom',
    targetHandle: 'target-top'
  },
])

// Функция для преобразования узлов в формат для сохранения
const getFamilyMembersData = () => {
  return nodes.value
    .filter(node => !node.data.isAddButton && node.data.label)
    .map(node => ({
      id: node.id,
      name: node.data.label,
      role: node.data.role,
      avatar: node.data.avatar || null, // Здесь будет маркер "has_file" если есть файл
      qr_code: node.data.qr_code || null,
      position: node.position
    }))
}

// Отслеживаем изменения в узлах и отправляем данные наверх
watch(nodes, () => {
  const familyData = getFamilyMembersData()
  emit('update:modelValue', familyData)
}, { deep: true })

// Отслеживаем изменения файлов аватаров
watch(avatarFiles, () => {
  emit('update:avatarFiles', avatarFiles.value)
}, { deep: true })

// Обработчик изменения данных узла
const handleNodeDataChange = (nodeId, field, value) => {
  const node = nodes.value.find(n => n.id === nodeId)
  if (node && !node.data.isAddButton) {
    if (field === 'avatar' && value instanceof File) {
      // Если это File объект, сохраняем его отдельно
      avatarFiles.value.set(nodeId, value)
      node.data.avatar = 'has_file' // маркер что файл есть
    } else {
      node.data[field] = value
    }
  }
}

// Остальные функции без изменений...
function handleAddClick(nodeId) {
  const node = nodes.value.find(n => n.id === nodeId)
  if (!node || !node.data.isAddButton) return

  if (node.data.addType === 'brother') {
    addNewBrother()
  } else if (node.data.addType === 'child') {
    addNewChild()
  } else if (node.data.addType === 'wife') {
    addNewWife()
  }
}

function addNewWife() {
  const wifeId = `wife-${Date.now()}`
  const addButtonNode = nodes.value.find(n => n.id === 'add-wife-btn')
  
  const newWife = {
    id: wifeId,
    position: { ...addButtonNode.position },
    style: { width: '90px', height: '105px', padding: '5px' },
    data: {
      label: '',
      avatar: '',
      role: 'spouse'
    }
  }

  addButtonNode.position.x -= 110
  nodes.value.splice(nodes.value.indexOf(addButtonNode), 0, newWife)

  edges.value.push({
    id: `you-${wifeId}`,
    source: 'you',
    target: wifeId,
    type: 'marriage',
    sourcePosition: Position.Left,
    targetPosition: Position.Right,
    sourceHandle: 'source-left',
    targetHandle: 'target-right'
  })
}

function addNewBrother() {
  const brotherId = `brother-${Date.now()}`
  const addButtonNode = nodes.value.find(n => n.id === 'add-brother-btn')
  
  const newBrother = {
    id: brotherId,
    position: { ...addButtonNode.position },
    style: { width: '90px', height: '105px', padding: '5px' },
    data: {
      label: '',
      avatar: '',
      qr_code: '',
      role: 'sibling'
    }
  }

  addButtonNode.position.x += 110
  nodes.value.splice(nodes.value.indexOf(addButtonNode), 0, newBrother)

  edges.value.push({
    id: `mom-${brotherId}`,
    source: 'mom',
    target: brotherId,
    type: 'special',
    sourcePosition: Position.Bottom,
    targetPosition: Position.Top,
    sourceHandle: 'source-bottom',
    targetHandle: 'target-top'
  })
}

function addNewChild() {
  const childId = `child-${Date.now()}`
  
  const existingChildren = nodes.value.filter(n => 
    n.id.startsWith('child') && !n.data.isAddButton
  )
  
  const baseX = 245
  const spacing = 110
  
  let newPosition
  if (existingChildren.length === 1) {
    newPosition = { x: baseX - spacing, y: 490 }
  } else {
    const childrenCount = existingChildren.length
    if (childrenCount % 2 === 0) {
      const rightOffset = Math.ceil(childrenCount / 2) * spacing
      newPosition = { x: baseX + rightOffset, y: 490 }
    } else {
      const leftOffset = Math.ceil(childrenCount / 2) * spacing
      newPosition = { x: baseX - leftOffset, y: 490 }
    }
  }
  
  const newChild = {
    id: childId,
    position: newPosition,
    style: { width: '90px', height: '105px', padding: '5px' },
    data: {
      label: '',
      avatar: '',
      qr_code: '',
      role: 'child'
    }
  }

  const addButtonNode = nodes.value.find(n => n.id === 'add-child-btn')
  if (addButtonNode) {
    const rightmostChild = Math.max(...nodes.value
      .filter(n => n.id.startsWith('child') && !n.data.isAddButton)
      .map(n => n.position.x))
    addButtonNode.position.x = Math.max(rightmostChild + spacing, newPosition.x + spacing)
  }

  const addButtonIndex = nodes.value.findIndex(n => n.id === 'add-child-btn')
  nodes.value.splice(addButtonIndex, 0, newChild)

  edges.value.push({
    id: `you-${childId}`,
    source: 'you',
    target: childId,
    type: 'special',
    sourcePosition: Position.Bottom,
    targetPosition: Position.Top,
    sourceHandle: 'source-bottom',
    targetHandle: 'target-top'
  })
}

// Animation directive
const vScrollAnimate = {
  mounted(el, binding) {
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
              entry.target.style.opacity = '1'
              entry.target.style.transform = 'translate(0, 0)'
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
  unmounted(el) {
    if (el._observer) el._observer.disconnect()
  }
}

// Экспортируем функцию для получения данных семьи
defineExpose({
  getFamilyMembersData,
  getAvatarFiles: () => avatarFiles.value
})
</script>

<template>
  <div 
    class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]">
    <div class="text-center space-y-5 mx-auto mt-10 md:mt-[70px]">
      <span 
        v-scroll-animate="{ delay: 200 }"
        class="badge badge-green"
      >
        Family Tree
      </span>
    </div>
    <div class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0">
      <div style="width: 100%; height: 900px;">
        <VueFlow 
          :nodes="nodes" 
          :edges="edges" 
          fit-view-on-init 
          :edge-types="edgeTypes"
          v-scroll-animate="{ direction: 'up', offset: 200 }"
          :zoom-on-scroll="false"
          :zoom-on-pinch="false"
          :zoom-on-double-click="false"
          :pan-on-drag="false"
          :nodes-draggable="false"
          :nodes-connectable="false"
          :elements-selectable="false"
          @node-click="(event) => handleAddClick(event.node.id)"
        >
          <template #node-default="nodeProps">
            <SpecialNodeEdit 
              v-bind="nodeProps" 
              class="shadow-sm"
              @update-node-data="handleNodeDataChange"
            />
          </template>

          <Controls />
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

.vue-flow-main {
  position: relative;
  z-index: 1;
  width: 100%;
  height: 100%;
}
</style>