<template>
  <div class="bg-white dark:bg-black overflow-x-hidden">
    <HeaderNavigation />
    <FamilyTreeEdit id="family-tree" />
    <Footer />
  </div>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import CalendarIcon from '@/components/icons/CalendarIcon.vue'
import ClockIcon from '@/components/icons/ClockIcon.vue'
import HeaderNavigation from '@/components/memorial/HeaderNavigation.vue'
import Gallery from '@/components/memorial/Gallery.vue'
import TimeLine from '@/components/memorial/TimeLine.vue'
import Footer from '@/components/memorial/Footer.vue'
import FamilyTreeEdit from '@/components/memorial/FamilyTree/Create.vue'
</script>
