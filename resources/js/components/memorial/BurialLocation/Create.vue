<script setup lang="ts">
import { ref } from 'vue'
import exifr from 'exifr'
import { Input } from '@/components/ui/input'
import { Button } from '@/components/ui/button'
import { MapPin, ImageIcon } from 'lucide-vue-next'
import {
    HoverCard,
    HoverCardContent,
    HoverCardTrigger,
} from '@/components/ui/hover-card'

const props = defineProps<{
    graveLocation: string
    graveParcel: string
    graveLine: string
    graveNumber: string
    coordinates: string
    gravePhoto: File | null
}>()

const emit = defineEmits([
    'update:graveLocation',
    'update:graveParcel',
    'update:graveLine',
    'update:graveNumber',
    'update:coordinates',
    'update:gravePhoto',
])

const photoPreview = ref<string | null>(null)

const onFileChange = async (e: Event) => {
    const file = (e.target as HTMLInputElement).files?.[0]
    if (!file) return

    emit('update:gravePhoto', file)

    // Extract EXIF GPS coordinates
    try {
        const exifData = await exifr.parse(file, { gps: true })

        if (exifData?.latitude && exifData?.longitude) {
            const coordinates = `${exifData.latitude}, ${exifData.longitude}`
            emit('update:coordinates', coordinates)
        } else {
            emit('update:coordinates', 'Photo has no GPS coordinates')
        }
    } catch (error) {
        console.warn('Failed to extract GPS data from image:', error)
        emit('update:coordinates', 'Photo has no GPS coordinates')
    }

    // Show preview
    const reader = new FileReader()
    reader.onload = (event) => {
        photoPreview.value = event.target?.result as string
    }
    reader.readAsDataURL(file)
}
</script>

<template>
    <div class="space-y-10 max-w-3xl mx-auto px-3 sm:px-1">
        <div class="text-center space-y-5 mx-auto mt-1 md:mt-[30px]">
            <!-- <span class="badge badge-green">
                Burial Location
            </span> -->

            <p class="text-muted-foreground max-w-2xl mx-auto">
                Here you can enter the cemetery address and exact coordinates to make it easier for relatives to find
                the resting place. This feature helps your loved ones get to the specified location quickly and easily,
                paying tribute to the memory.
            </p>
        </div>

        <!-- ADDRESS SECTION -->
        <section class="max-w-4xl mx-auto">
            <!-- <h3 class="text-lg font-medium mb-4 mt-12 flex items-center gap-2">
                <MapPinIcon class="size-5" />
                Cemetery Address
            </h3> -->

            <div class="space-y-4">
                <Input placeholder="Cemetery Address (E.g. Central Cemetery, Main Street 123)"
                    :model-value="graveLocation" @update:model-value="emit('update:graveLocation', $event)" />

                <div class="w-full">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <Input placeholder="Parcel number" :model-value="graveParcel"
                            @update:model-value="emit('update:graveParcel', $event)" class="w-full" />

                        <Input placeholder="Row number" :model-value="graveLine"
                            @update:model-value="emit('update:graveLine', $event)" class="w-full" />

                        <Input placeholder="Grave number" :model-value="graveNumber"
                            @update:model-value="emit('update:graveNumber', $event)" class="w-full" />
                    </div>

                </div>
            </div>
        </section>

        <!-- COORDINATES SECTION -->
        <section class="max-w-4xl mx-auto">


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- LEFT COLUMN: Inputs -->
                <div class="space-y-6">
                    <!-- Coordinates Input -->
                    <div class="space-y-2">

                        <Input placeholder="GPS Coordinates (47.497912, 42.458989)" :model-value="coordinates"
                            @update:model-value="emit('update:coordinates', $event)" />
                        <p class="text-[0.8rem] text-muted-foreground ms-1">
                            Enter coordinates manually or they will be extracted from the uploaded photo.
                        </p>

                    </div>

                    <!-- File Upload Input -->
                    <div class="space-y-2">
                        <!-- <label class="text-sm font-medium flex items-center gap-2">
                            <ImageIcon class="size-4" />
                            Upload Photo with Location
                        </label> -->
                        <div class="relative">
                            <label for="image-upload"
                                class="flex h-10 w-full items-center rounded-md border border-input bg-background px-3 py-2 text-sm cursor-pointer">
                                <span class="text-muted-foreground">Choose image</span>

                                <ImageIcon class="ml-auto w-4 h-4 text-muted-foreground" />
                            </label>

                            <input id="image-upload" type="file" accept="image/*" capture="environment"
                                @change="onFileChange" class="hidden" />
                        </div>

                        <p class="text-[0.8rem] text-muted-foreground ms-1">
                            We will not display your photo on the website.
                            The image is used only to extract GPS coordinates (location data) from the photo
                            metadata.
                        </p>

                        <div class="text-[0.8rem] text-muted-foreground flex flex-col gap-1 mt-2">

                            <div class="flex items-center gap-3 ms-1">
                                <span class="flex items-center gap-2">
                                    <span class="text-xs font-medium">Enable GPS Location:</span>
                                </span>
                                <!-- iOS Hover Card -->

                                <HoverCard>
                                    <HoverCardTrigger as-child>
                                        <div
                                            class="flex items-center gap-1 cursor-help hover:text-foreground transition-colors group">
                                            <span class="underline decoration-dotted underline-offset-4 text-xs">iOS
                                                Video</span>
                                        </div>
                                    </HoverCardTrigger>
                                    <HoverCardContent class="w-90 p-0 border-none">
                                        <div class="aspect-video w-full">
                                            <iframe width="100%" height="100%"
                                                src="https://www.youtube.com/embed/5FjW6CGXD6k?autoplay=1&mute=1&loop=1&playlist=5FjW6CGXD6k"
                                                title="iOS Location Settings" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen class="rounded-t-md"></iframe>
                                        </div>
                                        <div class="p-4 space-y-2">
                                            <h4 class="text-sm font-semibold">iOS: Turn on Camera Location</h4>
                                            <p class="text-xs text-muted-foreground">
                                                Go to Settings > Privacy > Location Services > Camera > While Using
                                                the
                                                App.
                                            </p>
                                        </div>
                                    </HoverCardContent>
                                </HoverCard>

                                <span class="text-muted-foreground/30">|</span>

                                <!-- Android Hover Card -->
                                <HoverCard>
                                    <HoverCardTrigger as-child>
                                        <div
                                            class="flex items-center gap-1 cursor-help hover:text-foreground transition-colors group">
                                            <span class="underline decoration-dotted underline-offset-4 text-xs">Android
                                                Video</span>
                                        </div>
                                    </HoverCardTrigger>
                                    <HoverCardContent class="w-90 p-0 border-none">
                                        <div class="aspect-video w-full">
                                            <iframe width="100%" height="100%"
                                                src="https://www.youtube.com/embed/5FjW6CGXD6k?autoplay=1&mute=1&loop=1&playlist=5FjW6CGXD6k"
                                                title="Android Location Settings" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen class="rounded-t-md"></iframe>
                                        </div>
                                        <div class="p-4 space-y-2">
                                            <h4 class="text-sm font-semibold">Android: Geo-tag Photos</h4>
                                            <p class="text-xs text-muted-foreground">
                                                Open Camera > Settings > Enable "Location tags" or "Save location".
                                            </p>
                                        </div>
                                    </HoverCardContent>
                                </HoverCard>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN: Photo Preview (Persistent Gray Box) -->
                <div>
                    <div
                        class="w-full h-[230px] aspect-video bg-muted/50 rounded-lg flex items-center justify-center overflow-hidden relative">
                        <img v-if="photoPreview" :src="photoPreview" alt="Grave photo preview"
                            class="w-full h-full object-cover" />
                        <div v-else class="text-center p-4 text-muted-foreground">
                            <ImageIcon class="size-10 mx-auto mb-2 opacity-20" />
                            <span class="text-xs">No photo selected</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
