<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard, login, register } from '@/routes';
import { ref } from 'vue'
import { VueFlow } from '@vue-flow/core'
import { Controls } from '@vue-flow/controls'
import { Background } from '@vue-flow/background'
import { markRaw } from 'vue'
import { Position } from '@vue-flow/core'

// these components are only shown as examples of how to use a custom node or edge
// you can find many examples of how to create these custom components in the examples page of the docs
import SpecialNode from '@/components/SpecialNode.vue'
import SpecialEdge from '@/components/SpecialEdge.vue'
import MarriageEdge from '@/components/MarriageEdge.vue'

const edgeTypes = {
  special: markRaw(SpecialEdge),
  marriage: markRaw(MarriageEdge),

}

// these are our nodes
const nodes = [
  {
    id: 'dad',
    position: { x: 190, y: 170 },
    style: { width: '90px', height: '105px', padding: '5px', },
    data: {
      label: 'Paul Richardson',
      avatar: 'https://www.online-tribute.com/memorial/uploads/tree/page-0-7-1696518291.jpg',
    }
  },
  {
    id: 'mom',
    position: { x: 345, y: 170 },
    style: { width: '90px', height: '105px', padding: '5px', },
    data: {
      label: 'Margaret Clarkson',
      avatar: 'https://www.online-tribute.com/memorial/uploads/tree/page-0-7-1696518299.jpg',
    }
  },
  {
    id: 'you',
    position: { x: 265, y: 331 },
    style: { width: '90px', height: '105px', padding: '5px', },
    data: {
      label: 'Arnold Shannon',
      avatar: 'http://rememus.test/images/front/testimonial-1.jpg',
    }
  },
  {
    id: 'grandpa_dad',
    position: { x: 75, y: 8 },
    style: { width: '90px', height: '105px', padding: '5px', },
    data: {
      label: 'John Richardson',
      avatar: 'https://www.online-tribute.com/memorial/uploads/tree/page-0-7-1696518264.jpg',
    }
  },
  {
    id: 'grandma_dad',
    position: { x: 200, y: 8 },
    style: { width: '90px', height: '105px', padding: '5px', },
    data: {
      label: 'Jacqueline Richardson',
      avatar: 'https://www.online-tribute.com/memorial/uploads/tree/page-0-7-1696518272.jpg',
    }
  },
  {
    id: 'grandpa_mom',
    position: { x: 330, y: 8 },
    style: { width: '90px', height: '105px', padding: '5px', },
    data: {
      label: 'Bradley Clarkson',
      avatar: 'https://www.online-tribute.com/memorial/uploads/tree/page-0-7-1696518278.jpg',
    }
  },
  {
    id: 'grandma_mom',
    position: { x: 460, y: 8 },
    style: { width: '90px', height: '105px', padding: '5px', },
    data: {
      label: 'Emma Marie Clarkson',
      avatar: 'https://www.online-tribute.com/memorial/uploads/tree/page-0-7-1696518285.jpg',
    }
  },

  {
    id: 'wife',
    position: { x: 135, y: 331 }, // слева от 'you' (x: 265)
    style: { width: '90px', height: '105px', padding: '5px' },
    data: {
      label: 'Evelyn Lewis',
      avatar: 'https://www.online-tribute.com/memorial/static/random1.jpg',
    }
  },
  {
    id: 'child',
    position: { x: 245, y: 490 }, // ниже 'you'
    style: { width: '90px', height: '105px', padding: '5px' },
    data: {
      label: 'Ruby Shannon',
      avatar: 'https://www.online-tribute.com/memorial/uploads/tree/page-0-7-1696518909.jpg',
    }
  },
  {
    id: 'child2',
    position: { x: 135, y: 490 }, // ниже 'you'
    style: { width: '90px', height: '105px', padding: '5px' },
    data: {
      label: 'Ellia Liz Shannon',
      avatar: 'https://randomuser.me/api/portraits/women/5.jpg',
    }
  },
  {
    id: 'brother',
    position: { x: 375, y: 331 },
    style: { width: '90px', height: '105px', padding: '5px', },
    data: {
      label: 'Robert Richardson',
      avatar: 'https://randomuser.me/api/portraits/men/46.jpg',
    }
  },

  {
    id: 'brother2',
    position: { x: 485, y: 331 },
    style: { width: '90px', height: '105px', padding: '5px', },
    data: {
      label: 'Anabel Richardson',
      avatar: 'https://randomuser.me/api/portraits/women/44.jpg',
    }
  },
]



// Связи (ребра)
const edges = ref([

  // Родители → ты (сверху вниз)
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

  // Бабушки и дедушки → мама (сверху вниз)
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

  // Бабушки и дедушки → папа (сверху вниз)
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

  // Супружеская связь (горизонтально слева направо)
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

  // Ты и жена → дети (сверху вниз)
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
    id: 'you-child2', 
    source: 'you', 
    target: 'child2', 
    type: 'special',
    sourcePosition: Position.Bottom,
    targetPosition: Position.Top,
    sourceHandle: 'source-bottom',
    targetHandle: 'target-top'
  },
  // { 
  //   id: 'wife-child', 
  //   source: 'wife', 
  //   target: 'child', 
  //   type: 'special',
  //   sourcePosition: Position.Bottom,
  //   targetPosition: Position.Top,
  //   sourceHandle: 'source-bottom',
  //   targetHandle: 'target-top'
  // },
  // { 
  //   id: 'wife-child2', 
  //   source: 'wife', 
  //   target: 'child2', 
  //   type: 'special',
  //   sourcePosition: Position.Bottom,
  //   targetPosition: Position.Top,
  //   sourceHandle: 'source-bottom',
  //   targetHandle: 'target-top'
  // },

  // Родители → братья (сверху вниз)
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
  // { 
  //   id: 'dad-brother', 
  //   source: 'dad', 
  //   target: 'brother', 
  //   type: 'special',
  //   sourcePosition: Position.Bottom,
  //   targetPosition: Position.Top,
  //   sourceHandle: 'source-bottom',
  //   targetHandle: 'target-top'
  // },
  { 
    id: 'mom-brother2', 
    source: 'mom', 
    target: 'brother2', 
    type: 'special',
    sourcePosition: Position.Bottom,
    targetPosition: Position.Top,
    sourceHandle: 'source-bottom',
    targetHandle: 'target-top'
  },
  // { 
  //   id: 'dad-brother2', 
  //   source: 'dad', 
  //   target: 'brother2', 
  //   type: 'special',
  //   sourcePosition: Position.Bottom,
  //   targetPosition: Position.Top,
  //   sourceHandle: 'source-bottom',
  //   targetHandle: 'target-top'
  // },

  // Дополнительные горизонтальные связи (по желанию)
  
  // Связь между дедушкой и бабушкой по папиной линии
  // { 
  //   id: 'grandpa_dad-grandma_dad', 
  //   source: 'grandpa_dad', 
  //   target: 'grandma_dad', 
  //   type: 'marriage',
  //   sourcePosition: Position.Right,
  //   targetPosition: Position.Left,
  //   sourceHandle: 'source-right',
  //   targetHandle: 'target-left'
  // },

  // Связь между дедушкой и бабушкой по маминой линии
  // { 
  //   id: 'grandpa_mom-grandma_mom', 
  //   source: 'grandpa_mom', 
  //   target: 'grandma_mom', 
  //   type: 'marriage',
  //   sourcePosition: Position.Right,
  //   targetPosition: Position.Left,
  //   sourceHandle: 'source-right',
  //   targetHandle: 'target-left'
  // },

  // Связь между родителями (горизонтально)
  // { 
  //   id: 'dad-mom', 
  //   source: 'dad', 
  //   target: 'mom', 
  //   type: 'marriage',
  //   sourcePosition: Position.Right,
  //   targetPosition: Position.Left,
  //   sourceHandle: 'source-right',
  //   targetHandle: 'target-left'
  // },

  // Связи между братьями (горизонтально сверху к верху для визуального единства)
  // { 
  //   id: 'you-brother', 
  //   source: 'you', 
  //   target: 'brother', 
  //   // type: 'sibling',
  //   sourcePosition: Position.Top,
  //   targetPosition: Position.Top,
  //   sourceHandle: 'source-top',
  //   targetHandle: 'target-top'
  // },
  // { 
  //   id: 'brother-brother2', 
  //   source: 'brother', 
  //   target: 'brother2', 
  //   // type: 'sibling',
  //   sourcePosition: Position.Right,
  //   targetPosition: Position.Left,
  //   sourceHandle: 'source-right',
  //   targetHandle: 'target-left'
  // }


  // { id: 'dad-brother', source: 'dad', target: 'brother', type: 'special' },

])

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
</script>

<template>


  <div 
    class="flex flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]">
        <div class="text-center space-y-5 mx-auto mt-10 md:mt-[70px]">
          <span 
            v-scroll-animate="{ delay: 200 }"
            class="badge badge-green"
          >
            Family Tree
          </span>
        </div>
    <div
      class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0">

      <div class="w-full h-[500px] sm:h-[700px] md:h-[800px] lg:h-[1100px]">

        <VueFlow :nodes="nodes" :edges="edges" fit-view-on-init :edge-types="edgeTypes"
            
            v-scroll-animate="{ direction: 'up', offset: 200 }"
            :zoom-on-scroll="false"
            :zoom-on-pinch="false"
            :zoom-on-double-click="false"
            :pan-on-drag="false"
            :nodes-draggable="false"
            :nodes-connectable="false"
            :elements-selectable="false"
        >
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



.vue-flow-main {
  position: relative;
  z-index: 1;
  width: 100%;
  height: 100%;
}


</style>
