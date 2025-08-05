<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    products: {
        type: Array,
        default: () => [],
    },
});

defineOptions({ layout: AppLayout });
</script>

<template>
    <Head title="Products" />

    <div class="min-h-screen bg-gray-100 py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-6">Our Products</h1>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <div
                    v-for="product in products"
                    :key="product.id"
                    class="bg-white overflow-hidden shadow-sm rounded-lg p-6"
                >
                    <h2 class="text-xl font-semibold mb-2">{{ product.name }}</h2>
                    <p class="text-gray-700 mb-4">
                        {{ product.short_description || 'No description provided.' }}
                    </p>
                    <a
                        v-if="product.button_link"
                        :href="product.button_link"
                        target="_blank"
                        class="text-blue-600 hover:underline"
                    >
                        {{ product.button_text || 'Learn more' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
