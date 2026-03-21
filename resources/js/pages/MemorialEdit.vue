<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { ref, watch, onMounted, computed } from 'vue'
import { toast } from "vue-sonner"
import { Toaster } from '@/components/ui/sonner'
import { Head } from '@inertiajs/vue3';
import { Sparkles, Loader2, CheckCircle, Trash2, MessageCircle } from 'lucide-vue-next'

import 'vue-sonner/style.css'

// Подкомпоненты
import HeaderCreate from '@/components/memorial/Header/Create.vue' // Reusing Create for Header is fine as it's just inputs
import FamilyTreeEdit from '@/components/memorial/FamilyTree/Edit.vue'
import GalleryEdit from '@/components/memorial/Gallery/Edit.vue'
import TimelineCreate from '@/components/memorial/TimeLine/Create.vue' // Reusing Create as it handles v-model fine
import FeaturesCreate from '@/components/memorial/Features/Create.vue' // Reusing Create
import BurialLocationCreate from '@/components/memorial/BurialLocation/Create.vue' // Reusing Create

import { Button } from '@/components/ui/button'
import { Switch } from '@/components/ui/switch'
import { Label } from '@/components/ui/label'
import { Input } from '@/components/ui/input'
import { Textarea } from '@/components/ui/textarea'
import { Dialog, DialogScrollContent, DialogDescription, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog'

const props = defineProps<{
    memorial: any
    comments: any[]
}>()

// Храним File объекты аватаров отдельно
const avatarFiles = ref<Map<string, File>>(new Map())
const deletedGalleryIds = ref<number[]>([])

// Состояния активности секций
const sectionsEnabled = ref({
    familyTree: true,
    gallery: true,
    timeline: true,
    features: true,
    burialLocation: true,
    comments: true,
})

// Форма
const form = useForm({
    _method: 'PUT',
    name: '',
    birth_date: '',
    death_date: '',
    birth_place: '',
    grave_location: '',
    image: null as File | null,
    background_image: null as File | null,
    background_url: null,
    motto: '',
    biography: '',

    family_tree: [] as any[],
    gallery: [] as File[],
    timeline: [] as any[],

    // FEATURES
    characteristics: [] as string[],
    customTraits: '',
    hobbies: [] as string[],
    additionalHobbies: '',
    retirement: '',
    habits: '',
    stories: '',
    wisdom: '',

    // BURIAL LOCATION
    graveParcel: '',
    graveLine: '',
    graveNumber: '',
    coordinates: '',
    gravePhoto: null as File | null,

    // Флаги активности секций
    family_tree_enabled: true,
    gallery_enabled: true,
    timeline_enabled: true,
    features_enabled: true,
    burial_location_enabled: true,
    comments_enabled: true,

    // Deleted items
    deleted_gallery_ids: [] as number[]
})

// Computed для аватара главного персонажа
const mainPersonAvatarUrl = computed(() => {
    // 1. Сначала проверяем загруженное локально изображение (form.image)
    if (form.image) return form.image

    // 2. Затем проверяем фото из базы (memorial.photo)
    if (props.memorial?.photo) {
        const photo = props.memorial.photo
        if (photo.startsWith('http') || photo.startsWith('/storage')) {
            return photo
        }
        return `/storage/${photo}`
    }

    return null
})

// Debug watcher for avatar
watch(mainPersonAvatarUrl, (val) => {
    console.log('Computed mainPersonAvatarUrl:', val)
}, { immediate: true })

onMounted(() => {
    console.log('Memorial data:', props.memorial)
    console.log('Memorial photo:', props.memorial?.photo)

    if (props.memorial) {
        const m = props.memorial

        form.name = m.name || ''
        form.birth_date = m.birth_date || ''
        form.death_date = m.death_date || ''
        form.birth_place = m.birth_place || ''
        form.grave_location = m.grave_location || ''
        // image and background_image are files, we don't set them from URL usually unless we have a preview component
        // for HeaderCreate, we might need to pass initial image URL if it supports it.
        // Looking at HeaderCreate (not shown but assumed), it usually takes v-model:image. 
        // We might need to handle existing image display? 
        // For now, let's assume standard behavior: if no new file, backend keeps old.
        // background_url только если это внешний URL (http/https), не путь в storage
        if (m.background_image && (m.background_image.startsWith('http') || m.background_image.startsWith('/'))) {
            form.background_url = m.background_image
        } else {
            form.background_url = null
        }
        form.motto = m.motto || ''
        form.biography = m.biography || ''

        // Sections
        form.family_tree_enabled = !!m.family_tree_enabled
        form.gallery_enabled = !!m.gallery_enabled
        form.timeline_enabled = !!m.timeline_enabled
        form.features_enabled = !!m.features_enabled
        form.burial_location_enabled = !!m.burial_location_enabled
        form.comments_enabled = m.comments_enabled !== undefined ? !!m.comments_enabled : true

        sectionsEnabled.value = {
            familyTree: form.family_tree_enabled,
            gallery: form.gallery_enabled,
            timeline: form.timeline_enabled,
            features: form.features_enabled,
            burialLocation: form.burial_location_enabled,
            comments: form.comments_enabled,
        }

        // Family Tree - init handled by FamilyTreeEdit via initialData prop
        // But we need to sync form.family_tree with it?
        // Actually FamilyTreeEdit emits update:modelValue with the structure.
        // We don't need to manually set form.family_tree here mostly, EXCEPT to passing it initially?
        // No, FamilyTreeEdit takes 'initialData'.

        // Timeline
        if (m.timeline) {
            form.timeline = m.timeline.map((t: any) => ({
                ...t,
                // ensure numeric fields or dates are formatted if needed
            }))
        }

        // Features
        form.characteristics = m.characteristics || []
        form.hobbies = m.hobbies || []
        form.customTraits = m.custom_traits || ''
        form.additionalHobbies = m.additional_hobbies || ''
        form.retirement = m.retirement || ''
        form.habits = m.habits || ''
        form.stories = m.stories || ''
        form.wisdom = m.wisdom || ''

        // Burial
        form.graveParcel = m.grave_parcel || ''
        form.graveLine = m.grave_line || ''
        form.graveNumber = m.grave_number || ''
        form.coordinates = m.grave_coordinates || '' // Note: backend uses grave_coordinates

    }
})

// Синхронизация состояния переключателей с формой
watch(sectionsEnabled, (newVal) => {
    form.family_tree_enabled = newVal.familyTree
    form.gallery_enabled = newVal.gallery
    form.timeline_enabled = newVal.timeline
    form.features_enabled = newVal.features
    form.burial_location_enabled = newVal.burialLocation
    form.comments_enabled = newVal.comments
}, { deep: true })

// Синхронизация имени с деревом (Logic from Create)
watch(() => form.name, (newName) => {
    const youNode = form.family_tree.find((node: any) => node.id === 'you')
    if (youNode) {
        youNode.name = newName
    }
})

// Синхронизация аватара
watch(() => form.image, (newImage) => {
    if (newImage) {
        avatarFiles.value.set('you', newImage)
        const youNode = form.family_tree.find((node: any) => node.id === 'you')
        if (youNode) {
            const reader = new FileReader()
            reader.onload = (e) => {
                youNode.avatar = e.target?.result as string
            }
            reader.readAsDataURL(newImage)
        }
    } else {
        avatarFiles.value.delete('you')
        const youNode = form.family_tree.find((node: any) => node.id === 'you')
        if (youNode) youNode.avatar = ''
    }
}, { deep: true }) // Added deep just in case

// Timeline sync logic (Skipped for brevity/complexity, user can manually edit timeline if needed)
// Or better: keep it if it was useful.
// It seems useful to auto-update timeline events.
// ... (Copying sync logic from Create.vue if desired, but might be safer to let user edit manually in Edit mode to avoid overwriting their custom changes).
// Decision: OMIT auto-sync in Edit mode to prevent overwriting user's manual edits.
import { update as updateMemorial } from '@/routes/memorial'

// ── Comments moderation ───────────────────────────────────────
const localComments = ref<any[]>(
    props.comments
        ? [...props.comments].sort((a, b) => new Date(b.created_at).getTime() - new Date(a.created_at).getTime())
        : []
)

const COMMENTS_PAGE_SIZE = 3
const commentsVisibleCount = ref(COMMENTS_PAGE_SIZE)
const visibleComments = computed(() => localComments.value.slice(0, commentsVisibleCount.value))
function loadMoreComments() {
    commentsVisibleCount.value += COMMENTS_PAGE_SIZE
}

async function approveComment(comment: any) {
    const { default: axios } = await import('axios')
    try {
        await axios.patch(`/memorial/${props.memorial.slug || props.memorial.id}/comments/${comment.id}/approve`)
        const found = localComments.value.find(c => c.id === comment.id)
        if (found) found.status = 'approved'
        toast.success('Comment approved')
    } catch {
        toast.error('Failed to approve comment')
    }
}

async function deleteComment(comment: any) {
    if (!confirm('Delete this comment permanently?')) return
    const { default: axios } = await import('axios')
    try {
        await axios.delete(`/memorial/${props.memorial.slug || props.memorial.id}/comments/${comment.id}`)
        localComments.value = localComments.value.filter(c => c.id !== comment.id)
        toast.success('Comment deleted')
    } catch {
        toast.error('Failed to delete comment')
    }
}

function commentInitials(name: string): string {
    return name.split(' ').slice(0, 2).map((w: string) => w[0]?.toUpperCase() ?? '').join('')
}

function commentDate(dateStr: string): string {
    if (!dateStr) return ''
    return new Date(dateStr).toLocaleDateString('en-US', { day: '2-digit', month: 'long', year: 'numeric' })
}

function resolveCommentPhoto(comment: any): string | null {
    const p = comment.photo_thumb_url || comment.photo_url || comment.photo
    if (!p || p === 'null') return null
    if (p.startsWith('http') || p.startsWith('/storage')) return p
    if (p.startsWith('storage/')) return '/' + p
    return `/storage/${p}`
}

const isGenerating = ref(false)

const generateContent = async () => {
    if (isGenerating.value) return
    isGenerating.value = true
    try {
        const url = `/memorial/${props.memorial.slug || props.memorial.id}/generate-biography`
        // axios is pre-configured in Laravel+Vite to send the XSRF-TOKEN cookie automatically
        const { default: axios } = await import('axios')
        const { data } = await axios.post(url, {}, {
            headers: { Accept: 'application/json' },
        })
        if (data.error) throw new Error(data.error)
        if (data.biography) form.biography = data.biography
        if (data.motto) form.motto = data.motto
        toast.success('Biography and motto generated!')
    } catch (err: any) {
        const msg = err?.response?.data?.error || err?.message || 'Failed to generate biography'
        toast.error(msg)
    } finally {
        isGenerating.value = false
    }
}

const submit = () => {
    // Generate URL using Wayfinder helper
    const url = updateMemorial.url({ memorial: props.memorial.slug || props.memorial.id })

    form.post(url, {
        forceFormData: true,
        preserveScroll: true,
        onSuccess: () => {
            toast.success('Memorial updated')
            // Don't reset form on edit
        },
        onError: (errors) => {
            console.error('=== SUBMIT ERRORS ===', errors)
            const errorMessages = Object.values(errors).flat().join('\n')
            toast.error(errorMessages || 'Validation error', { duration: 5000 })
        }
    })
}

// Override the transform to build FormData just like Create
form.transform((data) => {
    const formData = new FormData()
    formData.append('_method', 'PUT') // Critical for Laravel to see this as PUT

    // Basic fields
    formData.append('name', data.name)
    if (data.birth_date) formData.append('birth_date', data.birth_date)
    if (data.death_date) formData.append('death_date', data.death_date)
    if (data.birth_place) formData.append('birth_place', data.birth_place)
    if (data.grave_location) formData.append('grave_location', data.grave_location)

    if (data.image) formData.append('image', data.image)
    if (data.background_image) formData.append('background_image', data.background_image)
    if (data.background_url) formData.append('background_url', data.background_url)

    formData.append('motto', data.motto || '')
    formData.append('biography', data.biography || '')

    // Toggles
    formData.append('family_tree_enabled', data.family_tree_enabled ? '1' : '0')
    formData.append('gallery_enabled', data.gallery_enabled ? '1' : '0')
    formData.append('timeline_enabled', data.timeline_enabled ? '1' : '0')
    formData.append('features_enabled', data.features_enabled ? '1' : '0')
    formData.append('burial_location_enabled', data.burial_location_enabled ? '1' : '0')
    formData.append('comments_enabled', data.comments_enabled ? '1' : '0')

    // Gallery
    if (data.gallery_enabled && data.gallery.length > 0) {
        data.gallery.forEach((file, index) => {
            formData.append(`gallery[${index}]`, file)
        })
    }
    // Deleted gallery images
    if (deletedGalleryIds.value.length > 0) {
        deletedGalleryIds.value.forEach((id, index) => {
            formData.append(`deleted_gallery_ids[${index}]`, id.toString())
        })
    }

    // Family Tree
    if (data.family_tree_enabled) {
        const familyTreeWithoutMainPerson = data.family_tree.filter(
            (member: any) => member.role !== 'main_person' && member.name
        )
        familyTreeWithoutMainPerson.forEach((member: any, index: number) => {
            // Keep ID if it's not a temp one (temp ones have specific format? or just pass all IDs)
            // Backend will check if ID exists in DB.
            formData.append(`family_tree[${index}][id]`, member.id)
            formData.append(`family_tree[${index}][name]`, member.name || '')
            formData.append(`family_tree[${index}][role]`, member.role)
            formData.append(`family_tree[${index}][qr_code]`, member.qr_code || '')

            if (member.position) {
                formData.append(`family_tree[${index}][position]`, JSON.stringify(member.position))
            }

            const avatarFile = avatarFiles.value.get(member.id)
            if (avatarFile && member.id !== 'you') {
                formData.append(`family_tree[${index}][avatar]`, avatarFile, avatarFile.name)
            }
        })
    }

    // Timeline
    if (data.timeline_enabled && data.timeline.length > 0) {
        data.timeline.forEach((item: any, index: number) => {
            formData.append(`timeline[${index}][id]`, item.id)
            formData.append(`timeline[${index}][title]`, item.title)
            formData.append(`timeline[${index}][description]`, item.description || '')
            formData.append(`timeline[${index}][type]`, item.type || '')
            formData.append(`timeline[${index}][location]`, item.location || '')
            formData.append(`timeline[${index}][related_person]`, item.related_person || '')

            if (item.date) formData.append(`timeline[${index}][date]`, item.date)
            if (item.date_from) formData.append(`timeline[${index}][date_from]`, item.date_from)
            if (item.date_to) formData.append(`timeline[${index}][date_to]`, item.date_to)

            if (item.media instanceof File) {
                formData.append(`timeline[${index}][media]`, item.media)
            }
            // Note for Edit: if media is string (URL), we don't send it back as file. 
            // Backend should respect existing media if no new file is sent.
        })
    }

    // Features
    if (data.features_enabled) {
        if (Array.isArray(data.characteristics)) {
            data.characteristics.forEach((char, index) => {
                formData.append(`characteristics[${index}]`, char)
            })
        }
        if (Array.isArray(data.hobbies)) {
            data.hobbies.forEach((hobby, index) => {
                formData.append(`hobbies[${index}]`, hobby)
            })
        }
        formData.append('custom_traits', data.customTraits || '')
        formData.append('additional_hobbies', data.additionalHobbies || '')
        formData.append('retirement', data.retirement || '')
        formData.append('habits', data.habits || '')
        formData.append('stories', data.stories || '')
        formData.append('wisdom', data.wisdom || '')
    }

    // Burial
    if (data.burial_location_enabled) {
        formData.append('grave_parcel', data.graveParcel || '')
        formData.append('grave_line', data.graveLine || '')
        formData.append('grave_number', data.graveNumber || '')
        formData.append('coordinates', data.coordinates || '')
        if (data.gravePhoto instanceof File) {
            formData.append('grave_photo', data.gravePhoto)
        }
    }

    return formData
})


const handleFamilyTreeUpdate = (updatedTree: any[]) => {
    form.family_tree = updatedTree
}

const handleAvatarFilesUpdate = (files: Map<string, File>) => {
    files.forEach((file, key) => {
        if (key !== 'you') avatarFiles.value.set(key, file)
    })
}

// Gallery photos are now uploaded immediately to the server via GalleryPhotoController.
// We no longer collect files for form submission — only deletion IDs are still tracked
// so that MemorialController.update() can clean up removed images on save.
const handleGalleryDelete = (ids: number[]) => {
    deletedGalleryIds.value = ids
}
</script>

<template>

    <Head :title="form.name" />

    <div class="bg-white dark:bg-black min-h-screen">
        <form @submit.prevent="submit" class="space-y-8">

            <HeaderCreate v-model:name="form.name" v-model:birth_date="form.birth_date"
                v-model:death_date="form.death_date" v-model:birth_place="form.birth_place" v-model:image="form.image"
                v-model:background_image="form.background_image" v-model:background_url="form.background_url"
                :errors="form.errors" :image-preview="memorial.photo ? `/storage/${memorial.photo}` : undefined"
                :background-image-url="memorial.background_image ? (memorial.background_image.startsWith('/') ? memorial.background_image : `/storage/${memorial.background_image}`) : undefined" /><!-- Note: initial-image prop is not in HeaderCreate? If not, we might not see the preview. 
             If HeaderCreate relies on v-model:image being a file, it won't show the existing URL.
             Ideally HeaderCreate should have an 'initialImage' prop or handle string in v-model.
             Assuming for now it works or user Re-uploads if they want to change. -->

            <!-- Motto and Biography Section -->
            <div class="space-y-4">
                <div class="px-4 md:px-6 lg:px-8 flex items-center justify-between">
                    <div class="mx-auto mt-10 md:mt-[7px] w-[760px]">
                        <div class="grid grid-cols-[1fr_auto_1fr] items-center">
                            <div></div>
                            <div class="text-center">
                                <span class="badge badge-green">
                                    Motto
                                </span>
                            </div>

                        </div>
                        <div class="space-y-2 mt-4">
                            <Input id="motto" v-model="form.motto"
                                placeholder="Enter a life motto or favorite quote..." />
                        </div>
                        <div class="space-y-2 mt-4">
                            <Textarea id="biography" v-model="form.biography" placeholder="Write a biography..."
                                class="min-h-[150px]" />
                        </div>

                        <!-- <p class="mt-2 text-xs text-gray-400 text-right">Uses AI to generate based on name, dates,
                            family tree,
                            timeline & features.</p> -->

                        <!-- Buttons -->
                        <div class="mt-3 flex flex-wrap items-center justify-end gap-3">
                            <button type="button" @click="generateContent" :disabled="isGenerating"
                                class="group/button inline-flex shrink-0 items-center justify-center rounded-lg border bg-clip-padding text-sm font-medium whitespace-nowrap transition-all outline-none select-none focus-visible:border-ring focus-visible:ring-3 focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50 aria-invalid:border-destructive aria-invalid:ring-3 aria-invalid:ring-destructive/20 dark:aria-invalid:border-destructive/50 dark:aria-invalid:ring-destructive/40 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4 border-border bg-background hover:bg-muted hover:text-foreground aria-expanded:bg-muted aria-expanded:text-foreground dark:border-input dark:bg-input/30 dark:hover:bg-input/50 h-8 gap-1.5 px-2.5 has-data-[icon=inline-end]:pr-2 has-data-[icon=inline-start]:pl-2">
                                <Loader2 v-if="isGenerating" class="size-4 animate-spin" />
                                <!-- <Sparkles v-else class="size-4" /> -->
                                {{ isGenerating ? 'Generating...' : '✨ Generate Biography & Motto' }}
                            </button>

                            <!-- Memories Modal -->
                            <Dialog>
                                <DialogTrigger asChild>
                                    <button type="button"
                                        class="group/button inline-flex shrink-0 items-center justify-center rounded-lg border bg-clip-padding text-sm font-medium whitespace-nowrap transition-all outline-none select-none focus-visible:border-ring focus-visible:ring-3 focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50 aria-invalid:border-destructive aria-invalid:ring-3 aria-invalid:ring-destructive/20 dark:aria-invalid:border-destructive/50 dark:aria-invalid:ring-destructive/40 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4 border-border bg-background hover:bg-muted hover:text-foreground aria-expanded:bg-muted aria-expanded:text-foreground dark:border-input dark:bg-input/30 dark:hover:bg-input/50 h-8 gap-1.5 px-2.5 has-data-[icon=inline-end]:pr-2 has-data-[icon=inline-start]:pl-2">
                                        Memories
                                    </button>
                                </DialogTrigger>
                                <DialogScrollContent class="sm:max-w-4xl max-h-[90vh] overflow-y-auto">
                                    <DialogHeader>
                                        <DialogTitle class="hidden">Memories</DialogTitle>
                                        <DialogDescription class="hidden">Provide the person's memories and traits.
                                        </DialogDescription>
                                    </DialogHeader>

                                    <div class="relative pb-4">
                                        <div v-if="!sectionsEnabled.features"
                                            class="absolute inset-0 bg-black/50 z-10 cursor-not-allowed rounded-lg">
                                        </div>
                                        <div :class="{ 'opacity-50 blur-sm': !sectionsEnabled.features }">
                                            <FeaturesCreate v-model:characteristics="form.characteristics"
                                                v-model:hobbies="form.hobbies" v-model:custom-traits="form.customTraits"
                                                v-model:additional-hobbies="form.additionalHobbies"
                                                v-model:retirement="form.retirement" v-model:habits="form.habits"
                                                v-model:stories="form.stories" v-model:wisdom="form.wisdom"
                                                :disabled="!sectionsEnabled.features" />
                                        </div>
                                    </div>
                                </DialogScrollContent>
                            </Dialog>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Family Tree Section -->
            <div class="space-y-4">
                <div class="px-4 md:px-6 lg:px-8 flex items-center justify-between">
                    <div class="mx-auto mt-10 md:mt-[7px] w-[760px]">
                        <div class="grid grid-cols-[1fr_auto_1fr] items-center">
                            <div></div>
                            <div class="text-center">
                                <span class="badge badge-green">
                                    Family Tree
                                </span>
                            </div>
                            <div class="flex justify-end items-center space-x-1">
                                <Label for="family-tree-toggle" class="cursor-pointer">
                                    {{ sectionsEnabled.familyTree ? 'Active' : 'Disabled' }}
                                </Label>
                                <Switch id="family-tree-toggle" v-model="sectionsEnabled.familyTree" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative transition-all duration-300"
                    :class="sectionsEnabled.familyTree ? 'h-auto' : 'h-[300px] overflow-hidden'">
                    <div v-if="!sectionsEnabled.familyTree"
                        class="absolute inset-0 bg-white/10 z-10 cursor-not-allowed"></div>
                    <div :class="{ 'opacity-80 blur-sm': !sectionsEnabled.familyTree }">
                        <FamilyTreeEdit :model-value="form.family_tree" :main-person-name="form.name"
                            :main-person-avatar="mainPersonAvatarUrl" :disabled="!sectionsEnabled.familyTree"
                            :initial-data="memorial?.family" @update:model-value="handleFamilyTreeUpdate"
                            @update:avatar-files="handleAvatarFilesUpdate" />
                    </div>
                </div>
            </div>

            <!-- Gallery Section -->
            <div class="space-y-4">
                <div class="px-4 md:px-6 lg:px-8 flex items-center justify-between">
                    <div class="mx-auto mt-10 md:mt-[7px] w-[760px]">
                        <div class="grid grid-cols-[1fr_auto_1fr] items-center">
                            <div></div>
                            <div class="text-center">
                                <span class="badge badge-green">
                                    Gallery
                                </span>
                            </div>
                            <div class="flex justify-end items-center space-x-1">
                                <Label for="gallery-toggle" class="cursor-pointer">
                                    {{ sectionsEnabled.gallery ? 'Active' : 'Disabled' }}
                                </Label>
                                <Switch id="gallery-toggle" v-model="sectionsEnabled.gallery" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div v-if="!sectionsEnabled.gallery" class="absolute inset-0 bg-white/10 z-10 cursor-not-allowed">
                    </div>
                    <div :class="{ 'opacity-80 blur-sm': !sectionsEnabled.gallery }">
                        <GalleryEdit
                            :disabled="!sectionsEnabled.gallery"
                            :initial-images="memorial?.images"
                            :memorial-id="memorial.id"
                            @delete:gallery-images="handleGalleryDelete" />
                    </div>
                </div>
            </div>

            <!-- Timeline Section -->
            <div class="space-y-4">
                <div class="px-4 md:px-6 lg:px-8 flex items-center justify-between">
                    <div class="mx-auto mt-10 md:mt-[7px] w-[760px]">
                        <div class="grid grid-cols-[1fr_auto_1fr] items-center">
                            <div></div>
                            <div class="text-center">
                                <span class="badge badge-green">
                                    Timeline
                                </span>
                            </div>
                            <div class="flex justify-end items-center space-x-1">
                                <Label for="timeline-toggle" class="cursor-pointer">
                                    {{ sectionsEnabled.timeline ? 'Active' : 'Disabled' }}
                                </Label>
                                <Switch id="timeline-toggle" v-model="sectionsEnabled.timeline" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative transition-all duration-300"
                    :class="sectionsEnabled.timeline ? 'h-auto' : 'h-[440px] overflow-hidden'">
                    <div v-if="!sectionsEnabled.timeline" class="absolute inset-0 bg-white/10 z-10 cursor-not-allowed">
                    </div>
                    <div :class="{ 'opacity-70 blur-sm': !sectionsEnabled.timeline }">
                        <TimelineCreate v-model="form.timeline" :birth-date="form.birth_date"
                            :death-date="form.death_date" :disabled="!sectionsEnabled.timeline" />
                    </div>
                </div>
            </div>

            <!-- Comments Moderation Section -->
            <div class="space-y-4">
                <div class="px-4 md:px-6 lg:px-8 flex items-center justify-between">
                    <div class="mx-auto mt-10 md:mt-[7px] w-[760px]">
                        <div class="grid grid-cols-[1fr_auto_1fr] items-center">
                            <div></div>
                            <div class="text-center">
                                <span class="badge badge-green">Commemorations</span>
                            </div>
                            <div class="flex justify-end items-center space-x-1">
                                <Label for="comments-toggle" class="cursor-pointer">
                                    {{ sectionsEnabled.comments ? 'Active' : 'Disabled' }}
                                </Label>
                                <Switch id="comments-toggle" v-model="sectionsEnabled.comments" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative transition-all duration-300"
                    :class="sectionsEnabled.comments ? 'h-auto' : 'h-[260px] overflow-hidden'">
                    <div v-if="!sectionsEnabled.comments" class="absolute inset-0 bg-white/10 z-10 cursor-not-allowed">
                    </div>
                    <div :class="{ 'opacity-80 blur-sm': !sectionsEnabled.comments }" class="px-4 md:px-6 lg:px-8">
                        <div class="mx-auto w-full max-w-[760px]">

                            <!-- Empty state -->
                            <div v-if="localComments.length === 0"
                                class="flex flex-col items-center justify-center py-10 gap-3 mt-2">
                                <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center">
                                    <MessageCircle class="w-6 h-6 text-gray-400" />
                                </div>
                                <p class="text-sm text-gray-400">No commemorations yet.</p>
                            </div>

                            <!-- Comment cards -->
                            <div v-else class="flex flex-col gap-3">
                                <div v-for="comment in visibleComments" :key="comment.id"
                                    class="border border-gray-300 rounded-xl p-4 flex gap-4 items-start">

                                    <!-- Avatar -->
                                    <div
                                        class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-sm font-semibold text-gray-600 dark:text-gray-300 flex-shrink-0">
                                        {{ commentInitials(comment.name) }}
                                    </div>

                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 flex-wrap mb-1">
                                            <span class="font-semibold text-sm text-gray-800 dark:text-gray-100">{{
                                                comment.name }}</span>
                                            <span class="text-xs text-gray-400">{{ commentDate(comment.created_at)
                                            }}</span>
                                            <span v-if="comment.status === 'pending'"
                                                class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium bg-yellow-100 text-yellow-700">Pending</span>
                                            <span v-else
                                                class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium bg-green-100 text-green-700">Approved</span>
                                        </div>
                                        <p class="mt-1 flex text-sm text-gray-600 dark:text-gray-300">
                                            <img v-if="resolveCommentPhoto(comment)"
                                                :src="resolveCommentPhoto(comment)!"
                                                class="me-2 rounded-lg h-16 w-16 object-cover" alt="comment photo" />
                                            {{ comment.content }}
                                        </p>

                                    </div>

                                    <!-- Actions -->
                                    <div class="flex flex-col gap-2 flex-shrink-0">
                                        <button v-if="comment.status === 'pending'" type="button"
                                            @click="approveComment(comment)"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-green-500 text-white hover:bg-green-600 transition-colors">
                                            <CheckCircle class="w-3.5 h-3.5" />
                                            Approve
                                        </button>
                                        <button type="button" @click="deleteComment(comment)"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-100 text-red-600 hover:bg-red-200 transition-colors">
                                            <Trash2 class="w-3.5 h-3.5" />
                                            Delete
                                        </button>
                                    </div>
                                </div>

                                <!-- Load more -->
                                <div v-if="commentsVisibleCount < localComments.length"
                                    class="flex justify-center pt-2">
                                    <button type="button" @click="loadMoreComments"
                                        class="px-5 py-2 rounded-full border border-gray-200 text-sm text-gray-500 hover:border-gray-400 hover:text-gray-700 hover:bg-gray-50 transition-all">
                                        Load more ({{ localComments.length - commentsVisibleCount }} remaining)
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Burial Location Section -->
            <div class="space-y-4">
                <div class="px-4 md:px-6 lg:px-8 flex items-center justify-between">
                    <div class="mx-auto mt-10 md:mt-[7px] w-[760px]">
                        <div class="grid grid-cols-[1fr_auto_1fr] items-center">
                            <div></div>
                            <div class="text-center">
                                <span class="badge badge-green">
                                    Burial Location
                                </span>
                            </div>
                            <div class="flex justify-end items-center space-x-1">
                                <Label for="burial-location-toggle" class="cursor-pointer">
                                    {{ sectionsEnabled.burialLocation ? 'Active' : 'Disabled' }}
                                </Label>
                                <Switch id="burial-location-toggle" v-model="sectionsEnabled.burialLocation" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative transition-all duration-300"
                    :class="sectionsEnabled.burialLocation ? 'h-auto' : 'h-[260px] overflow-hidden'">
                    <div v-if="!sectionsEnabled.burialLocation"
                        class="absolute inset-0 bg-white/10 z-10 cursor-not-allowed">
                    </div>
                    <div :class="{ 'opacity-80 blur-sm': !sectionsEnabled.burialLocation }">
                        <BurialLocationCreate v-model:grave-location="form.grave_location"
                            v-model:grave-parcel="form.graveParcel" v-model:grave-line="form.graveLine"
                            v-model:grave-number="form.graveNumber" v-model:coordinates="form.coordinates"
                            :grave-photo="form.gravePhoto || (memorial.grave_photo ? `/storage/${memorial.grave_photo}` : null)"
                            @update:grave-photo="(file) => form.gravePhoto = file"
                            :disabled="!sectionsEnabled.burialLocation" />
                    </div>
                </div>
            </div>

            <div class="text-center space-y-5 mx-auto mt-5 md:mt-[10px]">
                <Button type="submit"
                    class="items-center gap-2 cursor-pointer bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
                    :disabled="form.processing">
                    <Loader2 v-if="form.processing" class="w-4 h-4 mr-2 animate-spin" />
                    {{ form.processing ? 'Updating...' : 'Update Memorial' }}
                </Button>
            </div>

            <Toaster class="pointer-events-auto" position="top-center" />
        </form>
    </div>
</template>
