<template>
    <div class="container">
        <div v-for="(feature, index) in features" :key="feature.id ?? index" class="feature-item">
            <div class="feature-content" :class="{ 'reverse': feature.reverse }">
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
                <div class="icon-badge-wrapper">
                    <div class="icon-badge">
                        <div class="icon-container">
                            <div class="icon-wrapper">
                                <component :is="resolveIcon(feature)" class="icon" />
                            </div>
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
                            <img v-if="resolveImage(feature)" :src="resolveImage(feature)" :alt="feature.title"
                                class="feature-image rounded-lg" />
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
    Baby,
    GraduationCap,
    Briefcase,
    Heart,
    FileText,
    Star,
} from 'lucide-vue-next'

export default {
    name: 'TimelineViewFeatures',

    props: {
        features: {
            type: Array,
            required: true,
            default: () => [],
        },
    },

    methods: {
        /* ===== ДАТА ===== */
        formatDate(feature) {
            if (feature.date) {
                return this.formatSingleDate(feature.date)
            }
            if (feature.date_from && feature.date_to) {
                return `${this.formatSingleDate(feature.date_from)} – ${this.formatSingleDate(feature.date_to)}`
            }
            if (feature.date_from) {
                return this.formatSingleDate(feature.date_from)
            }
            return 'нет выбраной даты'
        },

        formatSingleDate(dateString) {
            if (!dateString) return ''
            const dateOnly = dateString.split('T')[0]
            const [year, month, day] = dateOnly.split('-').map(Number)
            const date = new Date(year, month - 1, day)
            if (isNaN(date.getTime())) return dateString
            return date.toLocaleDateString('ru-RU', {
                day: '2-digit',
                month: 'long',
                year: 'numeric',
            })
        },

        /* ===== ИКОНКА ===== */
        resolveIcon(feature) {
            const typeIconMap = {
                born: Star,
                birth_child: Baby,
                school: GraduationCap,
                work: Briefcase,
                wedding: Heart,
                other: FileText,
            }
            if (!feature) return FileText
            if (feature.type && typeIconMap[feature.type]) return typeIconMap[feature.type]
            return FileText
        },

        /* ===== ИЗОБРАЖЕНИЕ ===== */
        resolveImage(feature) {
            const src = feature.image || feature.media
            if (!src) return null
            if (src instanceof File) return URL.createObjectURL(src)
            if (typeof src === 'string') {
                if (src.startsWith('http')) return src
                if (src.startsWith('/storage')) return src
                if (src.startsWith('storage/')) return '/' + src
                return `/storage/${src}`
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
    padding-bottom: 1rem;
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
    padding-bottom: 0.5rem;
    text-align: end;
    gap: 2.5rem;
}

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

.icon-badge-wrapper {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
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

.image-grid {
    display: grid;
    grid-template-columns: auto 1fr auto;
    align-items: stretch;
}

.feature-image {
    width: 465px;
    height: 265px;
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

@media (min-width: 1024px) {
    .container {
        padding-top: 5rem;
    }

    .feature-content {
        gap: 2.5rem;
    }

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

    .timeline-line {
        left: 50%;
        transform: translateX(-50%);
    }
}
</style>
