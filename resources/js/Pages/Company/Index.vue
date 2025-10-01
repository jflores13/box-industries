<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TheFooter from '@/Components/TheFooter.vue';
import Hero from '@/Pages/Company/Hero_Figma.vue';
import InNumbers from '@/Pages/Company/InNumbers.vue';
import WhatWeStandFor from '@/Pages/Company/WhatWeStandFor.vue';
import Partners from '@/Components/Containers/Partners.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({ layout: AppLayout });

</script>

<template>
  <Head title="Company" />
    <!-- Hero Section -->
    <Hero />
    <!-- Statistics Section -->
    <InNumbers />
    <!-- What We Stand For Section -->
    <WhatWeStandFor />
    <!-- Partners Section -->
    <section class="text-black bg-gray-100 py-16 font-bold">
      <div class="w-full max-w-7xl mx-auto px-6 text-2xl">
        <p class="leading-relaxed">
          With over a decade of experience, Box Industries designs and manufactures 
          strategic, high-performance packaging solutions. We optimize every detail 
          — from raw materials to logistics — to deliver agile, scalable, and cost-efficient 
          results.
        </p>
        <p class="leading-relaxed mt-4">
          Trusted by leading global industries, including long-term partnerships in many 
          sectors.
        </p>
      </div>
      <Partners class="w-full max-w-7xl mx-auto" />
    </section>

    <TheFooter />
</template>
