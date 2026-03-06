<template>
    <section class="pt-[30px] md:pt-10 lg:pt-[70px] xl:pt-[80px] pb-16 bg-white dark:bg-[#0a0a0a]">
        <div class="lp:!max-w-[1290px] xl:max-w-[1140px] lg:max-w-[960px] mx-auto px-4 md:px-6 lg:px-8">

            <!-- Section Badge -->
            <div class="text-center space-y-5 mx-auto mb-10">
                <span class="badge badge-green">Commemorations</span>
            </div>

            <!-- Comments disabled -->
            <div v-if="!commentsEnabled" class="text-center text-gray-400 py-10 text-sm">
                Commemorations for this memorial are disabled.
            </div>

            <template v-else>
                <!-- Empty state -->
                <div v-if="!comments.length" class="flex flex-col items-center justify-center py-14 gap-4">
                    <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                        <MessageCircle class="w-7 h-7 text-gray-400" />
                    </div>
                    <p class="text-gray-500 text-sm">No Commemorations yet. <strong>Be the first!</strong></p>
                    <button @click="openModal" class="btn-comment">Leave a Commemoration</button>
                </div>

                <!-- Comments list -->
                <div v-else class="mb-10">
                    <!-- 3-column masonry с правильным порядком чтения (1,2,3/4,5,6) -->
                    <div class="flex gap-4 items-start">
                        <div v-for="(col, colIdx) in masonryColumns" :key="colIdx" class="flex flex-col gap-4 flex-1">
                            <div v-for="comment in col" :key="comment.id" class="comment-card">
                                <div class="comment-inner">
                                    <!-- Строка 1: аватар + имя + дата -->
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="comment-avatar">{{ initials(comment.name) }}</div>
                                        <div>
                                            <p class="comment-name">{{ comment.name }}</p>
                                            <p class="comment-date">{{ formatDate(comment.created_at) }}</p>
                                        </div>
                                    </div>
                                    <!-- Строка 2: текст обтекает фото (float right) -->
                                    <div class="comment-body">
                                        <FancyboxWrapper v-if="resolvePhoto(comment)">
                                            <a :href="resolvePhoto(comment) || undefined"
                                                :data-fancybox="`comment-${comment.id}`" :data-caption="comment.name"
                                                class="comment-photo-wrap block overflow-hidden rounded-lg group cursor-pointer">
                                                <img :src="resolvePhotoThumb(comment) || undefined" :alt="comment.name"
                                                    loading="lazy"
                                                    class="comment-photo transform group-hover:scale-105 transition-transform duration-500 ease-out" />
                                            </a>
                                        </FancyboxWrapper>
                                        <p class="comment-text">{{ comment.content }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Load more + Leave a Commemoration -->
                    <div class="flex flex-col items-center gap-3 pt-6">
                        <button v-if="visibleCount < comments.length" @click="loadMore" class="btn-load-more">
                            Load more ({{ comments.length - visibleCount }} remaining)
                        </button>
                        <button @click="openModal" class="btn-comment">Leave a Commemoration</button>
                    </div>
                </div>
            </template>

        </div>

        <!-- Modal -->
        <Dialog :open="showModal" @update:open="showModal = $event">
            <DialogContent class="sm:max-w-[500px]">
                <div class="flex flex-col space-y-1.5 text-center sm:text-left">
                    <DialogTitle class="text-lg font-semibold leading-none tracking-tight">Leave a Commemoration</DialogTitle>
                    <DialogDescription class="sr-only">Form to leave a commemoration</DialogDescription>
                </div>

                <!-- Success message -->
                <div v-if="submitted" class="success-banner my-4">
                    ✅ Thank you! Your comment has been submitted for moderation.
                </div>

                <form v-else @submit.prevent="submitComment" class="space-y-4 py-4">
                    <!-- Name -->
                    <div class="space-y-2">
                        <Input v-model="form.name" type="text" placeholder="Your name *" required maxlength="255" />
                    </div>

                    <!-- Content -->
                    <div class="space-y-2">
                        <textarea v-model="form.content" class="flex min-h-[100px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                            placeholder="Share your memories... *" required maxlength="2000" rows="4"></textarea>
                    </div>

                    <!-- Photo upload -->
                    <div class="space-y-2">
                        <div class="flex flex-col gap-3">
                            <div class="relative">
                                <input ref="photoInput" type="file" accept="image/*" @change="onPhotoChange"
                                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 pr-10 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" />
                                <Button variant="ghost" size="icon"
                                    class="absolute top-1/2 right-2 size-8 -translate-y-1/2 pointer-events-none">
                                    <ImageIcon class="w-4 h-4 text-gray-500" />
                                    <span class="sr-only">Photo</span>
                                </Button>
                            </div>

                            <div v-if="photoPreview" class="relative">
                                <img :src="photoPreview" class="rounded-lg max-h-28 w-full object-cover border" alt="Preview" />
                                <button type="button" @click="removePhoto" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 opacity-80 hover:opacity-100">
                                    <X class="w-4 h-4" />
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Error -->
                    <p v-if="error" class="text-sm font-medium text-red-500">{{ error }}</p>

                    <!-- Submit -->
                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2 pt-1">
                        <Button type="button" variant="outline" @click="closeModal" class="mt-2 sm:mt-0">
                            Cancel
                        </Button>
                        <Button type="submit" :disabled="loading">
                            {{ loading ? 'Sending...' : 'Send' }}
                        </Button>
                    </div>
                </form>
            </DialogContent>
        </Dialog>
    </section>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import { MessageCircle, X, Image as ImageIcon } from 'lucide-vue-next'
import axios from 'axios'
import FancyboxWrapper from '@/components/Fancybox.vue'

import { Dialog, DialogContent, DialogDescription, DialogTitle } from '@/components/ui/dialog'
import { Input } from '@/components/ui/input'
import { Button } from '@/components/ui/button'

const props = defineProps<{
    comments: any[]
    commentsEnabled: boolean
    memorialSlug: string
}>()

// ── Pagination ────────────────────────────────────────────────
const PAGE_SIZE = 6
const visibleCount = ref(PAGE_SIZE)
const sortedComments = computed(() =>
    [...props.comments].sort((a, b) =>
        new Date(b.created_at).getTime() - new Date(a.created_at).getTime()
    )
)
const NUM_COLS = 3
const visibleComments = computed(() => sortedComments.value.slice(0, visibleCount.value))

// Распределяем комментарии по колонкам в порядке чтения (1,2,3 / 4,5,6)
// Элемент с индексом i попадает в колонку i % NUM_COLS
const masonryColumns = computed(() => {
    const cols: any[][] = Array.from({ length: NUM_COLS }, () => [])
    visibleComments.value.forEach((comment: any, i: number) => {
        cols[i % NUM_COLS].push(comment)
    })
    return cols
})
function loadMore() {
    visibleCount.value += PAGE_SIZE
}

// ── Modal state ────────────────────────────────────────────────
const showModal = ref(false)
const submitted = ref(false)
const loading = ref(false)
const error = ref('')

const form = ref({ name: '', content: '', photo: null as File | null })
const photoPreview = ref<string>('')
const photoInput = ref<HTMLInputElement | null>(null)

function triggerPhotoInput() {
    if (photoInput.value) photoInput.value.click()
}
function openModal() {
    showModal.value = true
    submitted.value = false
    error.value = ''
}
function closeModal() {
    showModal.value = false
}

// ── Photo ─────────────────────────────────────────────────────
function onPhotoChange(e: Event) {
    const file = (e.target as HTMLInputElement).files?.[0]
    if (!file) return
    form.value.photo = file
    photoPreview.value = URL.createObjectURL(file)
}
function removePhoto() {
    form.value.photo = null
    photoPreview.value = ''
    if (photoInput.value) photoInput.value.value = ''
}

// ── Submit ────────────────────────────────────────────────────
async function submitComment() {
    if (!form.value.name.trim() || !form.value.content.trim()) {
        error.value = 'Пожалуйста, заполните имя и комментарий.'
        return
    }
    error.value = ''
    loading.value = true

    try {
        const data = new FormData()
        data.append('name', form.value.name)
        data.append('content', form.value.content)
        if (form.value.photo) data.append('photo', form.value.photo)

        await axios.post(`/memorial/${props.memorialSlug}/comments`, data, {
            headers: { 'Content-Type': 'multipart/form-data' },
        })

        submitted.value = true
        form.value = { name: '', content: '', photo: null }
        photoPreview.value = ''
        if (photoInput.value) photoInput.value.value = ''
    } catch (e: any) {
        const msg = e.response?.data?.message || e.message || 'Произошла ошибка. Попробуйте ещё раз.'
        error.value = msg
    } finally {
        loading.value = false
    }
}

// ── Helpers ───────────────────────────────────────────────────
function resolvePhoto(comment: any): string | null {
    const p = comment.photo
    if (!p || p === 'null') return null
    if (p.startsWith('http') || p.startsWith('/storage')) return p
    if (p.startsWith('storage/')) return '/' + p
    return `/storage/${p}`
}

function resolvePhotoThumb(comment: any): string | null {
    const t = comment.photo_thumb
    if (t && t !== 'null') {
        if (t.startsWith('http') || t.startsWith('/storage')) return t
        if (t.startsWith('storage/')) return '/' + t
        return `/storage/${t}`
    }
    // Fallback to full photo
    return resolvePhoto(comment)
}

function initials(name: string): string {
    return name
        .split(' ')
        .slice(0, 2)
        .map((w) => w[0]?.toUpperCase() ?? '')
        .join('')
}

function formatDate(dateStr: string): string {
    if (!dateStr) return ''
    return new Date(dateStr).toLocaleDateString('en-US', {
        day: '2-digit', month: 'long', year: 'numeric',
    })
}
</script>

<style scoped>
/* ── Comment card ──────────────────────────────────────────── */
.comment-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
}

.comment-inner {
    padding: 1.25rem;
}

/* clearfix-контейнер для обтекания текста вокруг фото */
.comment-body::after {
    content: '';
    display: table;
    clear: both;
}

.comment-photo-wrap {
    float: right;
    margin-left: 0.75rem;
    margin-bottom: 0.25rem;
    width: 90px;
    height: 90px;
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
}

.comment-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.comment-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    flex-shrink: 0;
}

.comment-name {
    font-size: 14px;
    font-weight: 600;
    color: #111827;
}

.comment-date {
    font-size: 12px;
    color: #9ca3af;
}

.comment-text {
    font-size: 14px;
    color: #4b5563;
    line-height: 1.6;
    white-space: pre-wrap;
}

/* ── Buttons ────────────────────────────────────────────────── */
.btn-comment {
    background: #111827;
    color: white;
    font-size: 14px;
    padding: 0.6rem 1.5rem;
    border-radius: 999px;
    border: none;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-comment:hover {
    background: #374151;
}

.btn-load-more {
    background: transparent;
    color: #6b7280;
    font-size: 13px;
    padding: 0.5rem 1.25rem;
    border-radius: 999px;
    border: 1px solid #e5e7eb;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-load-more:hover {
    border-color: #9ca3af;
    color: #374151;
    background: #f9fafb;
}

</style>
