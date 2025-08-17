<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    partner: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    image: null,
    alt_text: props.partner.alt_text || '',
    sort_order: props.partner.sort_order || 0,
});

function submit() {
    form.post(`/admin/partners/${props.partner.id}`, { forceFormData: true, _method: 'put' });
}
</script>

<template>
    <Head title="Edit Partner" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Partner
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="bg-white shadow sm:rounded-lg p-6 space-y-6" enctype="multipart/form-data">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Current Image</label>
                        <img :src="`/storage/${props.partner.image_path}`" :alt="props.partner.alt_text" class="h-16 w-16 object-cover mb-2" />
                        <input type="file" @change="form.image = $event.target.files[0]" class="mt-1 block w-full" />
                        <p class="text-xs text-gray-500 mt-1">Image should be 600x600 px.</p>
                        <span v-if="form.errors.image" class="text-red-500 text-xs">{{ form.errors.image }}</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alt Text</label>
                        <input v-model="form.alt_text" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        <span v-if="form.errors.alt_text" class="text-red-500 text-xs">{{ form.errors.alt_text }}</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Order</label>
                        <input v-model="form.sort_order" type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        <span v-if="form.errors.sort_order" class="text-red-500 text-xs">{{ form.errors.sort_order }}</span>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
