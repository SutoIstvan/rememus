<template>
  <div class="container">
    <div 
      v-for="(feature, index) in features" 
      :key="index"
      class="feature-item"
    >
      <div 
        class="feature-content"
        :class="{ 'reverse': feature.reverse }"
      >
        <!-- Text Section -->
        <div class="text-section desktop-only">
                      <p class="text-muted-foreground mb-3 text-sm">January 15, 2024</p>

          <h3 class="title">{{ feature.title }}</h3>
          <p class="description" :class="{ 'ml-auto': !feature.reverse }">
            {{ feature.description }}
          </p>
        </div>

        <!-- Icon Badge -->
        <div class="icon-badge">
          <div class="icon-container">
            <div class="icon-wrapper">
              <component :is="feature.icon" class="icon" />
            </div>
          </div>
        </div>

        <!-- Image Section -->
        <div class="image-section">
          <!-- Mobile Text -->
          <div class="text-section mobile-only">
            <p class="text-muted-foreground lg:mt-10 text-sm">January 15, 2024</p>
            <h3 class="title">{{ feature.title }}</h3>
            <p class="description">{{ feature.description }}</p>
          </div>

          <!-- Image Container -->
          <div class="image-container" :class="{ 'ml-auto': feature.reverse }">
            <div :class="{ 'icon-container image-grid lg:ml-auto': feature.reverse }">
              <img 
                :src="feature.image" 
                :alt="feature.title"
                class="feature-image"
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
export default {
  name: 'TimelineFeatures',
  data() {
    return {
      features: [
        {
          title: 'Get Organized',
          description: 'Start strong by syncing your calendars and tools like Google Calendar, Trello, and Slack in one place.',
          icon: 'IconLayoutList',
          image: 'https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?w=400&h=500&fit=crop',
          reverse: false,
          lineClass: 'line-fade-top'
        },
        {
          title: 'Track Progress',
          description: 'Monitor your performance with real-time dashboards and detailed analytics. Stay ahead with automated reports.',
          icon: 'IconLocateFixed',
          image: 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=500&fit=crop',
          reverse: true,
          lineClass: ''
        },
        {
          title: 'Collaborate Seamlessly',
          description: 'Empower your team with shared dashboards and instant communication tools. Keep everyone aligned with integrated platforms.',
          icon: 'IconUsers',
          image: 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=400&h=500&fit=crop',
          reverse: false,
          lineClass: ''
        },
        {
          title: 'Integrate Seamlessly',
          description: 'Integrate seamlessly across multiple platforms to enable smooth, automated task handovers.',
          icon: 'IconCpu',
          image: 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=400&h=500&fit=crop',
          reverse: true,
          lineClass: 'line-fade-bottom'
        }
      ]
    };
  },
  components: {
    IconLayoutList: {
      template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect width="7" height="7" x="3" y="3" rx="1"></rect>
          <rect width="7" height="7" x="3" y="14" rx="1"></rect>
          <path d="M14 4h7"></path>
          <path d="M14 9h7"></path>
          <path d="M14 15h7"></path>
          <path d="M14 20h7"></path>
        </svg>
      `
    },
    IconLocateFixed: {
      template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="2" x2="5" y1="12" y2="12"></line>
          <line x1="19" x2="22" y1="12" y2="12"></line>
          <line x1="12" x2="12" y1="2" y2="5"></line>
          <line x1="12" x2="12" y1="19" y2="22"></line>
          <circle cx="12" cy="12" r="7"></circle>
          <circle cx="12" cy="12" r="3"></circle>
        </svg>
      `
    },
    IconUsers: {
      template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
          <path d="M16 3.128a4 4 0 0 1 0 7.744"></path>
          <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
          <circle cx="9" cy="7" r="4"></circle>
        </svg>
      `
    },
    IconCpu: {
      template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 20v2"></path>
          <path d="M12 2v2"></path>
          <path d="M17 20v2"></path>
          <path d="M17 2v2"></path>
          <path d="M2 12h2"></path>
          <path d="M2 17h2"></path>
          <path d="M2 7h2"></path>
          <path d="M20 12h2"></path>
          <path d="M20 17h2"></path>
          <path d="M20 7h2"></path>
          <path d="M7 20v2"></path>
          <path d="M7 2v2"></path>
          <rect x="4" y="4" width="16" height="16" rx="2"></rect>
          <rect x="8" y="8" width="8" height="8" rx="1"></rect>
        </svg>
      `
    }
  }
};
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
  /* height: auto; */
  object-fit: cover;
  border-radius: 5px;
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