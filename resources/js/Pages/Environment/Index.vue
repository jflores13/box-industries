<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Hero from '@/Pages/Environment/Hero.vue';
import OurResponsibility from '@/Pages/Environment/OurResponsibility.vue';
import Certifications from '@/Pages/Environment/Certifications.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({ layout: AppLayout });

</script>

<template>
  <Head title="Environment" />
  <Hero />
  <OurResponsibility />
  <Certifications />
</template>
