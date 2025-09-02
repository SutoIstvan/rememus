<template>
  <header>
    <div
      v-scroll-animate="{ direction: 'up', offset: 100 }"
      class="header-one opacity-0 rounded-full lp:!max-w-[1290px] xl:max-w-[1140px] lg:max-w-[960px] md:max-w-[720px] sm:max-w-[540px] min-[500px]:max-w-[450px] min-[425px]:max-w-[375px] max-w-[320px] mx-auto w-full fixed left-1/2 -translate-x-1/2 z-50 top-5 flex items-center justify-between px-2.5 xl:py-0 py-2.5 bg-accent/60 border border-stroke-2 dark:border-stroke-6 dark:bg-background-9 backdrop-blur-lg"
    >
      <!-- Logo Section -->
      <div>
        <Link :href="'/dashboard'">
          <span class="sr-only">Home</span>
          <!-- <figure class="lg:max-w-[198px] lg:block hidden">
            <img 
              :src="logos.main" 
              alt="Rememus.com" 
              class="dark:invert" 
            />
          </figure> -->
          <figure class="max-w-[44px] flex items-center">
            <img 
              :src="logos.small" 
              alt="Rememus.com" 
              class="w-full dark:hidden block" 
            />
            <img 
              :src="logos.smallDark" 
              alt="Rememus.com" 
              class="w-full dark:block hidden" 
            />
            <div class="ms-2 text-xl">
              Rememus<span class="text-gray-500">.com</span>
            </div>
          </figure>
        </Link>
      </div>

      <!-- Desktop Navigation -->
      <nav class="hidden xl:flex items-center">
        <ul class="flex items-center">
          <li v-for="(item, index) in navigationItems" :key="index" class="py-2.5">
            <Link
              href="/dashboard"
              class="flex items-center gap-1 px-4 py-2 border border-transparent hover:border-stroke-2 dark:hover:border-stroke-7 rounded-full text-tagline-1 font-normal text-secondary/60 hover:text-secondary transition-all duration-200 dark:text-accent/60 dark:hover:text-accent"
            >
              {{ item.label }}
            </Link>
          </li>
        </ul>
      </nav>

      <!-- Desktop CTA Button -->
      <div class="xl:flex hidden items-center justify-center">
        <Link 
          href="/register" 
          class="btn btn-md btn-secondary hover:btn-primary dark:btn-accent"
        >
          <span>{{ ctaButton.text }}</span>
        </Link>
      </div>

      <!-- Mobile Menu Button -->
      <div class="xl:hidden block">
        <button
          @click="toggleMobileMenu"
          class="nav-hamburger flex flex-col gap-[5px] size-12 bg-background-4 dark:bg-background-6 rounded-full items-center justify-center cursor-pointer"
          :class="{ 'active': isMobileMenuOpen }"
        >
          <span class="sr-only">Menu</span>
          <span 
            class="block w-6 h-0.5 bg-stroke-9 dark:bg-stroke-1 transition-all duration-300"
            :class="{ 'rotate-45 translate-y-2': isMobileMenuOpen }"
          ></span>
          <span 
            class="block w-6 h-0.5 bg-stroke-9 dark:bg-stroke-1 transition-all duration-300"
            :class="{ 'opacity-0': isMobileMenuOpen }"
          ></span>
          <span 
            class="block w-6 h-0.5 bg-stroke-9 dark:bg-stroke-1 transition-all duration-300"
            :class="{ '-rotate-45 -translate-y-2': isMobileMenuOpen }"
          ></span>
        </button>
      </div>
    </div>

    <!-- Mobile Menu -->
    <Transition name="mobile-menu">
      <div v-if="isMobileMenuOpen" class="fixed inset-0 z-40 xl:hidden">
        <!-- Backdrop -->
        <div @click="toggleMobileMenu" class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>
        
        <!-- Menu Panel -->
        <div class="fixed top-[100px] left-1/2 -translate-x-1/2 w-[90%] max-w-md bg-white dark:bg-background-9 rounded-2xl border border-stroke-2 dark:border-stroke-6 p-6 shadow-xl">
          <nav>
            <ul class="space-y-4">
              <li v-for="(item, index) in navigationItems" :key="index">
                <Link
                  href="/dashboard"
                  @click="toggleMobileMenu"
                  class="flex items-center gap-3 px-4 py-3 rounded-xl text-secondary hover:bg-background-3 dark:text-accent dark:hover:bg-background-8 transition-all duration-200"
                >
                  <component v-if="item.icon" :is="item.icon" class="w-5 h-5" />
                  <span>{{ item.label }}</span>
                </Link>
              </li>
            </ul>
            
            <!-- Mobile CTA -->
            <div class="mt-6 pt-6 border-t border-stroke-2 dark:border-stroke-6">
              <Link 
                href="/register" 
                @click="toggleMobileMenu"
                class="btn btn-md btn-secondary hover:btn-primary dark:btn-accent w-full justify-center"
              >
                <span>{{ ctaButton.text }}</span>
              </Link>
            </div>
          </nav>
        </div>
      </div>
    </Transition>
  </header>
</template>

<script setup>
import { ref, watch } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

// Mobile menu state
const isMobileMenuOpen = ref(false)

// Props
const props = defineProps({
  navigationItems: {
    type: Array,
    default: () => [
      { label: 'History', route: 'history' },
      { label: 'Gallery', route: 'gallery' },
      { label: 'Timelines', route: 'timelines' },
      { label: 'Family tree', route: 'family-tree' },
      { label: 'Commemorations', route: 'commemorations' },
      { label: 'Contact Us', route: 'contact' }
    ]
  },
  logos: {
    type: Object,
    default: () => ({
      main: '/images/front/shared/main-logo-4.png',
      small: '/images/front/shared/logo.png',
      smallDark: '/images/front/shared/logo-dark.svg'
    })
  },
  ctaButton: {
    type: Object,
    default: () => ({
      text: 'Edit',
      route: 'register'
    })
  }
})

const page = usePage()

// Mobile menu toggle
const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value
}

// Close mobile menu on route change
watch(() => page.url, () => {
  isMobileMenuOpen.value = false
})

// Animation directive
const vScrollAnimate = {
  mounted(el, binding) {
    const { delay = 0, direction = 'up', offset = 100 } = binding.value || {}
    el.style.opacity = '0'
    el.style.transition = 'all 0.6s ease-out'
    switch (direction) {
      case 'up': el.style.transform = 'translateY(30px)'; break
      case 'down': el.style.transform = 'translateY(-30px)'; break
      case 'left': el.style.transform = 'translateX(-30px)'; break
      case 'right': el.style.transform = 'translateX(30px)'; break
    }
    if (delay > 0) el.style.transitionDelay = `${delay}ms`
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
      { root: null, rootMargin: `0px 0px -${offset}px 0px`, threshold: 0.1 }
    )
    observer.observe(el)
    el._observer = observer
  },
  unmounted(el) {
    if (el._observer) el._observer.disconnect()
  }
}
</script>


<!-- <style scoped>
/* Mobile menu transitions */
.mobile-menu-enter-active {
  transition: all 0.3s ease-out;
}

.mobile-menu-leave-active {
  transition: all 0.2s ease-in;
}

.mobile-menu-enter-from {
  opacity: 0;
  transform: scale(0.95) translateY(-20px);
}

.mobile-menu-leave-to {
  opacity: 0;
  transform: scale(0.95) translateY(-20px);
}

/* Button styles - если не определены в основном CSS */
.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0.5rem 1rem;
  border-radius: 9999px;
  font-weight: 500;
  text-decoration: none;
  transition: all 0.2s;
  border: 1px solid transparent;
}

.btn-md {
  padding: 0.625rem 1.5rem;
  font-size: 0.875rem;
}

.btn-secondary {
  background-color: rgb(243 244 246);
  color: rgb(55 65 81);
  border-color: rgb(209 213 219);
}

.btn-secondary:hover,
.btn-primary {
  background-color: rgb(59 130 246);
  color: white;
  border-color: rgb(59 130 246);
}

@media (prefers-color-scheme: dark) {
  .btn-accent {
    background-color: rgb(34 197 94);
    color: rgb(22 163 74);
    border-color: rgb(34 197 94);
  }
}

/* Hamburger animation */
.nav-hamburger.active span:first-child {
  transform: rotate(45deg) translateY(8px);
}

.nav-hamburger.active span:nth-child(2) {
  opacity: 0;
}

.nav-hamburger.active span:last-child {
  transform: rotate(-45deg) translateY(-8px);
}
</style> -->