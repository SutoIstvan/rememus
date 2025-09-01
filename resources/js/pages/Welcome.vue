<template>
  <div class="bg-background-2 dark:bg-background-5 overflow-x-hidden">
    <HeaderNavigation />
    <!-- Hero Section -->
    <section
      class="hero-section pt-[320px] md:pt-[200px] lg:pt-[200px] xl:pt-[220px] bg-[url('/images/front/hero-bg.png')] bg-no-repeat bg-cover bg-top relative z-0"
    >
      <!-- Hero Title Content -->
      <div
        class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 flex flex-col items-center space-y-[124px] relative z-10 mb-[100px] lg:mb-[150px] xl:mb-[220px]"
      >
        <!-- Дополнительный контент можно добавить здесь -->
      </div>

      <!-- Hero Bottom Item -->
      <div class="w-full bg-white dark:bg-black">
        <div class="relative z-0">
          <div class="relative w-full bg-gradient-to-t from-white dark:from-background-8 from-50% to-transparent"></div>
          <div class="flex flex-col lg:flex-row">
            <!-- Image Section -->
            <div class="lg:flex-1/3 lg:pe-[42px]">
              <div 
                v-scroll-animate="{ direction: 'left', delay: 200 }"
                class="relative h-full max-lg:max-w-[525px] max-lg:mx-auto"
              >
                <figure
                  class="shadow-lg lg:absolute lg:right-0 lg:bottom-0 max-w-[300px] max-lg:mx-auto bg-white dark:bg-background-9 rounded-[20px] overflow-hidden p-2"
                >
                  <img 
                    :src="person.image" 
                    :alt="person.name"
                    class="w-[300px] h-[300px] object-cover rounded-[20px] lg:w-[400px] lg:h-[400px]" 
                  />
                </figure>
              </div>
            </div>
            
            <!-- Person Info Section -->
            <div class="lg:flex-1/2 pt-[30px] max-lg:px-5 max-lg:text-center">
              <div 
                v-scroll-animate="{ delay: 200 }"
                class="mb-6"
              >
                <h2 class="mb-3">{{ person.name }}</h2>
              </div>
              
              <ul class="list-none space-y-2 mb-14">
                <!-- Birth/Death Dates -->
                <li 
                  v-scroll-animate="{ delay: 200 }"
                  class="flex items-center gap-3 mb-3 justify-center lg:justify-start"
                >
                  <CalendarIcon />
                  <p class="text-secondary dark:text-accent">
                    {{ person.birthYear }} - {{ person.deathYear }}
                  </p>
                </li>
                
                <!-- Location -->
                <li 
                  v-scroll-animate="{ delay: 200 }"
                  class="flex items-center gap-3 mb-3 justify-center lg:justify-start"
                >
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

        <!-- Feature/Memorial Section -->
    <section
      class="pt-16 md:pt-20 lg:pt-[70px] xl:pt-[80px] pb-16 md:pb-20 lg:pb-[90px] xl:pb-[100px] bg-white dark:bg-black"
    >
      <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center space-y-5 mx-auto mb-10 md:mb-[70px]">
          <span 
            v-scroll-animate="{ delay: 200 }"
            class="badge badge-green"
          >
            {{ memorial.badgeText }}
          </span>
          
          <section class="max-w-2xl mx-auto mt-1">
            <!-- Additional content можно добавить здесь -->
          </section>
          
          <div class="text-gray-700">
            <h4 
              v-scroll-animate="{ delay: 250 }"
              class="mb-3 max-w-[700px] mx-auto text-center mb-10"
            >
              {{ memorial.quote }}
            </h4>
            <p 
              v-scroll-animate="{ delay: 300 }"
              class="dropcap text-start text-lg" 
              v-html="memorial.description"
            >
            </p>
          </div>
        </div>
      </div>
    </section>

    <Gallery />


    <FamilyTree />

    <!-- Feature/Memorial Section -->
    <section
      class="pt-16 md:pt-20 lg:pt-[70px] xl:pt-[80px] pb-16 md:pb-20 lg:pb-[90px] xl:pb-[100px] bg-white dark:bg-black"
    >
      <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center space-y-5 mx-auto mb-10 md:mb-[70px]">
          <span 
            v-scroll-animate="{ delay: 200 }"
            class="badge badge-green"
          >
            {{ memorial.badgeText }}
          </span>
          
          <section class="max-w-2xl mx-auto mt-1">
            <!-- Additional content можно добавить здесь -->
          </section>
          
          <div class="text-gray-700">
            <h4 
              v-scroll-animate="{ delay: 250 }"
              class="mb-3 max-w-[700px] mx-auto text-center mb-10"
            >
              {{ memorial.quote }}
            </h4>
            <p 
              v-scroll-animate="{ delay: 300 }"
              class="dropcap text-start text-lg" 
              v-html="memorial.description"
            >
            </p>
          </div>
        </div>
      </div>
    </section>

    

    
  </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3'
import CalendarIcon from '@/Components/Icons/CalendarIcon.vue'
import ClockIcon from '@/Components/Icons/ClockIcon.vue'
import HeaderNavigation from '@/components/icons/HeaderNavigation.vue'
import Gallery from '@/components/icons/Gallery.vue'
import FamilyTree from './FamilyTree.vue'

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
  },
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
</script>

<!-- <style scoped>
/* Добавь кастомные стили если нужно */
.badge {
  display: inline-flex;
  align-items: center;
  padding: 0.25rem 0.75rem;
  border-radius: 9999px;
  font-size: 0.875rem;
  font-weight: 500;
}

.badge-green {
  background-color: rgb(220 252 231);
  color: rgb(22 163 74);
}

@media (prefers-color-scheme: dark) {
  .badge-green {
    background-color: rgb(20 83 45);
    color: rgb(187 247 208);
  }
}

.dropcap::first-letter {
  float: left;
  font-size: 3.75rem;
  font-weight: 700;
  line-height: 1;
  padding-right: 0.5rem;
  padding-top: 0.25rem;
}

.badge {
  @apply inline-flex items-center px-3 py-1 rounded-full text-sm font-medium;
}

.badge-green {
  @apply bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200;
}

.dropcap::first-letter {
  @apply float-left text-6xl font-bold leading-none pr-2 pt-1;
}
</style> -->