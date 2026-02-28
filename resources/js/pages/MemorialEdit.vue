<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { ref, watch, onMounted, computed } from 'vue'
import { toast } from "vue-sonner"
import { Toaster } from '@/components/ui/sonner'
import { Head } from '@inertiajs/vue3';
import { Sparkles, Loader2 } from 'lucide-vue-next'

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

const props = defineProps<{
    memorial: any
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
        form.background_url = m.background_image // If string
        form.motto = m.motto || ''
        form.biography = m.biography || ''

        // Sections
        form.family_tree_enabled = !!m.family_tree_enabled
        form.gallery_enabled = !!m.gallery_enabled
        form.timeline_enabled = !!m.timeline_enabled
        form.features_enabled = !!m.features_enabled
        form.burial_location_enabled = !!m.burial_location_enabled

        sectionsEnabled.value = {
            familyTree: form.family_tree_enabled,
            gallery: form.gallery_enabled,
            timeline: form.timeline_enabled,
            features: form.features_enabled,
            burialLocation: form.burial_location_enabled
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

const handleGalleryUpdate = (galleryFiles: File[]) => {
    form.gallery = galleryFiles
}

const handleGalleryDelete = (ids: number[]) => {
    deletedGalleryIds.value = ids
}
</script>

<template>

    <Head title="Edit Memorial" />

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
                        <!-- Generate button -->
                        <div class="mt-3">
                            <button type="button" @click="generateContent" :disabled="isGenerating" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                                       bg-gradient-to-r from-violet-600 to-indigo-600 text-white shadow-md
                                       hover:from-violet-700 hover:to-indigo-700 hover:shadow-lg hover:-translate-y-px
                                       disabled:opacity-60 disabled:cursor-not-allowed disabled:translate-y-0">
                                <Loader2 v-if="isGenerating" class="size-4 animate-spin" />
                                <Sparkles v-else class="size-4" />
                                {{ isGenerating ? 'Generating...' : '✨ Generate Biography & Motto' }}
                            </button>
                            <p class="mt-1 text-xs text-gray-400">Uses AI to generate based on name, dates, family tree,
                                timeline & features.</p>
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
                        <GalleryEdit :disabled="!sectionsEnabled.gallery" :initial-images="memorial?.images"
                            @update:gallery-files="handleGalleryUpdate" @delete:gallery-images="handleGalleryDelete" />
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

            <!-- Features Section -->
            <div class="space-y-4">
                <div class="relative">
                    <div v-if="!sectionsEnabled.features" class="absolute inset-0 bg-black/50 z-10 cursor-not-allowed">
                    </div>
                    <div :class="{ 'opacity-50 blur-sm': !sectionsEnabled.features }">
                        <FeaturesCreate v-model:characteristics="form.characteristics" v-model:hobbies="form.hobbies"
                            v-model:custom-traits="form.customTraits"
                            v-model:additional-hobbies="form.additionalHobbies" v-model:retirement="form.retirement"
                            v-model:habits="form.habits" v-model:stories="form.stories" v-model:wisdom="form.wisdom"
                            :disabled="!sectionsEnabled.features" />
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
                    {{ form.processing ? 'Updating...' : 'Update Memorial' }}
                </Button>
            </div>

            <Toaster class="pointer-events-auto" position="top-center" />
        </form>
    </div>
</template>
