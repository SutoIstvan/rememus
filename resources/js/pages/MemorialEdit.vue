<template>
  <div class="bg-white dark:bg-black overflow-x-hidden">
    <HeaderNavigation />
    <FamilyTreeEdit id="family-tree" />
    <Footer />
  </div>
</template>

<script setup lang="ts">
import HeaderNavigation from '@/components/memorial/Navigation.vue'
import Footer from '@/components/memorial/Footer.vue'
import FamilyTreeEdit from '@/components/memorial/FamilyTree/Edit.vue'
</script>
