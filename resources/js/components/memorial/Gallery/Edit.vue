<template>
    <div class="mx-auto max-w-3xl space-y-4 pt-1 text-center">
        <p class="text-muted-foreground max-w-xl mx-auto px-3 sm:px-1">
            You can upload photos and drag and drop them by simply capturing the image. The maximum size of one
            photo is 5 megabytes.
        </p>
        <div class="flex justify-center mb-4 mt-5">
            <label
                class="flex items-center gap-2 cursor-pointer bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                <Upload class="w-4 h-4" />
                Upload Photo
                <input ref="fileInput" type="file" accept="image/*" @change="handleFileUpload" class="hidden"
                    multiple />
            </label>
        </div>
        <div class="grid grid-cols-4 gap-3 pt-6 sm:grid-cols-3 md:grid-cols-6 mx-auto px-3 sm:px-1">
            <draggable v-model="images" item-key="id" :animation="300" :ghost-class="'ghost'" :drag-class="'dragging'"
                @start="drag = true" @end="onDragEnd" class="contents" handle=".drag-handle">
                <template #item="{ element }">
                    <div class="h-30 rounded-md relative group hover:cursor-pointer"
                        :class="{ 'border-0 border-red-500': drag }">

                        <!-- Uploading: show only Skeleton, no image underneath -->
                        <template v-if="element.status === 'uploading'">
                            <Skeleton class="w-full h-30 rounded-md" />
                        </template>

                        <!-- Error state -->
                        <template v-else-if="element.status === 'error'">
                            <div class="w-full h-30 flex flex-col items-center justify-center gap-1 bg-red-100 rounded-md">
                                <AlertCircle class="w-5 h-5 text-red-500" />
                                <button type="button"
                                    class="text-xs text-red-600 underline hover:text-red-800"
                                    @click="retryUpload(element)">
                                    Retry
                                </button>
                            </div>
                        </template>

                        <!-- Done: show thumbnail with controls -->
                        <template v-else>
                            <img :src="element.src" :style="{ transform: `rotate(${element.rotation}deg)` }"
                                class="w-full h-30 object-cover rounded-md transition-transform duration-300"
                                alt="Uploaded photo" />

                            <!-- Drag Handle -->
                            <div
                                class="drag-handle absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-70 transition-opacity bg-black bg-opacity-30 rounded-md">
                                <GripHorizontal class="w-6 h-6 text-white" />
                            </div>
                            <!-- Rotate -->
                            <button type="button"
                                class="absolute top-1 left-1 bg-gray-200 text-grey rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity hover:text-white hover:bg-blue-600 hover:cursor-pointer"
                                @click="rotateImage(element.id)" title="Rotate 90°">
                                <RotateCw class="w-4 h-4" />
                            </button>
                            <!-- Delete -->
                            <button type="button"
                                class="absolute top-1 right-1 bg-gray-200 text-grey rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity hover:text-white hover:bg-red-600 hover:cursor-pointer"
                                @click="removeImage(element.id)" title="Delete">
                                <Trash2 class="w-4 h-4" />
                            </button>
                        </template>
                    </div>
                </template>
            </draggable>

            <!-- Empty gray placeholders to keep the grid full -->
            <div v-for="n in placeholderCount" :key="`placeholder-${n}`" class="h-20 sm:!h-30 rounded-md bg-muted" />
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, onUnmounted, watch } from 'vue'
import draggable from 'vuedraggable'
import { GripHorizontal, Trash2, Upload, RotateCw, AlertCircle } from 'lucide-vue-next'
import { Skeleton } from '@/components/ui/skeleton'

type UploadStatus = 'uploading' | 'done' | 'error'

interface ImageItem {
    id: number | string          // server ID once uploaded; local temp ID while uploading
    tempId?: string              // local temp ID (used for matching during upload)
    src: string                  // objectURL (preview) or thumb_url after upload
    file?: File                  // only while status === 'uploading' (for retry)
    rotation: number
    isExisting?: boolean         // loaded from server on mount
    status: UploadStatus
}

const props = defineProps<{
    initialImages?: { id: number; image_path: string; order: number }[]
    memorialId: number | string
}>()

const emit = defineEmits<{
    (e: 'delete:gallery-images', ids: number[]): void
}>()

const images = ref<ImageItem[]>([])
const drag = ref(false)
const fileInput = ref<HTMLInputElement | null>(null)
const windowWidth = ref(window.innerWidth)

// Track deleted server image IDs so parent form still sends deleted_gallery_ids
const deletedImageIds = ref<number[]>([])

const updateWindowWidth = () => { windowWidth.value = window.innerWidth }

onMounted(() => {
    window.addEventListener('resize', updateWindowWidth)
    if (props.initialImages) {
        images.value = props.initialImages.map(img => ({
            id: img.id,
            src: `/storage/${img.image_path}`,
            rotation: 0,
            isExisting: true,
            status: 'done' as UploadStatus,
        }))
    }
})

watch(
    () => props.initialImages,
    (newImages) => {
        if (newImages) {
            images.value = newImages.map(img => ({
                id: img.id,
                src: `/storage/${img.image_path}`,
                rotation: 0,
                isExisting: true,
                status: 'done' as UploadStatus,
            }))
            deletedImageIds.value = []
        }
    },
    { deep: true }
)

onUnmounted(() => {
    window.removeEventListener('resize', updateWindowWidth)
    // Release objectURLs to avoid memory leaks
    images.value.forEach(img => {
        if (!img.isExisting && img.src.startsWith('blob:')) {
            URL.revokeObjectURL(img.src)
        }
    })
})

const placeholderCount = computed(() => {
    const isMobile = windowWidth.value < 640
    const maxPlaceholders = isMobile ? 4 : 6
    return images.value.length < maxPlaceholders ? maxPlaceholders - images.value.length : 0
})

/** Upload a single file to the server and update the image item in place */
const uploadToServer = async (item: ImageItem, file: File) => {
    const formData = new FormData()
    formData.append('photo', file)
    formData.append('_token', (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement)?.content ?? '')

    try {
        const { default: axios } = await import('axios')
        const { data } = await axios.post<{ id: number; url: string; thumb_url: string }>(
            `/memorial/${props.memorialId}/photos`,
            formData,
            { headers: { 'Content-Type': 'multipart/form-data' } }
        )

        // Find the item by tempId (it may have shifted in array)
        const found = images.value.find(i => i.tempId === item.tempId)
        if (found) {
            // Revoke the objectURL preview — server thumb takes over
            if (found.src.startsWith('blob:')) URL.revokeObjectURL(found.src)
            found.id = data.id
            found.src = data.thumb_url
            found.status = 'done'
            found.file = undefined
        }
    } catch {
        const found = images.value.find(i => i.tempId === item.tempId)
        if (found) found.status = 'error'
    }
}

const handleFileUpload = async (event: Event) => {
    const input = event.target as HTMLInputElement
    const files = Array.from(input.files || [])

    const maxPhotos = 12
    const uploadingCount = images.value.filter(i => i.status === 'uploading').length
    const availableSlots = maxPhotos - images.value.length + uploadingCount

    if (availableSlots <= 0) {
        alert(`Maximum ${maxPhotos} photos allowed`)
        if (fileInput.value) fileInput.value.value = ''
        return
    }

    const filesToUpload = files.slice(0, availableSlots)
    if (fileInput.value) fileInput.value.value = ''

    // 1. Add ALL items immediately so all skeletons appear at once
    const itemsToUpload: { item: ImageItem; file: File }[] = []
    for (let i = 0; i < filesToUpload.length; i++) {
        const file = filesToUpload[i]
        if (file.size > 5 * 1024 * 1024) {
            console.error(`File ${file.name} exceeds 5 MB`)
            continue
        }
        const tempId = `temp-${Date.now()}-${i}`
        const item: ImageItem = {
            id: tempId,
            tempId,
            src: URL.createObjectURL(file),
            file,
            rotation: 0,
            isExisting: false,
            status: 'uploading',
        }
        images.value.push(item)
        itemsToUpload.push({ item, file })
    }

    // 2. Let Vue render all skeletons before uploading
    await new Promise(r => setTimeout(r, 0))

    // 3. Upload sequentially — one at a time
    for (const { item, file } of itemsToUpload) {
        await uploadToServer(item, file)
    }
}

const retryUpload = async (item: ImageItem) => {
    if (!item.file) return
    item.status = 'uploading'
    await uploadToServer(item, item.file)
}

const removeImage = async (id: number | string) => {
    const index = images.value.findIndex(img => img.id === id)
    if (index === -1) return

    const img = images.value[index]

    if (img.isExisting) {
        // Delete from server immediately
        try {
            const { default: axios } = await import('axios')
            await axios.delete(`/memorial/${props.memorialId}/photos/${img.id}`)
        } catch (err) {
            console.error('Failed to delete photo', err)
            return
        }
        deletedImageIds.value.push(img.id as number)
        emit('delete:gallery-images', deletedImageIds.value)
    } else if (img.status === 'done') {
        // Uploaded but not "existing" — delete from server
        try {
            const { default: axios } = await import('axios')
            await axios.delete(`/memorial/${props.memorialId}/photos/${img.id}`)
        } catch (err) {
            console.error('Failed to delete photo', err)
            return
        }
    }

    // Release objectURL if applicable
    if (img.src.startsWith('blob:')) URL.revokeObjectURL(img.src)
    images.value.splice(index, 1)
}

const rotateImage = (id: number | string) => {
    const image = images.value.find(img => img.id === id)
    if (image) {
        image.rotation = (image.rotation + 90) % 360
    }
}

const onDragEnd = () => {
    drag.value = false
}
</script>

<style scoped>
.bg-muted {
    background-color: #e5e7eb;
}

.text-muted-foreground {
    color: #6b7280;
}

.ghost {
    opacity: 0.5;
    background: #c8ebfb;
}

.dragging {
    opacity: 0.8;
    transform: scale(1.05);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.contents {
    display: contents;
}
</style>
