<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    products: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <Head title="Products" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Products</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-end mb-4">
                    <Link
                        href="/admin/products/create"
                        class="px-4 py-2 bg-blue-600 text-white rounded"
                    >
                        New Product
                    </Link>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 shadow">
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
                        <tbody v-if="products.length > 0" class="bg-white divide-y divide-gray-200">
                            <tr v-for="product in products" :key="product.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ product.name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                    <Link
                                        :href="`/admin/products/${product.id}/edit`"
                                        class="text-indigo-600 hover:text-indigo-900"
                                    >
                                        Edit
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else class="p-6 text-center text-gray-500">
                            <tr class="flex">
                                <td class="flex px-6 py-4 whitespace-nowrap">
                                    No products found.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
