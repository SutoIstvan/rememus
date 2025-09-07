<template>
  <div class="bg-white dark:bg-black overflow-x-hidden">
    <HeaderNavigation />
    <Header />
    <Biography id="biography" />
    <Gallery id="gallery" />
    <FamilyTree id="family-tree" />
    <TimeLine id="timelines" />
    <Footer />
  </div>
</template>

<script setup lang="ts">
import HeaderNavigation from '@/components/memorial/HeaderNavigation.vue'
import Gallery from '@/components/memorial/Gallery.vue'
import FamilyTree from '@/components/memorial/FamilyTree.vue'
import TimeLine from '@/components/memorial/TimeLine.vue'
import Footer from '@/components/memorial/Footer.vue'
import Header from '@/components/memorial/Header.vue'
import Biography from '@/components/memorial/Biography.vue'

// Директива для анимаций
const vScrollAnimate = {
  mounted(el, binding) {
    const { delay = 0, direction = 'up', offset = 100 } = binding.value || {}

    // Начальное состояние
    el.style.opacity = '0'
    el.style.transition = 'all 0.6s ease-out'

    switch (direction) {
      case 'up':
        el.style.transform = 'translateY(30px)'
        break
      case 'down':
        el.style.transform = 'translateY(-30px)'
        break
      case 'left':
        el.style.transform = 'translateX(-30px)'
        break
      case 'right':
        el.style.transform = 'translateX(30px)'
        break
      default:
        el.style.transform = 'translateY(30px)'
    }

    if (delay > 0) {
      el.style.transitionDelay = `${delay}ms`
    }

    // Создаем observer
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
      {
        root: null,
        rootMargin: `0px 0px -${offset}px 0px`,
        threshold: 0.1
      }
    )

    observer.observe(el)
    el._observer = observer
  },

  unmounted(el) {
    if (el._observer) {
      el._observer.disconnect()
    }
  }
}


</script>

<!-- <style scoped>
/* Добавь кастомные стили если нужно */
.badge {
  display: inline-flex;
  align-items: center;
  padding: 0.25rem 0.75rem;
  border-radius: 9999px;
  font-size: 0.875rem;
  font-weight: 500;
}

.badge-green {
  background-color: rgb(220 252 231);
  color: rgb(22 163 74);
}

@media (prefers-color-scheme: dark) {
  .badge-green {
    background-color: rgb(20 83 45);
    color: rgb(187 247 208);
  }
}

.dropcap::first-letter {
  float: left;
  font-size: 3.75rem;
  font-weight: 700;
  line-height: 1;
  padding-right: 0.5rem;
  padding-top: 0.25rem;
}

.badge {
  @apply inline-flex items-center px-3 py-1 rounded-full text-sm font-medium;
}

.badge-green {
  @apply bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200;
}

.dropcap::first-letter {
  @apply float-left text-6xl font-bold leading-none pr-2 pt-1;
}
</style> -->