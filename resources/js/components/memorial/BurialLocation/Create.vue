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

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm font-medium mb-2 block">Parcel</label>
                        <Input placeholder="Parcel number" :model-value="graveParcel"
                            @update:model-value="emit('update:graveParcel', $event)" />
                    </div>
                    <div>
                        <label class="text-sm font-medium mb-2 block">Row</label>
                        <Input placeholder="Row number" :model-value="graveLine"
                            @update:model-value="emit('update:graveLine', $event)" />
                    </div>
                    <div>
                        <label class="text-sm font-medium mb-2 block">Number</label>
                        <Input placeholder="Grave number" :model-value="graveNumber"
                            @update:model-value="emit('update:graveNumber', $event)" />
                    </div>
                </div>
            </div>
        </section>

        <!-- COORDINATES SECTION -->
        <section class="max-w-4xl mx-auto">
            <h3 class="text-lg font-medium mb-4 flex items-center gap-2">
                GPS Coordinates
                <span class="text-sm font-normal text-muted-foreground">
                    (optional)
                </span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <Input placeholder="E.g. 47.497912, 42.458989" :model-value="coordinates"
                        @update:model-value="emit('update:coordinates', $event)" />
                    <small class="text-muted-foreground">
                        Enter coordinates manually or they will be extracted from the uploaded photo.
                    </small>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="flex-1">
                            <label class="text-sm font-medium mb-2 block flex items-center gap-2">
                                <ImageIcon class="size-4" />
                                Upload Photo with Location
                            </label>
                            <input type="file" accept="image/*" @change="onFileChange"
                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" />
                            <small class="text-muted-foreground">
                                Accepted formats: JPG, JPEG, PNG, WEBP. Max: 20 MB.
                            </small>
                        </div>
                    </div>

                    <div v-if="photoPreview" class="mt-4">
                        <div class="border rounded-lg p-2 bg-muted/50 inline-block">
                            <img :src="photoPreview" alt="Grave photo preview"
                                class="rounded-lg max-h-40 object-cover shadow" />
                        </div>
                        <p class="mt-2 text-sm text-muted-foreground">
                            Uploaded photo
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
