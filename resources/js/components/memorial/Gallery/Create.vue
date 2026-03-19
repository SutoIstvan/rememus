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

                        <!-- Loading: show only Skeleton, no image underneath -->
                        <template v-if="element.loading">
                            <Skeleton class="w-full h-30 rounded-md" />
                        </template>

                        <!-- Done: show objectURL preview with controls -->
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
import { ref, computed, onMounted, onUnmounted } from 'vue'
import draggable from 'vuedraggable'
import { GripHorizontal, Trash2, Upload, RotateCw } from 'lucide-vue-next'
import { Skeleton } from '@/components/ui/skeleton'

interface ImageItem {
    id: number
    src: string        // thumbnail blobURL (canvas-resized) or original objectURL while loading
    file: File
    rotation: number
    loading: boolean   // true while canvas thumbnail is being generated
}

const emit = defineEmits<{
    (e: 'update:gallery-files', files: File[]): void
}>()

const images = ref<ImageItem[]>([])
const drag = ref(false)
const fileInput = ref<HTMLInputElement | null>(null)
const windowWidth = ref(window.innerWidth)

const updateWindowWidth = () => { windowWidth.value = window.innerWidth }

onMounted(() => window.addEventListener('resize', updateWindowWidth))

onUnmounted(() => {
    window.removeEventListener('resize', updateWindowWidth)
    // Release all objectURLs on unmount
    images.value.forEach(img => URL.revokeObjectURL(img.src))
})

const placeholderCount = computed(() => {
    const isMobile = windowWidth.value < 640
    const maxPlaceholders = isMobile ? 4 : 6
    return images.value.length < maxPlaceholders ? maxPlaceholders - images.value.length : 0
})

const emitGalleryFiles = () => {
    const promises = images.value.map(async (img) => {
        if (img.rotation === 0) return img.file
        return await rotateImageFile(img.file, img.rotation)
    })
    Promise.all(promises).then(files => emit('update:gallery-files', files))
}

/**
 * Generates a small canvas thumbnail from a File and returns a blobURL.
 * The original objectURL used to load the Image is released after drawing.
 * @param maxPx  Max dimension (longest side) of the thumbnail in pixels
 */
const createThumbnailUrl = (file: File, maxPx = 400): Promise<string> => {
    return new Promise((resolve) => {
        const img = new Image()
        const tempUrl = URL.createObjectURL(file)
        img.onload = () => {
            URL.revokeObjectURL(tempUrl) // release immediately after load
            const scale = Math.min(1, maxPx / Math.max(img.width, img.height))
            const canvas = document.createElement('canvas')
            canvas.width = Math.round(img.width * scale)
            canvas.height = Math.round(img.height * scale)
            const ctx = canvas.getContext('2d')
            if (!ctx) { resolve(tempUrl); return }
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height)
            canvas.toBlob(
                blob => resolve(blob ? URL.createObjectURL(blob) : tempUrl),
                'image/webp',
                0.8
            )
        }
        img.onerror = () => resolve(tempUrl)
        img.src = tempUrl
    })
}

const rotateImageFile = async (file: File, rotation: number): Promise<File> => {
    return new Promise((resolve) => {
        const img = new Image()
        const canvas = document.createElement('canvas')
        const ctx = canvas.getContext('2d')
        img.onload = () => {
            if (rotation === 90 || rotation === 270) {
                canvas.width = img.height; canvas.height = img.width
            } else {
                canvas.width = img.width; canvas.height = img.height
            }
            if (!ctx) { resolve(file); return }
            ctx.translate(canvas.width / 2, canvas.height / 2)
            ctx.rotate((rotation * Math.PI) / 180)
            ctx.drawImage(img, -img.width / 2, -img.height / 2)
            canvas.toBlob(blob => {
                resolve(blob ? new File([blob], file.name, { type: file.type, lastModified: Date.now() }) : file)
            }, file.type)
        }
        img.src = URL.createObjectURL(file)
    })
}

const handleFileUpload = async (event: Event) => {
    const input = event.target as HTMLInputElement
    const files = Array.from(input.files || [])

    const maxPhotos = 12
    const availableSlots = maxPhotos - images.value.length

    if (availableSlots <= 0) {
        alert(`You can upload a maximum of ${maxPhotos} photos`)
        if (fileInput.value) fileInput.value.value = ''
        return
    }

    const filesToUpload = files.slice(0, availableSlots)
    if (fileInput.value) fileInput.value.value = ''

    // 1. Push ALL items immediately — all skeletons render at once
    const addedIds: number[] = []
    for (let i = 0; i < filesToUpload.length; i++) {
        const file = filesToUpload[i]
        if (file.size > 5 * 1024 * 1024) {
            console.error(`File ${file.name} exceeds 5 MB`)
            continue
        }
        const id = Date.now() + i
        images.value.push({
            id,
            src: '',        // will be set to thumbnail after canvas processing
            file,
            rotation: 0,
            loading: true,
        })
        addedIds.push(id)
        emitGalleryFiles()
    }

    // 2. Let Vue render all skeletons
    await new Promise(r => setTimeout(r, 0))

    // 3. Generate client-side thumbnail sequentially, replace src, clear loading
    for (let i = 0; i < addedIds.length; i++) {
        const id = addedIds[i]
        const item = images.value.find(img => img.id === id)
        if (!item) continue
        // Generate a small canvas thumbnail (~400px) — no server needed
        item.src = await createThumbnailUrl(item.file, 400)
        item.loading = false
    }
}

const removeImage = (id: number) => {
    const img = images.value.find(i => i.id === id)
    if (img) URL.revokeObjectURL(img.src)
    images.value = images.value.filter(i => i.id !== id)
    emitGalleryFiles()
}

const rotateImage = (id: number) => {
    const image = images.value.find(img => img.id === id)
    if (image) {
        image.rotation = (image.rotation + 90) % 360
        emitGalleryFiles()
    }
}

const onDragEnd = () => {
    drag.value = false
    emitGalleryFiles()
}
</script>

<style scoped>
.bg-muted { background-color: #e5e7eb; }
.text-muted-foreground { color: #6b7280; }

.ghost { opacity: 0.5; background: #c8ebfb; }
.dragging { opacity: 0.8; transform: scale(1.05); box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
.contents { display: contents; }
</style>