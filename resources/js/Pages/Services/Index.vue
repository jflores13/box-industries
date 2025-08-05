<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    services: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <Head title="Services" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Services</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-end mb-4">
                    <Link
                        href="/admin/services/create"
                        class="px-4 py-2 bg-blue-600 text-white rounded"
                    >
                        New Service
                    </Link>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="service in services" :key="service.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ service.name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                    <Link
                                        :href="`/admin/services/${service.id}/edit`"
                                        class="text-indigo-600 hover:text-indigo-900"
                                    >
                                        Edit
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>