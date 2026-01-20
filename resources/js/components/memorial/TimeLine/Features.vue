<template>
  <div class="container">
    <div 
      v-for="(feature, index) in features" 
      :key="feature.id ?? index"
      class="feature-item"
    >
      <div 
        class="feature-content"
        :class="{ 'reverse': feature.reverse }"
      >
        <!-- Text Section -->
        <div class="text-section desktop-only">
          <p class="text-muted-foreground mb-3 text-sm">
            {{ formatDate(feature) }}
          </p>

          <h3 class="title">{{ feature.title }}</h3>
          <p class="description" :class="{ 'ml-auto': !feature.reverse }">
            {{ feature.description }}
          </p>
        </div>

        <!-- Icon Badge -->
        <div class="icon-badge">
          <div class="icon-container">
            <div class="icon-wrapper">
              <component :is="resolveIcon(feature)" class="icon" />
            </div>
          </div>
        </div>

        <!-- Image Section -->
        <div class="image-section">
          <!-- Mobile Text -->
          <div class="text-section mobile-only">
            <p class="text-muted-foreground lg:mt-10 text-sm">
              {{ formatDate(feature) }}
            </p>
            <h3 class="title">{{ feature.title }}</h3>
            <p class="description">{{ feature.description }}</p>
          </div>

          <!-- Image Container -->
          <div class="image-container" :class="{ 'ml-auto': feature.reverse }">
            <div :class="{ 'image-grid lg:ml-auto': feature.reverse }">
              <img 
                v-if="resolveImage(feature)"
                :src="resolveImage(feature)"
                :alt="feature.title"
                class="feature-image rounded-lg"
              />
            </div>
          </div>
        </div>
      </div>

      <!-- Timeline Line -->
      <div class="timeline-line" :class="feature.lineClass"></div>
    </div>
  </div>
</template>

<script>
import {
  LayoutList,
  LocateFixed,
  Users,
  Cpu,
} from 'lucide-vue-next'

export default {
  name: 'TimelineFeatures',

  props: {
    features: {
      type: Array,
      required: true,
      default: () => [],
    },
  },

  emits: ['edit', 'remove'],

  methods: {
    /* ===== ДАТА ===== */
formatDate(feature) {
  console.log('formatDate called with:', feature)
  console.log('All keys:', Object.keys(feature))
  console.log('date:', feature.date)
  console.log('date_from:', feature.date_from)
  console.log('date_to:', feature.date_to)
  
  // Приоритет 1: одиночная дата
  if (feature.date) {
    console.log('Using date:', feature.date)
    return this.formatSingleDate(feature.date)
  }

  // Приоритет 2: период (date_from - date_to)
  if (feature.date_from && feature.date_to) {
    console.log('Using range:', feature.date_from, feature.date_to)
    return `${this.formatSingleDate(feature.date_from)} – ${this.formatSingleDate(feature.date_to)}`
  }

  // Приоритет 3: только date_from
  if (feature.date_from) {
    console.log('Using date_from:', feature.date_from)
    return this.formatSingleDate(feature.date_from)
  }

  console.log('No date found')
  return ''
},

    formatSingleDate(dateString) {
      if (!dateString) return ''

      // Убираем время если оно есть, берем только дату
      const dateOnly = dateString.split('T')[0]
      
      // Разбиваем на части YYYY-MM-DD
      const [year, month, day] = dateOnly.split('-').map(Number)
      
      // Создаем дату без временной зоны
      const date = new Date(year, month - 1, day)

      // Проверка на валидность даты
      if (isNaN(date.getTime())) {
        console.warn('Invalid date:', dateString)
        return dateString
      }

      return date.toLocaleDateString('ru-RU', {
        day: '2-digit',
        month: 'long',
        year: 'numeric',
      })
    },

    /* ===== ИКОНКА ===== */
    resolveIcon(feature) {
      const map = {
        IconLayoutList: LayoutList,
        IconLocateFixed: LocateFixed,
        IconUsers: Users,
        IconCpu: Cpu,
      }

      // Маппинг типов событий на иконки
      const typeIconMap = {
        birth_child: Users,        // Рождение ребёнка
        school: LayoutList,        // Школа
        work: Cpu,                 // Работа
        wedding: Users,            // Свадьба
        other: LocateFixed,        // Другое
      }

      // Проверка на существование feature
      if (!feature) {
        return LayoutList
      }

      // Приоритет 1: тип события
      if (feature.type && typeIconMap[feature.type]) {
        return typeIconMap[feature.type]
      }

      // Приоритет 2: явно указанная иконка
      if (typeof feature.icon === 'string' && map[feature.icon]) {
        return map[feature.icon]
      }

      // По умолчанию
      return LayoutList
    },

    /* ===== ИЗОБРАЖЕНИЕ ===== */
    resolveImage(feature) {
      const src = feature.image || feature.media
      if (!src) return null

      if (src instanceof File) {
        return URL.createObjectURL(src)
      }

      if (typeof src === 'string') {
        return src
      }

      return null
    },
  },
}
</script>


<style scoped>
.container {
  max-width: 1200px;
  margin: 0 auto;
  overflow: hidden;
  padding-bottom: 10rem;
}

.feature-item {
  position: relative;
}

.feature-content {
  display: flex;
  width: 100%;
  justify-content: center;
  padding: 0.25rem;
  padding-top: 2.5rem;
  padding-bottom: 2.5rem;
  text-align: end;
  gap: 2.5rem;
}

/* На мобильных убираем reverse */
.text-section {
  flex: 1;
}

.desktop-only {
  display: none;
}

.mobile-only {
  text-align: start;
  margin-bottom: 2.5rem;
}

.title {
  font-size: 1.5rem;
  font-weight: 600;
  letter-spacing: -0.96px;
  margin-bottom: 0.625rem;
}

.description {
  color: #6b7280;
  max-width: 300px;
  letter-spacing: -0.32px;
  line-height: 1.5;
}

.ml-auto {
  margin-left: auto;
}

.icon-badge {
  background: white;
  z-index: 10;
  width: fit-content;
  height: fit-content;
  transform: translateY(-1.25rem);
  padding: 1rem;
}

.icon-container {
  background: #f9fafb;
  border: 1px solid #e5e7eb;
  border-radius: 10px;
  padding: 5px;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.icon-wrapper {
  background: #f3f4f6;
  border: 1px solid #e5e7eb;
  border-radius: 6px;
  padding: 0.25rem;
  width: fit-content;
}

.icon {
  width: 1rem;
  height: 1rem;
  flex-shrink: 0;
}

.image-section {
  flex: 1;
  transform: translateX(-1rem);
}

.image-container {
  display: flex;
  flex-direction: column;
}

.border-top,
.border-bottom {
  width: 100%;
  border: 2px dashed #e5e7eb;
  height: 1.5rem;
  background-image: url("data:image/svg+xml,%3Csvg width='7' height='7' viewBox='0 0 6 6' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23000000' fill-opacity='0.15' fill-rule='evenodd'%3E%3Cpath d='M5 0h1L0 6V5zM6 5v1H5z'/%3E%3C/g%3E%3C/svg%3E");
}

.image-grid {
  display: grid;
  grid-template-columns: auto 1fr auto;
  align-items: stretch;
}

.border-left,
.border-right {
  border: 2px dashed #e5e7eb;
  height: 100%;
  width: 1.5rem;
  background-image: url("data:image/svg+xml,%3Csvg width='7' height='7' viewBox='0 0 6 6' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23000000' fill-opacity='0.15' fill-rule='evenodd'%3E%3Cpath d='M5 0h1L0 6V5zM6 5v1H5z'/%3E%3C/g%3E%3C/svg%3E");
}

.feature-image {
  width: 400px;
  height: 250px;
  max-width: 100%;
  object-fit: cover;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.timeline-line {
  position: absolute;
  z-index: 1;
  height: 100%;
  width: 3px;
  left: 2.3rem;
  top: 0;
  border-radius: 9999px;
  background: rgba(0, 0, 0, 0.1);
}

.line-fade-top::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 3px;
  height: 1rem;
  transform: translateY(-100%);
  background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.1));
}

.line-fade-bottom {
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1), transparent);
}

/* Десктопные стили - применяем reverse только здесь */
@media (min-width: 1024px) {
  .container {
    padding-top: 5rem;
  }

  .feature-content {
    gap: 2.5rem;
  }

  /* Reverse применяется только на десктопе */
  .feature-content.reverse {
    flex-direction: row-reverse;
    text-align: start;
  }

  .desktop-only {
    display: block;
  }

  .mobile-only {
    display: none;
  }

  .text-section {
    padding-top: 0.5rem;
  }

  .icon-badge {
    transform: translateX(0) translateY(-1.25rem);
  }

  .image-section {
    transform: translateX(0);
  }

  .border-top,
  .border-bottom {
    height: 2.5rem;
    padding-left: 2.5rem;
    padding-right: 2.5rem;
  }

  .border-left,
  .border-right {
    width: 2.5rem;
  }

  .timeline-line {
    left: 50%;
    transform: translateX(-50%);
  }
}
</style>