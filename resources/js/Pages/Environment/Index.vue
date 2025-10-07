<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Hero from '@/Pages/Environment/Hero.vue';
import OurResponsibility from '@/Pages/Environment/OurResponsibility.vue';
import Certifications from '@/Pages/Environment/Certifications.vue';
import { Head } from '@inertiajs/vue3';
import { useTexts } from '@/composables/useTexts';

defineOptions({ layout: AppLayout });

const { texts: environmentTexts } = useTexts('environment');

</script>

<template>
  <Head :title="environmentTexts.title || 'Environment'" />
  <Hero />
  <OurResponsibility />
  <Certifications />
</template>
