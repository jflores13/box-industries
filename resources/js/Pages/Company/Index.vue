<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Hero from '@/Pages/Company/Hero_Figma.vue';
import InNumbers from '@/Pages/Company/InNumbers.vue';
import WhatWeStandFor from '@/Pages/Company/WhatWeStandFor.vue';
import Partners from '@/Components/Containers/Partners.vue';
import { Head } from '@inertiajs/vue3';
import { useTexts } from '@/composables/useTexts';

defineOptions({ layout: AppLayout });

const { texts: companyTexts } = useTexts('company');

</script>

<template>
  <Head :title="companyTexts.title || 'Company'" />
    <!-- Hero Section -->
    <Hero />
    <!-- Statistics Section -->
    <InNumbers />
    <!-- What We Stand For Section -->
    <WhatWeStandFor />
    <!-- Partners Section -->
    <section class="text-black bg-gray-100 py-16 font-bold">
      <div class="w-full max-w-7xl mx-auto px-6 text-2xl">
        <p class="leading-relaxed">{{ companyTexts.our_experience }}</p>
      </div>
    </section>
</template>
