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
                        <div v-scroll-animate="{ direction: 'left', delay: 200 }"
                            class="relative h-full max-lg:mx-auto">
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
                        <div v-scroll-animate="{ delay: 200 }" class="mb-6">
                            <h2 class="mb-3">{{ person.name }}</h2>
                        </div>

                        <ul class="list-none space-y-2 mb-14 max-lg:!mb-0">
                            <!-- Birth/Death Dates -->
                            <li v-scroll-animate="{ delay: 200 }"
                                class="flex items-center gap-3 mb-3 justify-center lg:justify-start">
                                <CalendarIcon />
                                <p class="text-secondary dark:text-accent">
                                    {{ person.birthYear }} - {{ person.deathYear }}
                                </p>
                            </li>

                            <!-- Location -->
                            <li v-scroll-animate="{ delay: 200 }"
                                class="flex items-center gap-3 mb-3 justify-center lg:justify-start">
                                <ClockIcon />
                                <p class="text-secondary dark:text-accent">
                                    {{ person.location }}
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import CalendarIcon from '@/components/icons/CalendarIcon.vue'
import ClockIcon from '@/components/icons/ClockIcon.vue'

// Определяем props от Laravel контроллера
const props = defineProps({
    person: {
        type: Object,
        default: () => ({
            name: 'Arnold Shannon',
            image: '/images/front/testimonial-1.jpg',
            birthYear: '1975',
            deathYear: '2023',
            location: 'Jacksonville, Florida'
        })
    }
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