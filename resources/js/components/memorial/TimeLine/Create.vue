<template>
  <div class="overflow-hidden">
    <section class="container mx-auto space-y-8 px-4 py-24 md:px-6 2xl:max-w-[1400px]">
      <div class="mx-auto max-w-3xl space-y-4 text-center">
        <h2 class="text-3xl font-bold">Our Journey</h2>
        <p class="text-muted-foreground">
          From humble beginnings to industry leader — explore the milestones that have shaped our company's growth and success over the years.
        </p>
      </div>

      <!-- Desktop Timeline -->
      <div class="relative mx-auto hidden max-w-4xl pt-10 md:block">
        <div class="bg-border absolute left-1/2 h-[calc(100%-6rem)] w-0.5 -translate-x-1/2 transform z-0 top-24"></div>
        <div class="space-y-12">
          <div
            v-for="(milestone, index) in visibleMilestones"
            :key="milestone.year"
            :class="[
              'relative flex items-center gap-8',
              index % 2 === 0 ? 'flex-row-reverse' : ''
            ]"
          >
            <div class="absolute left-1/2 z-10 -translate-x-1/2 transform">
              <div
                class="bg-primary text-primary-foreground flex h-12 w-12 items-center justify-center rounded-full font-bold"
              >
                {{ milestone.year }}
              </div>
            </div>
            <div :class="['w-1/2', index % 2 === 0 ? 'pr-16 text-right' : 'pl-16']">
              <div class="bg-card text-card-foreground flex flex-col gap-6 rounded-xl shadow-sm p-0">
                <div v-if="!milestone.isPhoto" class="space-y-2 p-5">
                  <div :class="['flex items-center gap-2', index % 2 === 0 ? 'justify-end' : '']">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="lucide lucide-badge-check text-primary h-5 w-5"
                    >
                      <path
                        d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"
                      ></path>
                      <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <h6 class="font-bold">{{ milestone.title }}</h6>
                  </div>
                  <p class="text-muted-foreground text-sm">{{ milestone.desc }}</p>
                </div>
                <div v-else class="relative h-54 overflow-hidden rounded-xl md:h-62 lg:h-70">
                  <img
                    :src="milestone.image"
                    :alt="milestone.title"
                    class="absolute h-full w-full object-cover object-center transition-transform duration-300 group-hover:scale-105"
                  />
                  <div class="absolute inset-0 h-full bg-[linear-gradient(transparent_20%,var(--primary)_100%)] mix-blend-multiply"></div>
                  <div class="absolute inset-x-0 bottom-0 flex flex-col p-4 text-primary-foreground md:p-6">
                    <div class="mb-2 pt-2 text-lg font-semibold md:mb-3 md:pt-3">{{ milestone.title }}</div>
                    <div class="mb-1 line-clamp-2 text-sm md:mb-2">{{ milestone.desc }}</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="w-1/2"></div>
          </div>
        </div>
        <div v-if="visibleCount < milestones.length" class="z-50 flex justify-center pt-8 relative">
          <button
            @click="loadMore"
            class="inline-flex items-center gap-2 rounded-md bg-primary px-4 py-2 text-primary-foreground transition-colors hover:bg-primary/90"
          >
            Показать больше
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="lucide lucide-chevron-down"
            >
              <path d="m6 9 6 6 6-6" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Timeline -->
      <div class="relative mx-auto max-w-md pt-4 md:hidden">
        <div class="bg-border absolute top-0 bottom-0 left-6 w-0.5 z-0"></div>
        <div class="space-y-8">
          <div v-for="milestone in visibleMilestones" :key="milestone.year" class="relative pl-10">
            <div class="absolute pt-5 left-0 z-10">
              <div
                class="bg-primary text-primary-foreground flex h-12 w-12 items-center justify-center rounded-full font-bold"
              >
                {{ milestone.year }}
              </div>
            </div>
            <div class="bg-card text-card-foreground flex flex-col gap-6 rounded-xl shadow-sm p-0">
              <div v-if="!milestone.isPhoto" class="space-y-2 p-4">
                <div class="flex items-center gap-2">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-badge-check text-primary h-5 w-5"
                  >
                    <path
                      d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"
                    ></path>
                    <path d="m9 12 2 2 4-4"></path>
                  </svg>
                  <h6 class="font-bold">{{ milestone.title }}</h6>
                </div>
                <p class="text-muted-foreground text-sm">{{ milestone.desc }}</p>
              </div>
              <div v-else class="relative h-58 overflow-hidden rounded-xl">
                <img
                  :src="milestone.image"
                  :alt="milestone.title"
                  class="absolute h-full w-full object-cover object-center transition-transform duration-300 group-hover:scale-105"
                />
                <div class="absolute inset-0 h-full bg-[linear-gradient(transparent_20%,var(--primary)_100%)] mix-blend-multiply"></div>
                <div class="absolute inset-x-0 bottom-0 flex flex-col items-start p-3 text-primary-foreground">
                  <div class="mb-1 pt-1 text-base font-semibold">{{ milestone.title }}</div>
                  <div class="mb-3 line-clamp-2 text-xs">{{ milestone.desc }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div v-if="visibleCount < milestones.length" class="z-50 relative flex justify-center pt-6 pl-10">
          <div class="absolute left-0 top-0 z-20">
            <div class="bg-border h-6 w-0.5"></div>
          </div>
          <button
            @click="loadMore"
            class="inline-flex items-center gap-2 rounded-md bg-primary px-4 py-2 text-primary-foreground transition-colors hover:bg-primary/90 ml-4"
          >
            Показать больше
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="lucide lucide-chevron-down"
            >
              <path d="m6 9 6 6 6-6" />
            </svg>
          </button>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const milestones = [
  {
    year: '2010',
    title: 'Company Founded',
    desc: 'Started with a team of 3 in a small office in San Francisco.',
    isPhoto: false
  },
  {
    year: '2013',
    title: 'First Major Product Launch',
    desc: 'Released our flagship product that changed the industry.',
    isPhoto: true,
    image: 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w2NDI3NzN8MHwxfGFsbHwxMjN8fHx8fHwyfHwxNzIzODA2OTM5fA&ixlib=rb-4.0.3&q=80&w=1080'
  },
  {
    year: '2015',
    title: 'International Expansion',
    desc: 'Opened our first international offices in London and Tokyo.',
    isPhoto: false
  },
  {
    year: '2018',
    title: '100,000 Customers',
    desc: 'Reached a milestone of 100,000 active customers worldwide.',
    isPhoto: false
  },
  {
    year: '2020',
    title: 'Major Acquisition',
    desc: 'Acquired our biggest competitor to expand our market reach.',
    isPhoto: true,
    image: 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w2NDI3NzN8MHwxfGFsbHwxMjN8fHx8fHwyfHwxNzIzODA2OTM5fA&ixlib=rb-4.0.3&q=80&w=1080'
  },
  {
    year: '2023',
    title: 'Sustainability Initiative',
    desc: 'Launched our commitment to be carbon neutral by 2025.',
    isPhoto: false
  }
]

const visibleCount = ref(5)
const visibleMilestones = computed(() => milestones.slice(0, visibleCount.value))

const loadMore = () => {
  visibleCount.value = Math.min(visibleCount.value + 5, milestones.length)
}
</script>