<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Hero from '@/Pages/Public/Services/Hero_Figma.vue';
import ServicesList from '@/Pages/Public/Services/ServicesList.vue';
import TheFooter from '@/Components/TheFooter.vue';
import { Services } from '@/data';

defineOptions({ layout: AppLayout });

</script>

<template>
    <Head title="Services" />
    <Hero />
    <section class="w-full bg-box-brown py-12 mx-auto sm:px-6 lg:px-8">
        <div class="w-full max-w-7xl px-6 mx-auto">
            <h1 class="text-5xl font-bold mb-6 text-box-yellow">Development</h1>
        </div>
        <ServicesList :services="Services" />
    </section>
    <TheFooter mode="light" />
</template>
