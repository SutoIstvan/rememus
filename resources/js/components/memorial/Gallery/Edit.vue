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
                        <img :src="element.src" :style="{ transform: `rotate(${element.rotation}deg)` }"
                            class="w-full h-30 object-cover rounded-md transition-transform duration-300"
                            alt="Uploaded photo" />
                        <!-- Drag Handle Icon -->
                        <div
                            class="drag-handle absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-70 transition-opacity bg-black bg-opacity-30 rounded-md">
                            <GripHorizontal class="w-6 h-6 text-white" />
                        </div>
                        <!-- Rotate Icon -->
                        <button type="button"
                            class="absolute top-1 left-1 bg-gray-200 text-grey rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity hover:text-white hover:bg-blue-600 hover:cursor-pointer"
                            @click="rotateImage(element.id)" title="Rotate 90°">
                            <RotateCw class="w-4 h-4" />
                        </button>
                        <!-- Delete Icon -->
                        <button type="button"
                            class="absolute top-1 right-1 bg-gray-200 text-grey rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity hover:text-white hover:bg-red-600 hover:cursor-pointer"
                            @click="removeImage(element.id)" title="Delete">
                            <Trash2 class="w-4 h-4" />
                        </button>
                    </div>
                </template>
            </draggable>
            <div v-for="n in placeholderCount" :key="`placeholder-${n}`" class="h-20 sm:!h-30 rounded-md bg-muted">
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, onUnmounted, watch } from 'vue'
import draggable from 'vuedraggable'
import { GripHorizontal, Trash2, Upload, RotateCw } from 'lucide-vue-next'

interface ImageItem {
    id: number | string // can be string for existing db ids
    src: string
    file?: File // Optional because existing images don't have File objects
    rotation: number
    isExisting?: boolean
}

const props = defineProps<{
    initialImages?: { id: number; image_path: string; order: number }[]
}>()

const emit = defineEmits<{
    (e: 'update:gallery-files', files: File[]): void
    (e: 'delete:gallery-images', ids: number[]): void
}>()

const images = ref<ImageItem[]>([])
const drag = ref(false)
const fileInput = ref<HTMLInputElement | null>(null)
const windowWidth = ref(window.innerWidth)
const deletedImageIds = ref<number[]>([])

const updateWindowWidth = () => {
    windowWidth.value = window.innerWidth
}

onMounted(() => {
    window.addEventListener('resize', updateWindowWidth)

    // Initialize with existing images
    if (props.initialImages) {
        images.value = props.initialImages.map(img => ({
            id: img.id,
            src: `/storage/${img.image_path}`,
            rotation: 0,
            isExisting: true
        }))
    }
})

// Re-sync when Inertia updates the prop after a successful save
// (avoids duplicate/stale entries from temporary FileReader previews)
watch(
    () => props.initialImages,
    (newImages) => {
        if (newImages) {
            images.value = newImages.map(img => ({
                id: img.id,
                src: `/storage/${img.image_path}`,
                rotation: 0,
                isExisting: true
            }))
            deletedImageIds.value = []
        }
    },
    { deep: true }
)

onUnmounted(() => {
    window.removeEventListener('resize', updateWindowWidth)
})

const placeholderCount = computed(() => {
    const isMobile = windowWidth.value < 640 // sm breakpoint
    const maxPlaceholders = isMobile ? 4 : 6
    return images.value.length < maxPlaceholders ? maxPlaceholders - images.value.length : 0
})

const emitGalleryFiles = () => {
    // Collect ONLY new files to be uploaded
    const newFilesPromises = images.value
        .filter(img => !img.isExisting && img.file)
        .map(async (img) => {
            if (img.rotation === 0 && img.file) {
                return img.file
            }
            // Если изображение повернуто
            if (img.file) {
                return await rotateImageFile(img.file, img.rotation)
            }
            return null
        })

    Promise.all(newFilesPromises).then((files) => {
        // filter nulls
        const validFiles = files.filter(f => f !== null) as File[]
        emit('update:gallery-files', validFiles)
    })

    emit('delete:gallery-images', deletedImageIds.value)
}

// Функция для поворота файла изображения
const rotateImageFile = async (file: File, rotation: number): Promise<File> => {
    return new Promise((resolve) => {
        const img = new Image()
        const canvas = document.createElement('canvas')
        const ctx = canvas.getContext('2d')

        img.onload = () => {
            // ... same rotation logic ...
            if (rotation === 90 || rotation === 270) {
                canvas.width = img.height
                canvas.height = img.width
            } else {
                canvas.width = img.width
                canvas.height = img.height
            }

            if (!ctx) {
                resolve(file)
                return
            }

            ctx.translate(canvas.width / 2, canvas.height / 2)
            ctx.rotate((rotation * Math.PI) / 180)
            ctx.drawImage(img, -img.width / 2, -img.height / 2)

            canvas.toBlob((blob) => {
                if (blob) {
                    const rotatedFile = new File([blob], file.name, {
                        type: file.type,
                        lastModified: Date.now(),
                    })
                    resolve(rotatedFile)
                } else {
                    resolve(file)
                }
            }, file.type)
        }

        img.src = URL.createObjectURL(file)
    })
}

const handleFileUpload = (event: Event) => {
    const input = event.target as HTMLInputElement
    const files = Array.from(input.files || [])

    const maxPhotos = 10
    const availableSlots = maxPhotos - images.value.length

    if (availableSlots <= 0) {
        alert(`Maximum ${maxPhotos} photos allowed`)
        if (fileInput.value) fileInput.value.value = ''
        return
    }

    const filesToUpload = files.slice(0, availableSlots)

    try {
        filesToUpload.forEach((file, i) => {
            if (file.size > 5 * 1024 * 1024) {
                console.error(`File ${file.name} is too large`)
                return
            }

            const reader = new FileReader()
            reader.onload = (e) => {
                images.value.push({
                    id: Date.now() + i,
                    src: e.target?.result as string,
                    file: file,
                    rotation: 0,
                    isExisting: false
                })
                emitGalleryFiles()
            }
            reader.readAsDataURL(file)
        })

        if (fileInput.value) {
            fileInput.value.value = ''
        }
    } catch (error) {
        console.error('File upload error:', error)
    }
}

const removeImage = (id: number | string) => {
    const index = images.value.findIndex(img => img.id === id)
    if (index !== -1) {
        const img = images.value[index]
        if (img.isExisting) {
            deletedImageIds.value.push(img.id as number)
        }
        images.value.splice(index, 1)
        emitGalleryFiles()
    }
}

const rotateImage = (id: number | string) => {
    const image = images.value.find((img) => img.id === id)
    if (image) {
        // Rotation for existing images is only visual for now unless we implement backend rotation
        // For new images, it affects the uploaded file
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
.bg-muted {
    background-color: #e5e7eb;
}

.text-muted-foreground {
    color: #6b7280;
}

.placeholder-fade-enter-active,
.placeholder-fade-leave-active {
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.placeholder-fade-enter-from,
.placeholder-fade-leave-to {
    opacity: 0;
    transform: scale(0.8);
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
