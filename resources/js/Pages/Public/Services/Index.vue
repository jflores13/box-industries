<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Hero from '@/Pages/Public/Services/Hero.vue';
import ServicesList from '@/Pages/Public/Services/ServicesList.vue';
import TheFooter from '@/Components/TheFooter.vue';

defineProps({
    services: {
        type: Array,
        default: () => [],
    },
});

defineOptions({ layout: AppLayout });

</script>

<template>
    <Head title="Services" />
    <Hero />
    <section class="min-h-screen bg-gray-100 py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-6 text-box-yellow text-3xl">Development</h1>
        </div>
        <ServicesList :services="services" />
    </section>
    <TheFooter mode="light" />
</template>
