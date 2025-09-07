<template>
    <section
        class="hero-section pt-[190px] md:pt-[230px] lg:pt-[230px] xl:pt-[220px] bg-[url('/images/front/hero-bg.png')] bg-no-repeat bg-cover bg-top relative z-0">
        <!-- Hero Title Content -->
        <div
            class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 flex flex-col items-center space-y-[124px] relative z-10 mb-[100px] lg:mb-[130px] xl:mb-[210px]">
            <!-- Дополнительный контент можно добавить здесь -->
        </div>

        <!-- Hero Bottom Item -->
        <div class="w-full bg-white dark:bg-black">
            <div class="relative z-0">
                <div class="relative w-full bg-gradient-to-t from-white dark:from-background-8 from-50% to-transparent">
                </div>
                <div class="flex flex-col lg:flex-row">
                    <!-- Image Section -->
                    <div class="lg:flex-1/3 lg:pe-[42px]">
                        <div class="relative h-full max-lg:mx-auto">
                            <figure class="shadow-lg absolute lg:right-0 lg:bottom-0 w-[300px]
                                    max-lg:left-1/2 max-lg:-translate-x-1/2 max-lg:top-[-100px]
                                    bg-white dark:bg-background-9 rounded-[10px] overflow-hidden p-1">
                                <img :src="person.image" :alt="person.name"
                                    class="w-[300px] h-[300px] object-cover rounded-[10px]" />
                            </figure>
                        </div>
                    </div>

                    <!-- Person Info Section -->
                    <div class="lg:flex-1/2 pt-[30px] max-lg:px-5 max-lg:text-center max-lg:mt-[200px]">

                        <h2 class="w-100">
                            <Input
                                v-model="memorialName"
                                type="text"
                                placeholder="Enter Name"
                                class="w-full text-lg"
                            />
                        </h2>

                        <ul class="list-none space-y-2 mb-8 max-lg:!mb-0 mt-5">
                                <li
                                    class="flex items-center gap-3 mb-3 justify-center lg:justify-start text-pretty text-xl tracking-tighter xl:text-4xl/none sm:text-3xl">
                                    <Calendar class="w-6 h-6 text-primary" />
                                    {{ person.birthYear }} - {{ person.deathYear }}
                                </li>
                                <li
                                    class="flex items-center gap-3 mb-3 justify-center lg:justify-start">
                                    <MapPin class="w-6 h-6 text-primary" />
                                    <Input
                                        v-model="memorialName"
                                        type="text"
                                        placeholder="Enter location"
                                        class="w-90 text-lg"
                                    />
                                </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import BlurReveal from '@/components/ui/blur-reveal/BlurReveal.vue'
import { MapPin, Calendar, Calendar1 } from "lucide-vue-next";
import Input from '@/components/ui/input/Input.vue';
import { ref, watch, onMounted } from "vue";

const memorialName = ref("");


// Определяем props от Laravel контроллера
const props = defineProps({
    person: {
        type: Object,
        default: () => ({
            name: 'Arnold Shannon',
            image: '/images/front/testimonial-1.jpg',
            birthYear: '1975 jan 15',
            deathYear: '2023 mar 23',
            location: 'Jacksonville, Florida'
        })
    }
})

</script>