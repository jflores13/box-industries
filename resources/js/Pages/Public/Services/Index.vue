<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Hero from '@/Pages/Public/Services/Hero_Figma.vue';
import ServicesList from '@/Pages/Public/Services/ServicesList.vue';
import { Services } from '@/data';
import { useTexts } from '@/composables/useTexts';

defineOptions({ layout: AppLayout });

const { texts: servicesTexts } = useTexts('services');

</script>

<template>
    <Head :title="servicesTexts.title || 'Services'" />
    <Hero />
    <section class="w-full bg-box-brown py-12 mx-auto sm:px-6 lg:px-8">
        <div class="w-full max-w-7xl px-6 mx-auto">
            <h1 class="text-5xl font-bold mb-6 text-box-yellow">{{ servicesTexts.services_section_title }}</h1>
        </div>
        <ServicesList :services="Services" />
    </section>
</template>
