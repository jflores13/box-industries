<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    service: Object,
});

const page = usePage();
const isSuperAdmin = computed(() => page.props.auth.user?.role === 'super_admin');

const form = useForm({
    name_en: props.service.name_en,
    name_es: props.service.name_es,
    short_en: props.service.short_en ?? '',
    short_es: props.service.short_es ?? '',
    long_en: props.service.long_en ?? '',
    long_es: props.service.long_es ?? '',
});

function submit() {
    form.put(`/admin/services/${props.service.id}`);
}

function destroy() {
    if (confirm('Are you sure you want to delete this service?')) {
        form.delete(`/admin/services/${props.service.id}`);
    }
}
</script>

<template>
    <Head title="Edit Service" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Service
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="bg-white shadow sm:rounded-lg p-6 space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input v-model="form.name_en" type="text" placeholder="Name (EN)" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        <span v-if="form.errors.name" class="text-red-500 text-xs">{{ form.errors.name }}</span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name (ES)</label>
                        <input v-model="form.name_es" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Short Description (EN)</label>
                        <textarea v-model="form.short_en" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Short Description (ES)</label>
                        <textarea v-model="form.short_es" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Long Description (EN)</label>
                        <textarea v-model="form.long_en" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Long Description (ES)</label>
                        <textarea v-model="form.long_es" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            Update
                        </button>
                        <button
                            v-if="isSuperAdmin"
                            @click.prevent="destroy"
                            type="button"
                            class="px-4 py-2 bg-red-600 text-white rounded"
                        >
                            Delete
                        </button>
                        <Link :href="'/admin/services'" class="px-4 py-2 bg-gray-300 rounded">Cancel</Link>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>