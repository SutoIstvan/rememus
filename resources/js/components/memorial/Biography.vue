<template>
    <section id="history"
        class="pt-[30px] md:pt-10 lg:pt-[70px] xl:pt-[80px] pb-16 md:pb-20 lg:pb-[90px] xl:pb-[100px] bg-white dark:bg-black">
        <div class="lp:!max-w-[1290px] xl:max-w-[1140px] lg:max-w-[960px] mx-auto px-4 md:px-6 lg:px-8">
            <div class="text-center space-y-5 mx-auto">
                <span v-scroll-animate="{ delay: 200 }" class="badge badge-green">
                    {{ memorial.badgeText }}
                </span>

                <section class="max-w-2xl mx-auto mt-1">
                    <!-- Additional content можно добавить здесь -->
                </section>

                <div class="text-gray-700">
                    <h4 v-scroll-animate="{ delay: 250 }" class="mb-3 max-w-[700px] mx-auto text-center mb-10">
                        {{ memorial.quote }}
                    </h4>
                    <p v-scroll-animate="{ delay: 300 }" class="dropcap text-start text-lg"
                        v-html="memorial.description">
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
// Определяем props от Laravel контроллера
const props = defineProps({
    memorial: {
        type: Object,
        default: () => ({
            badgeText: 'Motto',
            quote: 'The comfort of having a friend may be taken away, but not that of having had one.',
            description: `Shannon Adams, a beloved wife, mother, and dedicated community member, peacefully passed away on March 25, 2023 - at the age of 73.
                Born on March 10, 1950, Shannon grew up with strong family values and a deep sense of community.<br><br>
                She excelled academically and athletically in high school, eventually earning a Bachelor's degree in Business Administration. In 1975, Shannon married her love, George, and they shared 48 years of a loving marriage, raising two children, Emily and Michael, and becoming adoring grandparents to Grace, Ethan, and Lily. Professionally, Shannon had a distinguished career in finance, marked by her integrity and mentorship of young professionals. She also dedicated her time to various charitable causes, leaving a positive impact on her community. Shannon had a passion for the outdoors, often spending weekends camping, fishing, and hiking with her family, instilling a love for nature in her loved ones.
                <br><br>
                Shannon is survived by her wife, children, grandchildren, and siblings, Robert Jr. and Susan. A memorial service will be held on October 2, 2023, at St. Mary's Community Church at 2:00 PM. In lieu of flowers, the family requests donations to the Shannon Adams Memorial Scholarship Fund, supporting underprivileged youth's education in the community. Shannon's legacy lives on through the countless lives she touched, the values she upheld, and the love she shared. She will be deeply missed but forever cherished.
                `
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