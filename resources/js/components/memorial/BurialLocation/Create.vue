<script setup lang="ts">
import { ref } from 'vue'
import { Input } from '@/components/ui/input'
import { Button } from '@/components/ui/button'
import { MapPinIcon, ImageIcon } from 'lucide-vue-next'

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

const onFileChange = (e: Event) => {
    const file = (e.target as HTMLInputElement).files?.[0]
    if (!file) return

    emit('update:gravePhoto', file)

    const reader = new FileReader()
    reader.onload = (event) => {
        photoPreview.value = event.target?.result as string
    }
    reader.readAsDataURL(file)
}
</script>

<template>
    <div class="space-y-10 px-4 md:px-6 lg:px-8">
        <div class="text-center space-y-5 mx-auto mt-1 md:mt-[30px]">
            <!-- <span class="badge badge-green">
                Burial Location
            </span> -->

            <p class="text-muted-foreground">
                Here you can enter the cemetery address and exact coordinates to make it easier for relatives to find
                <br>
                the resting place. This feature helps your loved ones get to the specified location quickly
                <br> and easily, paying tribute to the memory.
            </p>
        </div>

        <!-- ADDRESS SECTION -->
        <section class="max-w-4xl mx-auto">
            <h3 class="text-lg font-medium mb-4 mt-12 flex items-center gap-2">
                <MapPinIcon class="size-5" />
                Cemetery Address
            </h3>

            <div class="space-y-4">
                <Input placeholder="E.g. Central Cemetery, Main Street 123" :model-value="graveLocation"
                    @update:model-value="emit('update:graveLocation', $event)" />

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
            <h3 class="text-lg font-medium mb-4 flex items-center gap-2">
                Location Details
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- LEFT COLUMN: Inputs -->
                <div class="space-y-6">
                    <!-- Coordinates Input -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium">
                            GPS Coordinates <span class="text-muted-foreground font-normal">(optional)</span>
                        </label>
                        <Input placeholder="E.g. 47.497912, 42.458989" :model-value="coordinates"
                            @update:model-value="emit('update:coordinates', $event)" />
                        <p class="text-[0.8rem] text-muted-foreground">
                            Enter coordinates manually or they will be extracted from the uploaded photo.
                        </p>
                    </div>

                    <!-- File Upload Input -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium flex items-center gap-2">
                            <ImageIcon class="size-4" />
                            Upload Photo with Location
                        </label>
                        <input type="file" accept="image/*" @change="onFileChange"
                            class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" />
                        <p class="text-[0.8rem] text-muted-foreground">
                            Accepted formats: JPG, JPEG, PNG, WEBP. Max: 20 MB.
                        </p>
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
