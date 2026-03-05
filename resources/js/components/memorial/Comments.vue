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
        <Transition name="modal">
            <div v-if="showModal" class="modal-overlay" @click.self="closeModal">
                <div class="modal-box">
                    <div class="modal-header">
                        <h3 class="modal-title">Leave a Commemoration</h3>
                        <button @click="closeModal" class="modal-close">
                            <X class="w-5 h-5" />
                        </button>
                    </div>

                    <!-- Success message -->
                    <div v-if="submitted" class="success-banner">
                        ✅ Thank you! Your comment has been submitted for moderation.
                    </div>

                    <form v-else @submit.prevent="submitComment" class="modal-form">
                        <!-- Name -->
                        <div class="form-group">
                            <label class="form-label">Your name *</label>
                            <input v-model="form.name" type="text" class="form-input" placeholder="Иван Иванов" required
                                maxlength="255" />
                        </div>

                        <!-- Content -->
                        <div class="form-group">
                            <label class="form-label">Your Commemoration *</label>
                            <textarea v-model="form.content" class="form-input form-textarea"
                                placeholder="Share your memories..." required maxlength="2000" rows="4" />
                        </div>

                        <!-- Photo upload -->
                        <div class="form-group">
                            <label class="form-label"> Photo (optional)</label>
                            <div class="photo-upload-area" @click="triggerPhotoInput">
                                <img v-if="photoPreview" :src="photoPreview" class="photo-preview-img" alt="preview" />
                                <div v-else class="photo-upload-placeholder">
                                    <ImageIcon class="w-6 h-6 text-gray-400 mx-auto mb-1" />
                                    <span class="text-xs text-gray-400">Click to upload photo</span>
                                </div>
                            </div>
                            <input ref="photoInput" type="file" accept="image/*" class="hidden"
                                @change="onPhotoChange" />
                            <button v-if="form.photo" type="button" @click="removePhoto" class="remove-photo-btn">×
                                Remove photo</button>
                        </div>

                        <!-- Error -->
                        <p v-if="error" class="form-error">{{ error }}</p>

                        <!-- Submit -->
                        <button type="submit" class="btn-submit" :disabled="loading">
                            <span v-if="loading" class="loading-dots">Sending...</span>
                            <span v-else>Send</span>
                        </button>
                    </form>
                </div>
            </div>
        </Transition>
    </section>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import { MessageCircle, X, Image as ImageIcon } from 'lucide-vue-next'
import axios from 'axios'
import FancyboxWrapper from '@/components/Fancybox.vue'

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
    if (!p) return null
    if (p.startsWith('http') || p.startsWith('/storage')) return p
    if (p.startsWith('storage/')) return '/' + p
    return `/storage/${p}`
}

function resolvePhotoThumb(comment: any): string | null {
    const t = comment.photo_thumb
    if (t) {
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

/* ── Modal ──────────────────────────────────────────────────── */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.modal-box {
    background: white;
    border-radius: 16px;
    width: 100%;
    max-width: 520px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #f3f4f6;
}

.modal-title {
    font-size: 16px;
    font-weight: 600;
}

.modal-close {
    background: none;
    border: none;
    cursor: pointer;
    color: #6b7280;
    padding: 4px;
    border-radius: 6px;
    display: flex;
}

.modal-close:hover {
    background: #f3f4f6;
}

/* ── Form ───────────────────────────────────────────────────── */
.modal-form {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.375rem;
}

.form-label {
    font-size: 13px;
    font-weight: 500;
    color: #374151;
}

.form-input {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 0.6rem 0.875rem;
    font-size: 14px;
    outline: none;
    transition: border-color 0.2s;
    width: 100%;
    box-sizing: border-box;
}

.form-input:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.15);
}

.form-textarea {
    resize: vertical;
    min-height: 100px;
    font-family: inherit;
}

.form-error {
    font-size: 13px;
    color: #ef4444;
}

/* ── Photo upload ───────────────────────────────────────────── */
.photo-upload-area {
    border: 1.5px dashed #d1d5db;
    border-radius: 8px;
    min-height: 90px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    overflow: hidden;
    transition: border-color 0.2s;
}

.photo-upload-area:hover {
    border-color: #6366f1;
}

.photo-upload-placeholder {
    text-align: center;
    padding: 1rem;
}

.photo-preview-img {
    width: 100%;
    max-height: 200px;
    object-fit: cover;
}

.remove-photo-btn {
    background: none;
    border: none;
    font-size: 12px;
    color: #ef4444;
    cursor: pointer;
    margin-top: 4px;
    padding: 0;
}

/* ── Submit ─────────────────────────────────────────────────── */
.btn-submit {
    background: #111827;
    color: white;
    font-size: 14px;
    font-weight: 500;
    padding: 0.75rem;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: background 0.2s;
    width: 100%;
}

.btn-submit:hover:not(:disabled) {
    background: #374151;
}

.btn-submit:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* ── Success ────────────────────────────────────────────────── */
.success-banner {
    margin: 1.5rem;
    padding: 1rem;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 8px;
    font-size: 14px;
    color: #15803d;
    text-align: center;
}

/* ── Modal transitions ──────────────────────────────────────── */
.modal-enter-active,
.modal-leave-active {
    transition: opacity 0.25s ease, transform 0.25s ease;
}

.modal-enter-from,
.modal-leave-to {
    opacity: 0;
    transform: scale(0.95);
}
</style>
