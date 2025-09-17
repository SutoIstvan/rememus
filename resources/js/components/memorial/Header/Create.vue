<script setup lang="ts">
import MemorialController from '@/actions/App/Http/Controllers/MemorialController';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Form, Head } from '@inertiajs/vue3';
import DatePicker from '@/components/DatePicker.vue';
import { LoaderCircle } from 'lucide-vue-next';

</script>

<template>
    <div class="max-w-2xl mx-auto bg-white dark:bg-background-9 shadow rounded-lg p-8 mt-8">
        <Head title="Создать мемориал" />

        <h1 class="text-2xl font-bold mb-6">Создать мемориал</h1>

        <Form v-bind="MemorialController.store.form()" v-slot="{ errors, processing }">
            <!-- Имя -->
            <div class="mb-4">
                <Label for="name">Имя</Label>
                <Input id="name" name="name" type="text" placeholder="Введите имя" autofocus />
                <InputError :message="errors.name" />
            </div>

            <!-- Дата рождения -->
            <div class="mb-4">
                <Label for="birth_date">Дата рождения</Label>
                <DatePicker name="birth_date" placeholder="Выберите дату рождения" />
                <InputError :message="errors.birth_date" />
            </div>

            <!-- Дата смерти -->
            <div class="mb-4">
                <Label for="death_date">Дата смерти</Label>
                <DatePicker name="death_date" placeholder="Выберите дату смерти" />
                <InputError :message="errors.death_date" />
            </div>

            <!-- Кнопка отправки -->
            <div class="mt-6">
                <Button class="w-full" :disabled="processing">
                    <LoaderCircle v-if="processing" class="h-4 w-4 animate-spin mr-2" />
                    Создать мемориал
                </Button>
            </div>
        </Form>
    </div>
</template>
