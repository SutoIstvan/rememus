<template>
  <div class="bg-white dark:bg-black overflow-x-hidden">
    <HeaderNavigation />
    <FamilyTreeEdit id="family-tree" />
    <Footer />
  </div>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import HeaderNavigation from '@/components/memorial/Navigation.vue'
import Gallery from '@/components/memorial/Gallery.vue'
import TimeLine from '@/components/memorial/TimeLine.vue'
import Footer from '@/components/memorial/Footer.vue'
import FamilyTreeEdit from '@/components/memorial/FamilyTree/Edit.vue'
</script>
