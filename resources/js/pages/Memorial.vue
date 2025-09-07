<template>
  <div class="bg-white dark:bg-black overflow-x-hidden">
    <Navigation />
    <Header id="biography" />
    <Biography  />
    <Gallery id="gallery" />
    <FamilyTree id="family-tree" />
    <TimeLine id="timelines" />
    <Footer />
  </div>
</template>

<script setup lang="ts">
import Navigation from '@/components/memorial/Navigation.vue'
import Gallery from '@/components/memorial/Gallery.vue'
import FamilyTree from '@/components/memorial/FamilyTree.vue'
import TimeLine from '@/components/memorial/TimeLine.vue'
import Footer from '@/components/memorial/Footer.vue'
import Header from '@/components/memorial/Header.vue'
import Biography from '@/components/memorial/Biography.vue'
</script>