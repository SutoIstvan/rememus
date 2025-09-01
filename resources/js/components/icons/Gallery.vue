<script setup lang="ts">
import { ref } from "vue";
import * as Masonry from "@/components/ui/masonry"; // shadcn-vue masonry
import { Skeleton } from "@/components/ui/skeleton";

// Галерея изображений
const images = ref([
  {
    id: "1",
    src: "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image.jpg",
    alt: "Gallery Image 1",
  },
  {
    id: "2",
    src: "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-1.jpg",
    alt: "Gallery Image 2",
  },
  {
    id: "3",
    src: "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-2.jpg",
    alt: "Gallery Image 3",
  },
  {
    id: "4",
    src: "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-3.jpg",
    alt: "Gallery Image 4",
  },
  {
    id: "5",
    src: "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-4.jpg",
    alt: "Gallery Image 5",
  },
  {
    id: "6",
    src: "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-5.jpg",
    alt: "Gallery Image 6",
  },
  {
    id: "7",
    src: "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-6.jpg",
    alt: "Gallery Image 7",
  },
  {
    id: "8",
    src: "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-7.jpg",
    alt: "Gallery Image 8",
  },
  {
    id: "9",
    src: "https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-8.jpg",
    alt: "Gallery Image 9",
  },
]);

// Заглушки для skeleton loader
const skeletonIds = Array.from({ length: 6 }, () =>
  `skeleton-${Math.random().toString(36).substring(2, 9)}`
);
</script>

<template>
  <div class="w-full max-w-6xl mx-auto px-4">
    <!-- Заголовок -->
    <div class="text-center space-y-5 mx-auto mb-10">
      <span class="badge badge-green">Gallery</span>
      <h2 class="text-3xl font-bold">Masonry Image Gallery</h2>
      <p class="text-muted-foreground text-base">
        Красивая адаптивная галерея с Masonry Layout и shadcn-vue.
      </p>
    </div>

    <!-- Masonry Layout -->
    <Masonry.Root
      columnCount="3"
      gap="{ column: 12, row: 12 }"
      class="w-full"
      fallback="loading"
    >
      <template #fallback>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
          <div
            v-for="id in skeletonIds"
            :key="id"
            class="rounded-lg overflow-hidden"
          >
            <Skeleton class="h-60 w-full" />
          </div>
        </div>
      </template>

      <!-- Рендер изображений -->
      <Masonry.Item
        v-for="image in images"
        :key="image.id"
        class="relative overflow-hidden rounded-lg group cursor-pointer transition-all duration-300 hover:scale-[1.02] hover:shadow-xl"
      >
        <img
          :src="image.src"
          :alt="image.alt"
          class="w-full h-auto object-cover rounded-lg transition-transform duration-500 group-hover:scale-105"
        />
      </Masonry.Item>
    </Masonry.Root>
  </div>
</template>

<style scoped>
.badge {
  @apply inline-block px-3 py-1 text-xs font-medium rounded-full;
}
.badge-green {
  @apply bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200;
}
</style>
