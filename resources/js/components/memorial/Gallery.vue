<template>
  <div class="lp:!max-w-[1290px] xl:max-w-[1140px] lg:max-w-[960px] mx-auto p-4 bg-white dark:bg-black">
    <!-- Заголовок -->
    <div class="text-center space-y-5 mx-auto mb-10 md:mb-[30px]" v-scroll-animate="{ delay: 50, direction: 'down' }">
      <span class="badge badge-green">Gallery</span>
    </div>

    <!-- Галерея с Fancybox -->
    <FancyboxWrapper :fancybox-options="{ groupAll: true }">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
        <div v-for="(column, colIndex) in columns" :key="colIndex" class="grid gap-4">
          <div v-for="(img, imgIndex) in column" :key="imgIndex"
            v-scroll-animate="{ delay: (colIndex * 100) + (imgIndex * 150), direction: 'up' }"
            class="group cursor-pointer relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
            <a :href="img" data-fancybox="gallery" :data-caption="`Image ${colIndex * 4 + imgIndex + 1}`">
              <img
                class="w-full h-full object-cover rounded-lg transform group-hover:scale-105 transition-transform duration-500 ease-out"
                :src="img" :alt="`Image ${colIndex * 4 + imgIndex + 1}`" />
              <div
                class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity duration-300 rounded-lg pointer-events-none">
              </div>
            </a>
          </div>
        </div>
      </div>
    </FancyboxWrapper>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import FancyboxWrapper from '@/components/Fancybox.vue'

const props = withDefaults(defineProps<{
  initialImages?: string[]
}>(), {
  initialImages: undefined,
})

const defaultImages = [
  "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image.jpg",
  "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-1.jpg",
  "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-2.jpg",
  "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-3.jpg",
  "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-4.jpg",
  "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-5.jpg",
  "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-6.jpg",
  "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-7.jpg",
  "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-8.jpg",
  "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-9.jpg",
  "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-10.jpg",
  "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-11.jpg",
]

const images = computed(() => props.initialImages?.length ? props.initialImages : defaultImages)

// Разделяем картинки на 4 колонки
const columns = computed(() => {
  const cols: string[][] = []
  for (let i = 0; i < 4; i++) {
    cols.push(images.value.slice(i * 3, i * 3 + 3))
  }
  return cols
})

// Директива для анимаций
const vScrollAnimate = {
  mounted(el: HTMLElement, binding: { value?: { delay?: number; direction?: string; offset?: number } }) {
    const { delay = 0, direction = 'up', offset = 100 } = binding.value || {}

    el.style.opacity = '0'
    el.style.transition = 'all 0.6s ease-out'

    switch (direction) {
      case 'up': el.style.transform = 'translateY(30px)'; break
      case 'down': el.style.transform = 'translateY(-30px)'; break
      case 'left': el.style.transform = 'translateX(-30px)'; break
      case 'right': el.style.transform = 'translateX(30px)'; break
      default: el.style.transform = 'translateY(30px)'
    }

    if (delay > 0) el.style.transitionDelay = `${delay}ms`

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            setTimeout(() => {
              (entry.target as HTMLElement).style.opacity = '1';
              (entry.target as HTMLElement).style.transform = 'translate(0, 0)'
            }, delay)
            observer.unobserve(entry.target)
          }
        })
      },
      { root: null, rootMargin: `0px 0px -${offset}px 0px`, threshold: 0.1 }
    )

    observer.observe(el)
      ; (el as any)._observer = observer
  },
  unmounted(el: HTMLElement) {
    if ((el as any)._observer) (el as any)._observer.disconnect()
  }
}
</script>