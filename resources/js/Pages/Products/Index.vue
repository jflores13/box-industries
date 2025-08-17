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
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Product ID
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    On Carousel
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-if="!products || products.length === 0">
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No products found. 
                                    <Link href="/admin/products/create" class="text-blue-600 hover:text-blue-800 underline ml-1">
                                        Create your first product
                                    </Link>
                                </td>
                            </tr>
                            <tr v-for="product in products" :key="product.id" v-else>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ product.name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ product.product_id || '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ product.category || '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span :class="product.on_carrousel ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'" 
                                          class="inline-flex px-2 py-1 text-xs font-semibold rounded-full">
                                        {{ product.on_carrousel ? 'Yes' : 'No' }}
                                    </span>
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
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>