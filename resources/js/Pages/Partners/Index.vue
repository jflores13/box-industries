<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    partners: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <Head title="Partners" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Partners</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-end mb-4">
                    <Link
                        href="/admin/partners/create"
                        class="px-4 py-2 bg-blue-600 text-white rounded"
                    >
                        New Partner
                    </Link>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Image
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Alt Text
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Order
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="partner in partners" :key="partner.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img :src="`/storage/${partner.image_path}`" :alt="partner.alt_text" class="h-16 w-16 object-cover" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ partner.alt_text }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ partner.sort_order }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                    <Link
                                        :href="`/admin/partners/${partner.id}/edit`"
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
