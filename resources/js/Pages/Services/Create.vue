<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    short_description: '',
    long_description: '',
});

function submit() {
    form.post('/services');
}
</script>

<template>
    <Head title="Create Service" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Service
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="bg-white shadow sm:rounded-lg p-6 space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input v-model="form.name" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        <span v-if="form.errors.name" class="text-red-500 text-xs">{{ form.errors.name }}</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Short Description</label>
                        <textarea v-model="form.short_description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        <span v-if="form.errors.short_description" class="text-red-500 text-xs">{{ form.errors.short_description }}</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Long Description</label>
                        <textarea v-model="form.long_description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        <span v-if="form.errors.long_description" class="text-red-500 text-xs">{{ form.errors.long_description }}</span>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>