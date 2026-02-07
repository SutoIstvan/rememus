<template>
  <div class="lp:!max-w-[1290px] xl:max-w-[1140px] lg:max-w-[960px] mx-auto p-4 bg-white dark:bg-black">
    <!-- Заголовок -->
    <div class="text-center space-y-5 mx-auto mb-10 md:mb-[30px]" v-scroll-animate="{ delay: 50, direction: 'down' }">
      <span class="badge badge-green">Gallery</span>
    </div>

    <!-- Галерея -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
      <div v-for="(column, colIndex) in columns" :key="colIndex" class="grid gap-4">
        <div v-for="(img, imgIndex) in column" :key="imgIndex"
          v-scroll-animate="{ delay: (colIndex * 100) + (imgIndex * 150), direction: 'up' }"
          class="group cursor-pointer relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300"
          @click="openImage(img, colIndex * 3 + imgIndex + 1)">
          <img
            class="h-auto w-full rounded-lg transform group-hover:scale-105 transition-transform duration-500 ease-out object-cover"
            :src="img" :alt="`Image ${colIndex * 3 + imgIndex + 1}`" />
          <div
            class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity duration-300 rounded-lg pointer-events-none">
          </div>
        </div>
      </div>
    </div>

    <!-- Custom Modal Dialog -->
    <div v-if="isDialogOpen" class="fixed inset-0 z-50 flex items-center justify-center" @click="closeDialog">
      <!-- Backdrop -->
      <div class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>

      <!-- Modal Content -->
      <div class="relative max-w-4xl w-full mx-4overflow-hidden" @click.stop>
        <!-- Кнопка закрытия -->
        <button @click="closeDialog"
          class="cursor-pointer hover:cursor-pointer absolute top-4 right-4 z-50 w-8 h-8 rounded-full bg-black/80 text-white hover:bg-black/90 flex items-center justify-center transition-colors">
          ✕
        </button>

        <!-- Навигация -->
        <button v-if="currentImageIndex > 0" @click="previousImage"
          class="cursor-pointer hover:cursor-pointer absolute left-4 top-1/2 -translate-y-1/2 z-40 w-10 h-10 rounded-full bg-black/60 text-white hover:bg-black/80 flex items-center justify-center transition-colors">
          ←
        </button>

        <button v-if="currentImageIndex < images.length - 1" @click="nextImage"
          class="cursor-pointer hover:cursor-pointer absolute right-4 top-1/2 -translate-y-1/2 z-40 w-10 h-10 rounded-full bg-black/60 text-white hover:bg-black/80 flex items-center justify-center transition-colors">
          →
        </button>

        <!-- Изображение -->
        <div class="flex flex-col items-center p-6">
          <img :src="currentImage" :alt="`Image ${currentImageIndex + 1}`"
            class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-lg" />

          <!-- Информация об изображении -->
          <div class="mt-4 text-center">
            <p class="text-sm text-gray-600 mb-2">
              Изображение {{ currentImageIndex + 1 }} из {{ images.length }}
            </p>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'

const images = [
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
];

// Разделяем картинки на колонки по 3 штуки
const columns = [];
for (let i = 0; i < 4; i++) {
  columns.push(images.slice(i * 3, i * 3 + 3));
}

// Состояние модального окна
const isDialogOpen = ref(false)
const currentImage = ref('')
const currentImageIndex = ref(0)

// Функции для работы с модальным окном
const openImage = (imageSrc, index) => {
  currentImage.value = imageSrc
  currentImageIndex.value = index - 1 // Преобразуем в 0-based index
  isDialogOpen.value = true
}

const closeDialog = () => {
  isDialogOpen.value = false
}

const nextImage = () => {
  if (currentImageIndex.value < images.length - 1) {
    currentImageIndex.value++
    currentImage.value = images[currentImageIndex.value]
  }
}

const previousImage = () => {
  if (currentImageIndex.value > 0) {
    currentImageIndex.value--
    currentImage.value = images[currentImageIndex.value]
  }
}



// Обработка клавиш
const handleKeydown = (event) => {
  if (!isDialogOpen.value) return

  if (event.key === 'Escape') {
    closeDialog()
  } else if (event.key === 'ArrowRight') {
    nextImage()
  } else if (event.key === 'ArrowLeft') {
    previousImage()
  }
}

// Добавляем обработчик клавиш при монтировании

onMounted(() => {
  document.addEventListener('keydown', handleKeydown)
})

onUnmounted(() => {
  document.removeEventListener('keydown', handleKeydown)
})

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