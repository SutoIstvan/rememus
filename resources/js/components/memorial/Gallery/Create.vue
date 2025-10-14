<template>
    <div class="mx-auto max-w-3xl space-y-4 pt-1 text-center">
        <div class="text-center space-y-5 mx-auto mt-10 md:mt-[7px]">
            <span v-scroll-animate="{ delay: 200 }" class="badge badge-green">
                Gallery
            </span>
        </div>
        <p class="text-muted-foreground">
            You can upload photos and drag and drop them by simply capturing the image. <br> The maximum size of one photo is 5 megabytes.
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
        <div class="grid grid-cols-4 gap-3 pt-6 sm:grid-cols-3 md:grid-cols-6">
            <transition-group name="smooth-drag" tag="div" class="contents">
                <draggable key="draggable" v-model="images" item-key="id" :animation="300" :ghost-class="'ghost'"
                    :drag-class="'dragging'" @start="drag = true" @end="onDragEnd" class="contents"
                    handle=".drag-handle">
                    <template #item="{ element }">
                        <div class="h-30 rounded-md relative group hover:cursor-pointer"
                            :class="{ 'border-0 border-red-500': drag }">
                            <img 
                                :src="element.src" 
                                :style="{ transform: `rotate(${element.rotation}deg)` }"
                                class="w-full h-30 object-cover rounded-md transition-transform duration-300" 
                                alt="Uploaded photo" 
                            />
                            <!-- Drag Handle Icon -->
                            <div
                                class="drag-handle absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-70 transition-opacity bg-black bg-opacity-30 rounded-md">
                                <GripHorizontal class="w-6 h-6 text-white" />
                            </div>
                            <!-- Rotate Icon -->
                            <button
                                type="button"
                                class="absolute top-1 left-1 bg-blue-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity hover:bg-blue-600"
                                @click="rotateImage(element.id)"
                                title="Rotate 90°">
                                <RotateCw class="w-4 h-4" />
                            </button>
                            <!-- Delete Icon -->
                            <button
                                type="button"
                                class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600"
                                @click="removeImage(element.id)"
                                title="Delete">
                                <Trash2 class="w-4 h-4" />
                            </button>
                        </div>
                    </template>
                </draggable>
                <div v-for="index in placeholderCount" :key="`placeholder-${index}`" class="h-30 rounded-md bg-muted">
                </div>
            </transition-group>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import draggable from 'vuedraggable'
import { GripHorizontal, Trash2, Upload, RotateCw } from 'lucide-vue-next'

interface ImageItem {
    id: number
    src: string
    file: File
    rotation: number
}

const emit = defineEmits<{
    (e: 'update:gallery-files', files: File[]): void
}>()

const images = ref<ImageItem[]>([])
const drag = ref(false)
const fileInput = ref<HTMLInputElement | null>(null)

const placeholderCount = computed(() => {
    return images.value.length < 6 ? 6 - images.value.length : 0
})

const emitGalleryFiles = () => {
    // Создаем массив промисов для поворота изображений
    const promises = images.value.map(async (img) => {
        if (img.rotation === 0) {
            return img.file
        }
        // Если изображение повернуто, создаем новый файл с поворотом
        return await rotateImageFile(img.file, img.rotation)
    })

    Promise.all(promises).then((files) => {
        emit('update:gallery-files', files)
    })
}

// Функция для поворота файла изображения
const rotateImageFile = async (file: File, rotation: number): Promise<File> => {
    return new Promise((resolve) => {
        const img = new Image()
        const canvas = document.createElement('canvas')
        const ctx = canvas.getContext('2d')

        img.onload = () => {
            // Определяем размеры canvas в зависимости от угла поворота
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

            // Перемещаем начало координат в центр
            ctx.translate(canvas.width / 2, canvas.height / 2)
            // Поворачиваем
            ctx.rotate((rotation * Math.PI) / 180)
            // Рисуем изображение
            ctx.drawImage(img, -img.width / 2, -img.height / 2)

            // Конвертируем canvas в blob и затем в File
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
    
    // Ограничение: максимум 10 фото
    const maxPhotos = 10
    const availableSlots = maxPhotos - images.value.length
    
    if (availableSlots <= 0) {
        alert(`Вы можете загрузить максимум ${maxPhotos} фотографий`)
        if (fileInput.value) fileInput.value.value = ''
        return
    }
    
    const filesToUpload = files.slice(0, availableSlots)
    
    if (files.length > availableSlots) {
        alert(`Загружено ${filesToUpload.length} из ${files.length} фотографий. Лимит: ${maxPhotos}`)
    }
    
    try {
        filesToUpload.forEach((file, i) => {
            // Проверка размера файла (5MB)
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
                    rotation: 0
                })
                emitGalleryFiles()
            }
            reader.onerror = () => console.error('Error reading file:', file.name)
            reader.readAsDataURL(file)
        })
        
        // Reset the file input
        if (fileInput.value) {
            fileInput.value.value = ''
        }
    } catch (error) {
        console.error('File upload error:', error)
    }
}

const removeImage = (id: number) => {
    images.value = images.value.filter((image) => image.id !== id)
    emitGalleryFiles()
}

const rotateImage = (id: number) => {
    const image = images.value.find((img) => img.id === id)
    if (image) {
        // Поворачиваем на 90 градусов, после 270 возвращаемся к 0
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

.smooth-drag-enter-active,
.smooth-drag-leave-active {
    transition: all 0.3s ease;
}

.smooth-drag-enter-from,
.smooth-drag-leave-to {
    opacity: 0;
    transform: translateY(10px);
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