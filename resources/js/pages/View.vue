<template>
  <div class="bg-white dark:bg-black overflow-x-hidden">
    <Navigation />


    <!-- Header with person info -->
    <Header :person="headerData" />

    <!-- Biography section -->
    <Biography :memorial="biographyData" />



    <!-- Gallery section -->
    <Gallery v-if="memorial.gallery_enabled && galleryImages.length > 0" id="gallery" :initial-images="galleryImages" />

    <!-- Family Tree section -->
    <FamilyTree id="family-tree" v-if="memorial.family_tree_enabled" :family-data="memorial.family ?? []"
      :memorial="memorial" />

    <!-- Timeline section -->
    <section v-if="memorial.timeline_enabled && timelineFeatures.length > 0" id="timelines"
      class="pt-[30px] bg-white dark:bg-black">
      <div class="lp:!max-w-[1290px] xl:max-w-[1140px] lg:max-w-[960px] mx-auto px-4 md:px-6 lg:px-8">

        <TimelineView :features="timelineFeatures" />
      </div>
    </section>

    <!-- Comments section -->
    <Comments v-if="!!memorial.comments_enabled" id="commemorations" :comments="approvedComments ?? []"
      :comments-enabled="true" :memorial-slug="memorial.slug" />

    <Footer />
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import Navigation from '@/components/memorial/Navigation.vue'
import Gallery from '@/components/memorial/Gallery.vue'
import FamilyTree from '@/components/memorial/FamilyTree.vue'
import Footer from '@/components/memorial/Footer.vue'
import Header from '@/components/memorial/Header.vue'
import Biography from '@/components/memorial/Biography.vue'
import TimelineView from '@/components/memorial/TimeLine/ViewFeatures.vue'
import Comments from '@/components/memorial/Comments.vue'

const props = defineProps<{
  memorial: any
  approvedComments: any[]
}>()

// ── Header data ──────────────────────────────────────────────
const headerData = computed(() => {
  const m = props.memorial
  const photo = m.photo
    ? (m.photo.startsWith('http') || m.photo.startsWith('/storage')
      ? m.photo
      : `/storage/${m.photo}`)
    : '/images/front/testimonial-1.jpg'

  const formatDate = (d: string | null) => {
    if (!d) return '?'
    return d.substring(0, 10)
  }

  const bg = m.background_image
    ? (m.background_image.startsWith('http') || m.background_image.startsWith('/')
      ? m.background_image
      : `/storage/${m.background_image}`)
    : null

  return {
    name: m.name || 'Unknown',
    image: photo,
    background: bg,
    birthYear: formatDate(m.birth_date),
    deathYear: formatDate(m.death_date),
    location: m.birth_place || m.grave_location || '',
  }
})

// ── Biography section data ────────────────────────────────────
const biographyData = computed(() => {
  const m = props.memorial
  return {
    badgeText: m.motto ? 'Motto' : 'In Memory',
    quote: m.motto || '',
    description: (m.biography || '').replace(/\n/g, '<br>'),
  }
})

// ── Timeline features ─────────────────────────────────────────
const timelineFeatures = computed(() => {
  const items: any[] = props.memorial.timeline ?? []
  return items
    .slice()
    .sort((a, b) => (a.order ?? 0) - (b.order ?? 0))
    .map((item, index) => ({
      ...item,
      reverse: index % 2 !== 0,
      lineClass: index === items.length - 1 ? 'line-fade-bottom' : '',
    }))
})

// ── Gallery images ────────────────────────────────────────────
const resolve = (p: string | null | undefined): string | null => {
  if (!p) return null
  if (p.startsWith('http') || p.startsWith('/storage')) return p
  if (p.startsWith('storage/')) return '/' + p
  return `/storage/${p}`
}

const galleryImages = computed(() => {
  const imgs: any[] = props.memorial.images ?? []
  return imgs
    .slice()
    .sort((a, b) => (a.order ?? 0) - (b.order ?? 0))
    .map((img) => {
      const path = resolve(img.image_path)
      if (!path) return null
      return {
        path,
        thumb: resolve(img.thumb_path) ?? path,
      }
    })
    .filter(Boolean) as { path: string; thumb: string }[]
})
</script>