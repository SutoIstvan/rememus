<script setup lang="ts">
import { CheckboxPill } from '@/components/ui/checkbox-pill'
import { Input } from '@/components/ui/input'
import { Textarea } from '@/components/ui/textarea'

const props = defineProps<{
  characteristics: string[]
  hobbies: string[]
  customTraits: string
  additionalHobbies: string
  retirement: string
  habits: string
  stories: string
  wisdom: string
}>()

const emit = defineEmits([
  'update:characteristics',
  'update:hobbies',
  'update:customTraits',
  'update:additionalHobbies',
  'update:retirement',
  'update:habits',
  'update:stories',
  'update:wisdom',
])

const CHARACTERISTICS = [
  { value: 'cheerful', label: 'Humorous' },
  { value: 'kind', label: 'Kind' },
  { value: 'helpful', label: 'Helpful' },
  { value: 'family-centered', label: 'Family-centered' },
  { value: 'wise', label: 'Wise / thoughtful' },
  { value: 'moody', label: 'Moody' },
  { value: 'strict-fair', label: 'Strict but fair' },
  { value: 'creative', label: 'Creative / artistic' },
  { value: 'precise', label: 'Precise / orderly' },
  { value: 'brave', label: 'Brave' },
  { value: 'religious', label: 'Religious / devout' },
  { value: 'calm', label: 'Calm' },
  { value: 'energetic', label: 'Energetic' },
  { value: 'charitable', label: 'Charitable' },
  { value: 'stubborn', label: 'Stubborn' },
]

const HOBBIES = [
  { value: 'gardening', label: 'Gardening' },
  { value: 'fishing', label: 'Fishing' },
  { value: 'crafting', label: 'Crafting / DIY' },
  { value: 'traveling', label: 'Traveling' },
  { value: 'cooking', label: 'Cooking / baking' },
  { value: 'music', label: 'Music' },
  { value: 'reading', label: 'Reading' },
  { value: 'sports', label: 'Sports' },
  { value: 'dancing', label: 'Dancing' },
  { value: 'animal-care', label: 'Animal care' },
  { value: 'collecting', label: 'Collecting' },
  { value: 'volunteering', label: 'Volunteering' },
]

const toggleCharacteristic = (value: string) => {
  const newArray = props.characteristics.includes(value)
    ? props.characteristics.filter(v => v !== value)
    : [...props.characteristics, value]
  emit('update:characteristics', newArray)
}

const toggleHobby = (value: string) => {
  const newArray = props.hobbies.includes(value)
    ? props.hobbies.filter(v => v !== value)
    : [...props.hobbies, value]
  emit('update:hobbies', newArray)
}
</script>

<template>
  <div class="space-y-10 max-w-3xl mx-auto">
    <div class="text-center space-y-5 mx-auto mt-10 md:mt-[70px]">
      <span class="badge badge-green">
        Memories
      </span>

      <p class="text-muted-foreground max-w-xl mx-auto px-3 sm:px-1">
        This section collects memories, life experiences, and personal traits to help create a respectful and meaningful
        biography.
      </p>
    </div>

    <!-- CHARACTERISTICS -->
    <section class="max-w-3xl mx-auto px-3 sm:px-1">
      <h3 class="text-lg font-medium mb-4 mt-12">
        Characteristics, Values, and Principles
      </h3>

      <div class="flex flex-row flex-wrap gap-2">
        <CheckboxPill v-for="item in CHARACTERISTICS" :key="item.value" :id="`char-${item.value}`" :label="item.label"
          :checked="characteristics.includes(item.value)" @update:checked="toggleCharacteristic(item.value)" />
      </div>

      <div class="mt-4">
        <Input placeholder="Other personality traits, values..." :model-value="customTraits"
          @update:model-value="emit('update:customTraits', $event)" />
      </div>
    </section>

    <!-- HOBBIES -->
    <section class="max-w-3xl mx-auto px-3 sm:px-1">
      <h3 class="text-lg font-medium mb-4">
        Hobbies and Passions
      </h3>

      <div class="flex flex-row flex-wrap gap-2">
        <CheckboxPill v-for="item in HOBBIES" :key="item.value" :id="`hobby-${item.value}`" :label="item.label"
          :checked="hobbies.includes(item.value)" @update:checked="toggleHobby(item.value)" />
      </div>

      <div class="mt-4">
        <Input placeholder="Additional hobbies..." :model-value="additionalHobbies"
          @update:model-value="emit('update:additionalHobbies', $event)" />
      </div>
    </section>

    <!-- TEXT SECTIONS -->
    <section class="max-w-3xl mx-auto px-3 sm:px-1">
      <div>
        <h3 class="text-lg font-medium mb-2">
          Retirement years

          <label for="retirement" class="text-sm font-normal text-muted-foreground">
            How did they spend their retirement years? What did they do during this time? Did they travel? Was there a
            favorite place where they liked to relax?
          </label>
        </h3>
        <Textarea id="retirement" rows="3"
          placeholder="Example: They spent their retirement years in their garden, loved pruning roses, and every summer vacationed at Lake Balaton with the family."
          :model-value="retirement" @update:model-value="emit('update:retirement', $event)" />
      </div>

      <div>
        <h3 class="text-lg font-medium mb-2">
          Memorable habits

          <label for="habits" class="text-sm font-normal text-muted-foreground">
            Was there a small habit that everyone remembers?
          </label>
        </h3>
        <Textarea id="habits" rows="3"
          placeholder="Examples: Always drank coffee at the kitchen table in the mornings. / Baked fresh brioche every Sunday. / Surprised everyone with handmade cards for every birthday."
          :model-value="habits" @update:model-value="emit('update:habits', $event)" />
      </div>

      <div>
        <h3 class="text-lg font-medium mb-2">
          Memorable stories

          <label for="stories" class="text-sm font-normal text-muted-foreground">
            A story, event, or characteristic that we will always remember
          </label>
        </h3>
        <Textarea id="stories" rows="3"
          placeholder="Examples: Once accidentally turned the garden hose on himself, and everyone laughed. / Gave gifts every Christmas wearing a funny hat."
          :model-value="stories" @update:model-value="emit('update:stories', $event)" />
      </div>

      <div>
        <h3 class="text-lg font-medium mb-2">
          Wisdom

          <label for="wisdom" class="text-sm font-normal text-muted-foreground">
            What was the life wisdom they left behind for us?
          </label>
        </h3>
        <Textarea id="wisdom" rows="3" placeholder="What advice or wisdom did they share in life?" :model-value="wisdom"
          @update:model-value="emit('update:wisdom', $event)" />
      </div>
    </section>
  </div>
</template>