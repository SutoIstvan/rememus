<template>

    <Head title="Create Memorial" />

    <form @submit.prevent="submitForm" class="space-y-6">
        <section
            class="hero-section pt-[190px] md:pt-[230px] lg:pt-[230px] xl:pt-[220px] bg-no-repeat bg-cover bg-top relative z-0"
            :style="{ backgroundImage: `url('${backgroundImage}')` }">

            <!-- Hero Title Content -->
            <div
                class="mx-auto px-4 md:px-6 lg:px-8 flex flex-col items-center relative z-10 mb-[100px] lg:mb-[130px] xl:mb-[210px]">
                <!-- Дополнительный контент можно добавить здесь -->
                <!-- Background Upload Button - перемещено вниз -->
                <div class="absolute mt-11 right-3 z-20 flex gap-3">
                    <!-- Remove Background Button -->
                    <div v-if="customBackground">
                        <button type="button" @click="removeBackground"
                            class="bg-red-500/80 hover:bg-red-500 text-white rounded-lg px-4 py-2 shadow-lg transition-all duration-200 hover:scale-105 flex items-center gap-2"
                            title="Вернуть стандартный фон">
                            <X class="w-4 h-4" />
                            <span class="text-sm font-medium">Убрать фон</span>
                        </button>
                    </div>

                    <!-- Upload Background Button -->
                    <div>
                        <input id="background-upload" type="file" accept="image/*" @change="handleBackgroundUpload"
                            class="hidden" />
                        <button type="button" @click="triggerBackgroundUpload"
                            class="bg-white/80 hover:bg-white cursor-pointer text-gray-700 hover:text-gray-900 rounded-lg px-4 py-2 shadow-lg transition-all duration-200 hover:scale-105 flex items-center gap-2"
                            title="Change background">
                            <ImageIcon class="w-5 h-5" />
                            <span class="text-sm font-medium">Change background</span>
                        </button>
                    </div>
                </div>
            </div>



            <!-- Hero Bottom Item -->
            <div class="w-full bg-white dark:bg-black">
                <div class="relative z-0">
                    <div
                        class="relative w-full bg-gradient-to-t from-white dark:from-background-8 from-50% to-transparent">
                    </div>
                    <div class="flex flex-col lg:flex-row">
                        <!-- Image Section -->
                        <div class="lg:flex-1/3 lg:pe-[42px]">
                            <div class="relative h-full max-lg:mx-auto">
                                <figure class="shadow-lg absolute lg:right-0 lg:bottom-0 w-[300px]
                                        max-lg:left-1/2 max-lg:-translate-x-1/2 max-lg:top-[-100px]
                                        bg-white dark:bg-background-9 rounded-[10px] overflow-hidden p-1 group">
                                    <img :src="previewImage || person.image" :alt="form.name || person.name"
                                        class="w-[300px] h-[300px] object-cover rounded-[10px]" />

                                    <!-- Upload Button Overlay -->
                                    <div class="absolute bottom-3 right-3">
                                        <input id="image-upload" type="file" accept="image/*" @change="handleFileUpload"
                                            class="hidden" />
                                        <button type="button" @click="triggerFileUpload"
                                            class="bg-white/80 hover:bg-white cursor-pointer text-gray-700 hover:text-gray-900 rounded-lg px-4 py-2 shadow-lg transition-all duration-200 hover:scale-105 flex items-center gap-2"
                                            title="Upload photo">
                                            <Camera class="w-5 h-5" />
                                            <span class="text-sm font-medium">Upload photo</span>
                                        </button>
                                    </div>

                                    <!-- Remove Button (показывается только если есть загруженное фото) -->
                                    <div v-if="selectedFile" class="absolute top-3 right-3">
                                        <button type="button" @click="removeImage"
                                            class="bg-red-500/90 hover:bg-red-500 text-white rounded-full p-2 shadow-lg transition-all duration-200 hover:scale-110"
                                            title="Удалить фото">
                                            <X class="w-4 h-4" />
                                        </button>
                                    </div>

                                    <!-- Upload Indicator -->
                                    <div v-if="!previewImage && !person.image"
                                        class="absolute inset-0 flex items-center justify-center bg-gray-100 dark:bg-gray-800 rounded-[10px]">
                                        <div class="text-center text-gray-500 dark:text-gray-400">
                                            <Camera class="w-12 h-12 mx-auto mb-2 opacity-50" />
                                            <p class="text-sm">Нажмите для загрузки фото</p>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>

                        <!-- Person Info Section -->
                        <div class="lg:flex-1/2 pt-[30px] max-lg:px-5 max-lg:text-center max-lg:mt-[200px]">
                            <h2 class="w-97">
                                <Input id="name" name="name" type="text" placeholder="Enter Name" class="w-full text-lg"
                                    v-model="form.name" autofocus />
                                <InputError :message="form.errors.name" />
                            </h2>

                            <ul class="list-none space-y-2 mb-8 max-lg:!mb-0 mt-5">
                                <li
                                    class="flex items-center gap-3 mb-3 justify-center lg:justify-start text-pretty text-xl tracking-tighter xl:text-4xl/none sm:text-3xl">
                                    <!-- Дата рождения -->
                                    <div class="mb-4">
                                        <DatePicker name="birth_date" placeholder="Выберите дату рождения"
                                            v-model="form.birth_date" />
                                        <InputError :message="form.errors.birth_date" />
                                    </div>

                                    <!-- Дата смерти -->
                                    <div class="mb-4">
                                        <DatePicker name="death_date" placeholder="Выберите дату смерти"
                                            v-model="form.death_date" />
                                        <InputError :message="form.errors.death_date" />
                                    </div>
                                </li>

                                <li
                                    class="mt-5 flex items-center gap-3 mb-3 justify-center lg:justify-start w-full max-w-md">
                                    <div class="relative w-97">
                                        <!-- Иконка внутри инпута -->
                                        <MapPin
                                            class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-muted-foreground" />

                                        <!-- Сам инпут -->
                                        <Input v-model="form.grave_location" name="grave_location" type="text"
                                            placeholder="Enter location" class="pl-10 w-full text-lg" />
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Секция загрузки изображения - можно убрать, так как загрузка теперь в блоке изображения -->
        <!-- <div class="mt-6 space-y-4">
            <Label for="image">Фото для мемориала</Label>
            <div class="flex items-center space-x-4">
                <input 
                    id="image"
                    type="file" 
                    accept="image/*"
                    @change="handleFileUpload" 
                    class="file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100"
                />
                <Button 
                    type="button" 
                    @click="removeImage" 
                    variant="outline"
                    v-if="selectedFile"
                >
                    Удалить
                </Button>
            </div>
            <InputError :message="form.errors.image" />
        </div> -->

        <!-- Кнопка отправки -->
        <div class="mt-6">
            <Button type="submit" class="w-full" :disabled="form.processing">
                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin mr-2" />
                Создать мемориал
            </Button>
        </div>
    </form>
</template>

<script setup lang="ts">
import BlurReveal from '@/components/ui/blur-reveal/BlurReveal.vue'
import { MapPin, Calendar, Calendar1, Camera, X, ImageIcon } from "lucide-vue-next";
import { Input } from '@/components/ui/input';
import { ref, watch, onMounted, computed } from "vue";
import DatePicker from '@/components/DatePicker.vue';
import MemorialController from '@/actions/App/Http/Controllers/MemorialController';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Form, Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

// Определяем props от Laravel контроллера
const props = defineProps({
    person: {
        type: Object,
        default: () => ({
            name: 'Arnold Shannon',
            image: '/images/front/testimonial-1.jpg',
            birthYear: '1975 jan 15',
            deathYear: '2023 mar 23',
            location: 'Jacksonville, Florida'
        })
    }
})

// Определяем интерфейс для данных формы
interface MemorialFormData {
    name: string;
    birth_date: string;
    death_date: string;
    grave_location: string;
    image?: File;
    background_image?: File; // Добавляем поле для фонового изображения
}

// Инициализируем форму
const form = useForm<MemorialFormData>({
    name: '',
    birth_date: '',
    death_date: '',
    grave_location: '',
    image: undefined,
    background_image: undefined // Добавляем поле для фонового изображения
})

// Реактивные переменные для работы с изображением
const selectedFile = ref<File | null>(null)
const previewImage = ref<string | null>(null)

// Реактивные переменные для работы с фоновым изображением
const customBackground = ref<File | null>(null)
const backgroundImage = ref<string>('/images/front/hero-bg.png') // стандартный фон

// Функция для программного клика по input file
const triggerFileUpload = () => {
    const fileInput = document.getElementById('image-upload') as HTMLInputElement
    fileInput?.click()
}

// Функция для загрузки фонового изображения
const triggerBackgroundUpload = () => {
    const fileInput = document.getElementById('background-upload') as HTMLInputElement
    fileInput?.click()
}

// Обработчик загрузки файла аватара
const handleFileUpload = (event: Event) => {
    const target = event.target as HTMLInputElement
    const file = target.files?.[0]

    if (file) {
        // Проверяем тип файла
        if (!file.type.startsWith('image/')) {
            alert('Пожалуйста, выберите изображение')
            return
        }

        // Проверяем размер файла (например, макс 5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('Размер файла не должен превышать 5MB')
            return
        }

        selectedFile.value = file
        form.image = file

        // Создаем превью изображения
        const reader = new FileReader()
        reader.onload = (e) => {
            previewImage.value = e.target?.result as string
        }
        reader.readAsDataURL(file)
    }
}

// Обработчик загрузки фонового изображения
const handleBackgroundUpload = (event: Event) => {
    const target = event.target as HTMLInputElement
    const file = target.files?.[0]

    if (file) {
        // Проверяем тип файла
        if (!file.type.startsWith('image/')) {
            alert('Пожалуйста, выберите изображение')
            return
        }

        // Проверяем размер файла (например, макс 10MB для фона)
        if (file.size > 10 * 1024 * 1024) {
            alert('Размер файла не должен превышать 10MB')
            return
        }

        customBackground.value = file
        form.background_image = file // Добавляем файл в форму

        // Создаем превью фонового изображения
        const reader = new FileReader()
        reader.onload = (e) => {
            backgroundImage.value = e.target?.result as string
        }
        reader.readAsDataURL(file)
    }
}

// Удаление изображения аватара
const removeImage = () => {
    selectedFile.value = null
    previewImage.value = null
    form.image = undefined

    // Очищаем input
    const fileInput = document.getElementById('image-upload') as HTMLInputElement
    if (fileInput) {
        fileInput.value = ''
    }
}

// Удаление фонового изображения
const removeBackground = () => {
    customBackground.value = null
    backgroundImage.value = '/images/front/hero-bg.png' // возвращаем стандартный фон
    form.background_image = undefined // Убираем из формы

    // Очищаем input
    const fileInput = document.getElementById('background-upload') as HTMLInputElement
    if (fileInput) {
        fileInput.value = ''
    }
}

// Отправка формы
const submitForm = () => {
    // Если есть изображения, отправляем как multipart/form-data
    if (form.image || form.background_image) {
        form.post('/memorials', {
            forceFormData: true,
            onSuccess: () => {
                // Обработка успешной отправки
                console.log('Memorial created successfully')
            },
            onError: (errors) => {
                // Обработка ошибок
                console.error('Form submission errors:', errors)
            }
        })
    } else {
        // Обычная отправка формы
        form.post('/memorials')
    }
}
</script>

<style scoped>
.picker-group {
    display: flex;
    gap: 4px;
}
</style>