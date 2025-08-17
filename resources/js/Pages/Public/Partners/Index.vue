<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    partners: {
        type: Array,
        default: () => [],
    },
});

defineOptions({ layout: AppLayout });
</script>

<template>
    <Head title="Partners" />

    <div class="min-h-screen bg-gray-100 py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-6">Our Partners</h1>

            <div class="grid gap-6 md:grid-cols-3 lg:grid-cols-4">
                <div
                    v-for="partner in partners"
                    :key="partner.id"
                    class="bg-white overflow-hidden shadow-sm rounded-lg p-6 flex items-center justify-center"
                >
                    <img :src="`/storage/${partner.image_path}`" :alt="partner.alt_text" class="h-24 w-24 object-cover" />
                </div>
            </div>
        </div>
    </div>
</template>
